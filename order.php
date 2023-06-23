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

<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    <div class="order_page">
                    <h2>Chào mừng bạn đã đến với website của chúng tôi!!!! <br>
					Mời bạn vào trang HOME và tham khảo các sản phẩm từ website của chúng tôi nhé!!!! 
				</h2>
                </div>						
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>


 <?php

include 'inc/footer.php';

?>