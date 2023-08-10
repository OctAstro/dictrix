<?php
include '../config/config.php';
$dbHost = $dictumConfig['mysql']['host'];
$dbUser = $dictumConfig['mysql']['user'];
$dbPasswd = $dictumConfig['mysql']['pass'];
$dbName = $dictumConfig['mysql']['name'];
$dbPort = $dictumConfig['mysql']['port'];
$dbPrefix = $dictumConfig['mysql']['prefix'];

$userName = $_SESSION['user'];
$passWord = $_SESSION['passWord'];

$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$result = mysqli_query($conn, "SELECT * FROM " . $Usersdb . " WHERE username = '{$userName}'");

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($row['salt1'] . $passWord . $row['salt2'], base64_decode($row['password']))) {
            $_SESSION['isLogin'] = 1;
            $_SESSION['userToken'] = $row['token'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userGroup'] = $row['usergroup'];
            $_SESSION['passWord'] = $passWord;
            $_SESSION['reg_date'] = $row['reg_date'];
            $_SESSION['email'] = base64_decode($row['email']);
        } else {
            $_SESSION['isLogin'] = 0;
            unset($_SESSION['isLogin']);
            $_SESSION = array();
            session_destroy();
            header("Location:../../login");
            header("Location: ../login");
        }}

} else {
    $_SESSION['isLogin'] = 0;
    unset($_SESSION['isLogin']);
    $_SESSION = array();
    session_destroy();
    header("Location:../../login");
    header("Location: ../login");
}