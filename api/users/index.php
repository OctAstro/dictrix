<?php
session_start();


$module = isset($_GET['module']) ? $_GET['module'] : "info";

$token = '00000000000000000000000000000000';

if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {

    $token = isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '00000000000000000000000000000000';
}

if($token != '00000000000000000000000000000000' || $module == "login"){

include '../../config/config.php';

$dbHost = $dictumConfig['mysql']['host'];
$dbUser = $dictumConfig['mysql']['user'];
$dbPasswd = $dictumConfig['mysql']['pass'];
$dbName = $dictumConfig['mysql']['name'];
$dbPort = $dictumConfig['mysql']['port'];
$dbPrefix = $dictumConfig['mysql']['prefix'];



    if($module != "NULLPAGES"){

        define('MODULES', "./modules/");

        include MODULES . $module . ".php";
    }
    else
    {
        echo json_encode(array('code' => 1, 'msg' => '请提供模块名称'));
        exit(1);
    }
}

else{
    echo json_encode(array('code' => 1, 'msg' => '请提供Token'));
    exit(1);
}