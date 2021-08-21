<?php
session_start();
    if(!isset($_SESSION['name'])) {
        echo "<script type='text/javascript'> alert('bạn chưa đăng nhập');";
        echo "location.href='dangnhap.php';";
        echo "</script>";
    }
    $_SESSION['cs_cuoi_mess']="";
    $_SESSION['gia_mess']='';
    
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
                    <h2>Thêm Bậc Giá</h2>
                    <?php
                    $id = $_GET['ma_nhom_tieu_thu'];
                    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
                    $sql = "SELECT * FROM nhomtieuthu where ma_nhom_tieu_thu = ".$id;
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $infor = $row;
                    }

                    $sql2 = "SELECT * FROM bacgia where ma_nhom_tieu_thu = ".$id;
                    $result2 = $conn->query($sql2);
                    if($result2->num_rows>0) {
                        while($row = $result2->fetch_assoc()) {
                            $infor2 = $row;
                        }
                    }
                    else {
                        $infor2['muc_tieu_thu_cuoi'] = 0;
                    }
                    ?>
                    <form action="xuly_ThemBacGia.php" method="post" name = "myForm">
                        <div class="form-group col-sm-5">
                            <label>Mã nhóm tiêu thụ:</label>
                            <input type="text" readonly name="ma_nhom_tieu_thu" class="form-control" value="<?php echo $infor['ma_nhom_tieu_thu'];?>">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Tên nhóm tiêu thụ:</label>
                            <input type="text" readonly name="ten_nhom_tieu_thu" class="form-control" value="<?php echo $infor['ten_nhom_tieu_thu'];?>">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Chỉ Số đầu:</label>
                            <input type="number" name="cs_dau" readonly class="form-control" value="<?php echo $infor2['muc_tieu_thu_cuoi'];?>">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Chỉ Số cuối:</label>
                            <input type="number" name="cs_cuoi" class="form-control" required min="">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Giá:</label>
                            <input type="number" name="dg" class="form-control" required min="1">
                        </div>

                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
           <?php require_once('footer.php'); ?>