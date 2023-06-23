<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
	$filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../Model/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$cart = new cart();
	if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $cart->shifted($id, $price, $time);
	}

	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$del_shifted = $cart->del_shifted($id, $price, $time);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn hàng</h2>
                <div class="block">
					<?php
						if(isset($shifted)){
							echo $shifted;
						}
					?>  
					
					<?php
						if(isset($del_shifted)){
							echo $del_shifted;
						}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="15%">Thời gian đặt</th>
							<th width="20%">Sản phẩm</th>
							<th width="10%">S.lượng</th>
							<th width="10%">Giá</th>
							<th width="10%">ID KH</th>
							<th width="20%">Địa chỉ</th>
							<th width="10%">Thay đổi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$cart = new cart();
							$fm = new Format();
							$get_inbox_cart = $cart->get_inbox_cart();
								if($get_inbox_cart){
									$i = 0;
									while($result = $get_inbox_cart->fetch_assoc()){
										$i++ ;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order'])?></td>
							<th><?php echo $result['productName'] ?></th>
							<th><?php echo $result['quantity'] ?></th>
							<th><?php echo $result['productPrice']  ?></th>
							<th><?php echo $result['customer_id']  ?></th>
							<th><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem Khách hàng</a></th>
							<td>
								<?php
									if($result['status']==0){
								?>
								<a href="?shiftid=<?php echo $result['orderId']?>&price=<?php echo $result['productPrice'] ?>
								&time=<?php echo $result['date_order'] ?>">Chưa xử lý</a>
								<?php
									}elseif($result['status']==1){		
								?>
								<?php
									echo 'Chưa nhận';
								?>
								<?php
									}elseif($result['status']==2){
								?>
								<a href="?delid=<?php echo $result['orderId']?>&price=<?php echo $result['productPrice'] ?>
								&time=<?php echo $result['date_order'] ?>">Xóa</a></td>
								<?php
									}
								
								?>
					
						</tr>
						<?php
									}
								}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
