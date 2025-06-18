@extends('layouts.UserLayout')
@section('title', 'Shop Cart')
@section('content')


<!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse($cart as $productId => $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('img/product/' . $item['image']) }}" width="70">
                                            <h5>{{ $item['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format($item['price']) }}đ
                                        </td>
                                    <td class="shoping__cart__quantity align-middle">
                                    <form action="{{ route('cart.update', $productId) }}" method="POST" style="display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" name="action" value="decrease" 
                                            class="btn btn-sm btn-outline-dark px-2 py-1" style="width: 30px;">−</button>

                                        <input type="text" name="quantity" value="{{ $item['quantity'] }}"
                                            class="text-center mx-2" readonly
                                            style="width: 40px; height: 30px; border: 1px solid #ccc; border-radius: 4px;">

                                        <button type="submit" name="action" value="increase" 
                                            class="btn btn-sm btn-outline-dark px-2 py-1" style="width: 30px;">+</button>
                                    </form>
                                </td>

                                        <td class="shoping__cart__total">
                                            {{ number_format($item['price'] * $item['quantity']) }}đ
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: none;">
                                                    <span class="icon_close"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Giỏ hàng trống</td>
                                    </tr>
                                    @endforelse
                                </>
                            </tbody>        
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('user.shop')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                       <div class="shoping__discount">
    <h5>Discount Codes</h5>
    <div class="d-flex align-items-center gap-2">
        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="d-flex align-items-center gap-2">
            @csrf
            <input type="text" name="coupon_code" value="{{ session('discount.code') ?? '' }}" class="form-control" placeholder="Enter your coupon code" style="max-width: 180px;">
            <button type="submit" class="site-btn">APPLY COUPON</button>
        </form>

        @if(session()->has('discount'))
            <form action="{{ route('cart.removeCoupon') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger" title="Bỏ mã giảm">
                    <i class="fa fa-times"></i>
                </button>
            </form>
        @endif
    </div>

    @if(session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif
</div>

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>{{ number_format($subtotal) }}đ</span></li>

                                @if(session()->has('discount'))
                                    <li>Discount ({{ session('discount.code') }}) 
                                        <span>-{{ number_format(session('discount.amount')) }}đ</span>
                                    </li>
                                    <li>Total 
                                        <span>{{ number_format($subtotal - session('discount.amount')) }}đ</span>
                                    </li>
                                @else
                                    <li>Total <span>{{ number_format($total) }}đ</span></li>
                                @endif
                            </ul>
                            <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection