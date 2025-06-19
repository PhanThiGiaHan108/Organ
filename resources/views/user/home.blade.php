@extends('layouts.UserLayout')

@section('content')

 <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
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
                    <div class="hero__item set-bg" data-setbg="{{asset('img/hero/banner.jpg')}}">
                            <div class="hero__text">
                                <span>FRUIT FRESH</span>
                                <h2>Vegetable <br />100% Organic</h2>
                                <p>Free Pickup and Delivery Available</p>
                                <a href="{{ route('user.shop') }}" class="primary-btn">SHOP NOW</a>
                            </div>
                            
                        </div>
                
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
          
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/' . $category->image) }}">
                                <h5><a href="#">{{ $category->name }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section End -->
     <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Products</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)
                                <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->slug }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset('img/product/' . $product->image) }}">
                                <ul class="featured__item__pic__hover">
                                    <li> <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" <i class="fa fa-eye"></i></a></li>
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
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <h5>{{ number_format($product->price) }}₫</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
    </section>
    <!-- Featured Section End -->
@endsection
