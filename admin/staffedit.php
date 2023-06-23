<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/staff.php'?>
<?php
    $st = new staff();
    if(!isset($_GET['id_nhanvien']) || $_GET['id_nhanvien']==NULL){
        echo "<script> window.location = 'stafflist.php'</script>";
    }else{
        $id = $_GET['id_nhanvien']; 
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$ma_nhanvien = $_POST['ma_nhanvien'];   //Tạo biến để lấy ra dữ liệu
        $ten_nhanvien = $_POST['ten_nhanvien'];   //Tạo biến để lấy ra dữ liệu
        $chuc_vu = $_POST['chuc_vu'];   //Tạo biến để lấy ra dữ liệu
        $bo_phan = $_POST['bo_phan'];   //Tạo biến để lấy ra dữ liệu
        $luong_chinh = $_POST['luong_chinh'];   //Tạo biến để lấy ra dữ liệu
        $phu_cap = $_POST['phu_cap'];   //Tạo biến để lấy ra dữ liệu
        $tong_luong = $_POST['tong_luong']; 
        $ngay_nhanluong = $_POST['ngay_nhanluong'];
		$updateStaff = $st->update_staff($ma_nhanvien, $ten_nhanvien, $chuc_vu, $bo_phan, $luong_chinh, $phu_cap, $tong_luong, $ngay_nhanluong, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thông tin nhân viên</h2>
                <?php
                    if(isset($updateStaff)){
                        echo $updateStaff;
                    }
                ?>
                <?php
                    $get_staff_by_id = $st->getStaffById($id); 
                    if($get_staff_by_id){
                        while($result = $get_staff_by_id->fetch_assoc()){


                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                    <tr>
                            <td>
                                <input type="text" name="ma_nhanvien" placeholder="Thêm mã nhân viên..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="ten_nhanvien" placeholder="Thêm tên nhân viên..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="chuc_vu" placeholder="Thêm chức vụ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="bo_phan" placeholder="Thêm bộ phận..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="luong_chinh" placeholder="Thêm lương chính..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="phu_cap" placeholder="Thêm phụ cấp..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="tong_luong" placeholder="Thêm tổng lương..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="ngay_nhanluong" placeholder="Thêm ngày nhận lương..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa thông tin nhân viên" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>