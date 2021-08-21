<?php
    session_start();
    $ma_nv = $_GET['ma_nv'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "DELETE FROM user WHERE ma_nv = '$ma_nv'";
    if($conn->query($sql)==true) {
        echo "<script type='text/javascript'>";
        echo "alert('Xoá thành công');";
        echo "location.href='DanhSachNhanVien.php';";
        echo "</script>";
    }
    else {
        echo "<script type='text/javascript'>";
        echo "alert('xoá thất bại');";
        echo "location.href='DanhSachNhanVien.php';";
        echo "</script>";
    }
    //$conn->query($sql);
?>