@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<body>
    <div class="page">
        <!-- Navbar -->
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <form action="{{ route('filter.produk') }}" method="POST" autocomplete="off" novalidate
                                class="sticky-top">
                                @csrf
                                <div class="form-label">Kategori type</div>
                                <div class="mb-4">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="kategori[]" value="all"
                                            id="select-all">
                                        <span class="form-check-label">All Categories</span>
                                    </label>
                                    @foreach ($kategoris as $kategori)
                                        @if ($kategori && !is_null($kategori->nama_kategori))
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input kategori-checkbox"
                                                    name="kategori[]" value="{{ $kategori->id }}">
                                                <span class="form-check-label">{{ $kategori->nama_kategori }}</span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-primary w-100">Simpan Perubahan</button>
                                    <a href="#" class="btn btn-link w-100" id="reset-defaults">Reset ke default</a>
                                </div>
                            </form>
                        </div>
                        <script>
                            document.getElementById('select-all').addEventListener('change', function() {
                                let checkboxes = document.querySelectorAll('.kategori-checkbox');
                                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                            });

                            document.getElementById('reset-defaults').addEventListener('click', function(e) {
                                e.preventDefault();
                                document.getElementById('select-all').checked = true;
                                let checkboxes = document.querySelectorAll('.kategori-checkbox');
                                checkboxes.forEach(checkbox => checkbox.checked = false);
                            });
                        </script>

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
                                                                    <form id="keranjangForm"
                                                                        action="{{ route('keranjang.tambah') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="produk_id"
                                                                            value="{{ $produk->id }}">
                                                                        <input type="hidden" name="jumlah"
                                                                            value="1">
                                                                        <!-- Atur jumlah sesuai kebutuhan -->
                                                                        <button id="keranjangButton" type="submit"
                                                                            class="btn btn-primary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
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
                                                                            </svg>
                                                                            Keranjang
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Your existing code to display products -->

                                            <ul class="pagination">
                                                @if ($produks->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1"
                                                            aria-disabled="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path d="M15 6l-6 6l6 6" />
                                                            </svg>
                                                            prev
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $produks->previousPageUrl() }}"
                                                            tabindex="-1" aria-disabled="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path d="M15 6l-6 6l6 6" />
                                                            </svg>
                                                            prev
                                                        </a>
                                                    </li>
                                                @endif
                                                @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                                                    <li
                                                        class="page-item {{ $page == $produks->currentPage() ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endforeach
                                                @if ($produks->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $produks->nextPageUrl() }}">
                                                            next
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path d="M9 6l6 6l-6 6" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#">
                                                            next
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path d="M9 6l6 6l-6 6" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
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
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
</body>
{{-- sweetalert --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('keranjangButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            Swal.fire({
                title: 'Tambahkan ke keranjang?',
                text: "Apakah Anda yakin ingin menambahkan produk ini ke keranjang?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('keranjangForm').submit();
                }
            });
        });

        @if (session('status') == 'added')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Produk berhasil ditambahkan ke keranjang.'
            });
        @elseif (session('status') == 'updated')
            Swal.fire({
                icon: 'info',
                title: 'Produk sudah ada',
                text: 'Produk sudah ada di keranjang, jumlah telah ditambahkan.'
            });
        @endif
    });
</script>

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

@if (session('error'))
    <!-- Tampilkan SweetAlert untuk pesan error -->
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal...',
            text: '{{ session('error') }}',
        });
    </script>
@endif
@endsection
