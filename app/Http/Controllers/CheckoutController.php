<?php
namespace App\Http\Controllers;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function checkout(){
        return view('user.checkout');
    }
     public function submit(Request $request)
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
    }

    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $discount = session('discount.amount', 0);
    $total = $subtotal - $discount;

    // Lấy thông tin từ request (form checkout)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'order_notes' => 'nullable|string',
    ]);

    $order = Order::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'order_notes' => $request->order_notes,
        'subtotal' => $subtotal,
        'total' => $total,
        'payment_method' => 'cod', // mặc định là thanh toán khi nhận hàng
        'status' => 'pending', // đảm bảo cột này là string trong migration
    ]);

    foreach ($cart as $productId => $item) {
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
             'price' => $item['price'],
            'total' => $item['price'] * $item['quantity'],
        ]);
    }

    session()->forget(['cart', 'discount']);

    return redirect()->route('orders.success')->with('success', 'Đặt hàng thành công!');
}

}