<?php
session_start();
include '../config/config.php';

$userName = $_POST['username'];
$PassWD = $_POST['passwd'];

$dbHost = mysqlInfo('host', $dictumConfig);
$dbUser = mysqlInfo('user', $dictumConfig);
$dbPasswd = mysqlInfo('pass', $dictumConfig);
$dbName = mysqlInfo('name', $dictumConfig);
$dbPort = mysqlInfo('port', $dictumConfig);
$dbPrefix = mysqlInfo('prefix', $dictumConfig);

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$result = mysqli_query($conn, "SELECT * FROM " . $Usersdb . " WHERE username = '{$userName}'");

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($row['salt1'] . $PassWD . $row['salt2'], base64_decode($row['passwd']))) {
            echo json_encode(array('code' => 200, 'msg' => '密码正确'), JSON_UNESCAPED_UNICODE);
            $_SESSION['isLogin'] = 1;
            $_SESSION['userToken'] = $row['token'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['email'] = base64_decode($row['email']);
        } else {
            echo json_encode(array('code' => 403, 'msg' => '密码错误'), JSON_UNESCAPED_UNICODE);
            exit(1);
        }}

} else {
    echo json_encode(array('code' => 404, 'msg' => '找不到用户'), JSON_UNESCAPED_UNICODE);
    exit(1);
}
