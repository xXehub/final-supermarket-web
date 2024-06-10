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
                                    Detail Pesanan
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Kategori</h3>
                                <div class="card-actions">
                                    <a href="{{ route('kategori.edit', ['kategori' => $kategori->id]) }}"data-bs-toggle="modal"
                                        data-bs-target="#modal-editKategori">
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
                                        <div class="datagrid-title">Kode Kategori</div>
                                        <div class="datagrid-content">{{ $kategori->kode_kategori }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Nama Kategori</div>
                                        <div class="datagrid-content">{{ $kategori->nama_kategori }}</div>
                                    </div>
                                    {{-- total belom ke fix --}}
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">deskripsi</div>
                                        <div class="datagrid-content">
                                            {{ $kategori->deskripsi }}</div>
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
    @include('panel.kategori.edit')
@endsection
