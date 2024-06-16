@foreach($keranjang as $keranjangs)
<form action="{{ route('keranjang.update', ['keranjang' => $keranjangs->id]) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="modal modal-blur fade" id="modal-editData" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jumlah Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ $keranjangs->jumlah }}" required>
                                @error('jumlah')
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
                                aria-label="Tambah keranjangs">
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
@endforeach
@if (!isset($isEdit) || !$isEdit)
    @vite('resources/js/datatable/keranjangs.js')
@endif

<script>
    document.getElementById('kode_keranjangs').addEventListener('input', function(e) {
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
            title: 'Berhasil Update keranjangs'
        });
    };
</script>
