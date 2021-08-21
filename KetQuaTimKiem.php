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
                        $html="";
                        $stt=0;
                        $search_key = $_GET['search_key'];
                        $search_target = $_GET['search_target'];
                        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                        //tìm chỉ số nước
                        if($search_target == 1) {
                            $sql = "SELECT * FROM chisonuoc WHERE ma_csn = '$search_key'";
                            if(is_numeric($search_key)==true) {
                                $sql = "SELECT * FROM chisonuoc WHERE ma_csn = '$search_key'";
                                $result = $conn->query($sql);
                                if($result->num_rows>0) {
                                    $html.='
                                    <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th scope="col">STT</th>
                                            <th scope="col">mã chỉ số nước</th>
                                            <th scope="col">chỉ số cũ</th>
                                            <th scope="col">chỉ số mới</th>
                                            <th scope="col">tên khách hàng</th>
                                            <th scope="col">mã công tơ</th>
                                        </thead>
                                        <tbody>';
                                    while($row=$result->fetch_assoc()) {
                                        $makh=$row['ma_kh'];
                                        $sql1 = "SELECT *FROM khachhang WHERE ma_kh = '$makh'";
                                        $result1 = $conn->query($sql1);
                                        while($row1 = $result1->fetch_assoc()) {
                                            $tenkh = $row1['ho_ten'];
                                            $mact = $row1['ma_cong_to'];
                                        }
                                        $stt++;
                                        $html.= '
                                        <tr>
                                        <td>'.$stt.'</td>
                                        <td>'.$row['ma_csn'].'</td>
                                        <td>'.$row['cs_cu'].'</td>
                                        <td>'.$row['cs_moi'].'</td>
                                        <td>'.$tenkh.'</td>
                                        <td>'.$mact.'</td>
                                        </tr>';
                                    }
                                }
                                else {
                                    $html = "không tìm thấy kết quả cho ".$search_key;
                                }
                            }
                            else {
                                $newsql = "SELECT * FROM khachhang WHERE ho_ten LIKE '%$search_key%'";
                                $res = $conn->query($newsql);
                                if($res->num_rows>0) {
                                    $html.='
                                    <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th scope="col">STT</th>
                                            <th scope="col">mã chỉ số nước</th>
                                            <th scope="col">chỉ số cũ</th>
                                            <th scope="col">chỉ số mới</th>
                                            <th scope="col">tên khách hàng</th>
                                            <th scope="col">mã công tơ</th>
                                        </thead>
                                        <tbody>';
                                    while($r = $res->fetch_assoc()) {
                                        $makh = $r['ma_kh'];
                                        $sql = "SELECT * FROM chisonuoc WHERE ma_kh = '$makh'";
                                        $result = $conn->query($sql);
                                        if($result->num_rows>0) {
                                            while($row=$result->fetch_assoc()) {
                                                $makh=$row['ma_kh'];
                                                $sql1 = "SELECT *FROM khachhang WHERE ma_kh = '$makh'";
                                                $result1 = $conn->query($sql1);
                                                while($row1 = $result1->fetch_assoc()) {
                                                    $tenkh = $row1['ho_ten'];
                                                    $mact = $row1['ma_cong_to'];
                                                }
                                                $stt++;
                                                $html.= '
                                                <tr>
                                                <td>'.$stt.'</td>
                                                <td>'.$row['ma_csn'].'</td>
                                                <td>'.$row['cs_cu'].'</td>
                                                <td>'.$row['cs_moi'].'</td>
                                                <td>'.$tenkh.'</td>
                                                <td>'.$mact.'</td>
                                                </tr>';
                                            }
                                        }
                                    }
                                }
                                else {
                                    $html = "không tìm thấy kết quả cho ".$search_key;
                                }
                            }
                        }
                        // tìm hoá đơn
                        else if($search_target == 2) {
                            $sql = "SELECT * FROM hoadon WHERE ma_hd = '$search_key'";
                            if(is_numeric($search_key)==true) {
                                $sql = "SELECT * FROM hoadon WHERE ma_hd = '$search_key'";
                                $result = $conn->query($sql);
                                
                                if($result->num_rows>0) {
                                    $html.='
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
                                        <tbody>';
                                    while($row1=$result->fetch_assoc()) {
                                        $makh = $row1['ma_kh'];
                                        $sql1 = "SELECT * FROM hoadon WHERE ma_kh = '$makh'";
                                        $result1 = $conn->query($sql1);
                                        while($row=$result1->fetch_assoc()) {
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
                                    $html.='</tbody>
                                        </table>
                                        </div>';
                                }
                                else {
                                    $html='không tìm thấy kết quả cho '.$search_key;
                                }
                                
                            }
                            else {
                                $sql1 = "SELECT * FROM khachhang WHERE ho_ten LIKE '%$search_key%'";
                                $result1 = $conn->query($sql1);
                                if($result1->num_rows>0) {
                                    $html.='
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
                                        <tbody>';
                                }
                                else {
                                    $html='không tìm thấy kết quả cho '.$search_key;
                                }
                                while($row1=$result1->fetch_assoc()) {
                                    $makh = $row1['ma_kh'];
                                    $sql = "SELECT * FROM hoadon WHERE ma_kh = '$makh'";
                                    $result = $conn->query($sql);
                                    while($row=$result->fetch_assoc()) {
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
                                $html.='</tbody>
                                </table>
                                </div>';
                                
                            }
                        }
                        //tìm khách hàng
                        else if($search_target == 3) {
                            
                            if(is_numeric($search_key) == true) {
                                $sql = "SELECT * FROM khachhang WHERE ma_kh = '$search_key'";
                            }
                            else {
                                $sql = "SELECT * FROM khachhang WHERE ho_ten LIKE '%$search_key%'";
                            }
                            $result = $conn->query($sql);
                            if($result->num_rows>0) {
                                $html.='
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th scope="col">STT</th>
                                        <th scope="col">Họ Tên</th>
                                        <th scope="col">Địa Chỉ</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Công Nợ</th>
                                        <th scope="col">Nhóm Tiêu Thụ</th>
                                        <th scope="col">Tuỳ Chọn</th>
                                    </thead>
                                    <tbody>';
                            }
                            else {
                                $html='không tìm thấy kết quả cho '.$search_key;
                            }
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
                                <td>'.$nhom_tieu_thu.'</td>
                                <td>
                                <a class="btn btn-primary" href="ThemChiSoNuoc.php?ma_kh='.$row['ma_kh'].'"><option value="0">thêm csn</option></a>
                                <a class="btn btn-primary" href="SuaChiSoNuoc.php?ma_kh='.$row['ma_kh'].'"><option value="1">sửa csn</option> </a>
                                <a  class="btn btn-primary" href="ChiTietKhachHang.php?ma_kh='.$row['ma_kh'].'">chi tiết</a>
                                <a  class="btn btn-primary" href="SuaThongTinKhachHang.php?ma_kh='.$row['ma_kh'].'">sửa KH</a></td></tr>
                                </tbody>
                                    </table>
                                    </div>';
                            }
                        }
                    ?>
                    <?php echo $html; ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php require_once('footer.php'); ?>