<form id="delete-form-{{ $keranjang->id }}" action="{{ route('keranjang.destroy', ['keranjang' => $keranjang->id]) }}"
    method="POST">
    <div class="btn-list flex-nowrap">
        @csrf
        @method('delete')
        <a class="btn btn-outline-primary" onclick="confirmDelete({{ $keranjang->id }})">
            Hapus
        </a>
        <a class="btn btn-primary" href="{{ route('keranjang.edit', ['keranjang' => $keranjang->id]) }}" data-bs-toggle="modal"
            data-bs-target="#modal-editData">
            Edit
        </a>
    </div>
</form>
{{-- SweetAlert Library --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script untuk konfirmasi delete --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus?',
            text: "keranjang yang telah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirimkan formulir penghapusan
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

{{-- Notifikasi setelah penghapusan --}}
@if ($message = Session::get('hapus'))
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
