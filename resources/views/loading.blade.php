<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat Halaman...</title>
    <style>
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
        <div class="page page-center">
            <div class="container container-slim py-4">
                <div class="text-center">
                    <div class="mb-3">
                        <a href="." class="navbar-brand navbar-brand-autodark"><img
                                src="{{ asset('/static/gudangrempah/gricon.png') }}" height="36" alt=""></a>
                    </div>
                    <div class="text-muted mb-3">Halaman sedang dimuat</div>
                    <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content" style="display: none;">
    </div>
    <script>

        window.addEventListener('load', function() {
            setTimeout(function() {
                var loading = document.getElementById('loading');
                var content = document.getElementById('content');
                loading.style.display = 'none';
                content.style.display = 'block';
            }, 2000); //iki interval e mas
        });
    </script>
</body>
</html>