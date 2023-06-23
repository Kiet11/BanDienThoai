<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/brand.php'?>
<?php
    $brand = new brand();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandName = $_POST['brandName']; 
		$insertBrand = $brand->insert_brand($brandName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thương hiệu</h2>
                <?php
                    if(isset($insertBrand)){
                        echo $insertBrand;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="brandadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Thêm danh mục thương hiệu..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm thương hiệu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>