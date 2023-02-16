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
                @if (session('_alert_failures'))
                    <div class="col-sm-12">
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <ul class="p-0 m-0">
                                @foreach (Session::get('_alert_failures') as $error)
                                    行 {{ $error->row() }} は無効です。 ファイルをもう一度確認してください
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center pt-2 pb-2">
                        <h5 class="p-0 m-0">1. 製品 #Makeshop でカテゴリをインポート</h5>
                        <a href="{{ asset('/video/video-product.mp4') }}" target="blank"
                            class="m-0 p-0 d-flex justify-content-between align-item-center text-decoration-none"><span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-download" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg></span> &nbsp;&nbsp;ビデオチュートリアル</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('import.product') }}" role="form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">ファイル エクセル</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" name="file_excel" value="" class="form-control"
                                            id="file_excel">
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
                                                </svg> &nbsp; データのインポート
                                            </span>
                                        </button>
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
