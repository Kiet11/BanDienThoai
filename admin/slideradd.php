<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/product.php';?>

<?php
    $product = new product();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

		$insertSlider = $product->insert_slider($_POST, $_FILES);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Slider mới</h2>
    <div class="block"> 
        <?php
            if(isset($insertSlider)){
                echo $insertSlider;
            }
        ?>              
         <form action="slideradd.php" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tiêu đề</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" placeholder="Nhập tên tiêu đề..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Thêm hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="sliderImage"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                    <td>
                        <select name="sliderType">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm slider" />
                    </td>
                </tr>
            </table>
            </form>
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