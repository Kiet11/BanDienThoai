<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/post.php'?>
<?php
    $post = new post();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName']; 
        $catDesc = $_POST['catDesc']; 
        $catStatus = $_POST['catStatus']; 
		$insertCat = $post->insert_category_post($catName,$catDesc,$catStatus);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục tin tức</h2>
                <?php
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="postadd.php" method="POST" autocomplete="off">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Tên danh mục tin tức..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catDesc" placeholder="Mô tả danh mục tin tức..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus">
                                    <option value="0">Hiện</option>
                                    <option value="1">Ẩn</option>
                                </select>
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