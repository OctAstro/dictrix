<?php

$result = mysqli_query($con, "SELECT * FROM " . $dictumdb);

$i = 0;

$lists[0] = 0;

if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        // echo "id: " . $row["id"]. " - " . $row["author"]. " " . $row["creator"]. " ".$row["dictum"];
        $lists[$i] = array('id' => $row["id"] , 'author' => base64_decode($row["author"]) , 'creator' => base64_decode($row["creator"]),'dictum' => base64_decode($row["dictum"]),'create_date' =>$row["create_date"]);
        $i=$i+1;
    }
} else {
    echo "0 结果";
}

echo json_encode($lists);

?>