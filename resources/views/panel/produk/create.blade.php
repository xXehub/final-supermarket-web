<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal modal-blur fade" id="modal-tambahData" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                {{-- gawe nama produk --}}
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                    type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                                    placeholder="Masukan Nama barang">
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                {{-- gawe kode produk --}}
                                <label class="form-label">Kode Produk</label>
                                <input type="text" class="form-control @error('kode_produk') is-invalid @enderror"
                                    type="text" name="kode_produk" id="kode_produk"
                                    value="BRG-{{ old('kode_produk') }}" readonly disabled>
                            </div>
                        </div>

                        {{-- harga, kategori, stock --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                {{-- gawe harga produk --}}
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                    type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                                    placeholder="Masukan Nama barang">
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-select">
                                    {{-- @foreach ($kategoris as $kategori_sakkarepmu)
                                        <option value="{{ $kategori_sakkarepmu->id }}"
                                            {{ old('kategori_id') == $kategori_sakkarepmu->id ? 'selected' : '' }}>
                                            {{ $kategori_sakkarepmu->kode_kategori . ' ' . $kategori_sakkarepmu->nama_kategori }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                {{-- gawe kode produk --}}
                                <label class="form-label">Stock</label>
                                <input class="form-control @error('stock') is-invalid @enderror" type="number"
                                    name="stock" id="stock" value="{{ old('stock') }}" placeholder="1">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                    <input type="radio" name="report-type" value="1"
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
                            <a type="submit" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-tambahData" onclick="simpanForm()">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Simpan
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-tambahData" aria-label="Tambah Produk">
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

    </div>
</form>

<script>
    // Generate random string for kode_produk with XXX-XXX-XXX template
    function generateRandomCode() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var result = '';
        for (var i = 0; i < 3; i++) {
            for (var j = 0; j < 3; j++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            if (i < 2) {
                result += '-'; // Add hyphen after each group of characters except the last one
            }
        }
        return result;
    }

    // Call the function to generate random string and update the kode_produk input
    document.addEventListener('DOMContentLoaded', function() {
        var kode_produk_input = document.getElementById('kode_produk');
        kode_produk_input.value = generateRandomCode();
    });
</script>


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

{{-- gawe resetform --}}
<script>
    // gawe reset form
    function resetForm() {
        console.log("Form Reset Successs ");
        document.getElementById("nama_produk").value = '';
        document.getElementById("kategori").selectedIndex = 0;
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
@endif
