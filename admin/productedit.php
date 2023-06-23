<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/brand.php';?>
<?php include '../Model/category.php';?>
<?php include '../Model/product.php';?>

<?php
    $pro = new product();
    if(!isset($_GET['productId']) || $_GET['productId']==NULL){
        echo "<script> window.location = 'productlist.php'</script>";
    }else{
        $id = $_GET['productId']; 
    }
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

		$updatePro = $pro->update_product($_POST, $_FILES,$id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block"> 
        <?php
                    if(isset($updatePro)){      //thong bao
                        echo $updatePro;
                    }
                ?>     
            <?php 
                $get_product_by_id = $pro->getproductbyid($id);
                if($get_product_by_id){
                    while($result_product = $get_product_by_id->fetch_assoc()){
                    ?>      
         <form action="" method="post" enctype="multipart/form-data">      <!----ecttype de them hinh anh-->
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Chọn danh mục</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();

                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>
                            <option
                            
                            <?php 

                                if($result['catId']==$result_product['catId']){ echo 'selected'; }

                            ?>

                            value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>

                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Chọn thương hiệu</option>
                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                            ?>
                            <option 
                            <?php 

                                    if($result['brandId']==$result_product['brandId']){ echo 'selected'; }
                                
                                ?>

                            value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
                            <?php
                            }
                        }
                        ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả sản phẩm</label>
                    </td>
                    <td>
                        <textarea name="productDesc" class="tinymce"><?php echo $result_product['productDesc'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="text" name="productSoluong" value="<?php echo $result_product['productSoluong'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productPrice" value="<?php echo $result_product['productPrice'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh sản phẩm</label>
                    </td>
                    <td>
                    <img src="uploads/<?php echo $result_product['productImage'] ?>" width="100"><br>
                        <input type="file" name="productImage"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="productType">
                            <option>Chọn loại sản phẩm</option>
                            <?php
                                if($result_product['productType']==0){
                            ?>
                            <option  value="1">Nổi bật</option>
                            <option selected value="0">Không nổi bật</option>
                            <?php
                                }else{
                            ?>
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                            <?php 
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Sửa sản phẩm" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


