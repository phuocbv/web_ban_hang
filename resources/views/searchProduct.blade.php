@extends('layouts.app')

@section('title')
    @lang('categories.search')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/menu.css') }}">
    @include('layouts.title')
    <div class="view-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb border-shadow-bottom">
                        <li><a href="{{ route('home') }}">@lang('user.home')</a></li>
                    </ol>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div><h3>@lang('categories.search')</h3></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 margin-top-20">
                        <aside class="sidebar">
                            <nav class="sidebar-nav">
                                <ul class="metismenu">
                                    @foreach ($categories as $key => $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->id) }}" aria-expanded="false" class="title" id="category_{{ $category->id }}">
                                                {{ $category->name }} <span class="fa arrow"></span>
                                            </a>
                                            <ul aria-expanded="false">
                                                @foreach ($category->categories as $key => $value)
                                                    <li><a href="{{ route('category.show', $value->id) }}" id="sub_category_{{ $value->id }}">{{ $value->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </aside>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 margin-top-20">
                        <div class="speace20"></div>
                        <div class="title-filter">
                            <h3>@lang('categories.filter')</h3>
                        </div>
                        <div class="search">
                            <input type="button" value="@lang('categories.search')" class="button btn-search-product">
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                    <div class="shop-sort-by-options col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom"></div>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-20 cart">
                        @foreach ($products as $key => $product)
                            <div class="col-md-3 padding-zero block-product-category">
                                <div class="height-140p">
                                    <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                                        @if (count($product->images) > 0)
                                            <img src="{{ asset($product->images[0]->url) }}" class="img-product-category">
                                        @endif  
                                    </a>
                                    <span class="ribbon" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                        {{ $product->discount }}@lang('home.percent')
                                    </span>
                                </div>
                                <div class="text-align-center product-name">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                </div>
                                <div class="product-price">
                                    <span class="price" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                        {{ number_format($product->price, 0) }} @lang('home.currency')
                                    </span>
                                </div>
                                <div class="discount-price">
                                    <span class="price">
                                        {{ number_format(MyFuncs::getDiscount($product->price, $product->discount), 0) }}
                                        @lang('home.currency')
                                    </span>
                                </div>
                                <div>
                                    <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                                    <input type="button" class="button btn-add-cart" product-id="{{ $product->id }}" value="@lang('categories.addCart')">
                                </div>
                                <div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('bower_components/jquery.easyPaginate/lib/jquery.easyPaginate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/js/search.js') }}"></script>
    <script src="{{ asset('/js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        addCart.init('.btn-add-cart');
    </script>
@endsection
