<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/post.php';?>
<?php include '../Model/blog.php';?>

<?php
    $blog = new blog();
    if(!isset($_GET['id']) || $_GET['id']==NULL){
        echo "<script> window.location = 'bloglist.php'</script>";
    }else{
        $id = $_GET['id']; 
    }
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

		$updateBlog = $blog->update_blog($_POST, $_FILES,$id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa tin tức</h2>
        <div class="block"> 
        <?php
                    if(isset($updateBlog)){      //thong bao
                        echo $updateBlog;
                    }
                ?>     
            <?php 
                $get_blog_by_id = $blog->getblogbyid($id);
                if($get_blog_by_id){
                    while($result_blog = $get_blog_by_id->fetch_assoc()){
                    ?>      
         <form action="" method="post" enctype="multipart/form-data">      <!----ecttype de them hinh anh-->
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên tin tức</label>
                    </td>
                    <td>
                        <input type="text" name="title_blog" value="<?php echo $result_blog['title_blog'] ?>" class="medium" />
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
                            <option
                            
                            <?php 

                                if($result['id_cat_post']==$result_blog['category_post']){ echo 'selected'; }

                            ?>

                            value="<?php echo $result['id_cat_post']?>"><?php echo $result['title_post']?></option>

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
                        <textarea name="description_blog" class="tinymce"><?php echo $result_blog['description_blog'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Nội dung tin tức</label>
                    </td>
                    <td>
                        <textarea name="content" class="tinymce"><?php echo $result_blog['content'] ?></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh tin tức</label>
                    </td>
                    <td>
                    <img src="uploads/<?php echo $result_blog['image'] ?>" width="100"><br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại tin tức</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Hiển thị tin tức</option>
                            <?php
                                if($result_blog['status']==0){
                            ?>
                            <option selected value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                            <?php
                                }else{
                            ?>
                            <option value="0">Hiện</option>
                            <option selected value="1">Ẩn</option>
                            <?php 
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Sửa tin tức" />
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


