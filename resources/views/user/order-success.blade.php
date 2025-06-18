@extends('layouts.UserLayout')

@section('title', 'Đặt hàng thành công')

@section('content')
    <section class="checkout__success spad">
        <div class="container text-center">
            <h2 class="mb-4">Cảm ơn bạn đã đặt hàng!</h2>
            <p>Đơn hàng của bạn đã được ghi nhận và sẽ sớm được xử lý.</p>
            <a href="{{ route('home') }}" class="site-btn mt-4">Về trang chủ</a>
        </div>
    </section>
@endsection
