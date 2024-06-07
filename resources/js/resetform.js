// gawe reset form
function resetForm() {
    console.log("Form Reset Successs ");
    document.getElementById("nama_produk").value = '';
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