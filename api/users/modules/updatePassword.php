<?php
function salt($times)
{
    $rawsalts = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $salts = $rawsalts[rand(0, 62) - 1];
    for ($i = 1; $i <= $times - 1; $i++) {
        $salts = $salts . $rawsalts[rand(0, 62) - 1];
    }
    return $salts;
}
?>

<?php
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$conn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

$Usersdb = $dbPrefix . 'users';

$result = mysqli_query($conn, "SELECT * FROM " . $Usersdb . " WHERE token = '" . $token . "'");

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        if (password_verify($row['salt1'] . $oldPass . $row['salt2'], base64_decode($row['passwd']))) {
            $salt1 = salt(10);
            $salt2 = salt(10);
            $newPass = $salt1 . $newPass . $salt2;
            $sqla = "UPDATE `" . $Usersdb . "` SET `passwd`='" . base64_encode(password_hash($newPass, PASSWORD_BCRYPT)) . "' WHERE token=" . $token . "";
            $sqlb = "UPDATE `" . $Usersdb . "` SET `salt1`='" . $salt1 . "' WHERE id=" . $userId . "";
            $sqlc = "UPDATE `" . $Usersdb . "` SET `salt2`='" . $salt2 . "' WHERE id=" . $userId . "";
            mysqli_query($conn, $sqla);
            mysqli_query($conn, $sqlb);
            mysqli_query($conn, $sqlc);
            echo json_encode(array('code' => 200, 'msg' => '密码修改成功'), JSON_UNESCAPED_UNICODE);
            exit(1);

        } else {
            echo json_encode(array('code' => 403, 'msg' => '旧密码错误'), JSON_UNESCAPED_UNICODE);
            exit(1);
        }}

} else {
    echo json_encode(array('code' => 404, 'msg' => '找不到用户'), JSON_UNESCAPED_UNICODE);
    exit(1);
}