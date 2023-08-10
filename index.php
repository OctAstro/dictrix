<?php
if (file_exists('setup/setup.lock')) {
    include 'config/config.php'
    ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>主页 | <?php echo $dictumConfig['sitename'] ?></title>
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/dist/css/index/main.css" rel="stylesheet" />
</head>

<body data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-top" id="navbar" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="//mtsmc.net">
                <span style="color: #ffffff"><?php echo $dictumConfig['sitename'] ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold text-white" aria-current="page" href="./">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-white">开放接口</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-white" href="dashboard/">管理面板</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="p-1" class="banner w-100 d-flex align-items-center">
        <h1 class="mx-auto text-center text-white fw-bold" style="
                    text-shadow: 4px 5px 10px rgba(0, 0, 0, 0.445) !important;
                ">
            <?php echo $dictumConfig['sitename'] ?>
        </h1>
    </div>

    <div class="container">
        <div class="card shadow-lg px-5 py-4" style="top: -8vh">
            <div class="row">
                <div class="col my-3 d-flex flex-column text-right">
                    <div class="col-md-5"></div>
                    <div class="my-auto">
                        <div class="container-fluid py-5">
                            <h1 class="display-5 fw-bold">
                                <span id="dictum">我不是畏惧风，我只是怕风把沙子吹到我的眼睛里！</span>
                            </h1>
                            <p class="col-md-10 fs-4">
                                —— <span id="author">白凝羽「日常随笔」</span>
                            </p>
                            <button onclick="dictum()" class="btn btn-primary btn-lg">
                                再来一句
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="container">
        <div class="pt-5 mt-5 border-top text-center pb-5 text-body-secondary">
            <small>
                <p>
                    Copyright © 2022-Present Dictrix <br />
                    All rights reserved.
                </p>
            </small>
        </div>
    </footer>
    <script src="./assets/dist/js/index.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script>
    function dictum() {
        $.post("./api/dictums/?module=json", function(a) {
            var b = JSON.parse(a);
            if (b["code"] == 404) {
                $("#dictum").html(b["msg"]);
                $("#author").html("");
            } else {
                $("#dictum").html(b["dictum"]);
                $("#author").html(b["author"]);
            }
        });
    }
    setInterval(dictum(), 10000);
    console.log(
        `Powered by %cDictrix v0.1.0\nPlease star & fork to support the author!`,
        "background-color: #1A55ED; padding: 7px; color: #fff;"
    );
    </script>
</body>

</html>


<?php
} else {
    header("Location:./setup");
}
?>