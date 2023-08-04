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
                        <a href="{{ route('admin.colors.create') }}">Create</a>
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
                    @foreach($colors as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->name }}</td>
                        <td>{{ $color->updated_at }}</td>
                        <td>{{ $color->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.colors.edit', $color) }}">Edit</a>
                            <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST">
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
