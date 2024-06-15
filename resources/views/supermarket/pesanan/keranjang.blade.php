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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjangs as $keranjang)
                                        <tr>
                                            <td>{{ $keranjang->produk->nama_produk }}</td>
                                            <td>{{ $keranjang->jumlah }}</td>
                                            <td>{{ 'Rp ' . number_format($keranjang->produk->harga, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
