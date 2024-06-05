@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h1>
    <form action="{{ isset($product) ? route('produk.update', $product->id) : route('produk.store') }}" method="POST">
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="kode_produk">Product Code:</label>
            <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="{{ isset($product) ? $product->kode_produk : '' }}">
        </div>
        <div class="form-group">
            <label for="nama_produk">Name:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ isset($product) ? $product->nama_produk : '' }}">
        </div>
        <div class="form-group">
            <label for="kategori_id">Category:</label>
            <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ isset($product) ? $product->kategori_id : '' }}">
        </div>
        <div class="form-group">
            <label for="harga">Price:</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ isset($product) ? $product->harga : '' }}">
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ isset($product) ? $product->stock : '' }}">
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
