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
    <script src="{{ asset('/makeshop/listSearch.js') }}"></script>
    <script>
        const DEFAULT_PAGE = `/api/product/search?page=1`;
    </script>
    <script src="{{ asset('/makeshop/result_data.js') }}"></script>
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
                <section class="box-search" id="search_price">
                    <header>
                        <div class="title-header">
                            <h2>価格</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-price">
                            <div class="min-price">
                                <input type="number" min="0" v-bind:max="arraySearch.price_max" ref="price_min"
                                    id="price_min" class="form-control" placeholder="0">
                            </div>
                            <div class="icon">
                                <span>円 〜</span>
                            </div>
                            <div class="max-price">
                                <input type="number" min="0" v-bind:max="arraySearch.price_max" ref="price_max"
                                    id="price_max" class="form-control" placeholder="1.000.000">
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()" title="条件を変更">
                            条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_categories">
                    <header>
                        <div class="title-header">
                            <h2>タイプ</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.categories" class="item-checkbox">
                                <label v-bind:for="`category_${item.code}`">
                                    <input type="checkbox" name="size[]" v-model="arraySearch.category"
                                        :value="item.code" v-bind:id="`category_${item.code}`"
                                        class="custom-form-checkbox" />
                                    <span>{{ item.name }}</span>
                                </label>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()" title="条件を変更"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_origin">
                    <header>
                        <div class="title-header">
                            <h2>産地</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.origin" class="list-origin">
                                <div v-if="item.child" class="btn-open">
                                    <div class="block-button">
                                        <button class="hover-underline">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20"
                                                    class="svg-down mr-2 inline-block h-5 w-5 fill-current opacity-25">
                                                    <g fill="none" fill-opacity=".88" fill-rule="evenodd">
                                                        <g fill="#000">
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M14.283 7.245l.717.717-4.642 4.641c-.176.176-.449.196-.646.059l-.07-.059L5 7.962l.717-.717L10 11.528l4.283-4.283z"
                                                                            transform="translate(-810 -4492) translate(0 1622) translate(600 2860) translate(210 10)">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <svg viewBox="0 0 20 20" class="svg-left"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                    </path>
                                                </svg>
                                                <span>{{ item.name }}</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="none-block">
                                        <div v-for="(item_child, index_child) in item.array_child"
                                            class="list-orign-lv2">
                                            <div v-if="item_child.child" class="btn-open">
                                                <div class="block-button">
                                                    <button class="hover-underline">
                                                        <div class="flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20"
                                                                class="svg-down mr-2 inline-block h-5 w-5 fill-current opacity-25">
                                                                <g fill="none" fill-opacity=".88"
                                                                    fill-rule="evenodd">
                                                                    <g fill="#000">
                                                                        <g>
                                                                            <g>
                                                                                <g>
                                                                                    <path
                                                                                        d="M14.283 7.245l.717.717-4.642 4.641c-.176.176-.449.196-.646.059l-.07-.059L5 7.962l.717-.717L10 11.528l4.283-4.283z"
                                                                                        transform="translate(-810 -4492) translate(0 1622) translate(600 2860) translate(210 10)">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <svg viewBox="0 0 20 20" class="svg-left"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                                </path>
                                                            </svg>
                                                            <span>{{ item_child.name }}</span>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="none-block">
                                                    <div v-for="(item_child_lv2, index_child_lv2) in item_child.array_child"
                                                        class="item-checkbox">
                                                        <label v-bind:for="`type_${item_child_lv2.code}`">
                                                            <input type="radio" name="origin"
                                                                v-bind:value="item_child_lv2.code"
                                                                v-model="arraySearch.origin"
                                                                v-bind:id="`type_${item_child_lv2.code}`"
                                                                class="custom-form-checkbox" />
                                                            <span>{{ item_child_lv2.name }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="item-checkbox">
                                                    <label v-bind:for="`type_${item_child.code}`">
                                                        <input type="radio" name="origin"
                                                            v-bind:value="item_child.code"
                                                            v-model="arraySearch.origin"
                                                            v-bind:id="`type_${item_child.code}`"
                                                            class="custom-form-checkbox" />
                                                        <span>{{ item_child.name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="item-checkbox">
                                        <label v-bind:for="`origin_${item.code}`">
                                            <input type="radio" name="origin" v-bind:value="item.code"
                                                v-model="arraySearch.origin" v-bind:id="`origin_${item.code}`"
                                                class="custom-form-checkbox" />
                                            <span>{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_type">
                    <header>
                        <div class="title-header">
                            <h2>品種</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.type" class="list-type">
                                <div v-if="item.child" class="btn-open">
                                    <div class="block-button">
                                        <button class="hover-underline">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20"
                                                    class="svg-down mr-2 inline-block h-5 w-5 fill-current opacity-25">
                                                    <g fill="none" fill-opacity=".88" fill-rule="evenodd">
                                                        <g fill="#000">
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M14.283 7.245l.717.717-4.642 4.641c-.176.176-.449.196-.646.059l-.07-.059L5 7.962l.717-.717L10 11.528l4.283-4.283z"
                                                                            transform="translate(-810 -4492) translate(0 1622) translate(600 2860) translate(210 10)">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <svg viewBox="0 0 20 20" class="svg-left"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                    </path>
                                                </svg>
                                                <span>{{ item.name }}</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="none-block">
                                        <div v-for="(item_child, index_child) in item.array_child"
                                            class="item-checkbox">
                                            <label v-bind:for="`type_${item_child.code}`">
                                                <input type="checkbox" name="type[]" v-bind:value="item_child.code"
                                                    v-model="arraySearch.type" v-bind:id="`type_${item_child.code}`"
                                                    class="custom-form-checkbox" />
                                                <span>{{ item_child.name }}</span>
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
                                            <span>{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_size">
                    <header>
                        <div class="title-header">
                            <h2>サイズ</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.size" class="item-checkbox">
                                <label v-bind:for="`size_${item.id}`">
                                    <input type="checkbox" name="size[]" v-model="arraySearch.size"
                                        :value="item.code" v-bind:id="`size_${item.id}`"
                                        class="custom-form-checkbox" />
                                    <span>{{ item.name }}</span>
                                </label>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_vintage">
                    <header>
                        <div class="title-header">
                            <h2>ヴィンテージ</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.vintage" class="item-checkbox">
                                <label v-bind:for="`vintage_${item.id}`">
                                    <input type="checkbox" name="vintage[]" v-model="arraySearch.vintage"
                                        :value="item.code" v-bind:id="`vintage_${item.id}`"
                                        class="custom-form-checkbox" />
                                    <span>{{ item.name }}</span>
                                </label>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()" title="条件を変更"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="search_ranker">
                    <header>
                        <div class="title-header">
                            <h2>格付け</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div v-for="(item, index) in listSearch.ranker" class="list-ranker">
                                <div v-if="item.child" class="btn-open">
                                    <div class="block-button">
                                        <button class="hover-underline">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20"
                                                    class="svg-down mr-2 inline-block h-5 w-5 fill-current opacity-25">
                                                    <g fill="none" fill-opacity=".88" fill-rule="evenodd">
                                                        <g fill="#000">
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M14.283 7.245l.717.717-4.642 4.641c-.176.176-.449.196-.646.059l-.07-.059L5 7.962l.717-.717L10 11.528l4.283-4.283z"
                                                                            transform="translate(-810 -4492) translate(0 1622) translate(600 2860) translate(210 10)">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <svg viewBox="0 0 20 20" class="svg-left"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.187 16.9c-.25.253-.25.66 0 .91.248.253.652.253.9 0l7.285-7.355c.25-.25.25-.66 0-.91L7.088 2.19c-.25-.253-.652-.253-.9 0-.25.25-.25.658-.002.91L12.83 10l-6.643 6.9z">
                                                    </path>
                                                </svg>
                                                <span>{{ item.name }}</span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="none-block">
                                        <div v-for="(item_child, index_child) in item.array_child"
                                            class="item-checkbox">
                                            <label v-bind:for="`ranker_${item_child.code}`">
                                                <input type="checkbox" name="ranker[]" v-bind:value="item_child.code"
                                                    v-model="arraySearch.ranker"
                                                    v-bind:id="`ranker_${item_child.code}`"
                                                    class="custom-form-checkbox" />
                                                <span>{{ item_child.name }}</span>
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
                                            <span>{{ item.name }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button type="button" v-on:click="onSearch()"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="production_body">
                    <header>
                        <div class="title-header">
                            <h2>ボディ</h2>
                        </div>
                    </header>
                    <main>
                        <div id="noUiSlider">
                            <div id="range"></div>
                            <div class="body-number">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                            </div>
                            <div class="control">
                                <input type="number" name="power_min" value="1" id="power_min" max="3"
                                    min="1" ref="power_min" placeholder="1">
                                <span> から </span>
                                <input type="number" name="power_max" value="3" id="power_max" max="3"
                                    min="1" ref="power_max" placeholder="3">
                            </div>
                        </div>
                    </main>
                    <footer class="action-search">
                        <button v-on:click="onSearch()" type="button" title="条件を変更"> 条件を変更</button>
                    </footer>
                </section>
                <section class="box-search" id="production_keyword">
                    <header>
                        <div class="title-header">
                            <h2>キーワード</h2>
                        </div>
                    </header>
                    <main>
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
                    </main>
                </section>
                <section class="box-search" id="search_inventory">
                    <header>
                        <div class="title-header">
                            <h2>在庫状況</h2>
                        </div>
                    </header>
                    <main>
                        <div class="flex-type">
                            <div class="item-checkbox">
                                <label for="inventory">
                                    <input type="checkbox" name="inventory" checked id="inventory"
                                        class="custom-form-checkbox" />
                                    <span>在庫ありのみ</span>
                                </label>
                            </div>
                        </div>
                    </main>
                </section>
            </div>
            <div class="main-search" ref="main-search">
                <div class="total-search mb-2 ps-3">
                    ページ {{ current_page }} <span id="total" ref="total"
                        name="total"><b>{{ dataItems.length }}</b></span> 個の製品が見つかりました
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
                                    {{ item.id }}
                                </div>
                                <div class="itemDetail">
                                    <div class="iconArea">
                                        <img src="https://www.shinanoya-tokyo.jp/images/common/iconM.gif"
                                            alt="iconM">
                                        <img src="https://www.shinanoya-tokyo.jp/shopimages/4708/iconAG.gif"
                                            alt="iconAG">
                                        <img src="https://www.shinanoya-tokyo.jp/shopimages/4708/iconAH.gif"
                                            alt="iconAH">
                                    </div>
                                    <h3 class="name">
                                        <a v-bind:href="getUrl(item.brand_code)" target="blank">
                                            {{ item.name }}
                                        </a>
                                    </h3>
                                    <p class="price">{{ formatPrice(item.price_tax) }}（税込）
                                    </p>
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
    <script>
        const {
            createApp
        } = Vue;
        const ALL = "all";
        const MIN_PRICE = 0;
        const MAX_PRICE = 1000000;
        const POWER_MIN = 1;
        const POWER_MAX = 3;

        createApp({
            data() {
                return {
                    dataItems: [],
                    listSearch: [],
                    loader: false,
                    power_min: POWER_MIN,
                    power_max: POWER_MAX,
                    arraySearch: {
                        price_min: MIN_PRICE,
                        price_max: MAX_PRICE,
                        category: [],
                        origin: "",
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
                    totalProduct: 0
                }
            },
            mounted() {
                $('.block-button').on('click', (evt) => {
                    let _this = $(evt.currentTarget);
                    _this.parent('.btn-open').find(' > .none-block').slideToggle();
                    _this.toggleClass('active');
                    _this.find(' > .hover-underline').toggleClass('active');
                });
            },
            methods: {
                async onPaging(url) {
                    if (url === null) {
                        return false;
                    }
                    this.getResultData(url);
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
                    this.arraySearch.body = this.checkBody();
                    this.loader = false;
                    this.getResultData();
                    // offset top
                    window.scrollTo({
                        left: 0,
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                },
                getImage(image = null) {
                    return `https://makeshop-multi-images.akamaized.net/4708/itemimages/${image}`;
                },
                getUrl(slug = null) {
                    return `https://www.shinanoya-tokyo.jp/view/item/${slug}`;
                },
                checkBody() {
                    let list_body = this.listSearch.body;
                    this.power_min = parseInt(this.$refs.power_min.value);
                    this.power_max = parseInt(this.$refs.power_max.value);
                    let array_power = [];
                    list_body.forEach((item_list, index_list) => {
                        let power = parseInt(item_list.power);
                        if (this.power_min <= power && power <= this.power_max) {
                            array_power.push(item_list.code);
                        }
                    });
                    return array_power;
                },
                _console() {
                    console.log('START___console ____START');
                    console.log('__arraySearch =', this.arraySearch);
                    console.log('__power_min', this.power_min);
                    console.log('__power_max', this.power_max);
                    console.log('END___console ____END');
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
                                    products
                                } = result;
                                this.links = products.links;
                                this.totalProduct = products.total;
                                this.current_page = products.current_page;
                                this.dataItems = products.data;
                                this.loader = false;
                                this._console();
                            });
                    } catch (error) {
                        console.error(error);
                        this.loader = true;
                    }
                },
                async getListSearch() {
                    this.listSearch = listSearch();
                    let list_body = [];
                    this.listSearch.body.forEach((item, index) => {
                        list_body.push(item.code);
                    });
                    this.arraySearch.body = list_body;
                }
            },
            created() {
                this.getListSearch();
                this.getResultData();
            }
        }).mount('#appRoot');
    </script>
    <script>
        // search price form
        var $slider = $('#range').get(0);
        var $min = $('#power_min'); //最小値のテキストフィールド
        var $max = $('#power_max'); //最大値のテキストフィールド
        var minVal = POWER_MIN; //最小値
        var maxVal = POWER_MAX; //最大値
        var gap = 1; // 数値を5刻みにする
        //noUiSliderをセット
        noUiSlider.create($slider, {
            start: [minVal, maxVal], //
            connect: true,
            step: gap,
            range: {
                'min': minVal, //最小値を-5
                'max': maxVal //最小値を+5
            },
            pips: {
                mode: 'range',
                density: gap
            }
        });

        //noUiSlider event
        $slider.noUiSlider.on('update', function(values, handle) {
            //現在の最小値・最大値を取得
            var value = Math.floor(values[handle]);
            if (handle) {
                $max.get(0).value = value; //現在の最大値
            } else {
                $min.get(0).value = value; //現在の最小値
            }

            //noUiSlider下部の数値変更（そのままだと+-5の数値が表示されるため）
            $('.noUi-value-large').text(minVal);
            $('.noUi-value-large:last-child').text(maxVal);
        });

        //最小値をinputにセット
        $min.get(0).addEventListener('change', function() {
            $slider.noUiSlider.set([this.value, null]);
        });

        //最大値をinputにセット
        $max.get(0).addEventListener('change', function() {
            $slider.noUiSlider.set([null, this.value]);
        });
    </script>
</body>

</html>
