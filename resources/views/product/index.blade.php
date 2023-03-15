@extends('layouts.app')

@section('content')
    <style>
        .trundcat {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 600px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 15px;
        }

        .nav-paginate {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-paginate .hidden {
            display: none
        }

        .nav-paginate a {
            text-decoration: none;
            color: inherit;
        }

        .badge {
            display: inline-block;
            font-size: 75%;
            padding: 3px;
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
        }

        .badge-pill {
            padding-right: 0.6em;
            padding-left: 0.6em;
            border-radius: 10rem;
        }

        .badge-success {
            color: #fff;
            background-color: #007bff;
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('ダッシュボード') }}</div>

                    <div class="card-body">
                        <form method="GET" role="form" action="{{ route('product.index') }}">
                            <div class="d-flex justify-content-start">
                                <div class="form-group">
                                    <input type="text" name="keyword" class="form-control" value="{{ $keyword }}"
                                        placeholder="検索キーワードを入力してください">
                                </div>
                                <div class="form-group ms-2">
                                    <select class="form-control" name="orderBy">
                                        <option value="NONE">ソート順</option>
                                        <option value="DESC" {{ $orderBy === 'DESC' ? 'selected' : '' }}>DESC</option>
                                        <option value="ASC" {{ $orderBy === 'ASC' ? 'selected' : '' }}>ASC</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary ms-2" title="検索">検索</button>
                            </div>
                        </form>
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>名前</th>
                                    <th>画像</th>
                                    <th>価格</th>
                                    <th>ブランドコード</th>
                                    <th>カテゴリー</th>
                                    <th>スターテス</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            <h3 class="trundcat">
                                                {{ $product->name }}
                                            </h3>
                                        </td>
                                        <td>
                                            <img width="50" height="50"
                                                src="https://makeshop-multi-images.akamaized.net/2448/itemimages/{{ $product->image_big }}"
                                                alt="{{ $product->name }}" />
                                        </td>
                                        <td>
                                            {{ $product->price }}
                                        </td>
                                        <td>
                                            {{ $product->brand_code }}
                                        </td>
                                        <td>
                                            @if ($product->ProductCategories->count())
                                                @foreach ($product->ProductCategories as $category)
                                                    <span
                                                        class="badge badge-pill badge-success">{{ $category->Category->category_code }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->is_display != 'N')
                                                <span class="badge badge-pill badge-success">画面</span>
                                            @else
                                                <span class="badge badge-secondary badge-success">隠れる</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="nav-paginate">
                            {{ $products->links('layouts.paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
