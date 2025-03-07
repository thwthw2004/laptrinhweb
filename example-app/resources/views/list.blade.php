@extends('head')
@section('title', 'List')
@section('content')
    <div class="content">
        <h5 style="text-align: center">Danh sách user</h5>
        @if (Session::has('success'))
            <div class="text-danger">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 10%">#</th>
                    <th style="width: 10%">image</th>
                    <th style="width: 10%">Username</th>
                    <th style="width: 10%">Email</th>
                    <th style="width: 10%">phome</th>
                    <th style="width: 10%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @isset($users)
                    @foreach ($users as $item)
                        <tr>
                            <td> {{ $item->id }} </th>
                            <td> <img style="width: 50px" src="{{ url('image/' . $item->image, []) }}" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td> {{ $item->email }} </td>
                            <td> {{ $item->phone }} </td>
                            <td>
                                <a href="{{ route('list.edit', ['id' => $item->id]) }}">Edit</a>
                                | <a href="{{ route('list.view', ['id' => $item->id]) }}">View</a> |
                                <a href="{{ route('list.delete', ['id' => $item->id]) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-5') }}
        </form>

    </div>
@endsection
