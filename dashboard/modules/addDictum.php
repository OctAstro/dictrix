<?php
$siteInfo = [
    'pageTitle' => "添加语句",
    'describe' => "添加一个新的语句",
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
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">修改密码</h3>
                        </div>
                    </div>
                    <!--../api/users/updatePassword&token=<?php echo $_SESSION['userToken']; ?>-->
                    <div class="card-body">
                        <p><b>作者 (author) </b></p>
                        <p>
                            <input type="text" class="form-control" id="author" />
                        </p>
                        <p><b>创建者 (creator) </b></p>
                        <p>
                            <input type="text" class="form-control" id="creator"
                                value="<?php echo $_SESSION['user'];?>" />
                        </p>
                        <p><b>语句 (dictum) </b></p>
                        <p>
                            <textarea type="text" class="form-control" id="dictum" rows=5></textarea>
                        </p>

                        <div class="alert alert-success hidden" id="alert1" role="alert">
                            <i class="fa fa-check"></i> <span id="alertText1" style="padding-left: 1.5ch">Alert
                                Text</span>
                        </div>

                        <div class="alert alert-danger hidden" id="alert2" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> <span id="alertText2"
                                style="padding-left: 1.5ch">Alert
                                Text</span>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right" onclick="addNewDictum()">
                            确认修改
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<script>
function addNewDictum() {
    $.post(
        '../api/edit/?module=addDictum&token=<?php echo $_SESSION['userToken']; ?>', {
            author: $('#author').val(),
            creator: $('#creator').val(),
            dictum: $('#dictum').val(),
        },
        function(a) {
            console.log(a)
            a = JSON.parse(a);
            if (a['code'] == 0) {
                $("#alertText1").text("语句创建成功\nCID = " + a['data']['cid']);
                document.getElementById('alert1').classList.remove("hidden")
                document.getElementById('alert2').classList.add("hidden")
            } else {
                if (a['code'] == 1) {
                    $("#alertText2").text(a['msg']);
                    document.getElementById('alert2').classList.remove("hidden")
                    document.getElementById('alert1').classList.add("hidden")

                }
            }
        }
    );
}
</script>