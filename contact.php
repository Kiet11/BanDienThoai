<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

<?php
	if(isset($_POST['lienhe'])){
		$lienhe = $lh->insert_lienhe();
	}
?>

 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Trang liên hệ</h3>
  				<p>Hãy để lại những góp ý về website của chúng tôi hoặc nếu bạn cần liên hệ với chúng tôi hãy để lại thông tin bên dưới.<br>
				Chúng tôi sẽ cố gắn gởi phản hồi đến bạn nhanh nhất. Xin chân thành cảm ơn!!!!! </p>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Thông tin của bạn</h2>

					  <?php
							if(isset($lienhe)){
								echo $lienhe;
							}
						?>

					    <form action="" method="POST">
						
					    	<div>
						    	<span><label>Họ và tên</label></span>
						    	<span><input type="text" name="hoten" placeholder="Nhập họ và tên của bạn..."></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" name="email_lienhe" placeholder="Nhập địa chỉ E-mail..."></span>
						    </div>
						    <div>
						     	<span><label>Số điện thoại</label></span>
						    	<span><input type="text" name="sodienthoai" placeholder="Nhập số điện thoại..."></span>
						    </div>
						    <div>
						    	<span><label>Nội dung</label></span>
						    	<span><textarea name="noidunglienhe" placeholder="Nhập nội dung..."> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" name="lienhe" value="Gửi"></span>
						  </div>
					    </form>
				  </div>
  				</div>
			  </div>    	
    </div>


   
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

<?php

include 'inc/footer.php';

?>

