<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/blog.php';?>
<?php include '../Model/post.php';?>
<?php include_once '../helpers/format.php';?>

<?php
	$blog = new blog();
	$fm = new Format();
	if(isset($_GET['id'])){
        $id = $_GET['id']; 
		$delBlog = $blog->delete_blog($id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách tin tức</h2>
        <div class="block">  
			<?php 
				if(isset($delPro)){
					echo $delPro;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên T.tức</th>
					<th>D.Mục</th>
					<th>M.tả</th>
                    <th>N.dung</th>
					<th>H.ảnh</th>
					<th>Loại TT</th>
					<th>Thay đổi</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$blogList = $blog->show_blog();
					if($blogList){
						$i = 0;
						while($result = $blogList->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['title_blog'] ?></td>
					<td><?php echo $result['category_post'] ?></td>
					<td><?php 
					echo $fm->textShorten($result['description_blog'], 30);
					 ?></td>
                     <td><?php 
					echo $fm->textShorten($result['content'], 50);
					 ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
					
					<td><?php 
						if($result['status']==0){
							echo 'Hiện';
						}else{
							echo 'Ẩn';
						}
					?></td>
					<td><a href="blogedit.php?id=<?php echo $result['id'] ?><">Sửa</a> || 
					<a href="?id=<?php echo $result['id'] ?>">Xóa</a></td>
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
