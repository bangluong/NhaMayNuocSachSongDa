<?php
    session_start();
    $ma_hd = $_GET['ma_hd'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "UPDATE hoadon SET trang_thai = 2 WHERE ma_hd = '$ma_hd'";
    $conn->query($sql);
    $sql1 = "SELECT * FROM hoadon WHERE ma_hd = '$ma_hd'";
    $result = $conn->query($sql1);
    $makh=0;
    while ($row = $result->fetch_assoc()) {
        $makh = $row['ma_kh'];
    }
    $sql2 = "UPDATE khachhang SET cong_no = 0 WHERE ma_kh = '$makh'";
    $conn->query($sql2);
    header('location:DanhSachHoaDon.php');

?>