<?php
$siteInfo = [
    'pageTitle' => "语句列表",
    'describe' => "查看所有语句",
];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <?php echo $siteInfo['pageTitle']; ?>&nbsp;&nbsp;<small
                        class="text-muted text-xs"><?php echo $siteInfo['describe']; ?></small>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0 table-responsive">
                        <table class="download table table-striped table-valign-middle"
                            style="width: 100%; font-size: 15px">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
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
                    location.href = '../api/users/?module=logout'
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