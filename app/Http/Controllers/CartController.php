<?php
namespace App\Http\Controllers;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
        public function shopCart()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('user.shopcart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $subtotal, // hoặc cộng phí ship
        ]);
    }
      

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] < 1) {
                    unset($cart[$id]); // tự động xóa nếu số lượng < 1
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }
    public function applyCoupon(Request $request)
{
    $code = trim($request->coupon_code);

    // Mã giảm giá cố định theo số tiền (đơn vị: đồng)
    $coupons = [
        'GIAM10' => 10000,
        'GIAM20' => 20000,
    ];

    if (!isset($coupons[$code])) {
        return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ!');
    }

    $discountAmount = $coupons[$code];

    $cart = session()->get('cart', []);
    $subtotal = 0;

    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // Giảm không vượt quá subtotal
    $discountAmount = min($discountAmount, $subtotal);

    // Lưu vào session
    session()->put('discount', [
        'code' => $code,
        'amount' => $discountAmount,
    ]);

    return redirect()->back()->with('success', 'Đã áp dụng mã giảm giá!');
}

    public function removeCoupon()
    {
        session()->forget('discount');
        return redirect()->back()->with('success', 'Đã bỏ mã giảm giá!');
    }







}