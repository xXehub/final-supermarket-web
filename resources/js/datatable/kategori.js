$(function() {
    $("#kategoriTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/kategori",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "kode_kategori", name: "kode_kategori" },
            { 
                data: "nama_kategori", 
                name: "nama_kategori",
                render: function(data, type, row) {
                    // nama produk biar dadi kapital
                    var words = data.split(' ');
                    for (var i = 0; i < words.length; i++) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                    }
                    return words.join(' ');
                }
            },
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
