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
                                    <li><a href="{{ route('shop.cart') }}">Shoping Cart</a></li>
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
                             <li class="nav-item dropdown hover-dropdown">
    <a id="notificationDropdown" class="nav-link" href="{{ route('user.messages') }}">
        <i class="fa fa-bell"></i>
        <span class="badge bg-danger" id="noti-count" style="display: none;"></span>
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
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
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
                    <a href="#"><img src="{{ asset('img/logo.png') }}" alt="OGANI Logo" style="max-height: 50px;"></a>
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
function fetchNotificationCounts() {
    fetch("{{ route('notifications.counts') }}")
        .then(response => response.json())
        .then(data => {
            const countElem = document.getElementById("noti-count");

            if (data.total > 0 && data.unread > 0) {
                // Hiển thị khi có thông báo chưa đọc
                countElem.innerText = data.total;
                countElem.style.display = 'inline-block';
            } else {
                // Ẩn khi đã xem hết
                countElem.style.display = 'none';
            }
        })
        .catch(error => console.error("Lỗi khi fetch thông báo:", error));
}

document.addEventListener("DOMContentLoaded", fetchNotificationCounts);



</script>

</body>
</html>