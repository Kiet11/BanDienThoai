<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

<?php
    if(isset($_GET['tukhoa'])){
        $tukhoa = $_GET['tukhoa'];
        $data_Search = $product->search_product($tukhoa);
    }
?>
 <div class="main">

    <div class="content">
	      <div class="section group">

			  <?php
			 		$data_Search = $product->search_product($tukhoa);
					 if($data_Search){
						while($result = $data_Search->fetch_assoc()){
			  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img style="width: 200px; height: 200px" src="admin/uploads/<?php echo $result['productImage'] ?>" alt="" /></a>
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
 </div>

<?php

include 'inc/footer.php';

?>
