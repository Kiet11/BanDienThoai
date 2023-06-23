<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/lienhe.php';?>

<?php include_once '../helpers/format.php';?>

<?php
	// $blog = new blog();
	// $fm = new Format();
	// if(isset($_GET['id'])){
    //     $id = $_GET['id']; 
	// 	$delBlog = $blog->delete_blog($id);
    // }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin KH liên hệ</h2>
        <div class="block">  
			
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên KH</th>
                    
					<th>Email</th>
					<th>SĐT</th>
                    <th>Nội dụng</th>
                    
				</tr>
			</thead>
			<tbody>
				<?php
                    $lh = new lienhe();
					$lienheList = $lh->show_lienhe();
					if($lienheList){
						$i = 0;
						while($result = $lienheList->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['hoten'] ?></td>
                    
					<td><?php echo $result['email_lienhe']; ?></td>
                    <td><?php echo $result['sodienthoai']; ?></td>
                    <td><?php echo $result['noidunglienhe']; ?></td>

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
