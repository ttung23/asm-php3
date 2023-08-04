@section('content')
<body>
    <div class="main">
        <!-- Change_Log start -->
        @if($message = Session::get('success'))
            <div>
                <p class="alert alert-success">{{$message}}</p>
            </div>
        @endif
        <section style="margin: 0 28px" class="section-sm" id="Change_Log">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.users.create') }}">Create</a>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th>Last_login</th>
                    <th>Updated at</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->active }}</td>
                        <td>{{ $user->last_login }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @method("delete")
                                @csrf
                                <button onclick="return confirm('XOA HA?')" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- Change_Log end -->
    </div>
</body>
@endsection
@extends('layout.layout')
