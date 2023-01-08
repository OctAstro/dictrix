<?php
session_start();

if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1) {

    $token = isset($_SESSION['userToken']) ? $_SESSION['userToken'] : '';
}

include '../../config/config.php';

$dbHost = $dictumConfig['mysql']['host'];
$dbUser = $dictumConfig['mysql']['user'];
$dbPasswd = $dictumConfig['mysql']['pass'];
$dbName = $dictumConfig['mysql']['name'];
$dbPort = $dictumConfig['mysql']['port'];
$dbPrefix = $dictumConfig['mysql']['prefix'];

$module = isset($_GET['module']) ? $_GET['module'] : "info";

define('MODULES', "./modules/");

include MODULES . $module . ".php";