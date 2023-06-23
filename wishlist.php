<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php
    if(isset($_GET['proid'])){
        $customer_id = Session::get('customer_id');
        $proid = $_GET['proid'];
        $delwlist = $product->del_wlist($customer_id,$proid);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 500px;">Sản phẩm yêu thích</h2>

						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="30%">Tên SP</th>
								<th width="30%">H.ảnh</th>
								<th width="20%">Giá</th>
                                <th width="15%">Xem</th>
							</tr>

							<?php
                                $customer_id = Session::get('customer_id');
								$get_wishlist = $product->get_wishlist($customer_id);
								if($get_wishlist){
									$i = 0;
									while($result = $get_wishlist->fetch_assoc()){
                                        $i++ ;
							?>

							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage'] ?>" style="width: 120px; height: 120px" alt=""/></td>
								<td><?php echo $fm->format_currency($result['productPrice'])." "."VND" ?></td>
								<td>
                                    <a href="?proid=<?php echo $result['productId'] ?>">Xóa</a> || 
                                    <a href="details.php?proId=<?php echo $result['productId'] ?>">Đặt hàng ngay</a>
                                </td>
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