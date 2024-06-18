@extends('layouts.app')
@section('content')
    {{-- gawe auth check --}}
    @if (Auth::check())
        <div class="page">
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Account Settings
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="row g-0">
                              {{-- gawe sidebar --}}
                              @include('profile.sidebar')
                                <div class="col d-flex flex-column">
                                    <div class="card-body">
                                        <h2 class="mb-4">Akun Saya</h2>
                                        <h3 class="card-title">Profile Details</h3>
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-xl"
                                                    style="background-image: url('{{ asset('storage/' . (Auth::user()->gambar_profile ? Auth::user()->gambar_profile : '')) }}')"></span>
                                            </div>
                                            <div class="col-auto">
                                                <form action="{{ route('profile.updateAvatar') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-auto">
                                                        <label for="avatar" class="btn">
                                                            Upload Avatar
                                                            <input id="avatar" type="file" name="avatar"
                                                                style="display: none;" onchange="this.form.submit()"
                                                                accept="image/*">
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-auto">
                                                <form id="deleteAvatarForm" action="{{ route('profile.deleteAvatar') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-ghost-danger">
                                                        Delete avatar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <h3 class="card-title mt-4">Edit Profile</h3>
                                        {{-- form update --}}
                                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- form fields here -->
                                            <div class="row g-3">
                                                <div class="col-md">
                                                    <div class="form-label">Nama</div>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ Auth::user()->name }}">
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">Tanggal Pembuatan</div>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::user()->created_at }}" disabled>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">Lokasi</div>
                                                    <input type="text" class="form-control" value="Wuhan, Kalijudan" disabled>
                                                </div>
                                            </div>
                                            <h3 class="card-title mt-4">Email</h3>
                                            <p class="card-subtitle">This contact will be shown to others publicly, so
                                                choose it carefully.</p>
                                            <div class="row g-2">
                                                <div class="col-auto">
                                                    <input type="email" name="email" class="form-control w-auto"
                                                        value="{{ Auth::user()->email }}">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn">Ubah</button>
                                                </div>
                                            </div>
                                            <h3 class="card-title mt-4">Password</h3>
                                            <p class="card-subtitle">Klik tombol dibawah untuk mengganti password.</p>
                                            <div id="changePasswordBtn" class="row g-2">
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-outline-primary">Ubah
                                                        Password</button>
                                                </div>
                                            </div>
                                            <div id="setNewPasswordFields" style="display: none;">
                                                <div class="row g-2">
                                                    <div class="col-auto">
                                                        <input type="password" name="password" class="form-control w-auto"
                                                            placeholder="New password">
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control w-auto"
                                                            placeholder="Confirm new password">
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <h3 class="card-title mt-4">Public profile</h3>
                                            <p class="card-subtitle">Making your profile public means that anyone on the
                                                Dashkit network will be able to find you.</p> --}}
                                            <div>
                                                <label class="form-check form-switch form-switch-lg">
                                                    {{-- <input class="form-check-input" type="checkbox">
                                                    <span class="form-check-label form-check-label-on">You're currently
                                                        visible</span>
                                                    <span class="form-check-label form-check-label-off">You're currently
                                                        invisible</span> --}}
                                                </label>
                                            </div>
                                            <div class="card-footer bg-transparent mt-auto">
                                                <div class="btn-list justify-content-end">
                                                    <button type="reset" class="btn">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- delete profile --}}
                                        {{-- <h3 class="card-title mt-4">Delete Account</h3> --}}
                                        {{-- <form action="{{ route('profile.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete your account?')">Delete
                                            Account</button>
                                    </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif

    <script>
        document.getElementById('changePasswordBtn').addEventListener('click', function() {
            document.getElementById('changePasswordBtn').style.display = 'none';
            document.getElementById('setNewPasswordFields').style.display = 'block';
        });
    </script>
    {{-- library sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('deleteAvatarForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus profile?',
                text: "Profile yang dihapus akan hilang dari storage!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Iya, hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    <script>
        document.getElementById('passwordBaruForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus profile?',
                text: "Profile yang dihapus akan hilang dari storage!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Iya, hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection
