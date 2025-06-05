@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">--Select Product--</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
                @endforeach
            </select>
            @error('product_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <div class="mb-3">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">--Select Customer--</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
            @error('customer_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', 1) }}" class="form-control" required>
            @error('quantity')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
