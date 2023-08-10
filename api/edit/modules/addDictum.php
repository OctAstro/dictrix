<?php

$Dictumdb = $dbPrefix . 'dictum';





$author = isset($_REQUEST['author']) ? $_REQUEST['author'] : null;
$creator = isset($_REQUEST['creator']) ? $_REQUEST['creator'] : null;
$dictum = isset($_REQUEST['dictum']) ? $_REQUEST['dictum'] : null;

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);



if($author != null && $creator != null && $dictum != null){
    $result = mysqli_query($conn, "INSERT INTO `dictum`.`dic_dictum` (`author`, `creator`, `dictum`) VALUES ('". base64_encode($author) ."', '". base64_encode($creator) ."', '". base64_encode($dictum) ."');");

    $result = mysqli_query($conn, "select count(*) from `". $Dictumdb ."`");

    while ($row = mysqli_fetch_array($result)) {
        $lastID = (int)$row[0];
    }

    echo json_encode(array('code' => 0, 'data' => array('cid' =>  $lastID )));
    exit(1);
}

else{
    echo json_encode(array('code' => 1, 'msg' => '参数填写有误'));
    exit(1);
}