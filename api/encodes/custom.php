<?php
$custom=$_GET['custom'];
$outpuit=$custom;
if(empty($custom))
{
    $outpuit='{"id":"[uid]", "author":"[author]", "from":"[creator]", "dictum":"[text]" }';
}
while($row = mysqli_fetch_array($result))
  {
      $outpuit=str_replace('[author]',base64_decode($row['author']),$outpuit);
      $outpuit=str_replace('[uid]',base64_decode($row['id']),$outpuit);
      $outpuit=str_replace('[creator]',base64_decode($row['creator']),$outpuit);
      $outpuit=str_replace('[text]',base64_decode($row['dictum']),$outpuit);
      echo ($outpuit);

  }
?>