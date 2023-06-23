<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/category.php'?>

<?php 
	$filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../Model/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

    if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
        echo "<script> window.location = 'inbox.php'</script>";
    }else{
        $id = $_GET['customerid']; 
    }
    $cus = new customer();
    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 	$catName = $_POST['catName']; 
	// 	$updateCat = $cat->update_category($catName,$id);
    // }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                
                <?php
                    $get_customer = $cus->show_customer($id); 
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){


                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>Tên Khách hàng</td>
                            <td></td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td></td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            <td></td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Phone</td>
                            <td></td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td></td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']?>" class="medium" />
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