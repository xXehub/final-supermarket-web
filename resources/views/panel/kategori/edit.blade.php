<form action="{{ route('kategori.update', ['kategori' => $kategori->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal modal-blur fade" id="modal-editKategori" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- gawe nama kategori --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    type="text" name="nama_kategori" id="nama_kategori"
                                    value="{{ $errors->any() ? old('nama_kategori') : $kategori->nama_kategori }}"
                                    placeholder="Ubah Nama Barang" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- gawe kode kategori --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kode kategori</label>
                                <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror"
                                    type="text" name="kode_kategori" id="kode_kategori"
                                    value="{{ $errors->any() ? old('kode_kategori') : $kategori->kode_kategori }}"
                                    placeholder="Enter First Name" maxlength="3" required>
                            </div>
                        </div>
                        {{-- gawe status --}}
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
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $errors->any() ? old('deskripsi') : $kategori->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                aria-label="Tambah kategori">
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
    document.getElementById('kode_produk').addEventListener('input', function(e) {
        var value = e.target.value.replace(/[^A-Za-z0-9]/g, ''); // Remove non-alphanumeric characters
        if (value.length > 9) {
            value = value.slice(0, 9); // Limit to 9 characters
        }
        var formattedValue = '';
        for (var i = 0; i < value.length; i++) {
            if (i > 0 && i % 3 === 0) {
                formattedValue += '-';
            }
            formattedValue += value[i];
        }
        e.target.value = formattedValue;
    });
</script>
<script>
    jQuery(document).ready(function($) {
        @if ($errors->any())
            $('#modal-editKategori').modal('show');
        @endif
    });
</script>
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
            title: 'Berhasil Update Kategori'
        });
    };
</script>
