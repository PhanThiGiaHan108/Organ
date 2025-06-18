<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {  $categories = Category::all();
         $products = Product::with('category')->get();
        return view('user.home', compact('categories','products'));;
    }
 public function shop(Request $request)
{
    $categories = Category::withCount('products')->get();

    $query = Product::query();

    // Lọc theo tên (từ ô tìm kiếm)
    if ($request->has('keyword')) {
        $keyword = $request->input('keyword');
        $query->where('name', 'like', '%' . $keyword . '%');
    }

    // Lọc theo danh mục (dùng slug)
    if ($request->has('category')) {
        $category = Category::where('slug', $request->category)->first();
        if ($category) {
            $query->where('category_id', $category->id);
        }
    }

    // Lọc theo mức giá nếu có
    if ($request->has('price') && $request->price != '') {
        $priceParts = explode('-', $request->price);
        if (count($priceParts) == 2) {
            $min = (int)$priceParts[0];
            $max = (int)$priceParts[1];
            $query->whereBetween('price', [$min, $max]);
        }
    }

    // Lấy min-max để truyền ra view (nếu muốn hiển thị "Giá thấp nhất" hoặc "Giá cao nhất")
    $minPrice = Product::min('price');
    $maxPrice = Product::max('price');

    // Lấy danh sách sản phẩm có phân trang, giữ lại query khi chuyển trang
    $products = $query->paginate(6)->appends($request->query());

    // Sản phẩm khuyến mãi và mới nhất (không bị ảnh hưởng bởi lọc)
    $discountedProducts = Product::whereNotNull('discount_price')
        ->whereColumn('discount_price', '<', 'price')
        ->take(6)->get();

    $latestProducts = Product::orderBy('created_at', 'desc')->take(6)->get();

    return view('user.shop', compact(
        'categories',
        'products',
        'discountedProducts',
        'latestProducts',
        'minPrice',
        'maxPrice'
    ));
}



    public function showCategories()
    {
    $categories = Category::all();
    return view('user.home', compact('categories'));
    }
    public function detail($slug)
    {
        // $product = Product::where('slug', $slug)->firstOrFail();
        // return view('user.productdetail', compact('product'));
          $product = Product::where('slug', $slug)->with('category')->firstOrFail();

    $relatedProducts = Product::where('category_id', $product->category_id)
                        ->where('id', '!=', $product->id)
                        ->latest()
                        ->take(4) // lấy 4 sản phẩm liên quan
                        ->get();

    return view('user.productdetail', compact('product', 'relatedProducts'));
    }


    public function filterByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $categories = Category::withCount('products')->get();
        $products = Product::where('category_id', $category->id)->paginate(12);

        return view('user.shop', compact('products', 'categories', 'category'));
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->get();

        $categories = Category::withCount('products')->get(); // đảm bảo có danh sách category nếu trang shop cần

        return view('user.shop', [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
        ]);
    }
    

   
    

    


}
   



