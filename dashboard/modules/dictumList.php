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
                        <table class="table" style="width: 100%; font-size: 15px">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
function getList() {
    $.get("../api/dictums/?module=dictumList", function(data) {
        //console.log(data);
        data = JSON.parse(data);
        //console.log(data.length);
        for (i = 0; i <= data.length - 1; i++) {
            //console.log(i);
            dictumContent = ''
            console.log(data[i]['dictum'].length)
            if (data[i]['dictum'].length > 20) {
                for (j = 0; j <= 20 - 1; j++) {
                    dictumContent = dictumContent + data[i]['dictum'][j]
                }
                dictumContent = dictumContent + " ......"
                console.log(dictumContent)
            } else dictumContent = data[i]['dictum']
            $(
                "body > div > div.content-wrapper > div.content > div > div > div > div > div > table > tbody"
            ).append('<tr><th scope="row">' + data[i]['id'] + '</th><td>' + data[i]['author'] +
                '</td><td>' + dictumContent +
                '</td><td><a type="button" class="btn btn-outline-info" href="?page=dictumDetail&cid=' +
                data[i]['id'] + '">Info</button></td></tr>');
        }
    });
}

getList()
</script>