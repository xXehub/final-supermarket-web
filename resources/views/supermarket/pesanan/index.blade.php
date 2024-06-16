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
                                Keranjang Anda
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <div class="input-group" style="display:inline-flex; width:auto;">
                                        <input type="text" class="form-control"
                                            value="Rp. {{$totalBayar}}" readonly>
                                        <button type="button" class="btn">Bayar</button>
                                        <button data-bs-toggle="dropdown" type="button"
                                            class="btn dropdown-toggle dropdown-toggle-split"></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Kosongkan</a>
                                        </div>
                                    </div>
                                </div>
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
                                    <table class="table table-vcenter table-mobile-md card-table" id="pesananTable">
                                        <thead>
                                            <br />
                                            <tr>
                                                <th style="width: 10%;">ID</th>
                                                <th style="width: 45%;">Kode Pesanan</th>
                                                <th style="width: 45%;">Tanggal Pesanan</th>
                                                <th style="width: 15%;">Total bayar</th>
                                                <th style="width: 15%;">Status Pengiriman</th>
                                                <th style="width: 15%;">Status Pembayaran</th>
                                                <th style="width: 15%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- gawe nyeluk modal create e om :d --}}
        {{-- @include('panel.produk.create') --}}
        @include('supermarket.keranjang.edit') 
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
