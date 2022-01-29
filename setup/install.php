<?php
if(file_exists('setup.lock')){
    echo json_encode(array('code' => 0,'data'=>array('info'=>'It has been Completed')));
    exit(1);
}
else{
?><?php

function removeDir($dirName)
{
    if(!is_dir($dirName))
    {
        return false;
    }
    $handle = @opendir($dirName);
    while(($file = @readdir($handle)) !== false)
    {//判断是不是文件 .表示当前文件夹 ..表示上级文件夹 =2
    if($file != '.' && $file != '..')
    {
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
    $salts = $rawsalts[rand(0,62)-1];
    for($i=1;$i<=$times-1;$i++)
    {
        $salts =$salts.$rawsalts[rand(0,62)-1];
    }
    return $salts;
}
?><?php
$dbhost = $_POST['dbhost'];
$dbport = $_POST['dbport'];
$dbname = $_POST['dbname'];
$dbuser = $_POST['dbusername'];
$dbpw = $_POST['dbpasswd'];
$dbprefix = $_POST['dbprefix'];

$username= base64_encode($_POST['username']);
$passwd = $_POST['passwd'];
$email = base64_encode($_POST['email']);

$dbdictum = $dbprefix . 'dictum';
$dbusers = $dbprefix . 'users';

$con = mysqli_connect($dbhost,$dbuser,$dbpw,$dbname,$dbport);

$sqlquery = "CREATE TABLE ".$dbdictum." (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
author text NOT NULL,
creator text NOT NULL,
dictum text,
reg_date TIMESTAMP
)";

mysqli_query($con , $sqlquery);

$sqlquery = "INSERT INTO  ".$dbdictum." (`author`, `creator`, `dictum`, `reg_date`) VALUES ('RGljdHVtIFRlYW0=', 'RGljdHVtIFRlYW0=', '5LuW5Lus6K+06KaB5oiS5LqG5L2g55qE54uC77yM5bCx5YOP5pOm5o6J5LqG5rGh5Z6i', current_timestamp());";
mysqli_query($con , $sqlquery);

$sqlquery = "CREATE TABLE ".$dbusers." (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username text NOT NULL,
passwd text NOT NULL,
email text NOT NULL,
salt1 text NOT NULL,
salt2 text NOT NULL,
usergroup text
)";

mysqli_query($con , $sqlquery);

$salt1 = salt(10);
$salt2 = salt(10);

$passwd = $salt1 . $passwd . $salt2;

$sqlquery = "INSERT INTO ".$dbusers." (`username`, `passwd`, `email` , `salt1`, `salt2`, `usergroup`) VALUES ('".$username."', '".base64_encode(password_hash($passwd,PASSWORD_BCRYPT))."', '".$email."' ,'".$salt1."', '".$salt2."', 'super');";

mysqli_query($con , $sqlquery);

if(is_dir("../config/")){removeDir("../config/");}
else{}
mkdir("../config/");
        
touch("../config/database.php");
$CONFIGfile = fopen("../config/database.php", "w");
$txt = (
"<?php\n"
.'$dbhost = "'.$dbhost."\";
".'$dbname = "'.$dbname."\";
".'$dbuser = "'.$dbuser."\";
".'$dbpasswd = "' .$dbpw . "\";
".'$dbprefix = "'. $dbprefix."\";
?>");
fwrite($CONFIGfile, $txt);
fclose($CONFIGfile);
        
touch("../config/siteinfo.php");
$CONFIGfile = fopen("../config/siteinfo.php", "w");
$txt = (
"<?php\n"
."\$sitename = \"Dictum语录站\";//The Title Of WebSite\n"
."\$describe = \"\";//The Describe Of WebSite\n"
."\$tg = \"\";//Contribute Link\n"
."\$keyword = \"\";//KeyWord\n
?>");
fwrite($CONFIGfile, $txt);
fclose($CONFIGfile);

touch('./setup.lock');

echo json_encode(array('code' => 1,'data'=>array('info'=>'Setup complete')));

exit(1);

}
?>