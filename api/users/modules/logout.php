<?php
$_SESSION['isLogin'] = 0;
unset($_SESSION['isLogin']);
$_SESSION = array();
session_destroy();
header("Location:../../login");