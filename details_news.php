<?php

include 'inc/header.php';
include 'inc/slider.php';

?>

<?php
	if(!isset($_GET['blogId']) || $_GET['blogId']==NULL){
        echo "<script> window.location = '404.php'</script>";
    }else{
        $id = $_GET['blogId']; 
    }

    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 	$brandName = $_POST['brandName']; 
	// 	$updateBrand = $brand->update_brand($brandName,$id);
    // }
?>

 <div class="main">
    <div class="content">
    	

        <?php
					$details_news = $pos->get_post_byId($id);
					if($details_news){
						while($result = $details_news->fetch_assoc()){
			?>
        <div class="content_top">

        <div class="heading">
    		<h3><?php echo $result['title_blog'] ?></h3>
    		</div>

    		<div class="clear"></div>
    	</div>
	      <div class="section group">

				<div class="col-md-12">
					 
					 <h2><?php echo $result['title_blog']?> </h2>
					 <p><?php echo $result['description_blog'] ?></p>
                     <p><?php echo $result['content'] ?></p>
				</div>

			</div>

            <?php 
						}
					}
			?>
	
    </div>
 
 <?php

include 'inc/footer.php';

?>