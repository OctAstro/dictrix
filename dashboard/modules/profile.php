<?php
$siteInfo = [
    'pageTitle' => "用户信息",
];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <?php echo $siteInfo['pageTitle']; ?>&nbsp;&nbsp;<small class="text-muted text-xs">查看您的个人信息</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?">主页</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo $siteInfo['pageTitle']; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">账号信息</h3>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <h3 class="text-primary" style="padding: 16px; padding-left: 24px">
                            <?php echo htmlspecialchars($_SESSION['user']); ?>
                        </h3>
                        <table class="download table table-striped table-valign-middle"
                            style="width: 100%; font-size: 15px">
                            <tr>
                                <td style="width: 30%"><b>用户 ID</b></td>
                                <td><?php echo $_SESSION['userId']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><b>注册邮箱</b></td>
                                <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><b>用户组别</b></td>
                                <td><?php echo htmlspecialchars($_SESSION['userGroup']); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><b>访问密钥</b></td>
                                <td><?php echo htmlspecialchars($_SESSION['userToken']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">修改密码</h3>
                        </div>
                    </div>
                    <!--../api/users/updatePassword&token=<?php echo $_SESSION['userToken']; ?>-->
                    <div class="card-body">
                        <p><b>请输入旧密码</b></p>
                        <p>
                            <input type="password" class="form-control" id="oldPass" />
                        </p>
                        <p><b>请输入新密码</b></p>
                        <p>
                            <input type="password" class="form-control" id="newPass" />
                        </p>
                        <p><b>请再输入一次</b></p>
                        <p>
                            <input type="password" class="form-control" id="verifyPass" />
                        </p>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right" onclick="update()">
                            确认修改
                        </button>
                    </div>

                </div>

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">重置令牌</h3>
                        </div>
                    </div>
                    <!--../api/users/updatePassword&token=<?php echo $_SESSION['userToken']; ?>-->
                    <div class="card-body">
                        <p><b>请输入 "I'm Sure to Refresh the Token" (区分大小写，不包含"") </b></p>
                        <p>
                            <input type="text" class="form-control" id="verifyOne" />
                        </p>
                        <p><b>请输入 "I'm Sure" (区分大小写，不包含"") </b></p>
                        <p>
                            <input type="text" class="form-control" id="verifyTwo" />
                        </p>
                        <p><b>请输入账号密码</b></p>
                        <p>
                            <input type="password" class="form-control" id="rT_passwd" />
                        </p>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right" onclick="refreshToken()">
                            确认修改
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
function update() {
    if ($('#newPass').val() != $('#verifyPass').val()) {
        alert("新密码两次输入不一样！");
        $('#newPass').val('');
        $('#verifyPass').val('');
    } else {
        $.post(
            '../api/users/?module=updatePassword&token=<?php echo $_SESSION['userToken']; ?>', {
                oldPass: $('#oldPass').val(),
                newPass: $('#newPass').val(),
            },
            function(a) {
                a = JSON.parse(a);
                if (a['code'] == 200) {
                    $('#newPass').val('');
                    $('#verifyPass').val('');
                    alert("密码修改完成，请重新登陆");
                } else {
                    if (a['code'] == 403) {
                        alert(a['msg']);
                    }
                }
            }
        );
    }
}

function refreshToken() {
    vone = false;
    vtwo = false;
    if ($('#verifyOne').val() == "I'm Sure to Refresh the Token") {
        vone = true;
    } else {
        vone = false;
        alert("第一个输入框内容有误，请检查！");
    }
    if ($('#verifyTwo').val() == "I'm Sure") {
        vtwo = true;
    } else {
        vtwo = false;
        alert("第二个输入框内容有误，请检查！");
    }

    if (vone && vtwo) {
        $.post(
            '../api/users/?module=refreshToken', {
                passWd: $('#rT_passwd').val(),
                oldToken: '<?php echo $_SESSION['userToken']; ?>',
            },
            function(a) {
                console.log(a);
                a = JSON.parse(a);
                if (a['code'] == 200) {
                    alert("令牌刷新成功，请重新登陆");
                    location.href = '../api/users/?module=logout'
                }
            }
        );
    }

}
</script>