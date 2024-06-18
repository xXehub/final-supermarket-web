<form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" id="formTambahData">
    @csrf
    <div class="modal modal-blur fade" id="modal-tambahPembayaran" tabindex="-1" role="dialog" aria-hidden="true"
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
                                <label class="form-label">Username</label>
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
                                <label class="form-label">Kode Pesanan</label>
                                <select id="select-kodepesan" class="form-select" name="pemesanan_id">
                                    @foreach ($pemesanan as $pemesanan_item)
                                        <option value="{{ $pemesanan_item->id }}"
                                            {{ old('pemesanan_id') == $pemesanan_item->id ? 'selected' : '' }}>
                                            {{ $pemesanan_item->kode_pesanan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pemesanan</label>
                                @foreach ($pemesanan as $pemesanan_item)
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" id="tanggal" value="{{ $pemesanan->tanggal }}" readonly>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- gawe nama produk / pilih produk --}}
                        <div class="col-lg-6">
                            <div class="mb-6">
                                <label class="form-label">Metode pembayarans</label>
                                <select class="form-select" id="produk_id" name="produk_id">
                                    <option value="" disabled selected>Pilih Metode Bayar</option>
                                    @foreach ($metodePembayaran as $metode)
                                        <option value="{{ $metode->id }}"
                                            {{ old('metode_pembayaran_id') == $metode->id ? 'selected' : '' }}>
                                            {{ $metode->nama }}
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
                                <label class="form-label">Status Pembayaran</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status"
                                    id="status">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                    <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="dibayar" {{ old('status') == 'dibayar' ? 'selected' : '' }}>
                                        Dibayar</option>
                                </select>
                                @error('status')
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
        window.TomSelect && (new TomSelect(el = document.getElementById('select-kodepesan'), {
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
            $('#modal-tambahPembayaran').modal('show');
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
