@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $produk->nama_produk }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Product Code: {{ $produk->kode_produk }}</h5>
            <p class="card-text">Category ID: {{ $produk->kategori_id }}</p>
            <p class="card-text">Price: {{ $produk->harga }}</p>
            <p class="card-text">Stock: {{ $produk->stock }}</p>
            <p class="card-text">Description: {{ $produk->deskripsi }}</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Back to Products</a>
        </div>
    </div>
</div>
@endsection
