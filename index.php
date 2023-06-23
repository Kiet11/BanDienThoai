<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

 <div class="main">

    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>SẢN PHẨM NỔI BẬT</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

			  <?php
			 		$getProduct_feathered = $product->getProduct_feathered();
					 if($getProduct_feathered){
						while($result = $getProduct_feathered->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img style="width: 200px; height: 200px" src="admin/uploads/<?php echo $result['productImage'] ?>" alt="" /></a>
					 <h2><?php echo $fm->textShorten($result['productName'],30 )?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'], 30) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['productPrice'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					 }
				?>

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>SẢN PHẨM MỚI NHẤT</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

			<?php
			 		$product_new = $product->getProduct_new();
					if($product_new){
						while($result_new = $product_new->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php"><img style="width: 200px; height: 200px" src="admin/uploads/<?php echo $result_new['productImage'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_new['productDesc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_new['productPrice'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result_new['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					 }
				?>
				
			</div>

			<!-------------Phan trang--------->
			<div>
				<?php
					$product_all = $product->get_all_product();
					$product_count = mysqli_num_rows($product_all);
					$product_button = ceil($product_count/4);
					$i = 1;
					echo '<p>Trang: </p>';
					for($i=1;$i<=$product_button;$i++){
						echo '<a style="margin: 0 5px;" href="index.php?trang='.$i.'">'.$i.'</a>';
					}
				?>
			</div>

    </div>
 

<?php

include 'inc/footer.php';

?>
