<?php
    include 'lib/session.php';
    Session::init();      
?>

<?php 
	include_once 'lib/database.php';
    include_once 'helpers/format.php';

	spl_autoload_register(function($className){
		include_once "Model/".$className.".php";
	});
	$db = new Database();
	$fm = new Format();
	$cart = new cart();
	$us = new user();
	$cat = new category();
	$product = new product();
	$cus = new customer();
	$pos = new post();
	$cont = new contact();
	$lh = new lienhe();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>


<!DOCTYPE HTML>
<head>
<title>Website Bán Điện Thoại</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="https://iweb.tatthanh.com.vn/pic/3/blog/images/image(1943).png" style="width: 150px; height:100px;" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
  						<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
						<input type="submit" value="Tìm kiếm">
						<input type="hidden" name="action" value="search_product">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
  									<?php 
									  $check_cart = $cart->check_cart();
									  if($check_cart){
										$sum = Session::get("sum");
										echo $fm->format_currency($sum).'Đ';
										}else{
											echo 'Trống';
										}	
									?>
								</span>
							</a>
						</div>
			      </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange" >
	  <li><a href="index.php">Trang chủ</a></li>
	  <li><a href="topbrands.php">Thương hiệu</a> </li>
		  
		<li class="dropdown">
			<a href="#">Tin tức</a>
			<ul style="margin-top: 20px;">
			<?php
				$post = $pos->show_category_post();
				if($post){
					while($result_new = $post->fetch_assoc()){
			?>
			<li>
				<a href="news.php?idPost=<?php echo $result_new['id_cat_post'] ?>"><?php echo $result_new['title_post']?></a>
			</li>
			<?php
			}
		}
		?>
			</ul>
		</li>

		<li><a href="contact.php">Liên hệ</a></li>

	  <li><a href="cart.php">Giỏ hàng</a></li>
	  <?php
	 	if(isset($_GET['customer_id'])){
			$customer_id = $_GET['customer_id'];
			$delCart = $cart->del_all_data_cart();
			$delCompare = $cart->del_compare($customer_id);
			 Session::destroy();
		 }
	  ?>
	  <li> 
		<?php 
			$login_check = Session::get('customer_login');
			if($login_check == false){
				echo '<a href="login.php">Đăng nhập</a>';
			}else{
				echo '<a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a>';
			}
		?>  

		<?php
			$login_check = Session::get('customer_login');
			if($login_check == false){
				echo '';
			}else{
				echo '<li><a href="profile.php">Thông tin Khách hàng</a></li>';
			}
		?>
		<?php 
		$customer_id = Session::get('customer_id');
		$check_order = $cart->check_order($customer_id);
		if($check_order==true){
			echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
		}else{
			echo '';
		}	
		?>

		<?php 
			$login_check = Session::get('customer_login');
			if($login_check){
				echo '<li><a href="compare.php">So sánh sản phẩm</a> </li>';
			}
		?> 

<?php 
			$login_check = Session::get('customer_login');
			if($login_check){
				echo '<li><a href="wishlist.php">Sản phẩm yêu thích</a> </li>';
			}
		?> 

	  	<div class="clear"></div>
	</ul>
</div>