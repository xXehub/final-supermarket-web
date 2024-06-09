$(function() {
    $("#detailPemesananTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/detail_pemesanan",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "pemesanan_id", name: "pemesanan_id" },
            { data: "produk_id", name: "produk_id" },
            { data: "jumlah", name: "jumlah" },
            { data: "subtotal", name: "subtotal" },
            { data: "actions", name: "actions", orderable: false, searchable: false },
        ],
        
        order: [[0, "desc"]],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
    });

    $("#detailPemesananTable").on("click", ".btn-delete", function (e) {
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

