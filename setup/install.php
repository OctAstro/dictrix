<?php

function removeDir($dirName)
{
    if (!is_dir($dirName)) {
        return false;
    }
    $handle = @opendir($dirName);
    while (($file = @readdir($handle)) !== false) {
        if ($file != '.' && $file != '..') {
            $dir = $dirName . '/' . $file;
            is_dir($dir) ? removeDir($dir) : @unlink($dir);
        }
    }
    closedir($handle);
    @rmdir($dirName);

}

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
if (file_exists('setup.lock')) {
    echo json_encode(array('code' => 0, 'isInstalled' => 1, 'data' => array('info' => 'It has been Completed')));
    exit(1);
} else {
    $dbHost = $_POST['dbhost'];
    $dbPort = $_POST['dbport'];
    $dbName = $_POST['dbname'];
    $dbUser = $_POST['dbusername'];
    $dbPassword = $_POST['dbpasswd'];
    $dbPrefix = $_POST['dbprefix'];

    $sitename = $_POST['sitename'];
    $sitename = str_replace("'", "\\'", $sitename);

    $description = $_POST['description'];
    $description = str_replace("'", "\\'", $description);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = base64_encode($_POST['email']);

    $token = md5(sha1($username . $password . $email . mt_rand(0, 99999999) . time()));

    $dbdictum = $dbPrefix . 'dictum';
    $dbusers = $dbPrefix . 'users';

    $con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

    $sqlquery = "CREATE TABLE " . $dbdictum . " (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
author VARCHAR(255) NOT NULL,
creator VARCHAR(255) NOT NULL,
dictum text, 
create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

    mysqli_query($con, $sqlquery);

    $sqlquery = "INSERT INTO  " . $dbdictum . " (`author`, `creator`, `dictum`, `create_date`) VALUES ('5pqu5YWJ5LmL5Z+O=', 'WXVyaWs=', '5rWu5LiW5LiH5Y2D77yM5ZC+54ix5pyJ5LiJ44CC5pel77yM5pyI5LiO5Y2/44CC5pel5Li65pyd77yM5pyI5Li65pqu77yM5Y2/5Li65pyd5pyd5pqu5pqu44CC', current_timestamp());";
    mysqli_query($con, $sqlquery);

    $sqlquery = "CREATE TABLE " . $dbusers . " (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
salt1 VARCHAR(255) NOT NULL,
salt2 VARCHAR(255) NOT NULL,
usergroup VARCHAR(255),
token VARCHAR(255),
reg_date VARCHAR(255)
)";

    mysqli_query($con, $sqlquery);

    $salt1 = salt(10);
    $salt2 = salt(10);

    $password = $salt1 . $password . $salt2;

    $sqlquery = "INSERT INTO " . $dbusers . " (`username`, `password`, `email` , `salt1`, `salt2`, `usergroup`,`token`,`reg_date`) VALUES ('" . $username . "', '" . base64_encode(password_hash($password, PASSWORD_BCRYPT)) . "', '" . $email . "' ,'" . $salt1 . "', '" . $salt2 . "', 'root','{$token}','" . time() . "');";

    mysqli_query($con, $sqlquery);

    $template = file_get_contents("../config/config_template.php");
    $template = str_replace("{DB_HOST}", $dbHost, $template);
    $template = str_replace("{DB_PORT}", $dbPort, $template);
    $template = str_replace("{DB_USER}", $dbUser, $template);
    $template = str_replace("{DB_PASS}", $dbPassword, $template);
    $template = str_replace("{DB_NAME}", $dbName, $template);
    $template = str_replace("{DB_PREFIX}", $dbPrefix, $template);

    $template = str_replace("{SITENAME}", $sitename, $template);
    $template = str_replace("{DESCRIPTION}", $description, $template);

    file_put_contents("../config/config.php", $template);

    touch('./setup.lock');

    echo json_encode(array('code' => 1, 'data' => array('info' => 'Setup complete')));

    exit(1);

}