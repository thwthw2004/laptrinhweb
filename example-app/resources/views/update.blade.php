@extends('head')
@section('title', 'Update')
@section('content')
    <div class="content">
        <div class="Form">
            <h5 style="text-align: center">Màn hình cập nhật</h5>
            @isset($user)
                <form action="{{ route('list.update', ['id' => $user->id]) }}" method="post"enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input class="inpuet_customm  @error('name') is-invalid @enderror" type="name" name="name"
                                    value="{{ $user->name }}" />

                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Mật khẩu</td>

                            <td>
                                <input class="inpuet_customm  @error('password') is-invalid @enderror" type="password"
                                    name="password" />

                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Nhập Lại Mật khẩu</td>
                            <td>
                                <input class="inpuet_customm  @error('password_confirmation') is-invalid @enderror"
                                    type="password" name="password_confirmation" />

                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>

                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input class="inpuet_customm  @error('email') is-invalid @enderror"
                                    type="email"value="{{ $user->email }}" name="email" />

                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input class="inpuet_customm  @error('name') is-invalid @enderror" type="phone"
                                    name="phone"value="{{ $user->phone }}" />

                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>

                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>
                                <input class="inpuet_customm  @error('image') is-invalid @enderror" accept="image/*"
                                    type="file" name="image" value="{{ $user->image }}" />

                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>


                    </table>
                    <div class="btnConfirm">
                        <button type="submit" class="btnSubmit">Update</button>
                    </div>
                </form>
            @endisset

        </div>
    </div>
@endsection
