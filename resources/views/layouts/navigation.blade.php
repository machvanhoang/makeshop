<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="@guest {{ url('/') }} @else {{ route('home') }} @endguest">
            <img src="https://allgrow-labo.jp/vn/images/company/logo_agLabo.svg" width="200" height="32"
                alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                @guest
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}"
                            title="{{ __('製品一覧') }}">{{ __('製品一覧') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.index') }}"
                            title="{{ __('カテゴリー') }}">{{ __('カテゴリー') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarImport" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            商品
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarImport">
                            <a class="dropdown-item" href="{{ route('import.product') }}"
                                title="商品情報をcsvで登録">商品情報をcsvで登録</a>
                            <a class="dropdown-item" href="{{ route('import.category') }}" title="CSVのカテゴリー情報を登録">CSVのカテゴリー情報を登録</a>
                            <a class="dropdown-item" href="{{ route('import.product-category') }}"
                                title="商品カテゴリ情報をcsvで登録">商品カテゴリ情報をcsvで登録</a>
                        </ul>
                    </li>
                @endguest
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
