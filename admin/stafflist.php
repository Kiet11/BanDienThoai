<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/staff.php'?>
<?php
	$st = new staff();
	if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
		$delStaff = $st->delete_staff($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách nhân viên</h2>
                <div class="block"> 
				<?php
                    if(isset($delStaff)){
                        echo $delStaff;
                    }
                ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT NV</th>
                            <th>Mã NV</th>
                            <th>Tên NV</th>
							<th>Chức vụ</th>
                            <th>Bộ phận</th>
                            <th>Lương chính</th>
                            <th>Phụ cấp</th>
                            <th>Tổng lương</th>
                            <th>Ngày nhận</th>
							<th>Thay đổi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_staff = $st->show_staff();
							if($show_staff){
								$i = 0;
								while($result = $show_staff->fetch_assoc()){
								$i ++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['ma_nhanvien']?></td>
                            <td><?php echo $result['ten_nhanvien']?></td>
                            <td><?php echo $result['chuc_vu']?></td>
                            <td><?php echo $result['bo_phan']?></td>
                            <td><?php echo $result['luong_chinh']?></td>
                            <td><?php echo $result['phu_cap']?></td>
                            <td><?php echo $result['tong_luong']?></td>
                            <td><?php echo $result['ngay_nhanluong']?></td>
							<td><a href="staffedit.php?id_nhanvien=<?php echo $result['id_nhanvien']?>">Sửa</a> || <a href="?delid=<?php echo $result['id_nhanvien']?>">Xóa</a></td>
						</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

