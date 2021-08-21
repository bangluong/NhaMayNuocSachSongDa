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
                    <h2>Thêm Chỉ Số Nước</h2>
                    <?php
                        $today = date("d");
                        $this_month = date("m");
                        $int_this_month = (int) $this_month;
                        $this_year = date("Y");
                        $int_this_year = (int) $this_year;
                        $int_today = (int) $today;
                        if($int_today < 28 ) {
                            if($int_this_month !=1) {
                                $int_this_month1 = $int_this_month-1;
                                $int_this_month2 = $int_this_month-2;
                                if($int_this_month2 == 0) {
                                    $int_this_month2 = 12;
                                }
                            }
                            else if($int_this_month == 1) {
                                $int_this_month1 = 12;
                                $int_this_month2 = 11;
                            }
                        }
                        else {
                            if($int_this_month !=1) {
                                $int_this_month1 = $int_this_month;
                                $int_this_month2 = $int_this_month-1;
                            }
                            else if($int_this_month == 1) {
                                $int_this_month1 = 1;
                                $int_this_month2 = 12;
                            }
                        }
                        $start_month = "";
                        $finish_month = "";
                        if($int_this_month2 < 10 ) {
                            $start_month .= "0".$int_this_month2;
                        }
                        if($int_this_month1 < 10 ) {
                            $finish_month .= "0".$int_this_month1;
                        }
                        $start_day= "$int_this_year"."-" . $start_month."-28";
                        $finish_day = "$int_this_year"."-" . $finish_month."-28";
                    ?>
                    <form action="xuly_ThemChiSoNuoc.php" method="post">
                        <div class="form-group col-sm-5">
                            <label>Mã Khách Hàng:</label>
                            <input type="text" name="ma_kh" class="form-control" id="ma_kh" onchange="load_ajax()">
                            <script language="javascript">
                                function load_ajax()
                                {
                                    $.ajax({
                                        url :"getName.php",
                                        type :"get",
                                        dataType: "text",
                                        data :{
                                            ma_kh:$('#ma_kh').val()
                                        },
                                        success: function (result){
                                            $('input[name="ten_kh"]').val(result);
                                        }
                                    })

                                    $.ajax({
                                        url :"getCS.php",
                                        type :"get",
                                        data :{
                                            ma_kh:$('#ma_kh').val()
                                        },
                                        success: function (result){
                                            $('input[name="cs_cu"]').val(result);
                                        }
                                    })
                                }
                            </script>
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Họ Tên Khách Hàng:</label>
                            <input type="text" readonly name="ten_kh" class="form-control" id="ho_ten">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Chỉ Số Cũ:</label>
                            <input type="text" readonly name="cs_cu" class="form-control" id="cs_cu">
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Chỉ Số Mới:</label>
                            <input type="text" name="cs_moi" class="form-control" required>
                        </div>

                        <div class="form-group col-sm-5">
                            <label>Kỳ Thanh Toán:</label>
                            <?php echo "từ ".$start_day." đến ".$finish_day; ?>
                        </div>
                        <input type="hidden" name="start_day" value="<?php echo $start_day; ?>">
                        <input type="hidden" name="finish_day" value="<?php echo $finish_day; ?>">
                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
           <?php require_once('footer.php'); ?>