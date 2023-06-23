<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

<?php
	if(!isset($_GET['catId']) || $_GET['catId']==NULL){
        echo "<script> window.location = '404.php'</script>";
    }else{
        $id = $_GET['catId']; 
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
					$name_cat = $cat->get_name_cart($id);
					if($name_cat){
						while($result_name = $name_cat->fetch_assoc()){
			?>

    		<div class="heading">
    		<h3>DANH MỤC: <?php echo $result_name['catName'] ?></h3>
    		</div>

			<?php 
						}
					}
			?>

    		<div class="clear"></div>
    	</div>
	      <div class="section group">

				<?php
					$productByCat = $cat->get_product_by_cart($id);
					if($productByCat){
						while($result = $productByCat->fetch_assoc()){
				?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="admin/uploads/<?php echo $result['productImage'] ?>" width="200px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result['productDesc'],30) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['productPrice']).' '.'VND' ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					}else{
						echo 'Danh mục này không tồn tại hoặc chưa có sản phẩm, bạn có thể tìm sản phẩm ở các danh mục còn lại!!!!!';
					}
				?>

			</div>

	
	
    </div>
 </div>
 <?php

include 'inc/footer.php';

?>