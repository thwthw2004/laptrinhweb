<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ControllerList extends Controller
{
    /**
     * Danh sách user (phân trang 10 user/trang)
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('list', compact('users'));
    }

    /**
     * Hiển thị thông tin chi tiết của user
     */
    public function show(string $id)
    {
        $user = User::with(['profile', 'posts', 'favorites'])->find($id);
        if ($user) {
            return view('view', compact('user'));
        }
        return redirect()->route('list')->withErrors('Không tìm thấy người dùng!');
    }

    /**
     * Hiển thị form chỉnh sửa user
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return view('update', compact('user'));
        }
        return redirect()->route('list')->withErrors('Không tìm thấy người dùng!');
    }

    /**
     * Cập nhật thông tin user
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('list')->withErrors('Người dùng không tồn tại!');
        }

        $request->validate([
            'name' => 'required|string|max:254',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            // 'password' => 'required|string|confirmed|min:6',
            // 'password_confirmation' => 'required|string',
            'age' => 'required|numeric|min:2',
            'facebook' => 'required|string|max:254',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Cập nhật thông tin
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->age = $request->input('age');
        $user->facebook = $request->input('facebook');

        // Xử lý ảnh mới (nếu có)
        if ($request->hasFile('image')) {
        $oldImage = $user->image;
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $user->image = $imageName;

        if ($user->save()) {
         if ($oldImage) {
         $oldImagePath = public_path('image/' . $oldImage);
        if (File::exists($oldImagePath)) {
        File::delete($oldImagePath);
            }
         }
         $image->move(public_path('image'), $imageName);
            }
         } else {
       $user->save();
        }

        return redirect()->route('list')->withSuccess('Cập nhật thành công!');
    }

    /**
     * Xóa user nếu không có bài viết hoặc sở thích
     */
    public function delete(string $id)
    {
        $user = User::with(['posts', 'favorites'])->find($id);
        if (!$user) {
            return redirect()->route('list')->withErrors('Không tìm thấy người dùng!');
        }

        // Kiểm tra user có bài viết hoặc sở thích không
        if ($user->posts->count() > 0) {
            return redirect()->route('list')->withErrors('Không thể xóa! Người dùng có bài viết.');
        }

        if ($user->favorites->count() > 0) {
            return redirect()->route('list')->withErrors('Không thể xóa! Người dùng có sở thích.');
        }

        // Xóa ảnh nếu có
         if ($user->image) {
            $imagePath = public_path('image/' . $user->image);
             if (File::exists($imagePath)) {
            File::delete($imagePath);
            }
        }

        // Xóa user
        $user->delete();

        return redirect()->route('list')->withSuccess('Xóa thành công!');
    }
}
