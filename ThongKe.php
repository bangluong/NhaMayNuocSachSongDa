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
                    <h1>BÁO CÁO THỐNG KÊ</h1></br>
                    <form action="" method="get">
                        <div class ="sl" id="sl">
                        <select name="ky">
                            <?php
                                if(isset($_GET['submit'])) {
                                    $month = $_GET['ky'];
                                }
                                else $month = (int)date("m");
                                $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                                $sql = "SELECT * FROM kytinhtien";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    if($row['ma_ky'] == $month) {
                                        echo '<option selected value = "'.$row['ma_ky'].'"> từ '.$row['ngay_bat_dau'].' đến '.$row['ngay_ket_thuc'].'</option>';
                                    }
                                    else echo '<option value = "'.$row['ma_ky'].'"> từ '.$row['ngay_bat_dau'].' đến '.$row['ngay_ket_thuc'].'</option>';
                                }
                            ?>
                        </select>
                        </div>
                        <input type="submit" value="lọc" name="submit" class="btn btn-primary">
                    </form>
                    <?php 
                        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                        $now = date("Y-m-d");
                        if(isset($_GET['submit'])) {
                            $month = $_GET['ky'];
                        }
                        else $month = (int)date("m");
                        $sql = "SELECT * FROM kytinhtien WHERE ma_ky = '$month'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {

                        }
                        $sql2 = "SELECT * FROM chisonuoc WHERE ma_ky = '$month'";
                        $res = $conn->query($sql2);
                        $tong_tien=0;
                        $tong_luong_tieu_thu=0;
                        while ($r = $res->fetch_assoc()) {
                            $ma_csn = $r['ma_csn'];
                            $sql1 = "SELECT * FROM hoadon WHERE ma_csn = '$ma_csn'";
                            $result1 = $conn->query($sql1);
                            $tong_tien=0;
                            $tong_luong_tieu_thu=0;
                            while($row = $result1->fetch_assoc()) {
                                $tong_tien += $row['thanh_tien'];
                                $tong_luong_tieu_thu += $row['luong_tieu_thu'];
                            }
                        }
                    ?>
                    <h2>Lượng tiêu thụ nước tháng <?php echo $month ?>: <?php echo $tong_luong_tieu_thu; ?></h2></br>
                    <h2>Doanh thu tháng <?php echo $month ?>: <?php echo $tong_tien; ?></h2></br>
                    <div class="table-responsive container">
                    <caption><h3>Lượng khách hàng mới tháng <?php echo $month ?>/2021</h3></caption>
                    <table class="table">
                        <thead>
                            <th scope="col">STT</th>
                            <th scope="col">Họ Tên</th>
                            <th scope="col">Địa Chỉ</th>
                            <th scope="col">Số Điện Thoại</th>
                            <th scope="col">Công Nợ</th>
                            <th scope="col">Nhóm Tiêu Thụ</th>
                        </thead>
                        <tbody>
                            <?php
                            $html="";
                            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                            $lastday = "";
                            $firstday = "";
                            if(isset($_GET['submit'])) {
                                $ky = $_GET['ky'];
                                $sql1 = "SELECT * FROM kytinhtien WHERE ma_ky = '$ky'";
                                $result1 = $conn->query($sql1);
                                while($row1 = $result1->fetch_assoc()) {
                                    $lastday = $row1['ngay_ket_thuc'];
                                    $firstday = $row1['ngay_bat_dau'];
                                }
                            }
                            else {
                             
                            }
                            $sql = "SELECT * FROM khachhang Where DATE(ngay_them) BETWEEN '$firstday' AND '$lastday'";
                            $result = $conn->query($sql);
                            $stt=0;
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $sql2 = "SELECT * FROM nhomtieuthu";
                                    $result2 = $conn->query($sql2);
                                    while($row2 = $result2->fetch_assoc()) {
                                        if($row['ma_nhom_tieu_thu'] == $row2['ma_nhom_tieu_thu']) {
                                            $nhom_tieu_thu = $row2['ten_nhom_tieu_thu'];
                                        }
                                    }
                                    $stt+=1;
                                    $html.= '
                                    <tr>
                                    <td>'.$stt.'</td>
                                    <td>'.$row['ho_ten'].'</td>
                                    <td>'.$row['dc'].'</td>
                                    <td>'.$row['sdt'].'</td>
                                    <td>'.$row['cong_no'].'</td>
                                    <td>'.$nhom_tieu_thu.'</td></tr>';
                                }
                            }
                            echo $html;
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="table-responsive container">
                    <caption><h3>Danh Sách Hoá Đơn tháng <?php echo $month ?>/2021</h3></caption>
                    <table class="table">
                        <thead>
                        <th scope="col">STT</th>
                            <th scope="col">mã hoá đơn</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">lượng tiêu thụ</th>
                            <th scope="col">thành tiền</th>
                            <th scope="col">trạng thái</th>
                            
                        </thead>
                        <tbody>
                            <?php
                            $html="";
                            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                            $lastday = "";
                            $firstday = "";
                            if(isset($_GET['submit'])) {
                                $ky = $_GET['ky'];
                                $sql1 = "SELECT * FROM kytinhtien WHERE ma_ky = '$ky'";
                                $result1 = $conn->query($sql1);
                                while($row1 = $result1->fetch_assoc()) {
                                    $lastday = $row1['ngay_ket_thuc'];
                                    $firstday = $row1['ngay_bat_dau'];
                                }
                            }
                            else $month = (int) date("m");
                            $sql2 = "SELECT * FROM chisonuoc WHERE ma_ky = '$month'";
                            $res = $conn->query($sql2);
                            $tong_tien=0;
                            $tong_luong_tieu_thu=0;
                            while ($r = $res->fetch_assoc()) {
                                $ma_csn = $r['ma_csn'];
                                $sql1 = "SELECT * FROM hoadon WHERE ma_csn = '$ma_csn'";
                                $result1 = $conn->query($sql1);
                                $stt=0;
                                while($row = $result1->fetch_assoc()) {
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
                                    </tr>';
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