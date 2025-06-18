@extends('layouts.AdminLayout')
@section('title', 'Bảng điều khiển')
@section('content')

    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item" style=><a href="{{ route('admin.dashboard') }}" style="  color: rgb(71, 160, 78);">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="  color: rgb(71, 160, 78);">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
    <h2 class="mb-4 text-black">Bảng điều khiển</h2>
<div class="container py-4">
    <div class="row g-4">
        <!-- Tài khoản -->
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100 d-flex flex-column justify-content-between">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-start">
                        <h5 class="card-title mb-2">Tài khoản</h5>
                        <h2 class="card-text mb-0">{{ $totalUsers }}</h2>
                    </div>
                    <div class="ms-3 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="{{ route('admin.user') }}" class="btn btn-light mt-2">Xem tài khoản</a>
                </div>
            </div>
        </div>

        <!-- Danh mục -->
        <div class="col-md-3">
            <div class="card text-white bg-success h-100 d-flex flex-column justify-content-between">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-start">
                        <h5 class="card-title mb-2">Danh mục</h5>
                        <h2 class="card-text mb-0">{{ $totalCategories }}</h2>
                    </div>
                    <div class="ms-3 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="{{ route('admin.category') }}" class="btn btn-light mt-2">Xem danh mục</a>
                </div>
            </div>
        </div>

        <!-- Sản phẩm -->
        <div class="col-md-3">
            <div class="card text-white bg-warning h-100 d-flex flex-column justify-content-between">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-start">
                        <h5 class="card-title mb-2">Sản phẩm</h5>
                        <h2 class="card-text mb-0">{{ $totalProducts }}</h2>
                    </div>
                    <div class="ms-3 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box2-fill" viewBox="0 0 16 16">
                            <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM15 4.667V5H1v-.333L1.5 4h6V1h1v3h6z"/>
                        </svg>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="{{ route('admin.product') }}" class="btn btn-light mt-2">Xem sản phẩm</a>
                </div>
            </div>
        </div>

        <!-- Đơn hàng -->
        <div class="col-md-3">
            <div class="card text-white bg-danger h-100 d-flex flex-column justify-content-between">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-start">
                        <h5 class="card-title mb-2">Đơn hàng</h5>
                        <h2 class="card-text mb-0">{{ $totalOrders }}</h2>
                    </div>
                    <div class="ms-3 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="{{ route('admin.order') }}" class="btn btn-light mt-2">Xem đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection