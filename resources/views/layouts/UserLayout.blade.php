<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <title>@yield('title', 'My Shop')</title>
</head>
<body>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> organshop@gmail.com</li>
                               <!-- <li><i class="fas fa-clock"></i> Opening from 8 AM to 9 PM</li> -->
                                <li><i class="fa fa-map-marker"></i> Yen Nghia, Ha Dong, Ha Noi</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                @auth
                                    <div class="theme-dropdown dropdown">
                                        <button class="btn btn-purple dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-user"></i> {{ Auth::user()->name ?? 'Guest' }}
                                        </button>
                                        <ul class="dropdown-menu show-dropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out me-2"></i> Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="#"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul class="menu-evenly">
                                <li class="active"><a href="{{route('home')}}">Home</a></li>
                                 <li class="active"><a href="{{route('about')}}">About</a></li>
                            <li><a href="{{ route('user.shop') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ route('shop.cart') }}">Shopping Cart</a></li>
                                    <li><a href="{{ route('checkout') }}">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                         <ul>
                            <li class="nav-item dropdown">
    <a href="{{ route('user.messages') }}" class="text-decoration-none text-primary position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="#333" class="bi bi-bell" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
        </svg>

        @php
            use App\Models\Contact;
            use Illuminate\Support\Facades\Auth;

            $user = Auth::user();
            $notificationCount = Contact::where('email', $user->email)
                                        ->whereHas('replies') // chỉ tính nếu đã có phản hồi
                                        ->where('is_read', false)
                                        ->count();
        @endphp

        @if ($notificationCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $notificationCount }}
            </span>
        @endif
    </a>
</li>



                            <li>
                                <a href="{{ route('shop.cart') }}">
                                    <i class="fa fa-shopping-bag"></i> 
                                    @if($cartQuantity > 0)
                                        <span>{{ $cartQuantity }}</span>
                                    @endif
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
          
        </div>
    </header>
    <!-- Header Section End -->
    <main>
        @yield('content')
    </main>
    
     <!-- Footer Section Begin -->
   <footer class="footer spad" style="background-color: #f4f6f8; padding-top: 40px;">
    <div class="container">
        <!-- Hàng 1: Thông tin liên hệ + Google Maps -->
        <div class="row mb-4">
            <!-- Cột trái: Logo + thông tin -->
            <div class="col-lg-6 col-md-12 mb-4 text-start">
                <div class="footer__about__logo mb-3">
                    <a href="#"><img src="{{ asset('img/logo.png') }}" alt=" Logo" style="max-height: 50px;"></a>
                </div>
                <ul class="list-unstyled" style="color: #333; font-size: 15px;">
                    <li class="mb-2"><i class="fa fa-map-marker"></i> Address: Yen Nghia, Ha Dong, Ha Noi</li>
                    <li class="mb-2"><i class="fa fa-phone"></i> Phone: 19008686</li>
                    <li><i class="fa fa-envelope"></i> Email: <a href="mailto:organshop@gmail.com" style="color: #333;">organshop@gmail.com</a></li>
                </ul>
            </div>

            <!-- Cột phải: Google Map -->
            <div class="col-lg-6 col-md-12 mb-4">
                    <iframe 
                        src="https://www.google.com/maps?q=Yen+Nghia,+Ha+Dong,+Ha+Noi&output=embed"
                        width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
            </div>
        </div>

        <!-- Hàng 2: Bản quyền -->
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <p style="text-align: center; color: #777;">
                        © 2025 All rights reserved | This template is made with 
                        <i class="fa fa-heart" style="color: red;"></i> by 
                        <a href="https://github.com/PhanThiGiaHan108/Organ.git" 
                           style="color: inherit; text-decoration: underline;">
                           Gia Han
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

    <!-- Footer Section End -->

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Bootstrap Bundle JS (includes Popper for dismissible alerts) -->
   

<script>



</body>
</html>