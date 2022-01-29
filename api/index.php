<?php

    if(!file_exists('../config/database.php') || !file_exists('../config/siteinfo.php'))
    {
        if(!file_exists('../config/database.php') && !file_exists('../config/siteinfo.php'))
            header("Location: /setup");
        else
        {
            if(!file_exists('../config/database.php') && file_exists('../config/siteinfo.php'))
                echo '找不到 siteinfo.php ，请重新安装<br>';
            if(file_exists('../config/database.php') && !file_exists('../config/siteinfo.php'))
                echo '找不到 database.php ，请重新安装<br>';
        }
        
    }
    
    include '../config/database.php';
    include '../config/siteinfo.php';
    
    $encode = isset($_REQUEST["encode"]) ? $_REQUEST["encode"] : 'json';
    
    $apifile = './encodes/'.$encode.'.php';
    
    if(!file_exists($apifile))
        $encode='json';
    
    $con = mysqli_connect($dbhost, $dbname, $dbpasswd , $dbname);
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $dictumdb = $dbprefix . 'dictum';
    
    $result = mysqli_query($con,"SELECT * FROM ".$dictumdb." order by rand() limit 1");
    include $apifile;
    
    mysqli_close($con);


?>