<?php
namespace App\Http\Controllers;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Hiển thị trang liên hệ.
     */
    public function contact()
    {
        return view('user.contact');
    }

    /**
     * Xử lý gửi form liên hệ.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Lưu thông tin liên hệ vào database
        Contact::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'message' => $validated['message'],
            'is_read' => false, // tin nhắn mới gửi sẽ chưa đọc
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ!');
    }



}
