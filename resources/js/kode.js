    // gawe produk
    function generateRandomCodeProduk() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var result = '';
        for (var i = 0; i < 3; i++) {
            for (var j = 0; j < 3; j++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            if (i < 2) {
                result += '-'; // Add hyphen after each group of characters except the last one
            }
        }
        return result;
    }

    // gawe kategori
    function generateRandomCodeKategori() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var result = '';
        for (var i = 0; i < 3; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    // gawe supplier
    function generateRandomCodeSupplier() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var result = 'SUP-'; // Tambahkan awalan SUP-
        for (var i = 0; i < 3; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
    
    // gawe pemesanan
    function generateRandomCodePemesanan() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var result = '';
        for (var i = 0; i < 3; i++) {
            for (var j = 0; j < 3; j++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            if (i < 2) {
                result += '-'; // Add hyphen after each group of characters except the last one
            }
        }
        return result;
    }

    // Call the function to generate random string and update the kode_produk input
    document.addEventListener('DOMContentLoaded', function() {
        var kode_produk_input = document.getElementById('kode_produks');
        kode_produk_input.value = generateRandomCodeProduk();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var kode_produk_input = document.getElementById('kode_kategori');
        kode_produk_input.value = generateRandomCodeKategori();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var kode_produk_input = document.getElementById('kode_supplier');
        kode_produk_input.value = generateRandomCodeSupplier();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var kode_produk_input = document.getElementById('kode_pesanan');
        kode_produk_input.value = generateRandomCodePemesanan();
    });
    
    
    
    