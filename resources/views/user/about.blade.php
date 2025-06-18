@extends('layouts.UserLayout')

@section('title', 'About Us')

@section('content')
<section class="about spad">
    <div class="container">
        <div class="row align-items-center">
            {{-- CỘT VĂN BẢN BÊN TRÁI --}}
            <div class="col-lg-6">
                <div class="about__text">
                    <div class="section-title">
                        <h2>Về Chúng Tôi</h2>
                        <p>Thực phẩm sạch từ thiên nhiên</p>
                    </div>
                    <p>
                        <strong>OganiShop</strong> là cửa hàng chuyên cung cấp các sản phẩm nông sản sạch, hữu cơ (Organic)
                        được tuyển chọn kỹ lưỡng từ các trang trại đạt chuẩn. Chúng tôi cam kết mang đến cho khách hàng
                        những sản phẩm chất lượng, an toàn cho sức khỏe và thân thiện với môi trường.
                    </p>
                    <p>
                        Tại OganiShop, chúng tôi tin rằng thực phẩm không chỉ là nguồn dinh dưỡng mà còn là nền tảng cho một
                        lối sống khỏe mạnh. Từng loại rau, củ, quả hay thực phẩm khô đều được kiểm định nghiêm ngặt, không
                        hóa chất, không chất bảo quản.
                    </p>
                    <ul class="about__features">
                        <li>Sản phẩm đạt chứng nhận hữu cơ</li>
                        <li>Giao hàng nhanh chóng trong ngày</li>
                        <li>Hỗ trợ tư vấn dinh dưỡng miễn phí</li>
                    </ul>
                     <a href="{{ route('user.shop') }}" class="primary-btn mt-3">
                        <i class="fa fa-shopping-basket"></i> Khám phá cửa hàng
                    </a>
                </div>
            </div>

            {{-- CỘT ẢNH BÊN PHẢI --}}
            <div class="col-lg-6">
                <div class="about__pic text-center">
                    <img src="{{ asset('img/organic.jpg') }}" alt="About OganiShop">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .about {
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .about__pic img {
        width: 100%;
        max-width: 500px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .about__text {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .section-title h2 {
        font-size: 40px;
        font-weight: 800;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .section-title p {
        font-size: 18px;
        color: #7fad39;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .about__text p {
        font-size: 16px;
        line-height: 1.7;
        color: #444;
        margin-bottom: 15px;
    }

    .about__features {
        list-style: none;
        padding-left: 0;
        margin-top: 20px;
    }

    .about__features li {
        font-size: 16px;
        margin-bottom: 8px;
        color: #333;
        position: relative;
        padding-left: 25px;
    }

    .about__features li::before {
        content: "✔";
        position: absolute;
        left: 0;
        top: 0;
        color: #7fad39;
        font-weight: bold;
    }

    .primary-btn {
        background-color: #7fad39;
        color: #fff;
        padding: 12px 28px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .primary-btn:hover {
        background-color: #689f38;
    }

    @media (max-width: 768px) {
        .about__text {
            padding: 20px;
            margin-bottom: 30px;
        }

        .about .row {
            flex-direction: column-reverse;
        }
    }
</style>
@endpush
