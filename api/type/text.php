<?php
$row = mysqli_fetch_array($result);
echo (base64_decode($row['dictum']));
?>