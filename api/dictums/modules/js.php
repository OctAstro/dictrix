<?php
$row = mysqli_fetch_array($result);
echo ('function dictum() {document.write("'.base64_decode($row['dictum']).' <br>——'.base64_decode($row['author']).'");}');
?>