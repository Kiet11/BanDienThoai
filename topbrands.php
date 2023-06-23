<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

 <div class="main">
	 
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>IPHONE</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

			  <?php
			 		$getProduct_Macbook = $product->getProduct_Macbook();
					 if($getProduct_Macbook){
						while($result = $getProduct_Macbook->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 200px; height: 200px" alt="" /></a>
					 <h2><?php echo  $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['productPrice'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					 }
				?>

			</div>

			<div class="content_top">
    		<div class="heading">
    		<h3>XIAOMI</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

			  <?php
			 		$getProduct_Dell = $product->getProduct_Dell();
					 if($getProduct_Dell){
						while($result = $getProduct_Dell->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 200px; height: 200px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['productPrice'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					 }
				?>

			</div>

			<div class="content_top">
    		<div class="heading">
    		<h3>OPPO</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

			  <?php
			 		$getProduct_Asus = $product->getProduct_Asus();
					 if($getProduct_Asus){
						while($result = $getProduct_Asus->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 200px; height: 200px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'], 50) ?></p>
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
    		<h3>SAMSUNG</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

			<?php
			 		$product_Surface = $product->getProduct_Surface();
					if($product_Surface){
						while($result = $product_Surface->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php"><img width="200px" src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 200px; height: 200px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['productPrice'])." "."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Xem</a></span></div>
				</div>

				<?php
						}
					 }
				?>
				
			</div>
    </div>


<?php

include 'inc/footer.php';

?>
