$(document).ready(function () {
    $('#submit-excel').on('click', function (e) {
        let file = $('#file_excel')[0].files[0];
        if (!file) {
            alert("ファイルが選択されていません！");
            return;
        }

        let reader = new FileReader();
        reader.readAsArrayBuffer(file);
        reader.onload = function (e) {
            let data = new Uint8Array(e.target.result);
            let workbook = XLSX.read(data, {type: 'array'});
            let firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            let jsonData = XLSX.utils.sheet_to_json(firstSheet, {header: 1});

            $('.loading-fixed').addClass('active');
            let headers = extractHeaders(jsonData);
            chunkAndSendFiles(jsonData, headers, 200, $('#submit-excel').data('url'));
        };
    });

    async function chunkAndSendFiles(data, headers, chunkSize, url) {
        let totalChunks = Math.ceil(data.length / chunkSize);
        toastr.info('完了した進捗状況: 0/' + totalChunks)

        for (let i = 0; i < totalChunks; i++) {
            let chunk = [headers, ...data.slice(i * chunkSize + 1, (i + 1) * chunkSize + 1)];

            // Create new workbook and worksheet
            let newWorkbook = XLSX.utils.book_new();
            let newWorksheet = XLSX.utils.aoa_to_sheet(chunk);
            XLSX.utils.book_append_sheet(newWorkbook, newWorksheet, 'Sheet1');

            // Convert workbook to a Blob
            let workbookOut = XLSX.write(newWorkbook, {bookType: 'xlsx', type: 'array'});
            let blob = new Blob([workbookOut], {type: 'application/octet-stream'});

            let formData = new FormData();
            formData.append('file_excel', blob, `chunk_${i + 1}.xlsx`);
            try {
                await sendFile(url, formData, i + 1, totalChunks);
            } catch (error) {
                break;
            }
        }

        $('#file').val('');
        $('.loading-fixed').removeClass('active');
        toastr.success('データの追加が成功しました');

        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    function sendFile(url, formData, chunkNumber, totalChunk) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    resolve(response);
                    toastr.info('完了した進捗状況: ' + chunkNumber + '/' + totalChunk)
                },
                error: function (xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function extractHeaders(data) {
        return data[0];
    }
});
