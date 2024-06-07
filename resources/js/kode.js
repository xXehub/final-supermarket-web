    // Generate random string for kode_produk with XXX-XXX-XXX template
    function generateRandomCode() {
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
        var kode_produk_input = document.getElementById('kode_produk');
        kode_produk_input.value = generateRandomCode();
    });

    