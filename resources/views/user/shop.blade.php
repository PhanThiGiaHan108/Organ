@extends('layouts.UserLayout')
@section('title', 'Shop')
@section('content')
<!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('user.shop') }}" method="GET">
                                <input type="text" name="keyword" placeholder="What do you need?" value="{{ request('keyword') }}">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>19006868</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
     <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="#">Home</a>
                            <span>Shop list</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->



<!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                       <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul class="category-list">
                                {{-- Nút "Tất cả sản phẩm" --}}
                                <li>
                                    <a href="{{ route('user.shop') }}"
                                    style="{{ request('category') || request('price') ? 'font-weight: bold; color: red;' : '' }}">
                                        🗙 Tất cả sản phẩm
                                    </a>
                                </li>

                                @foreach($categories as $cat)
                                    @php
                                        $query = ['category' => $cat->slug];
                                        if (request('price')) {
                                            $query['price'] = request('price');
                                        }
                                    @endphp
                                    <li>
                                        <a href="{{ route('user.shop', $query) }}"
                                        style="{{ request('category') == $cat->slug ? 'font-weight: bold; color: #7fad39;' : '' }}">
                                            {{ $cat->name }} ({{ $cat->products_count }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <form method="GET" action="{{ route('user.shop') }}">
                                    @if (request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif

                                    <ul class="filter-list">
                                            @php
                                                $currentPrice = request('price');
                                            @endphp

                                            @foreach([
                                                '' => 'Tất cả mức giá',
                                                '0-50000' => 'VNĐ 0 - VNĐ 50,000',
                                                '50001-100000' => 'VNĐ 50,001 - VNĐ 100,000',
                                                '100001-200000' => 'VNĐ 100,001 - VNĐ 200,000',
                                                '200001-300000' => 'VNĐ 200,001 - VNĐ 300,000',
                                                '300001-540000' => 'VNĐ 300,001 - VNĐ 540,000',
                                                "$minPrice-$minPrice" => 'Giá thấp nhất',
                                                "$maxPrice-$maxPrice" => 'Giá cao nhất',
                                            ] as $value => $label)
                                                <li>
                                                    <label style="{{ $currentPrice == $value ? 'color: #7fad39; font-weight: bold;' : '' }}">
                                                        <input type="radio"
                                                            name="price"
                                                            value="{{ $value }}"
                                                            {{ $currentPrice == $value ? 'checked' : '' }}
                                                            onchange="this.form.submit()">
                                                        {{ $label }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>

                                </form>
                            </div>
                        </div>

                        <div class="sidebar__item1">
                                <div class="latest-product__text">
                                    <h4>Latest Products</h4>
                                    <div class="latest-product__slider owl-carousel">
                                        @foreach ($latestProducts->chunk(3) as $productChunk)
                                            <div class="latest-prdouct__slider__item">
                                                @foreach ($productChunk as $product)
                                                    <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="{{ asset('img/product/' . $product->image) }}" alt="{{ $product->name }}">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6>{{ $product->name }}</h6>
                                                            <span>{{ number_format($product->discount_price ?? $product->price) }}₫</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="product__discount">
                            <div class="section-title product__discount__title">
                                <h2>Sale Off</h2>
                            </div>
                            <div class="row">
                                <div class="product__discount__slider owl-carousel">
                                    @foreach ($discountedProducts as $product)
                                        <div class="col-lg-4">
                                            <div class="product__discount__item">
                                                <div class="product__discount__item__pic set-bg"
                                                    data-setbg="{{ asset('img/product/' . $product->image) }}">
                                                    <div class="product__discount__percent">
                                                        -{{ 100 - round(($product->discount_price / $product->price) * 100) }}%
                                                    </div>
                                                    <ul class="product__item__pic__hover">
                                                        <li>
                                                            <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('cart.add') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="submit">
                                                                    <i class="fa fa-shopping-cart" style="color: #1c1c1c;"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__discount__item__text">
                                                    <span>{{ $product->category->name ?? 'No Category' }}</span>
                                                    <h5>
                                                        <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h5>
                                                    <div class="product__item__price">
                                                        {{ number_format($product->discount_price) }}₫
                                                        <span>{{ number_format($product->price) }}₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            @forelse ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ asset('img/product/' . $product->image) }}">
                                            <ul class="product__item__pic__hover">
                                                        <li>
                                                            <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('cart.add') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="submit">
                                                                    <i class="fa fa-shopping-cart" style="color: #1c1c1c;"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6>
                                                <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h6>
                                            <h5>
                                                {{ number_format($product->discount_price ?? $product->price) }}₫
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>Không có sản phẩm phù hợp.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="product__pagination">
                            {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
                        </div>


                    </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
     <style>
        .sidebar__item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
        .sidebar__item h4 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #333;
        }
        .price-range-wrap {
            padding: 10px 0;
        }
        .filter-list {
            list-style: none;
            padding: 0;
        }
        .filter-list li {
            padding: 5px 0;
        }
        .filter-list input[type="radio"] {
            margin-right: 5px;
        }
            input[type="radio"] {
        accent-color:#333;
    }

    </style>
@endsection
