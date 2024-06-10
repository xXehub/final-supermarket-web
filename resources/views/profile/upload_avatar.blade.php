<form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="avatar" accept="image/*">
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
