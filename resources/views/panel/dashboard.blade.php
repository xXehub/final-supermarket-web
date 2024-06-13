@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="#" class="btn">
                                    New view
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
                                Create new report
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-tambahData" aria-label="Create new report">
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
                <div class="row row-deck row-cards">

                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                        <path d="M12 3v3m0 12v3" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    132 Sales
                                                </div>
                                                <div class="text-muted">
                                                    12 waiting payments
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17h-11v-14h-2" />
                                                        <path d="M6 5l14 1l-1 7h-13" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $totalSemuaPesanan }} Pesanan
                                                </div>
                                                <div class="text-muted">
                                                    {{ $totalPesananDiterima }} Diterima Customer
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                        <path d="M12 12l8 -4.5" />
                                                        <path d="M12 12l0 9" />
                                                        <path d="M12 12l-8 -4.5" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $totalProduk }} Produk
                                                </div>
                                                <div class="text-muted">
                                                    {{ $barangBaruToday }} Produk Baru Hari ini
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $totalUser }} User
                                                </div>
                                                <div class="text-muted">
                                                    {{ $userBaruToday }} Baru Hari ini
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Penjualan tracker</h3>
                                <div id="chart-pemesanan" class="chart-lg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-title">Register activity</div>
                            </div>

                            <div class="card-table table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>User</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    @foreach ($userAnyar as $user)
                                        <tbody>
                                            <tr>
                                                <td class="w-1">
                                                    <span class="avatar avatar-sm"
                                                        style="background-image: url({{ $user->gambar_profile ? asset('storage/' . $user->gambar_profile) : '' }})"></span>
                                                </td>
                                                <td class="td-truncate">
                                                    <div class="text-truncate">
                                                        {{ $user->name }}
                                                    </div>
                                                </td>
                                                <td class="text-nowrap text-muted">{{ $user->created_at->format('d M Y') }}
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-md">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                                        <path d="M10 10l.01 0" />
                                        <path d="M14 10l.01 0" />
                                        <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h3 class="h1">Kelompok 6 Abu Bakar</h3>
                                        <div class="markdown text-muted">
                                            Hasil akhir projek kami yang mengangkat judul
                                            <a href="https://github.com/xxehub" target="_blank"
                                                rel="noopener">supermarket web app</a>,
                                            Aplikasi kami open source yang sudah tersedia di github, kami mengerjakan dengan
                                            sepenuh hati agar menghasilkan aplikasi yang seperti anak sendiri
                                        </div>
                                        <div class="mt-3">
                                            <a href="https://github.com/xxehub" class="btn btn-primary" target="_blank"
                                                rel="noopener">Download Projek</a>
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
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(
                    document.getElementById("chart-user-register"), {
                        chart: {
                            type: "area",
                            fontFamily: "inherit",
                            height: 192,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 0.16,
                            type: "solid",
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: "Purchases",
                            data: [
                                3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30,
                                17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70,
                            ],
                        }, ],
                        tooltip: {
                            theme: "dark",
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: "datetime",
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: [
                            "2020-06-20",
                            "2020-06-21",
                            "2020-06-22",
                            "2020-06-23",
                            "2020-06-24",
                            "2020-06-25",
                            "2020-06-26",
                            "2020-06-27",
                            "2020-06-28",
                            "2020-06-29",
                            "2020-06-30",
                            "2020-07-01",
                            "2020-07-02",
                            "2020-07-03",
                            "2020-07-04",
                            "2020-07-05",
                            "2020-07-06",
                            "2020-07-07",
                            "2020-07-08",
                            "2020-07-09",
                            "2020-07-10",
                            "2020-07-11",
                            "2020-07-12",
                            "2020-07-13",
                            "2020-07-14",
                            "2020-07-15",
                            "2020-07-16",
                            "2020-07-17",
                            "2020-07-18",
                            "2020-07-19",
                        ],
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                        point: {
                            show: false,
                        },
                    }
                ).render();
        });
        // @formatter:on
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && new ApexCharts(document.getElementById("chart-pemesanan"), {
                chart: {
                    type: "bar",
                    fontFamily: "inherit",
                    height: 400,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false,
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                        name: "Pending",
                        data: {!! json_encode(array_values($pendingData)) !!}
                    },
                    {
                        name: "Dikemas",
                        data: {!! json_encode(array_values($dikemasData)) !!}
                    },
                    {
                        name: "Dikirim",
                        data: {!! json_encode(array_values($dikirimData)) !!}
                    },
                    {
                        name: "Diterima",
                        data: {!! json_encode(array_values($diterimaData)) !!}
                    }
                ],
                xaxis: {
                    type: "category",
                    categories: {!! json_encode($dates) !!},
                    labels: {
                        rotate: -45,
                        formatter: function(val) {
                            return val;
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
                tooltip: {
                    theme: "dark",
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4,
                    },
                    strokeDashArray: 4,
                },
                colors: [
                    tabler.getColor("danger"),
                    tabler.getColor("green"),
                    tabler.getColor("warning", 0.8),
                    tabler.getColor("primary", 0.8),
                ],
                legend: {
                    show: true, // Ubah menjadi true jika ingin menampilkan legend
                    position: 'top', // Atur posisi legend
                    horizontalAlign: 'right', // Atur alignment horizontal legend
                    onItemClick: {
                        toggleDataSeries: false
                    },
                },
            }).render();
        });
    </script>
@endsection
