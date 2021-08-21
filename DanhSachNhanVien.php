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
                    <h2>Danh Sách Nhân Viên</h2>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th scope="col">STT</th>
                            <th scope="col">Họ Tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Tên Đăng Nhập</th>
                            <th scope="col">Tuỳ Chọn</th>
                        </thead>
                        <tbody>
                            <?php
                            $html="";
                            $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                            $sql = "SELECT * FROM user";
                            $result = $conn->query($sql);
                            $stt=0;
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $stt+=1;
                                    $html.= '
                                    <tr>
                                    <td>'.$stt.'</td>
                                    <td>'.$row['ho_ten'].'</td>
                                    <td>'.$row['sdt'].'</td>
                                    <td>'.$row['ten_dang_nhap'].'</td>
                                    <td>
                                    <a class="btn btn-primary" href="SuaNhanVien.php?ma_nv='.$row['ma_nv'].'">Sửa thông tin</a>
                                    <a class="btn btn-primary" href="XoaNhanVien.php?ma_nv='.$row['ma_nv'].'">Xoá</a>
                                    </td>
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