@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Navbar -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">{{ $ingfo_sakkarepmu }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        {{-- kene --}}
                        <div class="col-md-6 col-lg-4">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body p-4 py-5 text-center">
                                            <span class="avatar avatar-xl mb-4 rounded" style="background-image: url('{{ $produk->gambar_produk ? asset('storage/produk/' . $produk->gambar_produk) : '' }}')"></span>

                                            <h3 class="mb-0">{{ $produk->nama_produk }}</h3>
                                            <p class="text-muted">{{ $produk->created_at }}</p>
                                            <p class="mb-3">
                                                <span class="badge bg-red-lt">Belum Terverifikasi</span>
                                            </p>
                                        </div>
                                        <div class="progress card-progress">
                                            <div class="progress-bar" style="width: 0%" role="progressbar"
                                                aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"
                                                aria-label="0% Complete">
                                                <span class="visually-hidden">38% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Detail Produk</h3>
                                                    <div class="card-actions">
                                                        <a href="{{ route('produk.edit', ['produk' => $produk->id]) }}"data-bs-toggle="modal"
                                                            data-bs-target="#modal-editData">
                                                            Edit
                                                            Produk<!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <dl class="row">
                                                        <dt class="col-5">Kode Produksi:</dt>
                                                        <dd class="col-7">{{ $produk->kode_produk }}</dd>
                                                        <dt class="col-5">Nama:</dt>
                                                        <dd class="col-7">{{ $produk->nama_produk }}</dd>
                                                        <dt class="col-5">Supplier:</dt>
                                                        <dd class="col-7">{{ $produk->supplier->nama_supplier }}</dd>
                                                        <dt class="col-5">Kategori:</dt>
                                                        <dd class="col-7">{{ $produk->kategori->nama_kategori }}</dd>
                                                        <dt class="col-5">Stock:</dt>
                                                        <dd class="col-7">
                                                            <span class="flag flag-country-pl"></span> {{ $produk->stock }}
                                                        </dd>
                                                        <dt class="col-5">Harga:</dt>
                                                        <dd class="col-7">{{ $produk->harga }}</dd>
                                                        <dt class="col-5">Deskripsi:</dt>
                                                        <dd class="col-7">{{ $produk->deskripsi }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- nyeluk modal edit mas --}}
            @include('panel.produk.edit')
        @endsection
