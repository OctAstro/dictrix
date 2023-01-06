<?php
$siteInfo = [
    'pageTitle' => "管理面板",
    'describe' => "欢迎来到 Dictum 管理面板",
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
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">用户信息</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-primary"><?php echo $_SESSION['user']; ?></h3>
                        <table style="width: 100%; font-size: 15px; margin-bottom: 16px">
                            <tr>
                                <td style="width: 30%"><b>注册邮箱</b></td>
                                <td><?php echo $_SESSION['email']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><b>用户令牌</b></td>
                                <td><?php echo $_SESSION['userToken']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><b>注册时间</b></td>
                                <td><?php echo date('Y-m-d H:i:s', $_SESSION['reg_date']); ?></td>
                            </tr>
                        </table>
                        <span>请妥善保管令牌，令牌拥有你在站点的所有权限</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">站点公告</h3>
                        </div>
                    </div>
                    <div class="card-body fix-text fix-image"></div>
                </div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">使用帮助</h3>
                        </div>
                    </div>
                    <div class="card-body fix-text fix-image"></div>
                </div>
            </div>
        </div>
    </div>
</div>