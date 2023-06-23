<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/product.php';?>

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
        <h2>Danh sách bình luận</h2>
        <div class="block">  
			
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên Người BL</th>
					<th>Nội dung bình luận</th>
					<th>ID SP</th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $product = new product();
					$commentList = $product->show_comment();
					if($commentList){
						$i = 0;
						while($result = $commentList->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['commentName'] ?></td>
					<td><?php echo $result['commentDesc']; ?></td>
                    <td><?php echo $result['productId']; ?></td>

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
