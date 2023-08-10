<?php
$siteInfo = [
    'pageTitle' => "语句信息",
    'describe' => "查看语句详细信息",
];
$cid = isset($_GET['cid']) ? (int)$_GET['cid'] : 0;
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
            <?php if($cid < 0){?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">发生了错误: 非法ID</h3>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <h3 class="text-primary" style="padding: 16px; padding-left: 24px">
                            你的语句ID不合法!
                        </h3>
                    </div>
                </div>


            </div>
            <?php }; ?>

            <?php if($cid == 0){?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">发生了错误: 未提供ID或ID为0</h3>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <h3 class="text-primary" style="padding: 16px; padding-left: 24px">
                            你未提供语句ID或ID为0, 请前往
                            <a href="?page=dictumList" class="btn btn-primary"><i class="nav-icon fas fa-list"></i>
                                语句列表</a>
                            页面, 点击希望查看的语句旁的Info按钮查看
                        </h3>
                    </div>
                </div>


            </div>
            <?php }; 
            if($cid > 0){
                include '../config/config.php';

                $dbHost = $dictumConfig['mysql']['host'];
                $dbUser = $dictumConfig['mysql']['user'];
                $dbPasswd = $dictumConfig['mysql']['pass'];
                $dbName = $dictumConfig['mysql']['name'];
                $dbPort = $dictumConfig['mysql']['port'];
                $dbPrefix = $dictumConfig['mysql']['prefix'];
                
                $con = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);
                
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                $dictumdb = $dbPrefix . 'dictum';
                
                $sqlQuery = "SELECT * FROM " . $dictumdb . " WHERE id = " .$cid;

                $result = mysqli_query($con , $sqlQuery);

                $dictums = 0;

                if (mysqli_num_rows($result) > 0) {
                    // 输出数据
                    while($row = mysqli_fetch_assoc($result)) {
                        // echo "id: " . $row["id"]. " - " . $row["author"]. " " . $row["creator"]. " ".$row["dictum"];
                        $dictums = array('id' => $row["id"] , 'author' => base64_decode($row["author"]) , 'creator' => base64_decode($row["creator"]),'dictum' => base64_decode($row["dictum"]),'create_date' =>$row["create_date"]);
                    }
                } else {
                    echo "0 结果";
                }                
                ?>

            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">语句信息</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-primary">语句ID: <?php echo $dictums['id'] ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="width: 30%"><b>作者(author)</b></td>
                                    <td><span id="cardAuthor"><?php echo $dictums['author']?></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>创建者(creator)</b></td>
                                    <td><span id="cardCreator"><?php echo $dictums['creator']?></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>语句(dictum)</b></td>
                                    <td><span id="cardDictum"><?php echo $dictums['dictum']?></span></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%"><b>创建时间(create_date)</b></td>
                                    <td><span id="cardDate"><?php echo $dictums['create_date']?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
}?>
        </div>
    </div>
</div>