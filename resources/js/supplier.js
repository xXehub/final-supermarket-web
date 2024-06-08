$(function() {
    $("#supplierTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/supplier",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "kode_supplier", name: "kode_supplier" },
            { data: "nama_supplier", name: "nama_supplier" },
            { data: "alamat", name: "alamat" },
            { data: "no_hp", name: "no_hp" },
            { data: "deskripsi", name: "deskripsi" },
            { data: "actions", name: "actions", orderable: false, searchable: false },
        ],
        
        order: [[0, "desc"]],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
    });

    $(".datatable").on("click", ".btn-delete", function (e) {
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
