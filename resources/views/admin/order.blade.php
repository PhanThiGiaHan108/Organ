@extends('layouts.AdminLayout')

@section('title', 'Order Management')
@section('content')

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="  color: rgb(71, 160, 78);">Home</a></li>
                <li class="breadcrumb-item"><a href="#" style="  color: rgb(71, 160, 78);">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Management</li>
            </ol>
        </nav>
    </div>
</div>

<h2 class="mb-4 text-black">Order Management</h2>

<div class="mb-3" style="width: 33%;">
    <form class="d-flex" role="search" method="GET" action="{{ route('admin.order') }}">
        @csrf
        <input class="form-control me-2" type="search" name="keyword" placeholder="Search by name" value="{{ request('keyword') }}" />
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

<table class="table table-hover align-middle mt-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Total</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ number_format($order->total, 0, ',', '.') }}₫</td>
            <td>
                @switch($order->status)
                    @case('pending') Pending @break
                    @case('processing') Processing @break
                    @case('completed') Completed @break
                    @case('cancelled') Cancelled @break
                    @default Unknown
                @endswitch
            </td>
            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <a href="#" class="text-decoration-none text-primary me-2" data-bs-toggle="modal" data-bs-target="#orderDetailModal{{ $order->id }}">Details</a>
                <a href="#" class="text-decoration-none text-warning me-2" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">
                    <span data-bs-toggle="tooltip" title="Edit">✎</span>
                </a>
                <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
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

<!-- Edit Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Order #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $order->name) }}" required maxlength="50" /></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $order->email) }}" required maxlength="150" /></div>
                <div class="mb-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $order->phone) }}" required maxlength="20" /></div>
                <div class="mb-3"><label class="form-label">Address</label><input type="text" name="address" class="form-control" value="{{ old('address', $order->address) }}" required maxlength="200" /></div>
                <div class="mb-3"><label class="form-label">Notes</label><textarea name="order_notes" class="form-control" maxlength="1000">{{ old('order_notes', $order->order_notes) }}</textarea></div>
                <div class="mb-3"><label class="form-label">Total</label><input type="number" name="total" class="form-control" value="{{ old('total', $order->total) }}" required min="0" /></div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Detail Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Detail #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <div>
                        <h5 class="mb-0">{{ $order->name }}</h5>
                        <small class="text-muted">{{ $order->email }}</small>
                    </div>
                </div>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Products:</strong></p>
              
                        <ul>
                            @foreach ($order->orderDetails as $item)
                                <li>{{ $item->product->name ?? 'N/A' }} x {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
              

                <p><strong>Total:</strong><td>{{ number_format($order->total, 0, ',', '.') }}₫</td></p>
                <p><strong>Status:</strong>
                    @switch($order->status)
                        @case('pending') Pending @break
                        @case('processing') Processing @break
                        @case('completed') Completed @break
                        @case('cancelled') Cancelled @break
                        @default Unknown
                    @endswitch
                </p>
                <p><strong>Notes:</strong> {{ $order->order_notes ?? 'N/A' }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
