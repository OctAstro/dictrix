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
    
    $type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : 'json';
    
    $apifile = './type/'.$type.'.php';
    
    if(!file_exists($apifile))
        $type='json';
    
    $con = mysqli_connect($dbhost, $dbname, $dbpasswd , $dbname);
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $dictumdb = $dbprefix . 'dictum';
    
    $result = mysqli_query($con,"SELECT * FROM ".$dictumdb." order by rand() limit 1");
    include $apifile;
    
    mysqli_close($con);


?>