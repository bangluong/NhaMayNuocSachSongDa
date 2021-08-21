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
                    <h2>Danh Sách Hoá Đơn</h2>
                    <form action="">
                        sắp xếp: 
                        <select name="sx" id="">
                            <?php 
                            if(isset($_GET['submit'])) {
                                $sx = $_GET['sx'];
                            }
                            else $sx = 0;
                            ?>
                            <option value="0" <?php if($sx == 0) echo "selected"?>>mặc định</option>
                            <option value="1" <?php if($sx == 1) echo "selected"?>>thành tiền tăng dần</option>
                            <option value="4" <?php if($sx == 4) echo "selected"?>>thành tiền giảm dần</option>
                            <option value="5" <?php if($sx == 5) echo "selected"?>>lượng tiêu thụ tăng dần</option>
                            <option value="6" <?php if($sx == 6) echo "selected"?>>lượng tiêu thụ giảm dần</option>
                        </select>
                        <input type="submit" value="lọc" class="btn btn-primary" name="submit">
                    </form>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th scope="col">STT</th>
                            <th scope="col">mã hoá đơn</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">lượng tiêu thụ</th>
                            <th scope="col">thành tiền</th>
                            <th scope="col">trạng thái</th>
                            <th scope="col">Tuỳ Chọn</th>
                        </thead>
                        <tbody>
                            <?php
                            $html="";
                            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                            $sql = "SELECT * FROM hoadon";
                            if(isset($_GET['submit'])) {
                                $sx = $_GET['sx'];
                            }
                            else $sx = 0;
                            if($sx == 1) {
                                $sql = "SELECT * FROM hoadon ORDER BY thanh_tien ASC";
                            }
                            if($sx == 4) {
                                $sql = "SELECT * FROM hoadon ORDER BY thanh_tien DESC";
                            }
                            if($sx == 5) {
                                $sql = "SELECT * FROM hoadon ORDER BY luong_tieu_thu ASC";
                            }
                            if($sx == 6) {
                                $sql = "SELECT * FROM hoadon ORDER BY luong_tieu_thu DESC";
                            }
                            $result = $conn->query($sql);
                            $stt=0;
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if($row['trang_thai'] == 0) {
                                        $trang_thai = "chưa lưu";
                                    }
                                    else if($row['trang_thai'] == 1) {
                                        $trang_thai = "chưa thanh toán";
                                    }
                                    else if($row['trang_thai'] == 2) {
                                        $trang_thai = "đã thanh toán";
                                    }
                                    $sql2 = "SELECT * FROM khachhang WHERE ma_kh =".$row['ma_kh'];
                                    $result2 = $conn->query($sql2);
                                    while($row2 = $result2->fetch_assoc()) {
                                        if($row['ma_kh'] == $row2['ma_kh']) {
                                            $name = $row2['ho_ten'];
                                        }
                                    }
                                    $stt+=1;
                                    $html.= '
                                    <tr>
                                    <td>'.$stt.'</td>
                                    <td>'.$row['ma_hd'].'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$row['luong_tieu_thu'].'</td>
                                    <td>'.$row['thanh_tien'].'</td>
                                    <td>'.$trang_thai.'</td>
                                    <td>
                                    <a class="btn btn-primary" href="xuly_HoaDon.php?ma_hd='.$row['ma_hd'].'">lưu</a>
                                    <a class="btn btn-primary" href="ChiTietHoaDon.php?ma_hd='.$row['ma_hd'].'">chi tiết</a>
                                    <a class ="btn btn-primary" href="xuly_HoaDon2.php?ma_hd='.$row['ma_hd'].'">đã thanh toán</a></td></tr>';
                                }
                            }
                            echo $html;
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>