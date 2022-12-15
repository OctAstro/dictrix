<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['isLogin'] == 1) {
        header("Location:../dashboard");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <title>登录管理面板</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type='email'] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type='password'] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

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
    </style>
</head>

<body class="text-center">
    <main class="form-signin">
        <a href="https://github.com/ImJingLan/dictum"><img class="mb-4" src="../assets/brand/logo.svg?v1.0" alt=""
                width="80" height="80" /></a>
        <h1 class="h3 mb-3 fw-normal">登录 | Sign in</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="username" placeholder="Username" />
            <label for="username">用户名 | Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" />
            <label for="password">密码 | Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="logintask()">
            登录 | Sign in
        </button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    function logintask() {
        var username = $('#username').val();
        var passwd = $('#password').val();
        if (!username || !passwd) {
            alert('账号或密码不得为空');
        } else {
            $.post(
                '../api/users/?module=login', {
                    username: username,
                    passwd: passwd,
                },
                function(a) {
                    var a = JSON.parse(a);
                    if (a['code'] == 200) {
                        location.href = '../dashboard';
                    } else {
                        alert(a['msg']);
                    }
                }
            );
        }
    }
    </script>
</body>

</html>