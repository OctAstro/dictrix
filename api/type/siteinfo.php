<?php
include "../config/siteinfo.php";

echo json_encode(array( 'sitename'=> $sitename, "describe"=> $describe , 'submit'=>$tg , 'keyword'=>$keyword) );

?>