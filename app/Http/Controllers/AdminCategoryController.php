<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    // Hiển thị danh sách danh mục, có tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $categories = Category::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'LIKE', "%{$keyword}%");
        })->orderBy('id', 'asc')->paginate(10);

        return view('admin.category', compact('categories'));
    }

    // Thêm danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/categories'), $imageName);
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imageName,
        ]);

        return redirect()->route('admin.category')->with('success', 'Thêm danh mục thành công!');
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => "required|string|max:100|unique:categories,name,{$id}",
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($category->image && File::exists(public_path('img/categories/' . $category->image))) {
                File::delete(public_path('img/categories/' . $category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('admin.category')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra có sản phẩm liên quan không
        if (method_exists($category, 'products') && $category->products()->count() > 0) {
            return redirect()->route('admin.category')
                             ->with('error', 'Không thể xóa danh mục vì còn sản phẩm liên quan.');
        }

        // Xóa ảnh nếu có
        if ($category->image && File::exists(public_path('img/categories/' . $category->image))) {
            File::delete(public_path('img/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Xóa danh mục thành công!');
    }
}
