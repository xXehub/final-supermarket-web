@extends('layouts.app')

@section('content')
    <div class="page">
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
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="{{ route('produk.exportExcel') }}" class="btn">
                                        Cetak
                                    </a>
                                </span>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-tambahData">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Produk
                                </a>
                                <a href="{{ route('produk.create') }}" class="btn btn-primary d-sm-none btn-icon"
                                    data-bs-toggle="modal" data-bs-target="#modal-tambahData" aria-label="Tambah Produk">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-mobile-md card-table" id="produkTable">
                                        <thead>
                                            <br />
                                            <tr>
                                                <th style="width: 10%;">ID</th>
                                                <th style="width: 45%;">Produk</th>
                                                <th >Hidden</th>
                                                <th >Hidden</th>
                                                <th style="width: 15%;">Kategori</th>
                                                <th style="width: 15%;">Supplier</th>
                                                <th style="width: 10%;">Harga</th>
                                                <th style="width: 10%;">Quantity</th>
                                                <th style="width: 30%;">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- gawe nyeluk modal create e om :d --}}
        @include('panel.produk.create')
        @include('panel.produk.edit')
        <script>
            jQuery(document).ready(function($) {
                // Periksa apakah sedang dalam mode edit dan terdapat kesalahan validasi pada form edit
                @if (Route::is('produk.edit') && $errors->any())
                    $('#modal-editData').modal('show');
                    // Periksa apakah sedang dalam mode tambah dan terdapat kesalahan validasi pada form tambah
                @elseif (Route::is('produk.create') && $errors->any())
                    $('#modal-tambahData').modal('show');
                @endif
            });
        </script>
        
        {{-- gawe notif sukses --}}
        @if ($message = Session::get('hapus'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: '{{ $message }}'
                });
            </script>
        @endif
    @endsection
