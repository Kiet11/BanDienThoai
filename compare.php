<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 500px;">So sánh sản phẩm</h2>

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
								<th width="10%">ID</th>
								<th width="30%">Tên SP</th>
								<th width="30%">H.ảnh</th>
								<th width="20%">Giá</th>
                                <th width="10%">Xem</th>
							</tr>

							<?php
                                $customer_id = Session::get('customer_id');
								$get_compare = $product->get_compare($customer_id);
								if($get_compare){
									$i = 0;
									while($result = $get_compare->fetch_assoc()){
                                        $i++ ;
							?>

							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 120px; height: 120px" alt=""/></td>
								<td><?php echo $fm->format_currency($result['productPrice'])." "."VND" ?></td>
								<td><a href="details.php?proId=<?php echo $result['productId'] ?>">Xem</a></td>
							</tr>
							
							<?php
							
								}
							}
							?>
							
						</table>

					</div>
					<div class="shopping" >
						<div class="shopleft" >
							<a href="index.php" > <img src="images/shop.png"  alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>


 <?php

include 'inc/footer.php';

?>