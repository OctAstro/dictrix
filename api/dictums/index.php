<?php

include '../../config/config.php';

$dbHost = $dictumConfig['mysql']['host'];
$dbUser = $dictumConfig['mysql']['user'];
$dbPasswd = $dictumConfig['mysql']['pass'];
$dbName = $dictumConfig['mysql']['name'];
$dbPort = $dictumConfig['mysql']['port'];
$dbPrefix = $dictumConfig['mysql']['prefix'];

$type = isset($_REQUEST["module"]) ? $_REQUEST["module"] : 'json';

$apifile = './modules/' . $type . '.php';

if (!file_exists($apifile)) {
    $type = 'json';
}

$con = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPort);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$dictumdb = $dbPrefix . 'dictum';

$result = mysqli_query($con, "SELECT * FROM " . $dictumdb . " order by rand() limit 1");
include $apifile;

mysqli_close($con);