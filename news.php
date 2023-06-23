<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

<?php
	if(!isset($_GET['idPost']) || $_GET['idPost']==NULL){
        echo "<script> window.location = '404.php'</script>";
    }else{
        $id = $_GET['idPost']; 
    }

    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 	$brandName = $_POST['brandName']; 
	// 	$updateBrand = $brand->update_brand($brandName,$id);
    // }
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">

			<?php
					$name_cat = $pos->get_cat_post_byId($id);
					if($name_cat){
						while($result_name = $name_cat->fetch_assoc()){
			?>

    		<div class="heading">
    		<h3>DANH MỤC: <?php echo $result_name['title_post'] ?></h3>
    		</div>

			<?php 
						}
					}
			?>

    		<div class="clear"></div>
    	</div>
	      <div class="section group">

				<?php
					$postByCat = $pos->get_post_by_cat($id);
					if($postByCat){
						while($result = $postByCat->fetch_assoc()){
				?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details_blog.php?blogId=<?php echo $result['id'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" style="width: 200px height: 200px;" alt="" /></a>
					 <h2><?php echo $fm->textShorten($result['title_blog'],50 )?> </h2>
					 <p><?php echo $fm->textShorten($result['description_blog'],30) ?></p>
				     <div class="button"><span><a href="details_news.php?blogId=<?php echo $result['id'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					}else{
						echo 'Tin tức hiện tại đang trống hoặc đã bị xóa!!!! Bạn vui lòng xem tin tức khác';
					}
				?>

			</div>

	
	
    </div>
 <?php

include 'inc/footer.php';

?>