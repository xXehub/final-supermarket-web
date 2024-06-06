$(function() {
    $("#produkTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/produk",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "kode_produk", name: "kode_produk" },
            { data: "nama_produk", name: "nama_produk" },
            { data: "nama_kategori", name: "nama_kategori" },
            {
                data: "harga",
                name: "harga",
                render: function(data, type, row) {
                    var harga = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    return "Rp " + harga;
                },
            },
            { data: "stock", name: "stock" },
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