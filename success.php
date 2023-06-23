<?php

include 'inc/header.php';
//include 'inc/slider.php';

?>

<?php

    if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $cart->insertOrder($customer_id);
        $delCart = $cart->del_all_data_cart();
        header('Location:success.php');
    }
?>


<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">

            <div class="content_top">
                <div class="heading">
                    <h3>Đặt hàng thành công !!!!</h3>
                    <?php
                        $customer_id = Session::get('customer_id');
                        $get_amount = $cart->getAmountPrice($customer_id);
                        if($get_amount){
                            $amount = 0;
                            while($result = $get_amount->fetch_assoc()){
                                $price = $result['productPrice'];
                                $amount += $price;
                            }
                        }
                    ?>
                    <p>Tổng tiền hàng mà bạn đã mua từ Website: <?php 
                        $vat = $amount * 0.1; 
                        $total = $vat + $amount;
                        echo $fm->format_currency($total).'VND'; ?></p>
                    <p>Chúng tôi chân thành cảm ơn sẽ liên lạc với bạn sớm nhất!!!!</p>
                    <p>Xem lại giỏ hàng của bạn tại đây!!! <a href="orderdetails.php">ClickHere</a></p>
                </div>
            <div class="clear"></div>	
        </div>
    </div>
</form>

<?php

include 'inc/footer.php';

?>