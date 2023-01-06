<?php
$siteInfo = [
    'pageTitle' => "Opps! 你访问了一个不存在的页面",
    'describe' => "Error: 404",
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
                    <li class="breadcrumb-item active">404</li>
                </ol>
            </div>
        </div>
    </div>
</div>