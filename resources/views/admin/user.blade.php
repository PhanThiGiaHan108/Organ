@extends('layouts.AdminLayout')
@section('title', 'Quản lý người dùng')

@section('content')
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Management</li>
            </ol>
        </nav>
    </div>
</div>

<h2 class="mb-4 text-black">User Management</h2>

<!-- Tìm kiếm -->
<div class="mb-3" style="width: 33%;">
    <form class="d-flex" role="search" method="GET" action="{{ route('admin.user') }}">
        @csrf
        <input class="form-control me-2" type="search" name="keyword" placeholder="Search by email" value="{{ request('keyword') }}" />
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

<!-- Bảng người dùng -->
<table class="table table-hover align-middle mt-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>#{{ $user->id }}</td>
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
                <strong>{{ $user->name }}</strong>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <!-- Chi tiết -->
                <a href="#" class="text-decoration-none text-primary me-2" data-bs-toggle="modal"
                   data-bs-target="#userModal{{ $user->id }}">Details</a>

                <!-- Sửa -->
                <a href="#" class="text-decoration-none text-warning me-2" data-bs-toggle="modal"
                   data-bs-target="#editUserModal{{ $user->id }}">
                    <span data-bs-toggle="tooltip" title="Edit">
                        ✏️
                    </span>
                </a>

                <!-- Xóa -->
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                    style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
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

<!-- Modal Sửa -->
@foreach ($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Chỉnh sửa người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role">
                            @foreach (['admin', 'user'] as $role)
                                <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
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

<!-- Modal Chi tiết -->
@foreach ($users as $user)
<div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                    <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $user->address }}</li>
                    <li class="list-group-item"><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                    <li class="list-group-item"><strong>Created At:</strong> {{ $user->created_at }}</li>
                    <li class="list-group-item"><strong>Updated At:</strong> {{ $user->updated_at }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
