<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\File;

class ControllerList extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($user = User::find($id)) {
            return view('view', compact('user'));
        }
        return redirect()->route('list')->withErrors('Khong tim thay nguoi dung !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($user = User::find($id)) {
            return view('update', compact('user'));

        }
        return redirect()->route('list')->withErrors('Khong tim thay!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($user = User::find($id)) {
            $request->validate([
                'name' => 'required|string|max:254',
                'email' => 'required|email',
                'password' => 'required|string|confirmed|min:6',
                'password_confirmation' => 'required|string',
                'phone' => 'required|numeric|min:10',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $oldImgae = $user->image;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->phone = $request->input('phone');

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $user->image = $imageName;

            if ($user->save()) {
                $imageOldPath = 'image/' . $oldImgae;
                if (File::exists($imageOldPath)) {
                    File::delete($imageOldPath);
                }
                $image->move(public_path('image'), $imageName);
                return redirect()->route('list')->withSuccess('Thay doi thanh cong');
            }
            return redirect()->route('list')->withErrors('Thay doi khong thanh cong');

        }
        return redirect()->route('list')->withErrors('Nguoi dung khong ton tai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        if ($user = User::find($id)) {
            $image = $user->image;
            $user->delete();
            $imagePath = 'image/' . $image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return redirect()->route('list')->withSuccess('xoa thanh cong !');
        }
        return redirect()->route('list')->withErrors('khong tim thay nguoi dung !');
    }
}
