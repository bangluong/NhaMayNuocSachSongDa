<?php
session_start();
$error = array();
if(isset($_POST['submit']) && $_SESSION['id'] == 7) {
    $ho_ten = $_POST['ho_ten'];
    $sdt = $_POST['sdt'];
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = $_POST['mat_khau'];
    $confirm_mat_khau = $_POST['confirm_mat_khau'];
    if($mat_khau == $confirm_mat_khau) {
        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
        $mat_khau = md5($mat_khau);
        $sql = "INSERT into user (ho_ten, sdt, ten_dang_nhap, mat_khau, rule) 
                VALUES ('$ho_ten', '$sdt', '$ten_dang_nhap', '$mat_khau', 1)";
        if($conn->query($sql)==true) {
            echo "<script type='text/javascript'>";
            echo "alert('thêm mới thành công');";
            echo "location.href='ThemNhanVien.php';";
            echo "</script>";
        }
        else {
            echo "<script type='text/javascript'>";
            echo "alert('thêm mới thất bại');";
            echo "location.href='ThemNhanVien.php';";
            echo "</script>";
        }
        
    }
    else {
        $error['pass'] = "Nhập sai mật khẩu";
    }
    header('location:ThemNhanVien.php');
}
else {
    echo "<script type='text/javascript'>";
    echo "alert('chỉ admin mới được thực hiện chức năng này');";
    echo "location.href='index.php';";
    echo "</script>";
}

?>