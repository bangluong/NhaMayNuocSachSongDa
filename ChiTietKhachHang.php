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

                    $newsql = "SELECT * FROM hoadon WHERE ma_kh = ".$id;
                    $luong_tieu_thu=0;
                    $tong_tien_da_thanh_toan=0;
                    $newresult=$conn->query($newsql);
                    while ($row = $newresult->fetch_assoc()) {
                        $luong_tieu_thu+= $row['luong_tieu_thu'];
                        if($row['trang_thai'] == 2) {
                            $tong_tien_da_thanh_toan += $row['thanh_tien'];
                        }
                    }
                    ?>
                    <h2>Chi Tiết Khách Hàng</h2>
                    <label>Mã Khách Hàng:<?php echo $infor['ma_kh']; ?></label> </br>
                    <label>Tên Khách Hàng:<?php echo $infor['ho_ten']; ?></label> </br>
                    <label>Địa Chỉ Khách Hàng:<?php echo $infor['dc']; ?></label> </br>
                    <label>Số Điện Thoại:<?php echo $infor['sdt']; ?></label> </br>
                    <label>Công Nợ:<?php echo $infor['cong_no']; ?></label> </br>
                    <label>Tổng lượng tiêu thụ nước: <?php echo $luong_tieu_thu; ?></label></br>
                    <label>Tổng Tiền Đã Thanh Toán: <?php echo $tong_tien_da_thanh_toan; ?></label>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>