<?php
if(file_exists('./setup.lock')){
    echo json_encode(array("file_exists"=>1));
    exit(1);
}
else {
    echo json_encode(array("file_exists"=>0));
    exit(1);
}
?>