@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <!-- Judul halaman -->
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Detail Pembayaran
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <!-- Informasi detail pembayaran -->
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>ID Pembayaran:</strong> {{ $pembayaran->id }}</p>
                                    <p><strong>Nama:</strong> {{ $pembayaran->pemesanan->kode_pesanan }}</p>
                                    <p><strong>Tanggal Dibuat:</strong> {{ $pembayaran->created_at }}</p>
                                    <p><strong>Tanggal Diperbarui:</strong> {{ $pembayaran->updated_at }}</p>
                                </div>
                            </div>
                            <!-- Tombol kembali -->
                            <div class="mt-4">
                                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
