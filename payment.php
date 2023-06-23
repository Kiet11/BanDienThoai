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
                    <h3>PAYMENT</h3>
                </div>
                <div class="clear"></div>
                <h3 style="text-align: center; font-size: 20px; font-weight: bold;">Chọn phương thức thanh toán</h3> 
                <a href="offlinepayment.php">Thanh toán trực tiếp</a> ||
                <a href="donhangthanhtoanonline.php">Thanh toán online</a>
            </div>
 		</div>
 	</div>

<?php

include 'inc/footer.php';

?>