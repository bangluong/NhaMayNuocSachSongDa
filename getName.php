<?php
    $ma_kh = $_GET['ma_kh'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "SELECT * FROM khachhang where ma_kh = ".$ma_kh;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $infor = $row;
    }
    echo $infor['ho_ten'];
    //die(json_encode($infor));
?>