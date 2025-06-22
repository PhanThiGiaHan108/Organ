<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - OrganShop</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my_style.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="fixed w-64 h-full bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out z-50" id="sidebar">
            <div class="flex items-center justify-center h-16 bg-indigo-800 text-white">
                <span class="text-xl font-bold"  >Admin</span>
            </div>
            <div class="overflow-y-auto h-full">
                <ul class="mt-6">
                    <li class="px-4 py-2 text-gray-700 hover:bg-gray-200">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-gray-700 hover:bg-gray-200">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-gray-700 hover:bg-gray-200">
                        <a href="{{ route('admin.products.index') }}" class="flex items-center">
                            <i class="fas fa-box-open mr-2"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-gray-700 hover:bg-gray-200">
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 transition-all duration-200 ease-in-out">
            <div class="bg-white shadow p-4 flex justify-between items-center">
                <button id="toggleSidebar" class="md:hidden p-2 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-1 mx-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    <p class="text-gray-600 text-sm">@yield('subtitle')</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Create User
                </a>
            </div>

            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/my_script.js') }}"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
    @yield('scripts')
</body>
</html>