<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/product.php';?>

<?php
	$product = new product();
	if(isset($_GET['type_slider']) && isset($_GET['sliderType'])){
		$id = $_GET['type_slider'];
		$sliderType = $_GET['sliderType'];
		$update_type_slider = $product->update_type_slider($id, $sliderType);
	}

	if(isset($_GET['del_slider'])){
		$id = $_GET['del_slider'];
		$delete_slider = $product->delete_slider($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
			<?php
				if(isset($delete_slider)){
					echo $delete_slider;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tiêu đề Slider</th>
					<th>hình ảnh Slider</th>
					<th>Trạng thái</th>
					<th>Thay đổi</th>
				</tr>
			</thead>
			<tbody>


			<?php 
				$product = new product();
				$get_slider = $product->show_slider_list();
				if($get_slider){
					$i=0;
					while($result_slider = $get_slider->fetch_assoc()){
						$i++;
					?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result_slider['sliderName'] ?></td>
					<td><img src="uploads/<?php echo $result_slider['sliderImage']?>" height="100px" width="100px"/></td>
					<td>
						<?php
							if($result_slider['sliderType']==1){
						?>
						<a href="?type_slider=<?php echo $result_slider['sliderId']?>&sliderType=0" >Ẩn</a>
						<?php
							}else{
						?>
						<a href="?type_slider=<?php echo $result_slider['sliderId'] ?>&sliderType=1" >Hiện</a>
						<?php
							}
						?>
					</td>				
				<td>
					<a href="?del_slider=<?php echo $result_slider['sliderId'] ?>" >Xóa</a> 
				</td>
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
