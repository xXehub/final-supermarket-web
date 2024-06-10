$(function() {
    $("#pemesananTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/pemesanan",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "kode_pesanan", name: "kode_pesanan" },
            { data: "nama_user", name: "nama_user" },
            { data: "tanggal", name: "tanggal" },
            { data: "status", name: "status" },
            { data: "actions", name: "actions", orderable: false, searchable: false },
        ],
        
        order: [[0, "desc"]],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
    });

    $("#pemesananTable").on("click", ".btn-delete", function (e) {
        e.preventDefault();

        var form = $(this).closest("form");
        var name = $(this).data("name");

        Swal.fire({
            title: "Are you sure want to delete\n" + name + "?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: "bg-primary",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
