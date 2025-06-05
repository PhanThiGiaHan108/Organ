<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Bảng điều khiển Admin</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
            <li><a href="{{ route('admin.users') }}">Người dùng</a></li>
            <li><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
    
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>