@extends('layouts.UserLayout')
@section('ti>')  
@section('content')

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
      
        <div class="row mb-4">
            <div class="col-lg-12">
                <h6>
                    <span class="icon_tag_alt"></span>
                  Please enter the full information to complete the order.
                </h6>
            </div>
        </div>

        <div class="checkout__form">
    <h4 class="mb-4">Billing Details</h4>

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Bên trái: Thông tin người nhận -->
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Your Name <span>*</span></p>
                            <input type="text" name="name" required>
                        </div>
                    </div>
                </div>

                <div class="checkout__input">
                    <p>Address <span>*</span></p>
                    <input type="text" name="address" class="checkout__input__add" required>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Phone <span>*</span></p>
                            <input type="text" name="phone" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                </div>

                <div class="checkout__input mt-3">
                    <p>Order notes <span>*</span></p>
                    <input type="text" name="order_notes" placeholder=" Giao vào buổi sáng, không gọi trước...">
                </div>
            </div>

            <!-- Bên phải: Đơn hàng -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                <div class="checkout__order">
                    <h4>Your Order</h4>
                    <div class="checkout__order__products">Products <span>Total</span></div>
                    <ul>
                        @php $subtotal = 0; @endphp
                        @foreach (session('cart', []) as $id => $item)
                            @php $subtotal += $item['price'] * $item['quantity']; @endphp
                            <li>{{ $item['name'] }} x {{ $item['quantity'] }}
                                <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="checkout__order__subtotal">
                        Subtotal <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                    </div>

                    @php
                        $discount = session('discount');
                        $discountAmount = $discount['amount'] ?? 0;
                        $total = $subtotal - $discountAmount;
                    @endphp

                    @if ($discount)
                        <div class="checkout__order__subtotal">
                            Giảm ({{ $discount['code'] }}) <span>-{{ number_format($discount['amount'], 0, ',', '.') }}đ</span>
                        </div>
                    @endif

                    <div class="checkout__order__total">
                       Total <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>

                    <div class="checkout__input__checkbox">
                        <label for="payment">
                           Payment after delivery  
                            <input type="radio" name="payment_method" id="payment" value="cod" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <button type="submit" class="site-btn mt-4 w-100">PLACE ORDER</button>
                </div>
            </div>
        </div>
    </form>
</div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection
