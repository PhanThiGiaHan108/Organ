<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    // Hiển thị danh sách người dùng với tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('email', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id','asc')
            ->get();

        return view('admin.user', compact('users'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role'    => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'role'    => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'Cập nhật người dùng thành công!');
    }

    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Xóa người dùng thành công!');
    }
}
