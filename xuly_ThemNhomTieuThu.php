<?php
session_start();
if(isset($_POST['submit'])) {
    $id = $_POST['ma_nhom_tieu_thu'];
    $name = $_POST['ten_nhom_tieu_thu'];
    $mo_ta = isset($_POST['mo_ta']) ? $_POST['mo_ta'] : 'không có mô tả';
    $ma_nv = $_SESSION['id'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "INSERT into nhomtieuthu (ma_nhom_tieu_thu, ten_nhom_tieu_thu, mo_ta, ma_nv) 
            VALUES ('$id', '$name', '$mo_ta', '$ma_nv')";
    if($conn->query($sql)==true) {
        $_SESSION['message'] = "thêm mới thành công";
    }
    else {
        $_SESSION['message'] = "thêm mới thất bại";
    }
    header('location:ThemNhomTieuThu.php');
}

?>