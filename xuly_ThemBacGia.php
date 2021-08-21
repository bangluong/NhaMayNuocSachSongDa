<?php
session_start();
if(isset($_POST['submit'])) {
    $cs_dau = isset($_POST['cs_dau']) ? $_POST['cs_dau']:0;
    $cs_cuoi = isset($_POST['cs_cuoi']) ? $_POST['cs_cuoi']:0;
    $gia = isset($_POST['dg']) ? $_POST['dg']:0;
    $check=0;
    if($cs_cuoi < $cs_dau || $cs_cuoi == 0) {
        $_SESSION['cs_cuoi_mess']="chỉ số cuối phải lớn hơn chỉ số đầu và không được để trống";
        $check=1;
    }
    if($gia <= 0) {
        $_SESSION['gia_mess'] = "giá không được để trống và phải lớn hơn 0";
        $check=1;
    }
    $ma_nhom_tieu_thu = $_POST['ma_nhom_tieu_thu'];
    $ma_nv = $_SESSION['id'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "INSERT into bacgia (muc_tieu_thu_dau, muc_tieu_thu_cuoi, gia, ma_nv, ma_nhom_tieu_thu) 
            VALUES ('$cs_dau', '$cs_cuoi', '$gia', '$ma_nv', '$ma_nhom_tieu_thu')";
    //echo $sql;
    if($check==0){
        $conn->query($sql);
        header('location:DanhSachKhachHang.php');
    }
}

?>