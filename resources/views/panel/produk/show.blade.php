@extends('layouts.app')
@section('content')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    {{ $ingfo_sakkarepmu }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="col-md-6 col-lg-12">
                                <div class="row row-cards">
                                    <div class="col-12">
                                        <div class="card-body p-4 py-5 text-center">
                                            <span class="avatar avatar-xl mb-4 rounded"
                                                style="background-image: url('{{ $produk->gambar_produk ? asset('storage/produk/' . $produk->gambar_produk) : '' }}')"></span>
                                            <h3 class="mb-0">{{ $produk->nama_produk }}</h3>
                                            <p class="text-muted">{{ $produk->created_at }}</p>
                                            <p class="mb-3">
                                                <span class="badge bg-red-lt">Belum Terverifikasi</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Detail Kategori</h3>
                                <div class="card-actions">
                                    <a href="{{ route('produk.edit', ['produk' => $produk->id]) }}"data-bs-toggle="modal"
                                        data-bs-target="#modal-editData">
                                        Edit pemesanan
                                        <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Kode Produksi</div>
                                        <div class="datagrid-content">{{ $produk->kode_produk }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Nama Produk</div>
                                        <div class="datagrid-content">{{ $produk->nama_produk }}</div>
                                    </div>
                                    {{-- total belom ke fix --}}
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">supplier</div>
                                        <div class="datagrid-content">
                                            {{ $produk->supplier->nama_supplier }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Kategori</div>
                                        <div class="datagrid-content">{{ $produk->kategori->nama_kategori }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Stock</div>
                                        <div class="datagrid-content">{{ $produk->stock }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Harga</div>
                                        <div class="datagrid-content">
                                            {{ 'Rp ' . number_format($produk->harga, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Deskripsi</div>
                                        <div class="datagrid-content">
                                            {{ $produk->deskripsi }}</div>
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
