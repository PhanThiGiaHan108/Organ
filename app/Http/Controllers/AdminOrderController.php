<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;


class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $orders = Order::when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->with('orderDetails.product') 
            ->latest()
            ->paginate(10);

        return view('admin.order', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:50',
            'email'         => 'required|email|max:150',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:200',
            'order_notes'   => 'nullable|string|max:1000',
            'total'         => 'required|numeric|min:0',
            'status'        => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'order_notes'   => $request->order_notes,
            'total'         => $request->total,
            'status'        => $request->status,
        ]);

        return redirect()->route('admin.order')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order')->with('success', 'Order deleted successfully.');
    }
}
