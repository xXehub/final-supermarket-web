$(function() {
    $("#keranjangTable").DataTable({
        serverSide: true,
        processing: true,
        destroy: true,
        ajax: "/data/keranjang",
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "user_id", name: "user_id", visible: false },
                        // gambar produk
            {
                data: null,
                render: function(data, type, row) {
                    // Menggabungkan gambar_produk dan kode_produk dalam satu kolom
                    return '<td data-label="Name"><div class="d-flex py-1 align-items-center"><span class="avatar me-2" style="background-image: url(/storage/produk/' + data.gambar_produk + ')"></span><div class="flex-fill"><div class="font-weight-medium">' + data.nama_produk + '</div><div class="text-muted"><a href="#" class="text-reset">' + '</a></div></div></div></td>';
                }
            },
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
            { data: "produk_id", name: "produk_id", visible: false },
            { 
                data: "harga", 
                name: "harga",
                render: function(data, type, row) {
                    return "Rp " + new Intl.NumberFormat().format(data);
                }
             },
            { data: "jumlah", name: "jumlah" },
            {     
                data: "subtotal", 
                name: "subtotal",
                render: function(data, type, row) {
                    return "Rp " + new Intl.NumberFormat().format(data);
                } },
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


