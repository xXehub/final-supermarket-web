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
    <div class="row">
        <div class="col-12">
            <div class="row mb-0">
                <div class="col-lg-9 col-xl-10">
                    <h4 class="mb-3"></h4>
                </div>
                <div class="col-lg-3 col-xl-2">
                    <div class="d-grid gap-2">
                        <a href="{{ route('produk.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah
                            Barang</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Note : </h4>
                    <h6 class="card-subtitle">Tabel ini digunakan untuk menampilkan seluruh isi database tabel
                        <code> $().Barangs();</code>. Bisa ditambahkan melalui button di atas
                    </h6> --}}

                    <div class="table-responsive">
                        <table class="table border table-striped table-bordered text-nowrap datatable" id="produkTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Barang</th>
                                    <th>Name</th>
                                    <th>Kategori</th>
                                    <th>Harga Barang</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    {{-- jquery all --}}
    @vite('resources/assets/libs/jquery/dist/jquery.min.js')
    <!-- Bootstrap tether Core JavaScript -->
    @vite('resources/assets/libs/popper.js/dist/umd/popper.min.js')
    @vite('resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')
    {{-- plugin datatable --}}
    @vite('resources/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')
    @vite('resources/assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')
    @vite('resources/dist/js/pages/datatable/datatable-basic.init.js')
@endsection
