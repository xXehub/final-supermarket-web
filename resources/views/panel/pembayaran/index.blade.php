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
                                    <a href="#" class="btn">
                                        Cetak
                                    </a>
                                </span>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-tambahPembayaran">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Pembayaran
                                </a>
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary d-sm-none btn-icon"
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
                            <div id="table-default" class="table-responsive">
                                <table class="table" id="pembayaranTable">
                                    <br/>
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ID</th>
                                            <th style="width: 35%;">Kode Pesanan</th>
                                            <th style="width: 15%;">Total</th>
                                            <th style="width: 15%;">Total</th>
                                            <th style="width: 15%;">Metode</th>
                                            <th style="width: 15%;">Tanggal Pesan</th>
                                            <th style="width: 15%;">Status</th>
                                            <th style="width: 15%;">Action</th>
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
    @include('panel.pembayaran.create')
    {{-- @include('panel.pemesanan.edit') --}}
    <script>
        $(function() {
            $("#pembayaranTable").on("click", ".status-pending", function() {
                var row = $(this).closest("tr");
                var data = $("#pembayaranTable").DataTable().row(row).data();
                var pembayaranId = data.id; // Ambil ID pembayaran dari data baris yang diklik
                var token = $('meta[name="csrf-token"]').attr('content'); // Ambil CSRF token

                // Kirim permintaan AJAX untuk memperbarui status pembayaran menjadi "Dibayar"
                $.ajax({
                    url: '/update-status/' + pembayaranId,
                    type: 'POST',
                    data: {
                        _token: token,
                        status: 'dibayar' // Atur status menjadi "Dibayar"
                    },
                    success: function(response) {
                        // Jika permintaan berhasil, perbarui status pada tampilan
                        if (response.success) {
                            row.find('.badge').removeClass('bg-red').addClass('bg-green').text(
                                'Dibayar');
                        }
                    }
                });
            });
        });
    </script>
    {{-- gawe nyeluk modal create e om :d --}}
    {{-- @include('panel.pemesanan.create') --}}
    {{-- @include('panel.kategori.edit') --}}

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
