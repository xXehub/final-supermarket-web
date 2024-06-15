@extends('layouts.app')
@section('content')

    <body>
        <script src="./dist/js/demo-theme.min.js?1684106062"></script>
        <div class="page">
            <!-- Navbar -->
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Cari Berdasarkan Kategori
                                </h2>
                            </div>
                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <a href="#" class="btn btn-primary">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Post a job
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row g-4">
                            <div class="col-md-3">
                            
                                    {{-- <form action="}" method="POST"> --}}
                                        @csrf
                                        <form action="{{ route('filter.produk') }}" method="POST" autocomplete="off" novalidate class="sticky-top">
                                            @csrf
                                            <div class="form-label">Kategori type</div>
                                            <div class="mb-4">
                                                @foreach ($kategoris as $kategori)
                                                    @if ($kategori && !is_null($kategori->nama_kategori))
                                                        <label class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="kategori[]" value="{{ $kategori->id }}">
                                                            <span class="form-check-label">{{ $kategori->nama_kategori }}</span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="mt-5">
                                                <button class="btn btn-primary w-100">Confirm changes</button>
                                                <a href="#" class="btn btn-link w-100">Reset to defaults</a>
                                            </div>
                                        </form>

              
                                  
        
                                   
                            </div>
                            <div class="col-md-9">
                                <div class="row row-cards">
                                    <div class="space-y">
                                        @foreach ($produks as $produk)
                                            <div class="card">
                                                <div class="row g-0">
                                                    <div class="col-auto">
                                                        <div class="card-body">
                                                            <div class="avatar avatar-md"
                                                                style="background-image: url('{{ $produk->gambar_produk ? asset('storage/produk/' . $produk->gambar_produk) : '' }}')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body ps-0">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h3 class="mb-0"><a
                                                                            href="#">{{ $produk->nama_produk }}</a>
                                                                    </h3>

                                                                </div>
                                                                <div class="col-auto fs-4 text-black">
                                                                    {{ 'Rp ' . number_format($produk->harga, 0, ',', '.') }}
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <div
                                                                        class="mt-3 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
                                                                        <div class="mt-3 badges">
                                                                            <a href="#"
                                                                                class="badge badge-outline text-muted border fw-normal badge-pill">{{ $produk->kategori->nama_kategori }}</a>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="mt-3 list mb-0 text-muted d-block d-sm-none">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-auto">
                                                                    <div class="col-auto">
                                                                        <button type="button"
                                                                            class="btn btn-primary btn-md"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path
                                                                                    d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path d="M17 17h-11v-14h-2" />
                                                                                <path d="M6 5l14 1l-1 7h-13" />
                                                                            </svg> Keranjang</button>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="./dist/js/tabler.min.js?1684106062" defer></script>
        <script src="./dist/js/demo.min.js?1684106062" defer></script>
    </body>
    <script>
        // Add sorting functionality
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll('.form-check');
            const container = document.querySelector('.mb-4');

            function sortCheckboxes() {
                // Convert NodeList to Array
                const checkboxesArray = Array.from(checkboxes);

                // Sort checkboxes based on the text label
                checkboxesArray.sort((a, b) => {
                    const textA = a.querySelector('.form-check-label').innerText.toUpperCase();
                    const textB = b.querySelector('.form-check-label').innerText.toUpperCase();
                    return textA.localeCompare(textB);
                });

                // Clear the container
                container.innerHTML = '';

                // Append sorted checkboxes
                checkboxesArray.forEach(checkbox => {
                    container.appendChild(checkbox);
                });
            }

            // Initial sort
            sortCheckboxes();
        });
    </script>
    {{-- gawe notif gagal --}}
    @if ($message = Session::get('gagal'))
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
    {{-- gawe notif sukses --}}
    @if ($message = Session::get('success'))
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
