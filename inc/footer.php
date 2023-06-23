

</div>
   <div class="footer">
   	  <div class="wrapper">	

		 <?php
		 			$cont = new contact();
					$contact_foo = $cont->show_contact();
					if($contact_foo){
						while($result = $contact_foo->fetch_assoc()){
			?>
	     <div class="section group">
				<div class="col_1_of_3 span_1_of_3">
						<h4>Địa chỉ</h4>
						<ul>
						<p><?php echo $result['tenTruong'] ?></p>
						<p><?php echo $result['tenKhoa'] ?></p>
						</ul>
					</div>
				<div class="col_1_of_3 span_1_of_3">
					<h4>Quê quán</h4>
						<ul>
						<p><?php echo $result['gvhd'] ?></p>
						
						</ul>
				</div>
				<div class="col_1_of_3 span_1_of_3">
					<h4>Số điện thoại</h4>
						<ul>
						<p><?php echo $result['lop'] ?></p>
						<p><?php echo $result['ttsv'] ?></p>

						</ul>
				</div>
			</div>

			<?php
			}
		}
		?>
			<div class="copy_right">
				<p>Đồ án tốt nghiệp, đề tài website bán điện thoại </p>
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
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
