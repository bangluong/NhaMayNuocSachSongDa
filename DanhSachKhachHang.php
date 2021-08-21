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
                    <h2>Danh Sách Khách Hàng</h2>
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
                            <option value="1" <?php if($sx == 1) echo "selected"?>>công nợ tăng dần</option>
                            <option value="4" <?php if($sx == 4) echo "selected"?>>công nợ giảm dần</option>
                            <option value="2" <?php if($sx == 2) echo "selected"?>>tên a->z</option>
                            <option value="3" <?php if($sx == 3) echo "selected"?>>tên z->a</option>
                        </select>
                        <input type="submit" value="lọc" class="btn btn-primary" name="submit">
                    </form>
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
                        <tbody>
                            <?php
                            $html="";
                            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                            $sql = "SELECT * FROM khachhang";
                            if(isset($_GET['submit'])) {
                                $sx = $_GET['sx'];
                                if($sx == 1) {
                                    $sql = "SELECT * FROM khachhang ORDER BY cong_no ASC";
                                }
                                else if($sx == 2) {
                                    $sql = "SELECT * FROM khachhang ORDER BY ho_ten ASC";
                                }
                                else if($sx == 3) {
                                    $sql = "SELECT * FROM khachhang ORDER BY ho_ten DESC";
                                }
                                else if($sx == 4) {
                                    $sql = "SELECT * FROM khachhang ORDER BY cong_no DESC";
                                }
                                
                            }
                            
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
                                    <td>'.$nhom_tieu_thu.'</td>
                                    <td>
                                    <a class="btn btn-primary" href="ThemChiSoNuoc.php?ma_kh='.$row['ma_kh'].'"><option value="0">thêm csn</option></a>
                                    <a class="btn btn-primary" href="SuaChiSoNuoc.php?ma_kh='.$row['ma_kh'].'"><option value="1">sửa csn</option> </a>
                                    <a  class="btn btn-primary" href="ChiTietKhachHang.php?ma_kh='.$row['ma_kh'].'">chi tiết</a>
                                    <a  class="btn btn-primary" href="SuaThongTinKhachHang.php?ma_kh='.$row['ma_kh'].'">sửa KH</a></td></tr>';
                                }
                                echo $html;
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php require_once('footer.php'); ?>