<?php

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {

        echo json_encode(array('id' => (int) $row['id'], 'author' => base64_decode($row['author']), 'creator' => base64_decode($row['creator']), 'dictum' => base64_decode($row['dictum'])), JSON_UNESCAPED_UNICODE);

    }} else {
    echo json_encode(array('code' => 404, 'msg' => '数据库中没有语句'), JSON_UNESCAPED_UNICODE);
}
