<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php
	if(isset($_GET['cartId'])){
		$cartId = $_GET['cartId']; 
		$delCart = $cart->delete_cart($cartId);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$update_quantity_cart = $cart->update_quantity_cart($cartId, $quantity);
	}
?>

<?php 
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content = '0;URL=?id=live'>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage" style="margin-top: 100px;">
			    	<h2>Giỏ hàng</h2>

					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>

					<?php
						if(isset($delCart)){
							echo $delCart;
						}
					?>

						<table class="tblone">
							<tr>
								<th width="20%">Tên SP</th>
								<th width="10%">H.ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">S.lượng</th>
								<th width="20%">Tổng tiền</th>
								<th width="10%">Xóa</th>
							</tr>

							<?php
								$get_product_cart = $cart->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									
									while($result = $get_product_cart->fetch_assoc()){
							?>

							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['productPrice'])." "."VND" ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>	
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Sửa"/>
									</form>
								</td>
								<td><?php 
									$total = $result['productPrice'] * $result['quantity'];
									echo $fm->format_currency($total)." "."VND";
								?></td>
								<td><a href="?cartId=<?php echo $result['cartId'] ?>">X</a></td>
							</tr>
							
							<?php
									$subtotal += $total;
								}
							}
							?>
							
						</table>

						<?php 
									  $check_cart = $cart->check_cart();
									  if($check_cart){
										
									?>

						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng tiền hàng : </th>
								<td><?php
									
									echo $fm->format_currency($subtotal)." "."VND";
									Session::set('sum', $subtotal);
									
								?></td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php 
									$vat = $subtotal * 0.1;
									$grandtotal = $subtotal + $vat;
									echo $fm->format_currency($grandtotal)." "."VND";
								?></td>
							</tr>
					   </table>

					<?php 
						}else{
							echo 'Giỏ hàng của bạn đang trống!!! Hãy mua sắm ngay bây giờ!!!!';
						}	
					?>

					</div>
					
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"><input type="submit" class="buysubmit" name="submit" value="Tiếp tục mua sắm"/></a>
						</div>
						<div class="shopright">
							<a href="payment.php"><input type="submit" class="buysubmit" name="submit" value="Thanh toán"/></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>


 <?php

include 'inc/footer.php';

?>