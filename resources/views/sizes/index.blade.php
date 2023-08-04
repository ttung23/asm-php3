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
                        <a href="{{ route('admin.sizes.create') }}">Create</a>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Updated at</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($sizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td>{{ $size->name }}</td>
                        <td>{{ $size->updated_at }}</td>
                        <td>{{ $size->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.sizes.edit', $size) }}">Edit</a>
                            <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST">
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
