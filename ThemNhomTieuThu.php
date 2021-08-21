<?php
session_start();
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
                    <h2>Thêm Nhóm Tiêu Thụ</h2>
                    
                    <form action="xuly_ThemNhomTieuThu.php" method="post">
                        <div class="form-group col-sm-5">
                            <label>Mã Nhóm Tiêu Thụ:</label>
                            <input type="text" name="ma_nhom_tieu_thu" class="form-control">
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Tên Nhóm Tiêu Thụ:</label>
                            <input type="text" name="ten_nhom_tieu_thu" class="form-control">
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Mô tả:</label>
                            <input type="text" name="mo_ta" class="form-control">
                        </div>
                        <input type="submit" name="submit" value="thêm" class="btn btn-primary">
                        <button class="btn btn-danger">Huỷ</button>
                    </form>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>