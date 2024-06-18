@extends('layouts.app')
@section('content')
    {{-- gawe auth check --}}
    @if (Auth::check())
        <div class="page">
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Account Settings
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="row g-0">
                              {{-- gawe sidebar --}}
                              @include('profile.sidebar')
                                <div class="col d-flex flex-column">
                                    <div class="card-body">
                                        <div class="container-xl">
                                            {{-- <div class="card"> --}}
                                                {{-- <div class="card-body"> --}}
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-vcenter table-mobile-md card-table" id="pesananlogsTable">
                                                                <thead>
                                                                    <br />
                                                                    <tr>
                                                                        <th style="width: 10%;">ID</th>
                                                                        <th style="width: 20%;">Kode Pesanan</th>
                                                                        <th style="width: 15%;">Tanggal Pesanan</th>
                                                                        <th style="width: 35%;">Total bayar</th>
                                                                        <th style="width: 15%;">Status Pengiriman</th>
                                                                        <th style="width: 15%;">Status Pembayaran</th>
                                                                        {{-- <th style="width: 15%;">Actions</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                {{-- </div> --}}
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endsection
