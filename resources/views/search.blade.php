<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="/">
    <link rel="icon" type="image/png" href="https://allgrow-labo.jp/images/favicon/favicon-32x32.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カスタム検索 MakeShop</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.min.css">
    <link rel="stylesheet" href="{{ asset('/makeshop/style.css') }}">
    <link rel="stylesheet" href="https://gigaplus.makeshop.jp/2448/lib/css/wine-creator.css">
    <script src="{{ asset('/makeshop/listSearch.js') }}"></script>
    <script>
        const API = 'https://makeshop_tool.local';
        const DEFAULT_PAGE = `${API}/api/product/search?page=1`;
    </script>
    <script src="{{ asset('/makeshop/totalCategory.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.min.js"></script>
</head>

<body>
    <div id="appRoot">
        <div v-if="loader" class="containerLoader">
            <div class="loader-wrapper">
                <div class="loader-admin">
                    <div class="preloader">
                        <div class="spinner-layer">
                            <div class="circle-clipper float-left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper float-right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                    <p>お待ちください...</p>
                </div>
            </div>
        </div>
        <div class="container-search">
            <div class="siderbar-search">
                <button class="siderbar-search_close">
                    <img src="https://gigaplus.makeshop.jp/2448/lib/images/common/close.gif" alt="閉じる">
                </button>
                <button class="siderbar-search_back">
                    <svg viewBox="0 0 20 20" class="svg-left" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                        </path>
                    </svg>
                </button>
                <h2 class="sp-modalBtn-title">絞り込み　<span>全 @{{ totalProduct }} 件</span></h2>
                <div class="sp-modalBtn">
                    <div class="action-search sp-modalBtn-click">
                        <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                            選択したお好みワイン条件を検索する
                        </button>
                    </div>
                    <div class="category-checked_deletbtn">
                        <span v-on:click="resetSetting()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            選択した条件をクリアする
                        </span>
                    </div>
                </div>
                <div class="siderbar-search_spWrap">
                    <section class="box-checked-categories">
                        <div>
                            <h2 class="siderbar-search_title" v-if="categories.length > 0">選択した条件</h2>
                            <ul class="category-checked">
                                <li v-for="(item, index) in categories">
                                    <span>@{{ item.name }}</span>
                                </li>
                            </ul>
                            <div class="category-checked_deletbtn" v-if="categories.length > 0">
                                <span v-on:click="resetSetting()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                    選択した条件をクリアする
                                </span>
                            </div>
                        </div>
                    </section>
                    <section class="box-search" id="search_price">
                        <h2 class="siderbar-search_title">価格</h2>
                        <div class="siderbar-search_under">

                            <div class="box-search_inner">
                                <div class="flex-price">
                                    <div class="min-price">
                                        <input type="number" min="0" v-bind:max="arraySearch.price_max"
                                            ref="price_min" id="price_min" class="form-control" placeholder="0">
                                    </div>
                                    <div class="icon">
                                        <span>円 &#12316;</span>
                                    </div>
                                    <div class="max-price">
                                        <input type="number" min="0" v-bind:max="arraySearch.price_max"
                                            ref="price_max" id="price_max" class="form-control" placeholder="1.000.000">
                                    </div>
                                    <div class="icon">
                                        <span>円</span>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                                    選択したお好みワイン条件を検索する
                                </button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_categories">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">タイプ</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('category')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-for="(item, index) in listSearch.categories" class="item-checkbox">
                                        <label v-bind:for="`category_${item.code}`">
                                            <input type="checkbox" name="size[]" v-model="arraySearch.category"
                                                :value="item.code" v-bind:id="`category_${item.code}`"
                                                class="custom-form-checkbox" />
                                            <span>@{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                                    選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_origin">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">産地</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('origin')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div class="item-checkbox">
                                        <label for="all-origin">
                                            <input type="checkbox" ref="origin_all" name="all-origin"
                                                v-on:click="handleAllOrigin($event)" value="all-origin"
                                                id="all-origin" class="custom-form-checkbox" />
                                            <span>すべて</span>
                                        </label>
                                    </div>
                                    <div v-for="(item, index) in listSearch.origin" class="list-origin">
                                        <div v-if="item.child"
                                            v-bind:class="{ 'btn-open': true, 'active': isOpen(item.code, 'level2') }">
                                            <div class="item-checkbox">
                                                <label v-bind:for="`body_level_1_${item.code}`">
                                                    <input type="checkbox" v-bind:id="`body_level_1_${item.code}`"
                                                        class="custom-form-checkbox" v-model="this.bodyLevel.level2"
                                                        v-bind:value="item.code"
                                                        v-on:click="IsDemo($event, item, 'level1')" />
                                                    <span>@{{ item.name }}</span>
                                                </label>
                                                <div
                                                    v-bind:class="{ 'icon-open': true, 'active': isOpen(item.code, 'level2') }">
                                                    <svg viewBox="0 0 20 20" class="svg-down"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                        </path>
                                                    </svg>
                                                    <svg viewBox="0 0 20 20" class="svg-left"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div
                                                v-bind:class="{'none-block':true, 'block':isOpen(item.code, 'level2') }">
                                                <div v-for="(item_child, index_child) in item.array_child"
                                                    class="list-orign-lv2">
                                                    <div v-if="item_child.child"
                                                        v-bind:class="{ 'btn-open': true, 'active': isOpen(item_child.code, 'level3') }">
                                                        <div class="item-checkbox">
                                                            <label v-bind:for="`body_level_2_${item_child.code}`">
                                                                <input type="checkbox"
                                                                    v-bind:id="`body_level_2_${item_child.code}`"
                                                                    class="custom-form-checkbox"
                                                                    v-model="this.bodyLevel.level3"
                                                                    v-bind:value="item_child.code"
                                                                    v-on:click="IsDemo($event, item_child, 'level2')" />
                                                                <span>@{{ item_child.name }}</span>
                                                            </label>
                                                            <div
                                                                v-bind:class="{ 'icon-open': true, 'active': isOpen(item_child.code, 'level3') }">
                                                                <svg viewBox="0 0 20 20" class="svg-down"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                                    </path>
                                                                </svg>
                                                                <svg viewBox="0 0 20 20" class="svg-left"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div
                                                            v-bind:class="{ 'none-block': true, 'active': isOpen(item_child.code, 'level3') }">
                                                            <div v-for="(item_child_lv2, index_child_lv2) in item_child.array_child"
                                                                class="item-checkbox">
                                                                <label v-bind:for="`type_${item_child_lv2.code}`">
                                                                    <input type="checkbox" name="origin"
                                                                        v-bind:value="item_child_lv2.code"
                                                                        v-model="arraySearch.origin"
                                                                        v-bind:id="`type_${item_child_lv2.code}`"
                                                                        class="custom-form-checkbox" />
                                                                    <span>@{{ item_child_lv2.name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="item-checkbox">
                                                            <label v-bind:for="`type_${item_child.code}`">
                                                                <input type="checkbox" name="origin"
                                                                    v-bind:value="item_child.code"
                                                                    v-model="arraySearch.origin"
                                                                    v-bind:id="`type_${item_child.code}`"
                                                                    class="custom-form-checkbox" />
                                                                <span>@{{ item_child.name }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="item-checkbox">
                                                <label v-bind:for="`origin_${item.code}`">
                                                    <input type="checkbox" name="origin" v-bind:value="item.code"
                                                        v-model="arraySearch.origin" v-bind:id="`origin_${item.code}`"
                                                        class="custom-form-checkbox" />
                                                    <span>@{{ item.name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()"> 選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_type">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">品種</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('type')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-for="(item, index) in listSearch.type" class="list-type">
                                        <div v-if="item.child" class="btn-open">
                                            <div class="block-button">
                                                <button class="hover-underline">
                                                    <div class="flex">
                                                        <svg viewBox="0 0 20 20" class="svg-down"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                            </path>
                                                        </svg>
                                                        <svg viewBox="0 0 20 20" class="svg-left"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                            </path>
                                                        </svg>
                                                        <span>@{{ item.name }}</span>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="none-block">
                                                <div v-for="(item_child, index_child) in item.array_child"
                                                    class="item-checkbox">
                                                    <label v-bind:for="`type_${item_child.code}`">
                                                        <input type="checkbox" name="type[]"
                                                            v-bind:value="item_child.code" v-model="arraySearch.type"
                                                            v-bind:id="`type_${item_child.code}`"
                                                            class="custom-form-checkbox" />
                                                        <span>@{{ item_child.name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="item-checkbox">
                                                <label v-bind:for="`type_${item.code}`">
                                                    <input type="checkbox" name="type[]" v-bind:value="item.code"
                                                        v-model="arraySearch.type" v-bind:id="`type_${item.code}`"
                                                        class="custom-form-checkbox" />
                                                    <span>@{{ item.name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()"> 選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_size">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">サイズ</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('size')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-for="(item, index) in listSearch.size" class="item-checkbox">
                                        <label v-bind:for="`size_${item.id}`">
                                            <input type="checkbox" name="size[]" v-model="arraySearch.size"
                                                :value="item.code" v-bind:id="`size_${item.id}`"
                                                class="custom-form-checkbox" />
                                            <span>@{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()"> 選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_vintage">
                        <h2 class="siderbar-search_title title-open active"><span
                                class="title-text">ヴィンテージ</span><span class="sp_insert"
                                v-html="showNameCheckboxCategory('vintage')"></span>
                        </h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-for="(item, index) in listSearch.vintage" class="item-checkbox">
                                        <label v-bind:for="`vintage_${item.id}`">
                                            <input type="checkbox" name="vintage[]" v-model="arraySearch.vintage"
                                                :value="item.code" v-bind:id="`vintage_${item.id}`"
                                                class="custom-form-checkbox" />
                                            <span>@{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                                    選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_ranker">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">格付け</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('ranker')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-for="(item, index) in listSearch.ranker" class="list-ranker">
                                        <div v-if="item.child" class="btn-open">
                                            <div class="block-button">
                                                <button class="hover-underline">
                                                    <div class="flex">
                                                        <svg viewBox="0 0 20 20" class="svg-down"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                            </path>
                                                        </svg>
                                                        <svg viewBox="0 0 20 20" class="svg-left"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                            </path>
                                                        </svg>
                                                        <span>@{{ item.name }}</span>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="none-block">
                                                <div v-for="(item_child, index_child) in item.array_child"
                                                    class="item-checkbox">
                                                    <label v-bind:for="`ranker_${item_child.code}`">
                                                        <input type="checkbox" name="ranker[]"
                                                            v-bind:value="item_child.code"
                                                            v-model="arraySearch.ranker"
                                                            v-bind:id="`ranker_${item_child.code}`"
                                                            class="custom-form-checkbox" />
                                                        <span>@{{ item_child.name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="item-checkbox">
                                                <label v-bind:for="`ranker_${item.code}`">
                                                    <input type="checkbox" name="ranker[]" v-bind:value="item.code"
                                                        v-model="arraySearch.ranker" v-bind:id="`ranker_${item.code}`"
                                                        class="custom-form-checkbox" />
                                                    <span>@{{ item.name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()"> 選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_body">
                        <h2 class="siderbar-search_title title-open active"><span
                                class="title-text">味わいから探す</span><span class="sp_insert"
                                v-html="showNameCheckboxCategory('body')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div v-if="checking.body" class="item-checkbox">
                                        <label for="body-all">
                                            <input type="checkbox" ref="body_all" name="body-all"
                                                v-on:click="handleAllBody($event)" value="body-all" id="body-all"
                                                class="custom-form-checkbox" />
                                            <span>すべて</span>
                                        </label>
                                    </div>
                                    <div v-for="(item, index) in listSearch.body" class="item-checkbox">
                                        <label v-if="showItemBody(item.parent)" v-bind:for="`body_${item.id}`">
                                            <input type="checkbox" name="body[]" v-model="arraySearch.body"
                                                :value="item.code" v-bind:id="`body_${item.id}`"
                                                class="custom-form-checkbox" />
                                            <span>@{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                                    選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                    <section style="display: none !important" class="box-search btn-open" id="production_keyword">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">キーワード</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('keyword')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-keyword">
                                    <div class="main-keyword">
                                        <div class="keyword-input">
                                            <input type="text" ref="keyword" id="keyword" name="keyword"
                                                placeholder="キーワード、商品ID、ブランドコード" />
                                        </div>
                                        <div class="keyword-button">
                                            <button type="button" v-on:click="onSearch()" title="検索">検索</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="box-search btn-open" id="search_inventory">
                        <h2 class="siderbar-search_title title-open active"><span class="title-text">在庫状況</span><span
                                class="sp_insert" v-html="showNameCheckboxCategory('inventory')"></span></h2>
                        <div class="siderbar-search_under none-block" style="display: block;">
                            <div class="box-search_inner">
                                <div class="flex-type">
                                    <div class="item-checkbox">
                                        <label for="inventory-stocking">
                                            <input type="radio" name="inventory" value="stocking"
                                                id="inventory-stocking" class="custom-form-checkbox"
                                                v-model="arraySearch.inventory" />
                                            <span>在庫がある商品を表示</span>
                                        </label>
                                    </div>
                                    <div class="item-checkbox">
                                        <label for="inventory-all">
                                            <input type="radio" name="inventory" value="all" checked
                                                id="inventory-all" class="custom-form-checkbox"
                                                v-model="arraySearch.inventory" />
                                            <span>在庫が無い商品も表示</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="action-search sp-action_back">
                                <button type="button" v-on:click="onSearch()" title="選択したお好みワイン条件を検索する">
                                    選択したお好みワイン条件を検索する</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="main-search" ref="main-search">
                <div class="like-winetitleWrap">
                    <div class="titleArea">
                        <p class="title_sub">Find your favorite wine</p>
                        <h2 class="title_main">お好みワインを検索</h2>
                    </div>
                    <p class="like-wine_infoText">
                        複数の条件を選択することで、<br>
                        サイト内の商品から、お好みのワインを絞り込むことができます。<br>
                        自分の好みに合わせたぴったりなワインを見つけられます。
                    </p>
                    <div class="titleArea">
                        <p class="title_sub">results</p>
                        <h2 class="title_main">検索結果</h2>
                    </div>
                    <ul class="category-checked_resultsList" v-if="categories.length > 0">
                        <li v-for="(item, index) in categories">
                            <span>@{{ item.name }}</span>
                        </li>
                    </ul>
                    <div class="total-search mb-2 ps-3">全 @{{ totalProduct }}</span> 件
                    </div>
                </div>
                <div class="result-search">
                    <div class="product-wrap">
                        <ul class="category_itemArea_ul">
                            <li v-for="(item, index) in dataItems" key="index" v-bind:index="index"
                                v-bind:price="item.price">
                                <div class="itemImg">
                                    <a v-bind:href="getUrl(item.brand_code)" target="blank" v-bind:title="item.name">
                                        <img v-bind:src="getImage(item.image_big)" v-bind:alt="item.name"
                                            loading="lazy">
                                    </a>
                                    @{{ item.id }}
                                </div>
                                <div class="itemDetail">
                                    <h3 class="name">
                                        <a v-bind:href="getUrl(item.brand_code)" target="blank"
                                            v-html="item.name"></a>
                                    </h3>
                                    <p class="price">&yen;@{{ formatPrice(item.price_tax) }}<span
                                            class="price_small">（税込）</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div v-if="totalProduct" class="paging-search">
                    <ul>
                        <li v-for="(item, index) in links" v-on:click="onPaging(item.url)"
                            v-bind:class="{ active: item.active, disabled: (item.url === null ? true : false ) }">
                            <span v-html="item.label"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <button class="sp-likewine_fixedBtn">お好みワインを検索する</button>
    <div class="sp-likewine_fixedBtn_back"></div>
    <script>
        function removeItem(array, item) {
            let index = array.indexOf(item);
            if (index != -1) {
                array.splice(index, 1);
            }
            return array;
        }
        const {
            createApp
        } = Vue;
        const ALL = "all";
        const MIN_PRICE = 0;
        const MAX_PRICE = 1000000;
        const DEFAULT_SIZE = getSize()[0]['codes'];
        const DEFAULT_RANKER = getRanker()[0]['codes'];
        const DEFAULT_VINTAGE = getVintage()[0]['codes'];
        const DEFAULT_BODY_HIDDEN_BUTTON_ALL = ["ct636", "ct637", "ct639", "ct640", "ct642"];
        createApp({
            data() {
                return {
                    dataItems: [],
                    listSearch: [],
                    loader: false,
                    arraySearch: {
                        price_min: MIN_PRICE,
                        price_max: MAX_PRICE,
                        category: [],
                        origin: [],
                        type: [],
                        body: [],
                        size: [],
                        vintage: [],
                        ranker: [],
                        keyword: "",
                        inventory: ALL,
                    },
                    links: [],
                    current_page: 1,
                    submit: true,
                    totalProduct: 0,
                    categories: [],
                    checking: {
                        body: true
                    },
                    bodyLevel: {
                        level2: [],
                        level3: []
                    }
                }
            },
            mounted() {
                $('.block-button').on('click', (evt) => {
                    let _this = $(evt.currentTarget);
                    _this.parent('.btn-open').find(' > .none-block').slideToggle();
                    _this.toggleClass('active');
                    _this.find(' > .hover-underline').toggleClass('active');
                });
                let breakPoint = 1023;
                $('.title-open').on('click', (evt) => {
                    let window_w = window.innerWidth;
                    let _this = $(evt.currentTarget);
                    _this.toggleClass('active');
                    if (window_w <= breakPoint) {
                        _this.parent('.btn-open').find(' > .none-block').toggleClass('sp_active');
                        $('.siderbar-search_back').addClass('sp_active');
                        $('.sp-modalBtn').addClass('sp_active');
                    } else {
                        _this.parent('.btn-open').find(' > .none-block').slideToggle();
                    }
                });
                window.addEventListener('resize', function() {
                    let window_w = window.innerWidth;
                    if (window_w <= breakPoint) {
                        $('.siderbar-search_under.none-block').slideDown();
                        if ($('.sp-likewine_fixedBtn').hasClass('active')) {
                            $('body').css('overflow', 'hidden');
                        }
                    } else {
                        $('body').css('overflow', 'unset');
                    }
                });
                $('.siderbar-search_back').on('click', (evt) => {
                    $('.siderbar-search_under.none-block').removeClass('sp_active');
                    $('.siderbar-search_back').removeClass('sp_active');
                    $('.sp-modalBtn').removeClass('sp_active');
                });
                $('.sp-action_back').on('click', (evt) => {
                    let window_w = window.innerWidth;
                    if (window_w <= breakPoint) {
                        $('.siderbar-search_under.none-block').removeClass('sp_active');
                        $('.siderbar-search_back').removeClass('sp_active');
                        $('.sp-modalBtn').removeClass('sp_active');
                    }
                });
                $('.sp-likewine_fixedBtn').on('click', (evt) => {
                    let _this = $(evt.currentTarget);
                    _this.addClass('active');
                    $('.siderbar-search').addClass('active');
                    $('.sp-likewine_fixedBtn_back').addClass('active');
                    $('body').css('overflow', 'hidden');
                });
                $('.siderbar-search_close').on('click', (evt) => {
                    $('.siderbar-search').removeClass('active');
                    $('.sp-likewine_fixedBtn_back').removeClass('active');
                    $('.sp-likewine_fixedBtn').removeClass('active');
                    $('body').css('overflow', 'unset');
                });
                $('.sp-likewine_fixedBtn_back').on('click', (evt) => {
                    let _this = $(evt.currentTarget);
                    _this.removeClass('active');
                    $('.siderbar-search').removeClass('active');
                    $('.sp-likewine_fixedBtn').removeClass('active');
                    $('body').css('overflow', 'unset');
                });
                $('.sp-modalBtn-click').on('click', (evt) => {
                    $('.siderbar-search').removeClass('active');
                    $('.sp-likewine_fixedBtn').removeClass('active');
                    $('.sp-likewine_fixedBtn_back').removeClass('active');
                    $('body').css('overflow', 'unset');
                });
            },
            methods: {
                async onPaging(url) {
                    if (url === null) {
                        return false;
                    }
                    this.getResultData(url);
                    window.scrollTo({
                        left: 0,
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                IsDemo(event, item, type) {
                    console.log(`type= ${type} && item=`, item);
                    let checked = event.currentTarget.checked;
                    if (type == 'level1') { // Check level 1
                        if (checked) {
                            this.bodyLevel.level2.push(item.code);
                        } else {
                            removeItem(this.bodyLevel.level2, item.code);
                        }
                        if (item.child) {
                            item.array_child.forEach(item2 => {
                                if (checked) {
                                    if (!this.bodyLevel.level3.includes(item2.code)) {
                                        this.bodyLevel.level3.push(item2.code);
                                    }
                                } else {
                                    removeItem(this.bodyLevel.level3, item2.code);
                                }
                                if (item2.child) {
                                    const array_child_level3 = item2.array_child;
                                    array_child_level3.forEach(item3 => {
                                        if (checked) {
                                            if (!this.arraySearch.origin.includes(item3.code)) {
                                                this.arraySearch.origin.push(item3.code);
                                            }
                                        } else {
                                            removeItem(this.arraySearch.origin, item3.code);
                                        }
                                    });
                                } else {
                                    if (checked) {
                                        if (!this.arraySearch.origin.includes(item2.code)) {
                                            this.arraySearch.origin.push(item2.code);
                                        }
                                    } else {
                                        removeItem(this.arraySearch.origin, item2.code);
                                    }
                                }
                            });
                        }
                    } else if (type == 'level2') { // check level 2
                        if (checked) {
                            this.bodyLevel.level3.push(item.code);
                        } else {
                            removeItem(this.bodyLevel.level3, item.code);
                        }
                        if (item.child) {
                            item.array_child.forEach(item2 => {
                                if (checked) {
                                    if (!this.arraySearch.origin.includes(item2.code)) {
                                        this.arraySearch.origin.push(item2.code);
                                    }
                                } else {
                                    removeItem(this.arraySearch.origin, item2.code);
                                }
                            });
                        }
                    } else { //Future

                    }

                },
                isOpen(code, level) {
                    if (level == 'level2') {
                        if (this.bodyLevel.level2.includes(code))
                            return true;
                        return false;
                    } else {
                        if (this.bodyLevel.level3.includes(code))
                            return true;
                        return false;
                    }
                },
                showNameCheckboxCategory(type) {
                    let html = "";
                    if (type == 'keyword') {
                        html = this.arraySearch.keyword;
                        return html;
                    }
                    if (type == 'inventory') {
                        html = '在庫が無い商品も表示';
                        if (this.arraySearch.inventory == 'stocking') {
                            html = '在庫がある商品を表示';
                        }
                        return html;
                    }
                    if ((type == 'size' && this.arraySearch.size[0] == 'all') || (type == 'vintage' && this
                            .arraySearch.vintage[0] == 'all') || (type == 'ranker' && this.arraySearch.ranker[0] ==
                            'all')) {
                        return "すべて";
                    }
                    const categories = this.categories;
                    if (categories.length > 0) {
                        categories.forEach((item, index) => {
                            if (type === item.type) {
                                html += ` ${item.name},`
                            }
                        });
                        if (html == "") {
                            return "指定なし";
                        }
                        return html.substring(0, html.length - 1);
                    } else {
                        return "指定なし";
                    }
                },
                showItemBody(parent) {
                    const isShow = this.showCheckboxAllBody();
                    if (!isShow) {
                        const categories = this.arraySearch.category;
                        let isShow = false;
                        categories.forEach(item => {
                            if (parent.includes(item)) {
                                isShow = true;
                                return true;
                            }
                        });
                        return isShow;
                    }
                    return true;
                },
                showCheckboxAllBody() {
                    const categories = this.arraySearch.category;
                    let check = true;
                    // ct641 甘口ワイン
                    // ct1171 低アルコール
                    if (categories.includes("ct641") || categories.includes("ct1171")) {
                        return check;
                    }
                    if (categories.length > 0) {
                        categories.forEach(item => {
                            if (DEFAULT_BODY_HIDDEN_BUTTON_ALL.includes(item)) {
                                check = false;
                            }
                            if (!check) {
                                return check;
                            }
                        });
                    }
                    return check;
                },
                onFormatPrice() {
                    this.arraySearch.price_min = isNaN(parseFloat(this.$refs.price_min.value)) ? 0 : parseFloat(this
                        .$refs.price_min.value);
                    this.arraySearch.price_max = isNaN(parseFloat(this.$refs.price_max.value)) ? MAX_PRICE :
                        parseFloat(this.$refs.price_max.value);
                },
                onSearch(loader = true) {
                    if (!this.submit)
                        return false;
                    this.loader = loader;
                    this.onFormatPrice();
                    this.arraySearch.keyword = this.$refs.keyword.value;
                    this.loader = false;
                    this.getResultData();

                    window.scrollTo({
                        left: 0,
                        top: 0,
                        behavior: 'smooth'
                    });
                    this.checking = {
                        body: true
                    };
                },
                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                },
                resetSetting() {
                    this.arraySearch = {
                        price_min: MIN_PRICE,
                        price_max: MAX_PRICE,
                        category: [],
                        origin: [],
                        type: [],
                        body: [],
                        size: [],
                        vintage: [],
                        ranker: [],
                        keyword: "",
                        inventory: ALL,
                    };
                    this.categories = [];
                    this.$refs.body_all.checked = false;
                    this.$refs.origin_all.checked = false;
                    this.onSearch();
                },
                getImage(image = null) {
                    return `https://makeshop-multi-images.akamaized.net/4708/itemimages/${image}`;
                },
                getUrl(slug = null) {
                    return `https://www.shinanoya-tokyo.jp/view/item/${slug}`;
                },
                handleAllOrigin(event) {
                    let checked = event.target.checked;
                    this.arraySearch.origin = allOrigin(checked);
                },
                handleAllBody(event) {
                    let checked = event.target.checked;
                    this.arraySearch.body = allBody(checked);
                },
                async getResultData(url = DEFAULT_PAGE) {
                    this.loader = true;
                    try {
                        await axios.post(url, this.arraySearch, {
                                headers: {
                                    'Content-Security-Policy': 'upgrade-insecure-requests'
                                }
                            })
                            .then((response) => {
                                const {
                                    result
                                } = response.data;
                                const {
                                    products,
                                    totalCategory
                                } = result;
                                this.links = products.links;
                                this.totalProduct = products.total;
                                this.current_page = products.current_page;
                                this.dataItems = products.data;
                                this.categories = getCheckedCategory(totalCategory);
                                this.loader = false;
                                this.checking.body = this.showCheckboxAllBody();
                            });
                    } catch (error) {
                        this.loader = true;
                        console.error(error);
                    }
                },
                async getListSearch() {
                    this.listSearch = listSearch();
                }
            },
            created() {
                this.getListSearch();
                this.getResultData();
            },
            watch: {
                "arraySearch.category": function(newValue, oldValue) {
                    this.checking.body = this.showCheckboxAllBody();
                }
            },
        }).mount('#appRoot');
    </script>
</body>

</html>
