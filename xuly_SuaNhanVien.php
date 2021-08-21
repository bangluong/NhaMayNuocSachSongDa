<?php
    session_start();
    if(isset($_POST['submit']) && (int)$_SESSION['id'] == 7) {
        $id = $_POST['ma_nv'];
        $ho_ten = $_POST['ho_ten'];
        $sdt = $_POST['sdt'];
        $ten_dang_nhap = $_POST['ten_dang_nhap'];
        $mat_khau = $_POST['mat_khau'];
        $confirm_mat_khau = $_POST['confirm_mat_khau'];
        if($mat_khau == $confirm_mat_khau) {
            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
            $mat_khau = md5($mat_khau);
            $sql = "UPDATE user SET ho_ten = '$ho_ten', sdt='$sdt', ten_dang_nhap='$ten_dang_nhap', mat_khau='$mat_khau' WHERE ma_nv = '$id'";
            if($conn->query($sql)==true) {
                echo "<script type='text/javascript'>";
                echo "alert('thêm mới thành công');";
                echo "location.href='DanhSachNhanVien.php';";
                echo "</script>";
            }
            else {
                echo "<script type='text/javascript'>";
                echo "alert('thêm mới thất bại');";
                echo "location.href='SuaNhanVien.php';";
                echo "</script>";
            }
            //echo $sql;
            
        }
        else {
            $_SESSION['add_user_message'] = "Nhập sai mật khẩu";
        }
        header('location:DanhSachNhanVien.php');
    }
    else {
        echo "<script type='text/javascript'>";
        echo "alert('chỉ admin mới được thực hiện chức năng này');";
        echo "location.href='index.php';";
        echo "</script>";
    }
?>