@extends('head')
@section('title', 'Register')
@section('content')
    <div class="content">
        <div class="Form">
            <h5 style="text-align: center">Màn hình đăng ký</h5>
            <form action="{{ route('register.custom', []) }}" method="post" enctype="multipart/form-data">
                @csrf
                <table>
                    <tr>
                        <td>Name</td>

                        <td>
                            <input class="inpuet_customm @error('name') is-invalid @enderror" type="text" name="name" />

                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>Email</td>

                        <td>
                            <input class="inpuet_customm @error('email') is-invalid @enderror" type="email"
                                name="email" />

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>Mật khẩu</td>

                        <td>
                            <input class="inpuet_customm  @error('name') is-invalid @enderror" type="password"
                                name="password" />

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Nhập Lại Mật khẩu</td>
                        <td>
                            <input class="inpuet_customm  @error('name') is-invalid @enderror" type="password"
                                name="password_confirmation" />

                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input class="inpuet_customm  @error('name') is-invalid @enderror" type="phone"
                                name="phone" />

                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            <input class="inpuet_customm  @error('name') is-invalid @enderror" accept="image/*"
                                type="file" name="image" />

                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>


                </table>
                <div class="btnConfirm">
                    <a href="{{ route('login', []) }}">Đã có tài khoản</a>
                    <button type="submit" class="btnSubmit">Đăng Ký</button>
                </div>
            </form>
        </div>
    </div>
@endsection
