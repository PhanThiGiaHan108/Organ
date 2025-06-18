<?php
namespace App\Http\Controllers;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('user.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Ví dụ: Gửi mail hoặc lưu vào DB
        // Mail::to('organshop@gmail.com')->send(new ContactMail($request->all()));

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ!');
    }
}

