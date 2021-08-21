<?php
    session_start();
    if(isset($_POST['submit'])) {
        $id = $_GET['ma_kh'];
        $name = $_POST['ten_kh'];
        $phone = $_POST['sdt'];
        $ma_ct= (int)$_POST['ma_cong_to'];
        $address = $_POST['dc'];
        $nhom_tieu_thu = (int)$_POST['nhom_tieu_thu'];
        $day = date("Y-m-d");
        $ma_nv = (int)$_SESSION['id'];
        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
        $sql = "UPDATE khachhang set ho_ten = '$name', dc = '$address', sdt = '$phone', 
                ma_cong_to = '$ma_ct', ngay_them = '$day', cong_no = 0,
                ma_nhom_tieu_thu='$nhom_tieu_thu', ma_nv = '$ma_nv' where ma_kh='$id'";
        $conn->query($sql);
        //echo $sql;
        header('location:DanhSachKhachHang.php');
    }
?>