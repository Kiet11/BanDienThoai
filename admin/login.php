<?php
	include '../Model/adminlogin.php';  //Gọi các hàm xử lý trong file classes-adminlogin.php 
?>

<?php
	$class = new adminlogin();  //Gọi class trong file adminlogin
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {  //Sử dụng phương thức gởi dữ liệu
		$adminUser = $_POST['adminUser']; //Tạo biến để lấy ra dữ liệu
		$adminPass = md5($_POST['adminPass']); 

		$login_check = $class->login_admin($adminUser,$adminPass);  //Kiểm tra dữ liệu vừa mới lấy được
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="POST">
			<h1>Đăng nhập Admin</h1>
			<span><?php
				if(isset($login_check)){    //Hiển thị thông báo
					echo $login_check;
				}
			?></span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Đồ án tốt nghiệp</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>