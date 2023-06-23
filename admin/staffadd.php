<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/staff.php'?>
<?php
    $st = new staff();   //Gọi class trong file category   
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //Sử dụng phương thức gởi dữ liệu
		$ma_nhanvien = $_POST['ma_nhanvien'];   //Tạo biến để lấy ra dữ liệu
        $ten_nhanvien = $_POST['ten_nhanvien'];   //Tạo biến để lấy ra dữ liệu
        $chuc_vu = $_POST['chuc_vu'];   //Tạo biến để lấy ra dữ liệu
        $bo_phan = $_POST['bo_phan'];   //Tạo biến để lấy ra dữ liệu
        $luong_chinh = $_POST['luong_chinh'];   //Tạo biến để lấy ra dữ liệu
        $phu_cap = $_POST['phu_cap'];   //Tạo biến để lấy ra dữ liệu
        $tong_luong = $_POST['tong_luong']; 
        $ngay_nhanluong = $_POST['ngay_nhanluong'];  //Tạo biến để lấy ra dữ liệu
		$insertStaff = $st->insert_staff($ma_nhanvien, $ten_nhanvien, $chuc_vu, $bo_phan, $luong_chinh, $phu_cap, $tong_luong, $ngay_nhanluong);   //Thêm dữ liệu vừa mới lấy được
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thông tin nhân viên</h2>
                <?php
                    if(isset($insertStaff)){
                        echo $insertStaff;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="staffadd.php" method="POST">
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
                                <input type="submit" name="submit" Value="Thêm thông tin nhân viên" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>