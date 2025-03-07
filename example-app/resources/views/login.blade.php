@extends('head')
@section('title', 'Login')
@section('content')
    <div class="content">
        <div class="Form">
            <h5 style="text-align: center">Màn hình đăng nhập</h5>
            @if ($errors->any())
                <div class="text-danger">{{ $errors->first() }}</div>
            @endif
            @if (Session::has('success'))
                <div class="text-danger">{{ Session::get('success') }}</div>
            @endif
            <form action="{{ route('login.custom', []) }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input class="inpuet_customm" type="email" name="email" required />
                        </td>
                    </tr>
                    <tr>
                        <td>Mật khẩu</td>
                        <td>
                            <input class="inpuet_customm" type="password" name="password" required />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="inpuet_customm" type="checkbox" name="remember" />
                            <label for="remember">Ghi nhớ đăng nhập</label>
                        </td>
                    </tr>
                </table>
                <div class="btnConfirm">
                    <a href="#">Quên mật khẩu</a>
                    <button type="submit" class="btnSubmit">Đăng nhập</button>
                </div>
                {{-- lay thong bao loi --}}
                {{-- @if ($errors->any())
                    <div class="text-danger">{{ $errors->first() }}</div>
                @endif --}}
            </form>
        </div>
    </div>
@endsection
