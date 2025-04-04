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
    <div class="content">
        <div class="row">
            <h4>Profile (1-1)</h4>
            First name : {{ $user->profile->first_name }} <br>
            Last name : {{ $user->profile->last_name }} <br>
        </div>

        <div class="row">
            <h4>Danh sách bài viết đã viết (1 - N)</h4>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Post name</th>
                </thead>
                <tbody>
                    @foreach ($user->posts as $post)
                        <tr>
                            <td>{{ $post->post_id }}</td>
                            <td>{{ $post->post_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <h4>Danh sách sở thích (N-N)</h4>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Favorite</th>
                </thead>
                <tbody>
                    @foreach ($user->favorities as $favorite)
                        <tr>
                            <td>{{ $favorite->favorite_id }}</td>
                            <td>{{ $favorite->favorite_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
