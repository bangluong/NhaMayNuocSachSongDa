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
                    <?php
                    $id = $_GET['ma_kh'];
                    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                    $sql = "SELECT * FROM khachhang where ma_kh = ".$id;
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $infor = $row;
                    }
                    ?>
                    <h2>Thêm Khách Hàng</h2>
                    <form action="xuly_SuaKhachHang.php?ma_kh=<?php echo $id; ?>" method="post">
                        <div class="form-group col-sm-5">
                            <label>Mã Khách Hàng:</label>
                            <input type="text" readonly name="ma_kh" class="form-control" value="<?php echo $infor['ma_kh']; ?>">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Họ Tên Khách Hàng:</label>
                            <input type="text" name="ten_kh" class="form-control" value="<?php echo $infor['ho_ten']; ?>" >
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Địa Chỉ Khách Hàng:</label>
                            <input type="text" name="dc" class="form-control" value="<?php echo $infor['dc']; ?>">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Số Điện Thoại Khách Hàng:</label>
                            <input type="text" name="sdt" class="form-control" value="<?php echo $infor['sdt']; ?>" >
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Mã Công Tơ:</label>
                            <input type="text" name="ma_cong_to" class="form-control" value="<?php echo $infor['ma_cong_to']; ?>" >
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Mã Nhóm Tiêu Thụ:</label>
                            <select name="nhom_tieu_thu" class="form-control">
                            <?php
                                $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                                $sql = "SELECT * FROM nhomtieuthu";
                                $result = $conn->query($sql); 
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value ='". $row['ma_nhom_tieu_thu']. "'>".$row['ten_nhom_tieu_thu']."</option>";
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>