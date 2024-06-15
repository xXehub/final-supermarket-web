<form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data" id="formTambahData">
    @csrf
    <div class="modal modal-blur fade" id="modal-tambahPesanan" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan</label>
                                <select class="form-select" id="select-username" name="user_id">
                                    <option value="" disabled selected>Username</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            data-custom-properties="<span class='avatar avatar-xs' style='background-image: url({{ $user->gambar_profile ? asset('storage/' . $user->gambar_profile) : '' }})'></span>"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        {{-- gawe kode pemesanan --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Produk</label>
                                <input type="text" class="form-control @error('kode_pesanan') is-invalid @enderror"
                                    name="kode_pesanan" id="kode_pesanan" value="{{ old('kode_pesanan') }}" readonly
                                    disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pemesanan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" id="tanggal" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- gawe nama produk / pilih produk --}}
                        <div class="col-lg-6">
                            <div class="mb-6">
                                <label class="form-label">Nama Produk</label>
                                <select class="form-select" id="produk_id" name="produk_id">
                                    <option value="" disabled selected>Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}"
                                            data-custom-properties="<span class='badge bg-primary-lt'>{{ $produk->kode_produk }}</span>"{{ $produk->nama_produk }}
                                            {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                            {{ $produk->kode_pesanan . '' . $produk->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('produk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Status Pemesanan</label>
                                <select class="form-select" @error('status') is-invalid @enderror" name="status"
                                    id="status">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="dikemas" {{ old('status') == 'dikemas' ? 'selected' : '' }}>Dikemas
                                    </option>
                                    <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim
                                    </option>
                                    <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>
                                        Diterima</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pesanan</label>
                                <input class="form-control @error('jumlah') is-invalid @enderror" type="number"
                                    name="jumlah" id="jumlah" value="{{ old('jumlah') }}" placeholder="1">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Subtotal</label>
                                <input class="form-control" type="text" name="subtotal" id="subtotal" value="{{ old('subtotal') }}" readonly>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a class="btn" onclick="resetForm()">
                                    Reset
                                </a>
                            </span>
                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Simpan
                            </button>
                            <button type="submit" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="Tambah Produk">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('select-username'), {
            copyClassesToDropdown: false,
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data
                            .customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data
                            .customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });
    // @formatter:on
</script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('produk_id'), {
            copyClassesToDropdown: false,
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data
                            .customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data
                            .customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });
    // @formatter:on
</script>
<script>
    jQuery(document).ready(function($) {
        @if ($errors->any())
            $('#modal-tambahPesanan').modal('show');
        @endif
    });
</script>
<script>
    // Ambil form
    var form = document.getElementById("formTambahData");

    // Tambahkan event listener untuk menangkap saat form disubmit
    form.addEventListener("submit", function() {
        // Hapus atribut readonly dari input kode_produk sebelum mengirimkan formulir
        document.getElementById("kode_pesanan").removeAttribute("disabled");
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Produk",
            allowClear: true
        });
    });
</script>

<script>
    jQuery(document).ready(function($) {
        @if ($errors->any())
            $('#modal-tambahData').modal('show');
        @endif
    });
</script>
<script>
    // Ambil form
    var form = document.getElementById("formTambahData");

    // Tambahkan event listener untuk menangkap saat form disubmit
    form.addEventListener("submit", function() {
        // Hapus atribut readonly dari input kode_pesanan sebelum mengirimkan formulir
        document.getElementById("kode_pesanan").removeAttribute("disabled");
    });
</script>
{{-- gawe reopen modal lek enek validasi error --}}

{{-- library sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- gawe nyeluk js pek --}}
{{-- @vite('resources/js/barang.js') --}}

{{-- gawe simpan barang --}}
{{-- Notifikasi setelah penghapusan --}}
<script>
    // gawe reset form
    function simpanForm() {
        console.log("Simpan Form Successs ");

        // sweet alert notif reset
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 13000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: 'Berhasil Menambahkan Barang'
        });
    };
</script>
{{-- end simpan barang --}}

<script>
    // gawe reset form
    function resetForm() {
        console.log("Form Reset Successs ");
        document.getElementById("nama_user").value = '';
        document.getElementById("kategori_id").value = '';
        document.getElementById("harga").value = '';
        document.getElementById("deskripsi").value = '';

        // sweet alert notif reset
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
            title: 'Berhasil di Reset'
        });
    };
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
            icon: "error",
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
    <script>
        // Ambil elemen modal
        var modal = document.getElementById('modal-tambahData');

        // Tangkap event submit form
        var form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            // Lakukan validasi formulir di sini
            if (!form.checkValidity()) {
                // Jika validasi gagal, hentikan aksi default
                event.preventDefault();
                // Tampilkan modal
                var modal = new bootstrap.Modal(document.getElementById('modal-tambahData'));
                modal.show();
            }
        });
    </script>
@endif
