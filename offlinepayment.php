<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php

    if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $cart->insertOrder($customer_id);
        $delCart = $cart->del_all_data_cart();
        header('Location:success.php');
    }
?>


<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">

            <div class="content_top">
                <div class="heading">
                    <h3>Thanh toán trực tiếp</h3>
                </div>
            <div class="clear"></div>	
 		</div>
         <div class="payment" style="margin-top: 20px; width: 1950px">
            <div class="box_left" style="border: 1px solid #666; padding: 6px">
            <div class="cartpage">
			    	<h3 style="margin-bottom: 10px;">Giỏ hàng</h3>

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

						<table class="tblone" >
							<tr>
                                <th width="5%">ID</th>
								<th width="15%">Tên SP</th>
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
                                    $i = 0;
									
									while($result = $get_product_cart->fetch_assoc()){
                                        $i++;
							?>

							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['productPrice'])." "."VND" ?></td>
								<td>
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>"/>
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
								<td>10% (<?php echo $fm->format_currency($vat = $subtotal * 0.1).' '.'VND'; ?>)</td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php 
									$vat = $subtotal * 0.1;
									$grandtotal = $subtotal + $vat;
									echo $fm->format_currency($grandtotal).' '.'VND';
								?></td>
							</tr>
					   </table>

					<?php 
						}else{
							echo 'Giỏ hàng của bạn đang trống!!! Hãy mua sắm ngay bây giờ!!!!';
						}	
					?>
            </div>
            <div class="box_right" style="border: 1px solid #666; padding: 6px; margin-top: 20px;">
            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                    $get_customer = $cus->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                ?>
                <tr>
                    <td>Tên</td>
                    <td></td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td></td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td>Tỉnh/Thành phố</td>
                    <td></td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
               
                <tr>
                    <td>Số ĐT</td>
                    <td></td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td></td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Sửa thông tin</a></td>
                </tr>

                <?php
                        }
                    }
                ?>

            </table>
            </div>
			<a href="?orderId=order"><p style=" border: none; font-size: 25px; color: red; margin: 30px 350px;">ĐẶT HÀNG</p></a>

        </div>

 	</div>
     
	 

</form>

<?php

include 'inc/footer.php';

?>