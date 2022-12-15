<?php

$token = $_REQUEST['token'];

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$sqlQuery = "SELECT * FROM " . $Usersdb . " WHERE token = '{$token}'";

$result = mysqli_query($conn, $sqlQuery);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        $userInfoArray = array('username' => $row['username'], 'email' => base64_decode($row['email']), 'userGroup' => $row['usergroup'], 'token' => $row['token'], 'reg_date' => $row['reg_date']);
        echo json_encode(array('code' => 200, "userInfo" => $userInfoArray), JSON_UNESCAPED_UNICODE);

    }
} else {
    echo json_encode(array('code' => 404, 'msg' => '找不到用户'), JSON_UNESCAPED_UNICODE);
    exit(1);
}