@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">1. Instructions to get the
                        <span class="text-info bold">
                            URL PARSE
                        </span> #Makeshop
                    </div>
                    <div class="card-body">
                        <ol>
                            <li>
                                Video tutorial to get Makeshop's PARSE URL to sync data <br />
                                <div class="block-infomation mb-2 mt-2">
                                    <div class="block-body">
                                        <span>ID: AKI1</span> <br />
                                        <span>Password: ronro3150</span>
                                    </div>
                                </div>
                                <a href="https://www.makeshop.jp/main/reseller/login/"
                                    target="blank">https://www.makeshop.jp/main/reseller/login/</a> <br />
                                <a href="https://apidoc.makeshop.jp/product_search_sample/"
                                    target="blank">https://apidoc.makeshop.jp/product_search_sample/</a> <br />
                                <a class="btn btn-warning mt-3" target="blank"
                                    href="{{ asset('/video/support_token.mp4') }}">Watching video</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-3">
                @if (session('_alert_token'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('_alert_token') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">2. Generate ACCESS_TOKEN #Makeshop</div>
                    <div class="card-body">
                        <form action="{{ route('settings.parse_access_token') }}" role="form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="url_parse" class="form-label">URL PARSE</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="url_parse" value="" class="form-control"
                                            id="url_parse">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path
                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                        <path fill-rule="evenodd"
                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                    </svg> &nbsp; GET TOKEN
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-3">
                @if (session('_alert_data'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('_alert_data') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">3. Setting data on #Makeshop</div>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" role="form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="shop_id" class="form-label">Shop ID</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="shop_id" value="{{ $setting->shop_id }}"
                                            class="form-control" id="shop_id">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn-copy" type="button" title="Copy"
                                            data-text="{{ $setting->shop_id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <small class="d-none">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="auth_code" class="form-label">Auth code</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="auth_code" class="form-control" id="auth_code"
                                            value="{{ $setting->auth_code }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn-copy" type="button" title="Copy"
                                            data-text="{{ $setting->auth_code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="access_token" class="form-label">ACCESS TOKEN</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="access_token" value="{{ $setting->access_token }}"
                                            readonly class="form-control" id="access_token">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="process" class="form-label">Process</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="process" class="form-control" readonly
                                            id="process" value="{{ $setting->process }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn-copy" type="button" title="Copy"
                                            data-text="{{ $setting->process }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="response_format" class="form-label">Response format</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="response_format" class="form-control" readonly
                                            id="response_format" value="{{ $setting->response_format }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn-copy" type="button" title="Copy"
                                            data-text="{{ $setting->response_format }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="d-flex justify-conten-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path
                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                        <path fill-rule="evenodd"
                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                    </svg> &nbsp; Update
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.btn-copy').on('click', function(e) {
            e.preventDefault();
            const text = $(this).data('text');
            $('.btn-copy').removeClass('active');
            $(this).addClass('active');
            navigator.clipboard.writeText(text);
        });
    </script>
@endsection
