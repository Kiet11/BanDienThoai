<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/category.php'?>
<?php
    $cat = new category();   //Gọi class trong file category   
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //Sử dụng phương thức gởi dữ liệu
		$catName = $_POST['catName'];   //Tạo biến để lấy ra dữ liệu
		$insertCat = $cat->insert_category($catName);   //Thêm dữ liệu vừa mới lấy được
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
                <?php
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Thêm danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm danh mục" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>