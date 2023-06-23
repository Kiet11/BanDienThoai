<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/post.php'?>
<?php
	$post = new post();
	if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
		$delCat = $post->delete_category_post($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục tin tức</h2>
                <div class="block"> 
				<?php
                    if(isset($delCat)){
                        echo $delCat;
                    }
                ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Thứ tự danh mục</th>
							<th>Tên danh mục</th>
                            <th>Mô tả danh mục</th>
                            <th>Trạng thái</th>
							<th>Thay đổi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_cate = $post->show_category_post();
							if($show_cate){
								$i = 0;
								while($result = $show_cate->fetch_assoc()){
								$i ++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['title_post']?></td>
                            <td><?php echo $result['description_post']?></td>
                            <td><?php echo $result['status']?></td>
							<td><a href="postedit.php?id_cat_post=<?php echo $result['id_cat_post']?>">Sửa</a> || <a href="?delid=<?php echo $result['id_cat_post']?>">Xóa</a></td>
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

