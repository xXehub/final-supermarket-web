$(function () {
    $("#pembayaranTable").DataTable({
        serverSide: true,
        processing: true,
        ajax: "/data/pembayaran",
        columns: [
            { data: "id", name: "id", visible: false },
            {
                data: null,
                render: function (data, type, row) {
                    // Menggabungkan gambar_user dan kode_pesanan dalam satu kolom
                    return '<td data-label="Name"><div class="d-flex py-1 align-items-center"><span class="avatar me-2" style="background-image: url(/storage/' + data.gambar_profile + ')"></span><div class="flex-fill"><div class="font-weight-medium">' + data.nama_user + '</div><div class="text-muted"><a href="#" class="text-reset">' + data.kode_pesanan + '</a></div></div></div></td>';
                }
            },
            { data: "pemesanan_id", name: "pemesanan_id", visible: false },
            {
                data: "total",
                name: "total",
                render: function (data, type, row) {
                    var harga = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    return "Rp " + harga;
                },
            },
            {
                data: "metode_pembayaran",
                name: "metode_pembayaran",
                render: function (data, type, full, meta) {
                    var metode_pembayaranColor = "";
                    switch (data) {
                        case "Dana":
                            metode_pembayaranColor = "bg-blue";
                            break;
                        case "Ovo":
                            metode_pembayaranColor = "bg-green";
                            break;
                        case "Gopay":
                            metode_pembayaranColor = "bg-green";
                            break;
                        default:
                            metode_pembayaranColor = "bg-blue";
                            break;
                    }
                    var capitalizedMetodePembayaran = data.charAt(0).toUpperCase() + data.slice(1);
                    var badgeWidth = 100;
                    return '<span class="badge ' + metode_pembayaranColor + '" style="width: ' + badgeWidth + 'px;">' + capitalizedMetodePembayaran + '</span>';

                }
            },
            { data: "tanggal_pesan", name: "tanggal_pesan" },
            {
                data: "status",
                name: "status",
                render: function (data, type, full, meta) {
                    var statusColor = "";
                    switch (data) {
                        case "pending":
                            statusColor = "bg-red";
                            break;
                        case "dibatalkan":
                            statusColor = "bg-green";
                            break;
                        case "diproses":
                            statusColor = "bg-blue";
                            break;
                        case "dibayar":
                            statusColor = "bg-green";
                            break;
                        default:
                            statusColor = "bg-blue";
                            break;
                    }
                    var capitalizedStatus = data.charAt(0).toUpperCase() + data.slice(1);
                    var badgeWidth = 100;
                    return '<span class="badge ' + statusColor + '" style="width: ' + badgeWidth + 'px;">' + capitalizedStatus + '</span>';

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

    $("#pembayaranTable").on("click", ".btn-delete", function (e) {
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
