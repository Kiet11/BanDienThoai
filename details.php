<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php
	// $proId = new product();
    if(!isset($_GET['proId']) || $_GET['proId']==NULL){
        echo "<script> window.location = '404.php'</script>";
    }else{
        $id = $_GET['proId']; 
    }
	$customer_id = Session::get('customer_id');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
		$productid = $_POST['productid'];
		$insertCompare = $product->insertCompare($productid, $customer_id);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
		$productid = $_POST['productid'];
		$insertWishlist = $product->insertWishlist($productid, $customer_id);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];

		$insertCart = $cart->add_to_cart($id, $quantity);
	}
	if(isset($_POST['binhluan_submit'])){
		$comment = $cus->insert_comment();
	}
?>



 <div class="main">
    <div class="content">
    	<div class="section group">

			<?php 
				$getProduct_details = $product->get_details($id);
				if($getProduct_details){
					while($result_details = $getProduct_details->fetch_assoc()){
			?>

				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['productImage'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?></h2>					
					<div class="price">
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
						<p>Price: <span><?php echo $fm->format_currency($result_details['productPrice'])." "."VND" ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="POST">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Đặt hàng ngay"/>
						<?php
							if(isset($insertCart)){
								echo $insertCart;
							}
						?>
					</form>	
					<?php 
					if(isset($AddtoCart)){
						echo '<span style="color:red; font-size:18px">Sản phẩm đã tồn tại trong giỏ hàng của bạn!!!</span>';
					}
				?>			
				</div>
				<div class="add-cart">
				<form action="" method="POST">
					<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
					<?php 
						$login_check = Session::get('customer_login');
						if($login_check){
							echo '<input type="submit" class="buysubmit" name="compare" value="So sánh sản phẩm"/>'.' ';
						}else{
							echo '';
						}
					?> 

					<?php
						if(isset($insertCompare)){
							echo $insertCompare;
						}
					?>
					</form>
					
					<form style="margin-top: 10px;" action="" method="POST">
					<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
					<?php 
						$login_check = Session::get('customer_login');
						if($login_check){
							echo '<input type="submit" class="buysubmit" name="wishlist" value="Sản phẩm yêu thích"/>';
						}else{
							echo '';
						}
					?> 

					<?php
						if(isset($insertWishlist)){
							echo $insertWishlist;
						}
					?>
					</form>
				</div>
			</div>
			<div class="product-desc">
			<h2>Chi tiết sản phẩm</h2>
			<p><?php echo $result_details['productDesc'] ?></p>
	    </div>
				
	</div>

			<?php
					}
				}
			?>

				<div class="rightsidebar span_3_of_1">
					<h2>Danh mục sản phẩm</h2>
					<ul>
						<?php 
							$getAll_category = $cat->show_category_frontend();
							if($getAll_category){
								while($result_allCat = $getAll_category->fetch_assoc()){
						?>
						
						<li><a href="productbycat.php?catId=<?php echo $result_allCat['catId'] ?>"><?php echo $result_allCat['catName'] ?></a></li>
						
						<?php
								}
							}
						?>
    				</ul>			
 				</div>
 		</div>
 	</div>
	<div class="comment">
		<div class="row">
			<div class="col-md-8">
			<h5>Hãy đánh giá về sản phẩm của chúng tôi</h5>
			<?php
				if(isset($comment)){
					echo $comment;
				}
			?>
				<form action="" method="POST">
					<input type="hidden" value="<?php echo $id ?>" name="proId_comment">
					<p><input  type="text" placeholder="Tên khách hàng..." class="form-control" name="commentName" style="width: 500px; height: 50px; margin-top: 20px"></p><br>
					<p><textarea rows="5" placeholder="Bình luận..." class="form-control" name="binhluan" style="margin-bottom: 10px; resize:none; width:500px"></textarea></p>
					<input type="submit" name="binhluan_submit" class="btn btn-success" value="Gửi bình luận" style="margin-bottom: 30px; padding: 10px 10px">
				</form>
			</div>
		</div>
	</div>

<?php

include 'inc/footer.php';

?>