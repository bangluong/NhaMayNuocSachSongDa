<?php
session_start();
    if(!isset($_SESSION['name'])) {
        echo "<script type='text/javascript'> alert('bạn chưa đăng nhập');";
        echo "location.href='dangnhap.php';";
        echo "</script>";
    }
require_once('header.php');
?>
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
                        $mahd = $_GET['ma_hd'];
                        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                        $sql = "SELECT * FROM hoadon where ma_hd = ".$mahd;
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            $infor = $row;
                        }
                        $tiennuoc = (float)$infor['thanh_tien'] - (float)$infor['phi_ntsh'] - (float)$infor['thue'];
                        $newsql = "SELECT * FROM chisonuoc where ma_csn = ".$infor['ma_csn'];
                        $result2 = $conn->query($newsql);
                        $manv=0;
                        while($row = $result2->fetch_assoc()) {
                            $infor2 = $row;
                            $manv = $row['ma_nv'];
                        }
                        $newsql = "SELECT * FROM user WHERE ma_nv='$manv'";
                        $newres = $conn->query($newsql);
                        $nv="";
                        while($row = $newres->fetch_assoc()) {
                            $nv = $row['ho_ten'];
                        }
                    ?>

                    <table class="table table-bordered">
                        <tr>
                            <td>tổng số tiền</td>
                            <td>VAT</td>
                            <td>phí nước thải sinh hoạt</td>
                            <td>tiền nước</td>
                            <td>tuỳ chọn</td>
                            <td>tải về</td>
                        </tr>
                        <tr>
                            <td><?php echo $infor['thanh_tien']; ?></td>
                            <td><?php echo $infor['thue']; ?></td>
                            <td><?php echo $infor['phi_ntsh']; ?></td>
                            <td><?php echo $tiennuoc; ?></td>
                            <td><?php echo '<a class="btn btn-link" href="xuly_HoaDon.php?ma_hd='.$infor['ma_hd'].'">lưu</a>' ?>
                            <?php echo '<a class="btn btn-link" href="xuly_HoaDon2.php?ma_hd='.$infor['ma_hd'].'">đã thanh toán</a>' ?></td>
                            <td>tải về</td>
                        </tr>
                    </table>

                    <div>
                    <?php echo $infor['ngay_tao']; ?>
                        <table class="table-borderless table" width="80%">
                            <tr>
                                <td>
                                    chỉ số mới
                                </td>
                                <td>
                                    chỉ số cũ
                                </td>
                                <td>
                                    tiêu thụ
                                </td>
                            </tr>
                            <tr>
                            <td><?php echo $infor2['cs_moi']; ?></td>
                            <td><?php echo $infor2['cs_cu']; ?></td>
                            <td><?php echo $infor['luong_tieu_thu'];?></td>
                            </tr>
                            <tr>
                                <td><?php echo $infor['luong_tieu_thu'];?> khối nước</td>
                                <td></td>
                                <td><?php echo $tiennuoc; ?></td>
                            </tr>
                            <tr>
                                <td>cộng:</td>
                                <td></td>
                                <td><?php echo $tiennuoc; ?></td>
                            </tr>
                            <tr>
                                <td>thuế giá trị gia tăng:</td>
                                <td></td>
                                <td> <?php echo $infor['thue']; ?></td>
                            </tr>
                            <tr>
                                <td>phí nước thải sinh hoạt</td>
                                <td></td>
                                <td><?php echo $infor['phi_ntsh']; ?></td>
                            </tr>
                            <tr>
                                <td>tổng cộng</td>
                                <td></td>
                                <td> <?php echo $infor['thanh_tien']; ?></td>
                            </tr>
                            <tr>
                                <td>người lập</td>
                                <td></td>
                                <td><?php echo $nv; ?></td>
                            </tr>
                        </table>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php require_once('footer.php'); ?>