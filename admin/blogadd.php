<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/post.php';?>
<?php include '../Model/blog.php';?>

<?php
    $blog = new blog();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

		$insertBlog = $blog->insert_blog($_POST, $_FILES);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm tin tức</h2>
        <div class="block"> 
        <?php
                    if(isset($insertBlog)){      //thong bao
                        echo $insertBlog;
                    }
                ?>               
         <form action="blogadd.php" method="post" enctype="multipart/form-data">      <!----ecttype de them hinh anh-->
            <table class="form">
               
                <tr>
                    <td>
                        <label >Tên tin tức</label>
                    </td>
                    <td>
                        <input type="text" name="title_blog" placeholder="Nhập tên tin tức..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục tin tức</label>
                    </td>
                    <td>
                        <select id="select" name="category_post">
                            <option>Chọn danh mục</option>
                            <?php
                                $post = new post();
                                $postList = $post->show_category_post();
                                if($postList){
                                    while($result = $postList->fetch_assoc()){
                            ?>
                            <option value="<?php echo $result['id_cat_post']?>"><?php echo $result['title_post']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả tin tức</label>
                    </td>
                    <td>
                        <textarea name="description_blog" placeholder="Nhập mô tả tin tức" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Nội dung</label>
                    </td>
                    <td>
                        <textarea type="text" name="content" placeholder="Nhập nội dung tin tức" class="tinymce"></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh tin tức</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại tin tức</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Chọn hiển thị</option>
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm tin tức" />
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


