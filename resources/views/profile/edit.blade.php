@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Profiles</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Other input fields -->
    
        <div class="form-group">
            <label for="gambar_profile">Profile Image</label>
            <input type="file" class="form-control" id="gambar_profile" name="gambar_profile">
        </div>
    
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection

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
            title: 'Berhasil Update Barang'
        });
    };
</script>