<?php
session_start();
if(isset($_POST['submit'])) {
    $conn1 = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $ngay_bat_dau = $_POST['start_day'];
    $ngay_ket_thuc = $_POST['finish_day'];
    $new_sql = "INSERT into kytinhtien (ngay_bat_dau, ngay_ket_thuc)
                VALUES ('$ngay_bat_dau', '$ngay_ket_thuc')";
    $new_sql1 = "SELECT *FROM kytinhtien WHERE ngay_bat_dau = '$ngay_bat_dau'";
    $kq = $conn1->query($new_sql1);
    if($kq->num_rows > 0) {
        while($row = $kq->fetch_assoc()) {
            $ma_ky = $row['ma_ky'];
        }
    }
    else {
        $conn1->query($new_sql);
        $ma_ky = $conn1->insert_id;
    }
    


    $cs_cu = $_POST['cs_cu'];
    $cs_moi = $_POST['cs_moi'];
    $ma_kh = $_POST['ma_kh'];
    
    $start_day= "2021-08-28";
    $finish_day = "2021-09-28";
    $ma_nv = $_SESSION['id'];
    $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
    $sql = "INSERT into chisonuoc (cs_cu, cs_moi, ma_ky, ma_nv, ma_kh) 
            VALUES ('$cs_cu', '$cs_moi', '$ma_ky', '$ma_nv', '$ma_kh')";
    //echo $sql;
    $conn->query($sql);
    $ma_csn = $conn->insert_id;
    $cs_nuoc = $cs_moi- $cs_cu;

    
    function thanhTien($ma_kh, $cs_nuoc, $ma_csn)
    {
        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
        $thanh_tien = 0;
        $new_cs_nuoc = 0;
        $thue = "10%";
        $phi_ntsh = 10000;
        $now = date("Y-m-d");
        $ma_nv = $_SESSION['id'];
        $sql1 = "SELECT ma_nhom_tieu_thu FROM khachhang WHERE ma_kh='$ma_kh'";
        $result = $conn->query($sql1);
        if($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $ma_nhom_tieu_thu = $row['ma_nhom_tieu_thu'];
            }
        }
        else echo "0 res";
        $new_sql = "SELECT * FROM bacgia WHERE ma_nhom_tieu_thu = '$ma_nhom_tieu_thu'";
        $new_result = $conn->query($new_sql);
        if ($new_result->num_rows > 0) {
            // output data of each row
            while($row = $new_result->fetch_assoc()) {
                if($cs_nuoc > $row['muc_tieu_thu_cuoi']) {
                    $thanh_tien = ($row['muc_tieu_thu_cuoi'] - $row['muc_tieu_thu_dau']) * $row['gia'];
                    $new_cs_nuoc = $cs_nuoc - ($row['muc_tieu_thu_cuoi'] - $row['muc_tieu_thu_dau']);
                }
                else {
                    if($new_cs_nuoc > 0 ) {
                        $thanh_tien = $new_cs_nuoc * $row['gia'];
                    }
                    else $thanh_tien = $cs_nuoc * $row['gia'];
                    
                }
            }
        }
        $vat = $thanh_tien*0.1;
        $thanh_tien = $thanh_tien + $thanh_tien*0.1 + $phi_ntsh;
        $sql2 = "INSERT into hoadon (ma_kh, ma_csn, luong_tieu_thu, thanh_tien, thue, phi_ntsh, ngay_tao, ma_nv, trang_thai)
                VALUES ('$ma_kh', '$ma_csn', '$cs_nuoc', '$thanh_tien', '$vat', '$phi_ntsh', '$now', '$ma_nv', 0)";
        $conn->query($sql2);
    }
    thanhTien($ma_kh, $cs_nuoc, $ma_csn);
    header('location:DanhSachKhachHang.php');
}

?>