<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/post.php'?>
<?php
    $post = new post();
    if(!isset($_GET['id_cat_post']) || $_GET['id_cat_post']==NULL){
        echo "<script> window.location = 'postlist.php'</script>";
    }else{
        $id = $_GET['id_cat_post']; 
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName']; 
        $catDesc = $_POST['catDesc']; 
        $catStatus = $_POST['catStatus']; 
		$updateCat = $post->update_category_post($catName,$catDesc,$catStatus,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục tin tức</h2>
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $get_cate_name = $post->getcatpostbyId($id); 
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){


                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['title_post']?>" name="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['description_post']?>" name="catDesc" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus">
                                    <?php
                                        if($result['status']=='0'){
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
                            <td>
                                <input type="submit" name="submit" Value="Sửa danh mục" />
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
<?php include 'inc/footer.php';?>