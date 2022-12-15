<?php
if (file_exists('setup/setup.lock')) {
    include 'config/config.php'
    ?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <title><?php echo $dictumConfig['sitename'] ?> - Powered By Dictum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
        color: #333;
        text-shadow: none;
    }

    body {
        text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, 0.5);
    }

    .cover-container {
        max-width: 80em;
    }

    .copyright-link {
        color: rgba(255, 255, 255, 0.7) !important;
        text-decoration: none;
    }

    a.copyright-link:hover {
        color: rgba(255, 255, 255, 0.9) !important;
        text-decoration: none;
    }

    .nav-masthead .nav-link {
        padding: 0.25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.5);
        background-color: transparent;
        border-bottom: 0.25rem solid transparent;
    }

    .nav-masthead .nav-link:hover,
    .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, 0.25);
    }

    .nav-masthead .nav-link+.nav-link {
        margin-left: 1rem;
    }

    .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
    }
    </style>
    <style>
    .body-bg {
        background: url('./bg/bg.webp?v=1.0');
        backdrop-filter: brightness(60%) !important;
    }
    </style>
</head>

<body class="d-flex h-100 text-center text-white body-bg">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">
                    <?php echo $dictumConfig['sitename'] ?>
                </h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="#">主页</a>
                    <a class="nav-link" href="./api?type=help">开放接口</a>
                    <a class="nav-link" href="./login">管理后台</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1 id="dictum"></h1>
            <p id="author" class="lead"></p>
        </main>

        <footer class="mt-auto text-white-50">
            <p>
                &copy; 2021–
                <script>
                document.write(new Date().getFullYear());
                </script>
                Dictum Team<br />Powered By
                <span><a class="copyright-link" href="//github.com/ImJingLan/dictum">Dictum</a></span>
            </p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
    function dictum() {
        $.post('./api/dictums/?module=json', function(a) {
            var b = JSON.parse(a);
            if (b['code'] == 404) {
                $('#dictum').html(b['msg']);
                $('#author').html('');
            } else {
                $('#dictum').html(b['dictum']);
                $('#author').html('——' + b['author']);
            }
        });
    }
    setInterval(dictum(), 10000);
    </script>
</body>

</html>

<?php
} else {
    header("Location:./setup");
}
?>