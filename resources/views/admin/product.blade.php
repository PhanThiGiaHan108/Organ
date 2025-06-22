@extends('layouts.AdminLayout')
@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="  color: rgb(71, 160, 78);">Home</a></li>
                <li class="breadcrumb-item"><a href="#" style="  color: rgb(71, 160, 78);">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Management</li>
            </ol>
        </nav>
    </div>
</div>

<h1 class="mb-4 text-black">Product Management</h1>

<div class="d-flex justify-content-between mb-3">
    <div class="mb-3" style="width: 33%;">
        <form class="d-flex" role="search" method="GET" action="{{ route('admin.product') }}">
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search by name" value="{{ request('keyword') }}" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal" >
            + Thêm sản phẩm
        </button>
    </div>
</div>

<!-- Bảng sản phẩm -->
<table class="table table-hover align-middle mt-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>#{{ $product->id }}</td>
            <td><img src="{{ asset('img/product/' . $product->image) }}" alt="Image" width="50" height="50"></td>
            <td>{{ $product->name }}</td>
            <td>
                @if ($product->discount_price)
                    <span class="text-decoration-line-through text-muted">{{ number_format($product->price) }}đ</span><br>
                    <span class="text-danger">{{ number_format($product->discount_price) }}đ</span>
                @else
                    {{ number_format($product->price) }}đ
                @endif
            </td>
            <td>{{ $product->stock }}</td>
             <td>
                <a href="#" class="text-decoration-none text-primary me-2" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">Details</a>
                <a href="#" class="text-decoration-none text-warning me-2" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                    <span data-bs-toggle="tooltip" title="Edit">✎</span>
                </a>
                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-danger text-decoration-none">
                        <span data-bs-toggle="tooltip" title="Delete">🗑️</span>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
  {{ $products->links('pagination::bootstrap-5') }}

</div>

<style>
.pagination {
    --bs-pagination-color: #2575fc;
    --bs-pagination-hover-color: #fff;
    --bs-pagination-active-bg: #2575fc;
    --bs-pagination-active-border-color: #2575fc;
    --bs-pagination-hover-bg: #6a11cb;
    --bs-pagination-hover-border-color: #6a11cb;
    font-size: 1.1rem;
}
.pagination .page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    transition: background 0.2s, color 0.2s;
}
</style>

<!-- Modal: Edit Product -->
@foreach ($products as $product)
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Giá</label>
                        <input type="number" class="form-control" name="price" value="{{ intval(old('price', $product->price)) }}" required> <span class="input-group-text">VNĐ</span>
                    </div>
                    <div class="mb-3">
                        <label>Giá giảm (nếu có)</label>
                        <input type="number" step="1" class="form-control" name="discount_price" value="{{ intval(old('discount_price', $product->discount_price)) }}"> <span class="input-group-text">VNĐ</span>
                    </div>
                    <div class="mb-3">
                        <label>Tồn kho</label>
                        <input type="number" class="form-control" name="stock" value="{{ old('stock', $product->stock) }}">
                    </div>
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description', $product->description) }}" maxlength="200">
                    </div>
                    <div class="mb-3">
                        <label>Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        @if ($product->image)
                            <img src="{{ asset('img/product/' . $product->image) }}" alt="Image" width="100" class="mt-2">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach


<!-- Modal: Product Details -->
@foreach ($products as $product)
<div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $product->id }}</li>
                    <li class="list-group-item"><strong>Tên:</strong> {{ $product->name }}</li>
                    <li class="list-group-item"><strong>Giá:</strong>
                        @if ($product->discount_price)
                            <span class="text-decoration-line-through">{{ number_format($product->price) }}</span>
                            <span class="text-danger">{{ number_format($product->discount_price) }}</span>
                        @else
                            {{ number_format($product->price) }}đ
                        @endif
                        
                    </li>
                    <li class="list-group-item"><strong>Tồn kho:</strong> {{ $product->stock }}</li>
                    <li class="list-group-item"><strong>Mô tả:</strong> {{ $product->description }}</li>
                    <li class="list-group-item">
                        <strong>Ảnh:</strong><br>
                        <img src="{{ asset('img/product/' . $product->image) }}" alt="Image" width="150">
                    </li>
                    <li class="list-group-item"><strong>Ngày tạo:</strong> {{ $product->created_at }}</li>
                    <li class="list-group-item"><strong>Cập nhật:</strong> {{ $product->updated_at }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal: Thêm sản phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label>Giá</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label>Giá giảm</label>
                        <input type="number" step="0.01" class="form-control" name="discount_price">
                    </div>
                    <div class="mb-3">
                        <label>Số lượng tồn kho</label>
                        <input type="number" class="form-control" name="stock">
                    </div>
                    <div class="mb-3">
                        <label>Danh mục</label>
                        <select class="form-select" name="category_id" required>
                            <option value="" disabled selected>-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="mb-3">
                        <label>Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
