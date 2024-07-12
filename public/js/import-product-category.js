$(document).ready(function() {
    $('#submit-excel').on('click', function(e) {
        let file = $('#file_excel')[0].files[0];
        if (!file) {
            alert("ファイルが選択されていません！");

            return;
        }

        let reader = new FileReader();
        reader.readAsArrayBuffer(file);
        reader.onload = function(e) {
            let data = new Uint8Array(e.target.result);
            let workbook = XLSX.read(data, { type: 'array' });
            let firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            let jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1});

            chunkAndSendFiles(jsonData, 1000, $('#submit-excel').data('url'));
        };
    });

    async function chunkAndSendFiles(data, chunkSize, url) {
        let totalChunks = Math.ceil(data.length / chunkSize);
        let headers = data[0];

        $('.loading-fixed').addClass('active');
        for (let i = 0; i < totalChunks; i++) {
            let chunk = [headers, ...data.slice(i * chunkSize + 1, (i + 1) * chunkSize + 1)];
            let csvContent = arrayToCSV(chunk);

            let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });

            let formData = new FormData();
            formData.append('file_excel', blob, `chunk_${i + 1}.csv`);

            try {
                await sendFile(url, formData, i + 1);
            } catch (error) {
                break;
            }
        }
        $('.loading-fixed').removeClass('active');
        $('#file_excel').val('');

        alert('データの追加が成功しました！');
    }

    function sendFile(url, formData, chunkNumber) {
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
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function arrayToCSV(arrayData) {
        return arrayData.map(row => row.join(',')).join('\n');
    }
});
