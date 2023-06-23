<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastestDell = $product->getLastestDell();
					if($getLastestDell){
						while($resultDell = $getLastestDell->fetch_assoc()){					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $resultDell['productId'] ?>"> <img src="admin/uploads/<?php echo $resultDell['productImage'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>XIAOMI</h2>
						<p><?php echo $resultDell['productName'] ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultDell['productId'] ?>">Đặt hàng</a></span></div>
				   </div>
			   </div>	
			   
			   <?php
					}
				}
			   ?>

				<?php
					$getLastestMacBook = $product->getLastestMacBook();
					if($getLastestMacBook){
						while($resultMacBook = $getLastestMacBook->fetch_assoc()){					
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proId=<?php echo $resultMacBook['productId'] ?>"><img src="admin/uploads/<?php echo $resultMacBook['productImage'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>IPHONE</h2>
						  <p><?php echo $resultMacBook['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proId=<?php echo $resultMacBook['productId'] ?>">Đặt hàng</a></span></div>
					</div>
				</div>

				<?php
					}
				}
			   ?>

			</div>
			<div class="section group">

			<?php
					$getLastestAsus = $product->getLastestAsus();
					if($getLastestAsus){
						while($resultAsus = $getLastestAsus->fetch_assoc()){					
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $resultAsus['productId'] ?>"> <img src="admin/uploads/<?php echo $resultAsus['productImage'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>OPPO</h2>
						<p><?php echo $resultAsus['productName'] ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultAsus['productId'] ?>">Đặt hàng</a></span></div>
				   </div>
			   </div>	
			   
			   <?php
					}
				}
			   ?>
			   
			   <?php
					$getLastestSurface = $product->getLastestSurface();
					if($getLastestSurface){
						while($resultSurface = $getLastestSurface->fetch_assoc()){					
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proId=<?php echo $resultSurface['productId'] ?>"><img src="admin/uploads/<?php echo $resultSurface['productImage'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>SAMSUNG</h2>
						  <p><?php echo $resultSurface['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proId=<?php echo $resultSurface['productId'] ?>">Đặt hàng</a></span></div>
					</div>
				</div>
				<?php
					}
				}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
					<?php 
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result_slider = $get_slider->fetch_assoc()){
						
					?>

						<li><img src="admin/uploads/<?php echo $result_slider['sliderImage'] ?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
					<?php
							}
						}
					?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>