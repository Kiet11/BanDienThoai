<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../Model/brand.php'; ?>
<?php include '../Model/category.php'; ?>
<?php include '../Model/product.php'; ?>

<?php
$pro = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insertPro = $pro->insert_product($_POST, $_FILES);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($insertPro)) {      //thong bao
                echo $insertPro;
            }
            ?>
            <form action="productadd.php" method="post" enctype="multipart/form-data"> <!----ecttype de them hinh anh-->
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
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
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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
                                if ($brandlist) {
                                    while ($result = $brandlist->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                            <textarea name="productDesc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số lượng</label>
                        </td>
                        <td>
                            <input type="text" name="productSoluong" placeholder="Nhập số lượng" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Giá sản phẩm</label>
                        </td>

                        <td>
                            <input type="text" name="productPrice" placeholder="Nhập giá sản phẩm" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Ảnh sản phẩm</label>
                        </td>
                        <td>
                            <input type="file" name="productImage" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Loại sản phẩm</label>
                        </td>
                        <td>
                            <select id="select" name="productType">
                                <option>Chọn loại sản phẩm</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Thêm sản phẩm" />
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
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>