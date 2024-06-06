@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Produk</h4>
                            <form action="#">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Kode Produk</label>
                                                <input class="form-control @error('kode_produk') is-invalid @enderror"
                                                    type="text" name="kode_produk" id="kode_produk"
                                                    value="BRG-{{ old('kode_produk') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama Barang</label>
                                                <input class="form-control @error('nama_produk') is-invalid @enderror"
                                                    type="text" name="nama_produk" id="nama_produk"
                                                    value="{{ old('nama_produk') }}" placeholder="Masukan Nama barang">
                                                @error('nama_produk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label">kategori</label>
                                                <select name="kategori" id="kategori" class="form-select">
                                                    @foreach ($satuans as $kategori_sakkarepmu)
                                                        <option value="{{ $kategori_sakkarepmu->id }}"
                                                            {{ old('kategori') == $kategori_sakkarepmu->id ? 'selected' : '' }}>
                                                            {{ $kategori_sakkarepmu->kode_satuan . ' - ' . $kategori_sakkarepmu->nama_satuan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kategori')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Harga</label>
                                                <input class="form-control @error('harga') is-invalid @enderror"
                                                    type="text" name="harga" id="harga"
                                                    value="{{ old('harga') }}" placeholder="Masukan Harga barang">
                                                @error('harga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                {{-- <input type="text" class="form-control" placeholder="col-md-3"> --}}
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="3"
                                                    name="deskripsi" placeholder="Masukan Deskripsi barang">{{ old('deskripsi') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-info" onclick="simpanForm()">Simpan</button>

                                        <button type="button" class="btn btn-dark" onclick="resetForm()">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
// gawe random string kode_produk
function randomKode_sakkarepmu(length) {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var result = '';
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

// Call the function to generate random string and update the kode_produk input
document.addEventListener('DOMContentLoaded', function() {
    var kode_barang_input = document.getElementById('kode_produk');
    kode_barang_input.value = 'BRG-' + randomKode_sakkarepmu(3); // gawe selalu generate kode barang anyar
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
@endsection
