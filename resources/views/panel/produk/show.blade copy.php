@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $kategori->nama_kategori }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Category Code: {{ $kategori->kode_kategori }}</h5>
            <p class="card-text">Description: {{ $kategori->deskripsi }}</p>
            <a href="{{ route('kategori.index') }}" class="btn btn-primary">Back to Categories</a>
        </div>
    </div>
</div>
@endsection
