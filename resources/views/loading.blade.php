<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat Halaman...</title>
    <style>
        /* Tambahkan CSS untuk style loading page */
        #loading {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #fff;
            z-index: 99;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #loading p {
            font-size: 1.5em;
            color: #000;
        }
    </style>
</head>
<body>
    <div id="loading">
        <p>Memuat halaman...</p>
        <!-- Tambahkan animasi atau gambar loading di sini -->
    </div>

    <!-- Konten halaman Anda -->
    <div id="content" style="display: none;">
        <!-- Semua konten halaman Anda di sini -->
    </div>

    <script>
        // JavaScript untuk menghilangkan loading page setelah halaman selesai dimuat
        window.addEventListener('load', function () {
            var loading = document.getElementById('loading');
            var content = document.getElementById('content');
            loading.style.display = 'none';
            content.style.display = 'block';
        });
    </script>
</body>
</html>
