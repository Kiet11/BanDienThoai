<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check==false){
        header('Location:login.php');
    }
    $cart = new cart();
    if(isset($_GET['confirmid'])){
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted_confirm = $cart->shifted_confirm($id, $price, $time);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 500px;">Đơn hàng bạn đã đặt</h2>

						<table class="tblone">
							<tr>
                                <th width="5">ID</th>
								<th width="15%">Tên SP</th>
								<th width="10%">H.ảnh</th>
								<th width="10%">S.lượng</th>
								<th width="10%">Giá</th>
                                <th width="15%">Ngày mua</th>
                                <th width="15%">Tình trạng</th>
								<th width="5%">Xóa</th>
							</tr>

							<?php
                                $customer_id = Session::get('customer_id');
								$get_cart_ordered = $cart->get_cart_ordered($customer_id);
								if($get_cart_ordered){
									
									while($result = $get_cart_ordered->fetch_assoc()){
							?>

							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['productPrice'])." "."VND" ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td><?php 
									$total = $result['productPrice'] * $result['quantity'];
									echo $fm->format_currency($total)." "."VND";
								?></td>

                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td><?php 
                                    if($result['status']=='0'){
                                        echo 'Chưa xử lý';
                                    }elseif($result['status']==1){
                                    ?>
									<span>đang vận chuyển</span>
                                    
                                    <?php
                                    }elseif($result['status']==2){
                                        echo 'Đã nhận hàng';
                                    }
                                ?></td>

                                <?php
                                    if($result['status']=='0'){
                                ?>
                                <td><?php echo 'N/A'; ?></td>
                                <?php
                                    }elseif($result['status']=='1'){
                                ?>
								<td><a href="?confirmid=<?php echo $customer_id?>&price=<?php echo $result['productPrice'] ?>
								    &time=<?php echo $result['date_order'] ?>">Chưa nhận</a></td>
								<?php 
									}else{
								?>
								<td><?php echo 'Đã nhận hàng'?></td>
                                <?php
                                }
                                ?>
							</tr>
							
							<?php
									
								}
							}
							?>
							
						</table>

					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 

 <?php

include 'inc/footer.php';

?>