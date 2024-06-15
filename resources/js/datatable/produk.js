$(function() {
    $("#produkTable").DataTable({
        serverSide: true,
        processing: true,
            destroy: true,
        ajax: "/data/produk",
        columns: [
            { data: "id", name: "id", visible: false },
            // gambar produk
            {
                data: null,
                render: function(data, type, row) {
                    // Menggabungkan gambar_produk dan kode_produk dalam satu kolom
                    return '<td data-label="Name"><div class="d-flex py-1 align-items-center"><span class="avatar me-2" style="background-image: url(/storage/produk/' + data.gambar_produk + ')"></span><div class="flex-fill"><div class="font-weight-medium">' + data.nama_produk + '</div><div class="text-muted"><a href="#" class="text-reset">' + data.kode_produk + '</a></div></div></div></td>';
                }
            },
            { data: "kode_produk", name: "kode_produk" , visible: false},
            {
                data: "nama_produk" , visible: false,
                name: "nama_produk",
                render: function(data, type, row) {
                    // nama produk biar dadi kapital
                    var words = data.split(' ');
                    for (var i = 0; i < words.length; i++) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                    }
                    return words.join(' ');
                }
            },
            { data: "nama_kategori", name: "nama_kategori" },
            { data: "nama_supplier", name: "nama_supplier" },
            {
                data: "harga",
                name: "harga",
                render: function(data, type, row) {
                    var harga = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    return "Rp " + harga;
                },
            },
            {
                data: "stock",
                name: "stock",
                // pewarnaan badge stock sesuai dengan kondisi dibawah mas :D
                render: function(data, type, row) {
                    var badgeClass = "";
                    if (data < 20) {
                        badgeClass = "badge bg-danger me-1";
                    } else if (data < 100) {
                        badgeClass = "badge bg-warning me-1";
                    } else {
                        badgeClass = "badge bg-success me-1";
                    }
                    var badgeWidth = 50;
                    return '<span class="' + badgeClass + '" style="width: ' + badgeWidth + 'px;">' + data + '</span>';
                }
            },
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


