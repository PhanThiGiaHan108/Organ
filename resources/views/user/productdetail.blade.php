  @extends('layouts.UserLayout')
 @section('title', 'Shop Details') 
 @section('content')
  <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                       <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('img/product/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-md-6">
    <div class="product__details__text">
        <h3>{{ $product->name }}</h3>

        <!-- Đánh giá sao giả lập -->
        <div class="product__details__rating">
            @for ($i = 0; $i < 4; $i++)
                <i class="fa fa-star"></i>
            @endfor
            <i class="fa fa-star-half-o"></i>
            <span>(18 reviews)</span>
        </div>

        <!-- Giá -->
        <div class="product__details__price">
              {{ number_format($product->price ) }}₫
        </div>

        Mô tả
        <p>{{ $product->description }}</p>

        <!-- Form thêm vào giỏ -->
        <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    
    <div class="product__details__quantity">
        <div class="quantity">
            <div class="pro-qty">
                <input name="quantity" value="1" min="1" type="number">
            </div>
        </div>
    </div>

    <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>
</form>


        <!-- Thông tin thêm -->
        <ul>
            <li><b>Khả dụng</b> <span>{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span></li>
            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
            <li><b>Cân nặng</b> <span>{{ $product->weight ?? '1 kg' }}</span></li>
        </ul>
    </div>
</div>

                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>  
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Information</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Reviews (1)</h6>
                                    <p>Great product! Highly recommend.</p>
                                </div>
                            </div>
                        
    </section>
 </section> 

    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
   <section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($relatedProducts as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('img/product/' . $item->image) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="{{ route('product.detail', $item->slug) }}"><i class="fa fa-eye"></i></a></li>
                                 <li>
                                     <form action="{{ route('cart.add') }}" method="POST"">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"">
                                                    <i class="fa fa-shopping-cart"
                                                    style="color: #1c1c1c;"></i>
                                                </button>
                                        </form>
                                 </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a></h6>
                            <h5>  {{ number_format($product->price ) }}₫</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Related Product Section End -->
@endsection
