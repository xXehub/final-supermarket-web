@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- This page plugin CSS -->
        <!-- <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
        @vite('resources/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')
        @vite('resources/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')
        <!-- Memuat jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Memuat plugin DataTables -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    </head>
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
                                    <a href="#" class="btn">
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
                                                <th style="width: 45%;">Hidden</th>
                                                <th style="width: 45%;">Hidden</th>
                                                <th style="width: 15%;">Kategori</th>
                                                <th style="width: 10%;">Harga</th>
                                                <th style="width: 10%;">Quantity</th>
                                                <th style="width: 10%;">Actions</th>
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

        @vite('resources/dist/libs/list.js/dist/list.min.js?1684106062')
        {{-- tabel --}}
        @vite('resources/dist/js/tabler.min.js?1684106062')
        @vite('resources/dist/js/demo.min.js?1684106062')


        {{-- jquery all --}}
        {{-- @vite('resources/assets/libs/jquery/dist/jquery.min.js') --}}
        <!-- Bootstrap tether Core JavaScript -->
        {{-- @vite('resources/assets/libs/popper.js/dist/umd/popper.min.js') --}}
        {{-- @vite('resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') --}}
        {{-- plugin datatable --}}
        @vite('resources/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')
        {{-- @vite('resources/assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') --}}
        {{-- @vite('resources/dist/js/pages/datatable/datatable-basic.init.js') --}}
    @endsection
