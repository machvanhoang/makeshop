@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('_alert_total'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('_alert_total') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">1. #Makeshop の商品総数</div>
                    <div class="card-body">
                        <form action="{{ route('async.total_product') }}" role="form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">総製品</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="total_product"
                                            value="{{ old('total_product') ? old('total_product') : $setting->total_product }}"
                                            class="form-control" id="total_product">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                    <path fill-rule="evenodd"
                                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                </svg> &nbsp; 総製品の更新
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-3">
                @if (session('_alert_checking'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('_alert_checking') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">2. #Makeshop のデータをチェック</div>
                    <div class="card-body">
                        <form action="{{ route('async.checking') }}" role="form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">行動</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <button type="submit" class="btn btn-async btn-warning">
                                                <span class="d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                    </svg> &nbsp; データの確認
                                                </span>
                                            </button>
                                            @if (!empty($last_checking))
                                                <div class="timer-checking ms-3">
                                                    <span class="time_start">{{ $last_checking->time_start }}</span>
                                                    <span class="time-arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                        </svg></span>
                                                    <span class="time_end">{{ $last_checking->time_end }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-3">

                @if (session('_alert_async'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('_alert_async') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">3. すべてのデータを同期する.</div>
                    <div class="card-body">
                        <form action="{{ route('async.async') }}" role="form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">行動</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <button type="submit" class="btn btn-async btn-warning">
                                                <span class="d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-repeat"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                    </svg> &nbsp; データ同期
                                                </span>
                                            </button>
                                            @if (!empty($last_async))
                                                <div class="timer-checking ms-2">
                                                    <span class="time_start">{{ $last_async->time_start }}</span>
                                                    <span class="time-arrow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-arrow-right"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                        </svg></span>
                                                    <span class="time_end">{{ $last_async->time_end }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-3">
                <div class="card">
                    <div class="card-header">4. 1 つの製品を同期する.</div>
                    <div class="card-body">
                        <form action="{{ route('async.async_single') }}" role="form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">行動</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="form-group me-3">
                                                <input type="text" name="brand_code" id="brand_code"
                                                    class="form-control" placeholder="brand_code" value="000000017010">
                                            </div>
                                            <button type="submit" class="btn btn-async btn-warning">
                                                <span class="d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-repeat"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                    </svg> &nbsp; データ同期単品
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.btn-async').on('click', function(e) {
            $('.loading-fixed').addClass('active');
        });
    </script>
@endsection
