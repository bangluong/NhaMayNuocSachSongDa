<?php
session_start();
$_SESSION['add_user_message'] = "";
if(!isset($_SESSION['name'])) {
    echo "<script type='text/javascript'> alert('bạn chưa đăng nhập');";
    echo "location.href='dangnhap.php';";
    echo "</script>";
}
require_once('header.php');
?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once('sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once('topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h2>Thêm Nhân Viên</h2>
                    <form action="xuly_ThemNhanVien.php" method="post" id = "myform">
                        <div class="form-group col-sm-5">
                            <label>Tên Nhân Viên:</label>
                            <input type="text" name="ho_ten" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Số Điện Thoại:</label>
                            <input type="text" name="sdt" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Tên Đăng Nhập:</label>
                            <input type="text" name="ten_dang_nhap" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Mật Khẩu:</label>
                            <input type="password" name="mat_khau" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Nhập Lại Mật Khẩu:</label>
                            <input type="password" name="confirm_mat_khau" class="form-control" required>
                        </div>
                        <input type="submit" name="submit" value="thêm" class="btn btn-primary">
                        <button class="btn btn-danger">Huỷ</button>
                    </form>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>