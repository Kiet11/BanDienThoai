<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>


<?php 
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
?> 

 <?php
	// $proId = new product();
    // if(!isset($_GET['proId']) || $_GET['proId']==NULL){
    //     echo "<script> window.location = '404.php'</script>";
    // }else{
    //     $id = $_GET['proId']; 
    // }
	// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	// 	$quantity = $_POST['quantity'];
	// 	$AddtoCart = $cart->add_to_cart($id, $quantity);
	// }
?> 

 <div class="main">
    <div class="content">
    	<div class="section group">

			<div class="content_top">
                <div class="heading">
                    <h3>Thông tin khách hàng</h3>
                </div>
                <div class="clear"></div>
            </div>
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
 	</div>

<?php

include 'inc/footer.php';

?>