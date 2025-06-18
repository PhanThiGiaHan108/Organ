<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalCategories = Category::count();
    $totalProducts = Product::count();
    $totalOrders = Order::count();

    return view('admin.dashboard', compact(
        'totalUsers',
        'totalCategories',
        'totalProducts',
        'totalOrders'
    ));
}
}
