<?php 
session_start();
if(isset($_POST['submit'])) {
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['password'] = $_POST['password'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "SELECT ma_nv, ho_ten, ten_dang_nhap, mat_khau FROM user";
    $result = $conn->query($sql);
    if($conn->connect_error) {
        echo "lỗi kết nối csdl";
    }
    //var_dump($result);
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            if($_SESSION['name'] == $row['ten_dang_nhap'] && md5($_SESSION['password']) == $row['mat_khau'] ) {
                $_SESSION['id'] = $row['ma_nv'];
                echo "<script type='text/javascript'>";
                echo "location.href='index.php';";
                echo "</script>";
                header('location:index.php');
            }
            else {
                echo "<script type='text/javascript'>";
                echo "alert('đăng nhập thất bại');";
                echo "location.href='dangnhap.php';";
                echo "</script>";
            }
            
        }
    }
    else echo"0 result";
    $conn->close();

}
 ?>