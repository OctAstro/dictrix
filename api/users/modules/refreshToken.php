<?php

$PassWord = $_POST['password'];

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$result = mysqli_query($conn, "SELECT * FROM " . $Usersdb . " WHERE token = '{$token}'");

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($row['salt1'] . $PassWord . $row['salt2'], base64_decode($row['password']))) {
            $newToken = md5(sha1($row['username'] . $PassWord . $row['email'] . mt_rand(0, 99999999) . time()));
            $sqla = "UPDATE `" . $Usersdb . "` SET `token`='" . $newToken . "' WHERE token='" . $token . "'";
            mysqli_query($conn, $sqla);
            $_SESSION['userToken'] = $newToken;
            echo json_encode(array('code' => 200, 'msg' => '修改成功', 'token' => $newToken));
        } else {
            echo json_encode(array('code' => 403, 'msg' => '密码错误'));
            exit(1);
        }}

} else {
    echo json_encode(array('code' => 404, 'msg' => '找不到用户'));
    exit(1);
}