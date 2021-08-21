<?php
    session_start();
    if(isset($_POST['submit'])) {
        $id = (int)$_POST['ma_kh'];
        $name = $_POST['ten_kh'];
        $phone = $_POST['sdt'];
        $ma_ct= (int)$_POST['ma_cong_to'];
        $address = $_POST['dc'];
        $nhom_tieu_thu = (int)$_POST['nhom_tieu_thu'];
        $day = date("Y-m-d");
        $ma_nv = (int)$_SESSION['id'];
        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
        $sql = "INSERT into khachhang (ma_kh, ho_ten, dc, sdt,  ma_cong_to, ngay_them, cong_no, ma_nhom_tieu_thu, ma_nv) 
                VALUES ('$id', '$name', '$address','$phone', '$ma_ct', '$day' ,'0', '$nhom_tieu_thu','$ma_nv')";
        
        if($conn->query($sql)==true) {
            $_SESSION['message'] = "thêm mới thành công";
        }
        else {
            $_SESSION['message'] = "thêm mới thất bại";
        }
        header('location:ThemKhachHang.php');
    }
?>