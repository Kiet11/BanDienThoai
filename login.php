<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php 
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:index.php');
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

		$insertCustomer = $cus->insert_customer($_POST);
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

		$loginCustomer = $cus->login_customer($_POST);
	}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel" style="margin: 50px 270px 20px 20px;">
        	<h3>ĐĂNG NHẬP</h3>
        	<p>Đăng nhập theo biểu mẫu bên dưới</p>

			<?php
				if(isset($loginCustomer)){
					echo $loginCustomer;
				}
			?>

        	<form action="" method="POST">
                	<input type="text" name="email" class="field" placeholder="Nhập e-mail...">
                    <input type="password" name="password" class="field" placeholder="Nhập password...">
               
                    <div class="buttons"><input type="submit" class="grey" name="login" value="ĐĂNG NHẬP" style="font-size: 20px; background: #fff;"></div></div>
                    </div>
				</form>
				<?php 

				
				?>

    	<div class="register_account" style="margin: 20px 20px;">
    		<h3>Đăng ký tài khoản mới</h3>
			<?php
				if(isset($insertCustomer)){
					echo $insertCustomer;
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên của bạn" >
							</div>
							
							<div>
							   <input type="text" name="address" placeholder="Nhập địa chỉ nơi bạn đang ở" >
							</div>

							<div>
								<input type="text" name="city" placeholder="Nhập thành phố">
							</div>
		    			 </td>

		    			<td>
						<div>
							<input type="text" name="phone" placeholder="Nhập số điện thoại của bạn">
						</div>	        
	
		           <div>
		          <input type="text" name="email" placeholder="Nhập E-Mail của bạn">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Nhập mật khẩu">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" class="grey" name="submit" value="Đăng ký" style="font-size: 20px; background: #fff;"></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
  
 

 <?php

include 'inc/footer.php';

?>