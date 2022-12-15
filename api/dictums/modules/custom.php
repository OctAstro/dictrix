<?php
$custom = isset($_REQUEST["custom"]) ? $_REQUEST["custom"] : '{"id":[uid], "author":"[author]", "from":"[creator]", "dictum":"[dictum]" }';

while ($row = mysqli_fetch_array($result)) {
    $custom = str_replace('[author]', base64_decode($row['author']), $custom);
    $custom = str_replace('[uid]', $row['id'], $custom);
    $custom = str_replace('[creator]', base64_decode($row['creator']), $custom);
    $custom = str_replace('[dictum]', base64_decode($row['dictum']), $custom);
    echo ($custom);

}
