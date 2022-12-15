<?php
if (file_exists('setup.lock')) {
    echo json_encode(array('code' => 0, 'isInstalled' => 1, 'data' => array('info' => 'It has been Completed')));
    exit(1);
} else {
    echo json_encode(array('code' => 0, 'isInstalled' => 0, 'data' => array('info' => 'nothing')));

}
