<form action="{{ route('produk.update', ['produk' => $produk->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal modal-blur fade" id="modal-editData" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $ingfo_sakkarepmu }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    value="{{ $produk->nama_produk }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Produk</label>
                                <input type="text" class="form-control @error('kode_produk') is-invalid @enderror"
                                    type="text" name="kode_produk" id="kode_produk"
                                    value="{{ $errors->any() ? old('kode_produk') : $produk->kode_produk }}"
                                    maxlength="11" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="{{ $produk->harga }}" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-select">
                                    {{-- <option value="" disabled selected>Pilih Kategori</option> --}}
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $produk->kategori_id == $kategori->id ? 'elected' : '' }}>
                                            {{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input class="form-control" id="stock" type="number" name="stock"
                                    value="{{ $produk->stock }}" placeholder="1" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control"id="deskripsi" name="deskripsi">{{ $produk->deskripsi }}</textarea>
                            </div>
                        </div>
                        {{-- gawe upload gambar --}}
                        <div class="col-lg-12">
                            <div>
                                <br />
                                <label class="form-label" for="gambar_produk" class="form-label"
                                    value="{{ old('gambar_produk') }}">Gambar
                                    Produk</label>
                                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                                <!-- Tambah pesan kesalahan jika diperlukan -->
                                @error('gambar_produk')
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

@if (!isset($isEdit) || !$isEdit)
    @vite('resources/js/datatable/produk.js')
@endif

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
            title: 'Berhasil Update Produk'
        });
    };
</script>
