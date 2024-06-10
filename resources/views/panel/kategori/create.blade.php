<form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data" id="formTambahData">
    @csrf
    <div class="modal modal-blur fade" id="modal-tambahKategori" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                                    placeholder="Masukan Nama barang">
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Kategori</label>
                                <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror"
                                    name="kode_kategori" id="kode_kategori" value="{{ old('kode_kategori') }}" readonly
                                    disabled>
                            </div>
                        </div>
                        <label class="form-label">Status</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="report-type" value="1"
                                        class="form-selectgroup-input" checked>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Terverifikasi</span>
                                            <span class="d-block text-muted">Produk telah diverifikasi oleh admin</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="report-type" value="0"
                                        class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Tidak Terverifikasi</span>
                                            <span class="d-block text-muted">Produk belum diverifikasi oleh admin</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="3" name="deskripsi"
                                    placeholder="Produk ini adalah produk terlarang yang nantinya akan di ekspor ke berbagai negara "
                                    {{ old('deskripsi') }} rows="3"></textarea>
                            </div>
                        </div>
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
    jQuery(document).ready(function($) {
        @if ($errors->any())
            $('#modal-tambahKategori').modal('show');
        @endif
    });
</script>
<script>
    // Ambil form
    var form = document.getElementById("formTambahData");

    // Tambahkan event listener untuk menangkap saat form disubmit
    form.addEventListener("submit", function() {
        // Hapus atribut readonly dari input kode_kategori sebelum mengirimkan formulir
        document.getElementById("kode_kategori").removeAttribute("disabled");
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
        document.getElementById("nama_kategori").value = '';
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


    {{-- test --}}
@endif
