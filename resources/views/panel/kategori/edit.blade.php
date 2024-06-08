@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('produk.update', ['produk' => $produk->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kode_produk">Product Code</label>
            <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="{{ $produk->kode_produk }}" required>
        </div>
        <div class="form-group">
            <label for="nama_produk">Product Name</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
        </div>
        <div class="form-group">
            <label for="kategori_id">Category ID</label>
            <input type="number" class="form-control" id="kategori_id" name="kategori_id" value="{{ $produk->kategori_id }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Price</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $produk->stock }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $produk->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
