<?php
$id = $_GET['ma_kh'];
$conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
$sql = "SELECT *FROM chisonuoc where ma_kh='$id' order by ma_csn DESC LIMIT 1";
$result = $conn->query($sql);
if($result->num_rows>0) {
    while($row = $result->fetch_assoc()) {
        $infor = $row;
    }
    echo $infor['cs_moi'];
}
else echo 0;
?>