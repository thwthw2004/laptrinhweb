<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

//Unknow
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function login()
    {
        return view('login');
    }

    public function customLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('list')->withSuccess('Signed in' . $remember);
        }
        return redirect()->back();
    }

    public function registration()
    {
        return view('register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:254',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'image' => $imageName,
        ]);
        if ($user->save()) {
            $image->move(public_path('image'), $imageName);
            return redirect("login");
        }
        return back();
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])

        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route(('login'))->withSuccess('Logout thanh cong');
    }
}
