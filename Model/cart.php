<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class cart 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($id, $quantity){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sessionId = session_id(); 

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            $productImage = $result['productImage'];
            $productPrice = $result['productPrice'];
            $productName = $result['productName'];

            $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sessionId'";
            $result_check_cart = $this->db->select($check_cart);
           if($result_check_cart){
               $messenger = "<span style='color: red'>Sản phẩm này đã có trong giỏ hàng của bạn!!!</span>";
                return $messenger;
            }else{

            $query_insert = "INSERT INTO tbl_cart(productId, sessionId, productName, productPrice, quantity, productImage)
            VALUES ('$id', '$sessionId', '$productName', '$productPrice', '$quantity', '$productImage') ";
            $insert_cart = $this->db->insert($query_insert);

            if($insert_cart){
                header('Location:cart.php');
            }else{
                header('Location:404.php');
            }
        }
        }

        public function update_quantity_cart($cartId,$quantity){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);

            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";

            $result = $this->db->update($query);
            if($result){
                $messenger = "<span class='success'>Thay đổi số lượng sản phẩm thành công!!!</span>";
                return $messenger;
            }else{
                $messenger = "<span class='error'>Thay đổi số lượng sản phẩm không thành công!!!</span>";
                return $messenger;
            }
            return $result;
        }

        public function get_product_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_cart($cartId){
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId' ";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }else{
                $messenger = "<span class='error'>Xóa sản phẩm không thành công!!!</span>";
                return $messenger;
            }
            return $result;
        }
        public function check_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart(){
            $sessionId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertOrder($customer_id){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $productPrice = $result['productPrice'] * $quantity;
                    $productImage = $result['productImage'];
                    $customer_id = $customer_id;
                    $query_order = "INSERT INTO tbl_order(productId, productName,quantity, productPrice, productImage, customer_id)
                    VALUES ('$productId', '$productName', '$quantity', '$productPrice', '$productImage', '$customer_id') ";
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }

        public function getAmountPrice($customer_id){
         
            $query = "SELECT productPrice FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }

        public function get_cart_ordered($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        public function check_order($customer_id){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_order Where customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order order by date_order";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }

        public function shifted($id, $price, $time){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $time = mysqli_real_escape_string($this->db->link, $time);

            $query = "UPDATE tbl_order SET status = '1' WHERE orderId = '$id' AND productPrice = '$price' 
            AND date_order = '$time'";

            $result = $this->db->update($query);
            if($result){
                $messenger = "<span class='success'>Xử lý đơn hàng thành công!!!</span>";
                return $messenger;
            }else{
                $messenger = "<span class='error'>Xử lý đơn hàng không thành công!!!</span>";
                return $messenger;
            }
            return $result;
        }

        public function del_shifted($id, $price, $time){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $time = mysqli_real_escape_string($this->db->link, $time);

            $query = "DELETE From tbl_order  WHERE orderId = '$id' AND productPrice = '$price' 
            AND date_order = '$time'";

            $result = $this->db->update($query);
            if($result){
                $messenger = "<span class='success'>Xóa đơn hàng thành công!!!</span>";
                return $messenger;
            }else{
                $messenger = "<span class='error'>Xóa đơn hàng không thành công!!!</span>";
                return $messenger;
            }
            return $result;
        }

        public function shifted_confirm($id, $price, $time){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $time = mysqli_real_escape_string($this->db->link, $time);

            $query = "UPDATE tbl_order SET status = '2' WHERE customer_id = '$id' AND productPrice = '$price' 
            AND date_order = '$time'";

            $result = $this->db->update($query);
            return $result;
        }

        public function del_compare($customer_id){
            $sessionId = session_id();
            $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }
    }
    
?>