@extends('layouts.AdminLayout')

@section('title', 'Quản Lý Danh Mục')

@section('content')
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category Management</li>
            </ol>
        </nav>
    </div>

    <h2 class="mb-4 text-black">Category Management</h2>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <div class="mb-3" style="width: 33%;">
            <form class="d-flex" role="search" method="GET" action="{{ route('admin.category') }}">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Search by name" value="{{ request('keyword') }}" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                + Thêm danh mục
            </button>
        </div>
    </div>

    <table class="table table-hover align-middle mt-0">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>#{{ $category->id }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('img/categories/' . $category->image) }}" alt="{{ $category->name }}" width="50" height="50">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        {{-- Edit --}}
                        <a href="#" class="text-decoration-none text-warning me-2"
                           data-bs-toggle="modal"
                           data-bs-target="#editCategoryModal{{ $category->id }}"
                           title="Edit">
                            <i class="bi bi-pen"></i>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('admin.category', $category->id) }}" method="POST"
                              style="display:inline-block;"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 m-0 text-danger text-decoration-none" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $categories->links() }}
    </div>

    {{-- Modal Edit --}}
    @foreach ($categories as $category)
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
             aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form method="POST" action="{{ route('admin.category', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chỉnh sửa danh mục</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $category->id }}" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name', $category->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ảnh danh mục (tùy chọn)</label>
                                <input type="file" class="form-control" name="image">
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

    {{-- Modal Add --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form method="POST" action="{{ route('admin.category') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm danh mục mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newCategoryName" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" required placeholder="Nhập tên danh mục">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh danh mục</label>
                            <input type="file" class="form-control" name="image">
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
</div>
@endsection
