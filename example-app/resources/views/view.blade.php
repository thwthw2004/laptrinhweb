@extends('head')
@section('title', 'View')
@section('content')
    <div class="content">
        <div class="Form">
            <h5 style="text-align: center">Màn hình chi tiết</h5>
            @isset($user)
                <form action="{{ route('list.edit', ['id' => $user->id]) }}" method="get">
                    @csrf
                    <table>
                        <tr class="view">
                            <td> Username</td>
                            <td>
                                <p class="view"> {{ $user->name }} </p>
                            </td>
                        </tr>
                        <tr class="view">
                            <td>Email</td>
                            <td>
                                <p class="view"> {{ $user->email }}</p>
                            </td>
                        </tr>
                        <tr class="view">
                            <td>Phone</td>
                            <td>
                                <p class="view"> {{ $user->phone }}</p>
                            </td>
                        </tr>
                        <tr class="view">
                            <td>image</td>
                            <td>
                                <img style="width: 50px" src="{{ url('image/' . $user->image, []) }}" alt="">
                            </td>
                        </tr>
                    </table>
                    <div class="btnConfirm">
                        <button type="submit" class="btnSubmit">Chỉnh Sửa</button>
                    </div>
                </form>
            @endisset

        </div>
    </div>
@endsection
