@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <a href="{{ route('users.create') }}" class="btn btn-xs btn-info pull-right">Add User</a>
        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope=" col" style="width:5%" class="text-center">ID</th>
                    <th scope="col" style="width:20%" class="text-center">Name</th>
                    <th scope="col" style="width:5%" class="text-center">Edit</th>
                    <th scope="col" style="width:5%" class="text-center">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users['data'] as $item)
                    <tr class="thien1">
                        <td class="text-center">{{ $item['id'] }}</td>
                        <td class="text-center">{{ $item['name'] }}</td>
                        <td class="text-center">
                            <a href=" {{ route('users.edit', ['user' => $item['id']]) }}" class="btn btn-info">Edit</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('users.destroy', ['user' => $item['id']]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return  confirm('Are you sure?')"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!--Model add type-->


    <!--Modal add product-->

    <!-- Button trigger modal -->


    <!-- Modal -->

@endsection
