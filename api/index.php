<?php

include '../config/config.php';

$dbHost = mysqlInfo('host', $dictumConfig);
$dbUser = mysqlInfo('user', $dictumConfig);
$dbPasswd = mysqlInfo('pass', $dictumConfig);
$dbName = mysqlInfo('name', $dictumConfig);
$dbPort = mysqlInfo('port', $dictumConfig);
$dbPrefix = mysqlInfo('prefix', $dictumConfig);

$type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : 'json';

$apifile = './type/' . $type . '.php';

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
