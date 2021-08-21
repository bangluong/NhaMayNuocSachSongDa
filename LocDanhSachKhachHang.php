<?php
    $dc = $_GET['dc'];
    $sx = $_GET['sx'];
    $html="";
    $stt=0;
    if($sx == 2) {
        $conn = new mysqli('localhost', 'root', '', 'nhamaynuocsongda');
        $sql = "SELECT * FROM khachhang ORDER BY ho_ten DESC";
        $result=$conn->query($sql);
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
            $html='</tbody>
            </table>
            </div>';
        }
        else {
            $html = "không có kết quả";
        }
        
    }
?>