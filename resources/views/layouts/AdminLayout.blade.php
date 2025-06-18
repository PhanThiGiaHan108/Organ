<!DOCTYPE html>
<html lang="en">
<!-- filepath: d:\code\Laravel\BanHang\resources\views\layout\AdminLayout.blade.php -->
<!-- ...existing code... -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />


  <title>@yield('title')</title>
  <style>
    body {
      background: #f8fafc;
    }
    .sidebar-custom {
        position: fixed;
        top: 90px; /* bằng chiều cao navbar */
        background:rgb(234, 245, 235);
        left: 0;
        bottom: 0;
        overflow-y: auto;
      }

    .sidebar-custom .nav-link {
      color: #595650;
      font-weight: 500;
      margin-bottom: 8px;
      border-radius: 8px;
      transition: background 0.2s, color 0.2s;
      display: flex;
      align-items: center;
      gap: 10px;
      /* Add a subtle background on hover */
    }
    .sidebar-custom .nav-link.active,
    .sidebar-custom .nav-link:hover {
      background: rgba(255,255,255,0.18);
      color: rgb(71, 160, 78);
    }
    .sidebar-custom .nav-link svg {
      flex-shrink: 0;
    }
    .card {
      border: none;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(80,80,120,0.08);
      transition: transform 0.15s, box-shadow 0.15s;
    }
    .card:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 8px 32px rgba(80,80,120,0.15);
    }
    .card-footer {
      background: transparent;
      border: none;
    }
    .navbar {
      min-height: 90px;
      background: #f5f5f5;;
      box-shadow: 0 2px 8px rgba(80,80,120,0.06);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1030;
    }

    .navbar-brand img {
      border-radius: 50%;
      background: #fff;
    }
    .dropdown-menu {
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(80,80,120,0.08);
    }
    #userDropdown::after {
      color: #333 !important;
    }
    .content-area {
  margin-top: 90px;
  margin-left: 200px; /* hoặc tương ứng với chiều rộng sidebar */
background:rgb(234, 245, 235);
}


  </style>
</head>
<body>
  <!-- Navbar trên cùng -->
  <nav class="navbar navbar-expand-lg shadow-sm px-5 py-0">
    <div class="container-fluid">
      <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="">
      

      <!-- Phần bên phải -->
      <div class="ms-auto d-flex align-items-center gap-3">
        <!-- Chuông thông báo -->
        <a href="#" class="text-decoration-none text-primary position-relative">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#333" class="bi bi-bell" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
          </svg>
         
        </a>

        <!-- Avatar và dropdown -->
        <div class="dropdown" >
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#333" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <span class="me-2 fs-5 fw-semibold" style="color: #333;">
              {{ Auth::user()->name }}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <span class="dropdown-item-text text-muted">
                {{ Auth::user()->email ?? 'example@example.com' }}
              </span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Layout chính -->
  <div class="d-flex pt-3 px-2">
    <!-- Sidebar -->
    <div class="sidebar-custom d-flex flex-column">
      <h4 class="text-center py-3 border-bottom border-light" style="color: #595650;">Menu</h4>
      <ul class="nav flex-column px-3">
        <li class="nav-item">
          <a class="nav-link fs-5 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16"><path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 2 7.5V14a1 1 0 0 0 1 1h3.5a.5.5 0 0 0 .5-.5V11a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3.5a.5.5 0 0 0 .5.5H13a1 1 0 0 0 1-1V7.5a.5.5 0 0 0-.146-.354l-6-6z"/><path d="M13 2.5V6l-5-5-5 5V2.5a.5.5 0 0 1 1 0V6.293l4-4 4 4V2.5a.5.5 0 0 1 1 0z"/></svg>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 {{ request()->routeIs('admin.user') ? 'active' : '' }}" href="{{ route('admin.user') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16"><path d="M13 7a3 3 0 1 0-6 0 3 3 0 0 0 6 0z"/><path fill-rule="evenodd" d="M13 8a4 4 0 1 0-8 0 4 4 0 0 0 8 0zm-8 4a5 5 0 0 1 10 0v1H1v-1a5 5 0 0 1 4-4.9z"/></svg>
            User
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 {{ request()->routeIs('admin.order') ? 'active' : '' }}" href="{{ route('admin.order') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172z"/></svg>
            Order
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 {{ request()->routeIs('admin.product') ? 'active' : '' }}" href="{{ route('admin.product') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16"><path d="M8.186 1.113a1 1 0 0 0-.372 0l-6 1.5A1 1 0 0 0 1 3.5v9a1 1 0 0 0 .814.986l6 1.5a1 1 0 0 0 .372 0l6-1.5A1 1 0 0 0 15 12.5v-9a1 1 0 0 0-.814-.986l-6-1.5zM2 4.118l6 1.5 6-1.5V3.5a.5.5 0 0 0-.407-.492l-6-1.5a.5.5 0 0 0-.186 0l-6 1.5A.5.5 0 0 0 2 3.5v.618zm12 1.382-6 1.5-6-1.5V12.5a.5.5 0 0 0 .407.492l6 1.5a.5.5 0 0 0 .186 0l6-1.5A.5.5 0 0 0 14 12.5V5.5z"/></svg>
            Product
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 {{ request()->routeIs('admin.category') ? 'active' : '' }}" href="{{ route('admin.category') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16"><path d="M3 2a1 1 0 0 0-1 1v2.586a1 1 0 0 0 .293.707l7.586 7.586a2 2 0 0 0 2.828 0l2.586-2.586a2 2 0 0 0 0-2.828l-7.586-7.586A1 1 0 0 0 5.586 1H3zm1 1h2.586l7.586 7.586a1 1 0 0 1 0 1.414l-2.586 2.586a1 1 0 0 1-1.414 0L3 5.414V3zm1 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
            Category
          </a>
        </li>
        <li class="nav-item">

          <p>Notification</p>
        </li>
      </ul>
    </div>

    <!-- Nội dung chính -->
   <div class="flex-grow-1 p-4 content-area">

      @yield('content')
    </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.forEach(function (el) {
        new bootstrap.Tooltip(el, {
          delay: { show: 0, hide: 0 },
          trigger: 'hover focus'
        });
      });
    });
  </script>
</body>
</html>




