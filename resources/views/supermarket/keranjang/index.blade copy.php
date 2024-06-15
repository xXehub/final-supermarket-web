<!-- resources/views/keranjang/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Keranjang</div>
                    <div class="card-body">
                        @if ($keranjangs->isEmpty())
                            <p>Keranjang Anda kosong.</p>
                        @else
                            <table class="table" id="keranjangTable">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
