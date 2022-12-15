<?php
session_start();

if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {

    $token = $_SESSION['userToken'];
}

include '../../config/config.php';

$dbHost = mysqlInfo('host', $dictumConfig);
$dbUser = mysqlInfo('user', $dictumConfig);
$dbPasswd = mysqlInfo('pass', $dictumConfig);
$dbName = mysqlInfo('name', $dictumConfig);
$dbPort = mysqlInfo('port', $dictumConfig);
$dbPrefix = mysqlInfo('prefix', $dictumConfig);

$module = isset($_GET['module']) ? $_GET['module'] : "info";

define('MODULES', "./modules/");

include MODULES . $module . ".php";