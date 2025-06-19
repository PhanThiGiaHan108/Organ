<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact; 
use App\Models\ContactReply;

class NotificationController extends Controller
{
    // Trang admin: hiển thị tất cả liên hệ + phản hồi
    public function index()
    {
        // Đánh dấu toàn bộ liên hệ là đã đọc (chỉ nên dùng cho admin)
        Contact::where('is_read', false)->update(['is_read' => true]);

        // Lấy liên hệ mới nhất và phản hồi tương ứng
        $contacts = Contact::with('replies')->latest()->get();

        return view('admin.notification', compact('contacts'));
    }

    // Admin gửi phản hồi
    public function storeReply(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'reply' => 'required|string',
        ]);

        ContactReply::create([
            'contact_id' => $request->contact_id,
            'replied_by_user_id' => Auth::id(),
            'reply' => $request->reply,
        ]);

        return redirect()->back()->with('success', 'Đã gửi phản hồi!');
    }

    // Lấy số thông báo chưa đọc của user
    public function unreadCount()
    {
        $userEmail = Auth::user()->email;

        $unreadCount = Contact::where('email', $userEmail)
                              ->whereHas('replies') 
                              ->where('is_read', false)
                              ->count();

        return response()->json(['count' => $unreadCount]);
    }

    // Trang user xem các tin nhắn & đánh dấu đã đọc
    public function message()
    {
        $userEmail = Auth::user()->email;

        // Đánh dấu các phản hồi dành cho user hiện tại là đã đọc
        Contact::where('email', $userEmail)
            ->whereHas('replies') // chỉ đánh dấu những cái đã được trả lời
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Lấy tất cả liên hệ đã gửi kèm phản hồi
        $contacts = Contact::with('replies')
            ->where('email', $userEmail)
            ->latest()
            ->get();

        return view('user.contact-messages', compact('contacts'));
    }

    // Tùy chọn: Tổng số tất cả các liên hệ có phản hồi (có thể dùng sau)
    public function totalCount()
    {
        $userEmail = Auth::user()->email;

        $total = Contact::where('email', $userEmail)
                        ->whereHas('replies')
                        ->count();

        return response()->json(['total' => $total]);
    }
    public function counts()
{
    $userEmail = Auth::user()->email;

    $total = Contact::where('email', $userEmail)
                    ->whereHas('replies')
                    ->count();

    $unread = Contact::where('email', $userEmail)
                     ->whereHas('replies')
                     ->where('is_read', false)
                     ->count();

    return response()->json([
        'total' => $total,
        'unread' => $unread
    ]);
}

}
