@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary">Add Product</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table mt-2">
        <tr>
            <th>ID</th>
            <th>Product Code</th>
            <th>Name</th>
            <th>Category ID</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        @foreach ($produk as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->kode_produk }}</td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->kategori_id }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->stock }}</td>
            <td>
                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
