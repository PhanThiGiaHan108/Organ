<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class AdminProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $products = Product::when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $categories = Category::all();
        return view('admin.product', compact('products', 'categories'));
    }

     // Thêm sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock ?? 0,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.product')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => "required|string|max:255|unique:products,name,{$id}",
        'price' => 'required|integer|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Cập nhật ảnh nếu có
    if ($request->hasFile('image')) {
        if ($product->image && File::exists(public_path('img/product/' . $product->image))) {
            File::delete(public_path('img/product/' . $product->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/product'), $imageName);
        $product->image = $imageName;
    }

    $product->name = $request->name;
    $product->slug = Str::slug($request->name) . '-' . uniqid();
    $product->price = $request->price;
    $product->discount_price = $request->discount_price;
    $product->stock = $request->stock ?? 0;
    $product->category_id = $request->category_id;
    $product->description = $request->description;

    $product->save();
return redirect()->route('admin.product')->with('success', 'Cập nhật sản phẩm thành công!');


}

    // Xóa sản phẩm
    public function destroy($id)
{
    $product = Product::findOrFail($id);

    if ($product->image && File::exists(public_path('img/product/' . $product->image))) {
        File::delete(public_path('img/product/' . $product->image));
    }

    $product->delete();

    return redirect()->route('admin.product')->with('success', 'Xóa sản phẩm thành công!');
}

}
