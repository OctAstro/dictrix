<?php

$userName = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$result = mysqli_query($conn, "SELECT * FROM " . $Usersdb . " WHERE username = '{$userName}'");

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($row['salt1'] . $password . $row['salt2'], base64_decode($row['password']))) {
            echo json_encode(array('code' => 200, 'msg' => '密码正确', "token" => $row['token']), JSON_UNESCAPED_UNICODE);
            $_SESSION['isLogin'] = 1;
            $_SESSION['userToken'] = $row['token'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userGroup'] = $row['usergroup'];
            $_SESSION['passWord'] = $password;
            $_SESSION['reg_date'] = $row['reg_date'];
            $_SESSION['email'] = base64_decode($row['email']);
        } else {
            echo json_encode(array('code' => 403, 'msg' => '密码错误'), JSON_UNESCAPED_UNICODE);
            exit(1);
        }}

} else {
    echo json_encode(array('code' => 404, 'msg' => '找不到用户'), JSON_UNESCAPED_UNICODE);
    exit(1);
}