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
                        <a href="{{ route('admin.products.create') }}">Create</a>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Material</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Updated at</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img width="100" src="../{{ $product->img }}" alt=""></td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->cate_name }}</td>
                        <td>{{ $product->material_name }}</td>
                        <td>{{ $product->color_name }}</td>
                        <td>{{ $product->size_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
