<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class product 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_product($data,$files){

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
            $productSoluong = mysqli_real_escape_string($this->db->link, $data['productSoluong']);
            echo $productSoluong;
            $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
            $productType = mysqli_real_escape_string($this->db->link, $data['productType']);

            //kiem tra hinh anh va lay hinh anh vao folder uploads

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['productImage']['name'];
            $file_size = $_FILES['productImage']['size'];
            $file_temp = $_FILES['productImage']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $category == "" || $brand == "" || $productDesc == "" || $productSoluong == "" ||
            $productPrice == "" || $productType == "" || $file_name = ""){
                $alert = "<span class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName,catId,brandId,productDesc,productSoluong,productPrice,productType,productImage) 
                VALUES('$productName','$category','$brand','$productDesc','$productSoluong''$productPrice','$productType','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = "SELECT tbl_product.*, tbl_cartegory.catName, tbl_brand.brandName FROM tbl_product
             INNER JOIN tbl_cartegory ON tbl_product.catId = tbl_cartegory.catId
             INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId order by tbl_product.productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product where productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data,$files,$id){

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
            $productSoluong = mysqli_real_escape_string($this->db->link, $data['productSoluong']);
            $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
            $productType = mysqli_real_escape_string($this->db->link, $data['productType']);

            //kiem tra hinh anh va lay hinh anh vao folder uploads

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['productImage']['name'];
            $file_size = $_FILES['productImage']['size'];
            $file_temp = $_FILES['productImage']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $category == "" || $brand == "" || $productDesc == "" || 
            $productPrice == "" || $productType == ""){
                $alert = "<span class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    //Neu nguoi dung thay doi anh
                if($file_size > 204800){
                    $alert = "<span class='error'>Kích thước ảnh nên nhỏ hơn 2MB</span>";
                    return $alert;
                }
                elseif(in_array($file_ext, $permited)===false){
                    $alert= "<span class='error'>Bạn chỉ co thể upload:-".implode(',', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                productDesc = '$productDesc',
                productPrice = '$productSoluong',
                productPrice = '$productPrice',
                productType = '$productType',         
                productImage = '$unique_image'
                WHERE productId = '$id'";

                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa sản phẩm không thành công</span>";
                    return $alert;
                }

            }else{
                ////Neu nguoi dung khong thay doi anh

                $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    productDesc = '$productDesc',
                    productPrice = '$productSoluong',
                    productPrice = '$productPrice',
                    productType = '$productType'                
                    WHERE productId = '$id'";
            }
            
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa sản phẩm không thành công</span>";
                    return $alert;
                }
            }
        }

        public function delete_product($id){
            $query = "DELETE FROM tbl_product where productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
                    return $alert;
            }
        }

        ///////// END BACKEND////////

        public function getProduct_feathered(){
            $query = "SELECT * FROM tbl_product where productType = '1' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        ////// phan trang
        public function getProduct_new(){
            $sp_tung_trang = 4;
            if(!isset($_GET['trang'])){
                $trang = 1;
            }else{
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang-1)*$sp_tung_trang;
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tung_trang";
            $result = $this->db->select($query);
            return $result;
        }

        ////////////Phan trang index      Buoc 1 tao function get_all_product va sau do len get-product-new lam tiep

        public function get_all_product(){
            $query = "SELECT * FROM tbl_product ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id){
            $query = "SELECT tbl_product.*, tbl_cartegory.catName, tbl_brand.brandName FROM tbl_product
             INNER JOIN tbl_cartegory ON tbl_product.catId = tbl_cartegory.catId
             INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId where tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }


/////////////slider lay san pham moi nhat cua tung thuong hieu

        public function getLastestDell(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' order by productId desc LIMIT 1 "; ////Lay san pham dell(brandId=1) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestMacBook(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '9' order by productId desc LIMIT 1 "; ////Lay san pham macbook(brandId=3) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestAsus(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '7' order by productId desc LIMIT 1 "; ////Lay san pham ASUS(brandId=7) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestSurface(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '8' order by productId desc LIMIT 1 "; ////Lay san pham Surface(brandId=8) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function insertCompare($productid, $customer_id){
            
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
            

            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();
            
            $productName = $result['productName'];
            $productPrice = $result['productPrice'];
            $productImage = $result['productImage'];
            

            $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid'  AND customer_id = '$customer_id'";
            $result_check_compare = $this->db->select($check_compare);
           if($result_check_compare){
               $messenger = "<span style='color: red;'>Sản phẩm này đã có trong sản phẩm so sánh!!!</span>";
                return $messenger;
            }else{

            $query_insert = "INSERT INTO tbl_compare(customer_id,productId, productName, productPrice, productImage)
            VALUES ('$customer_id', '$productid', '$productName', '$productPrice', '$productImage') ";
            $insert_compare = $this->db->insert($query_insert);

            if($insert_compare){
                $alert = "<span style='color: green' class='success'>Thêm vào sản phẩm so sánh!!!!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm vào sản phẩm so sánh không thành công!!!</span>";
                    return $alert;
            }
        }
        }

        public function get_compare($customer_id){
            $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc "; ////Lay san pham Surface(brandId=8) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function insertWishlist($productid, $customer_id){
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
            

            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();
            
            $productName = $result['productName'];
            $productPrice = $result['productPrice'];
            $productImage = $result['productImage'];
            

            $check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid'  AND customer_id = '$customer_id'";
            $result_check_wlist = $this->db->select($check_wlist);
           if($result_check_wlist){
               $messenger = "<span style='color: red;'>Sản phẩm này đã có trong sản phẩm yêu thích!!!</span>";
                return $messenger;
            }else{

            $query_insert = "INSERT INTO tbl_wishlist(customer_id,productId, productName, productPrice, productImage)
            VALUES ('$customer_id', '$productid', '$productName', '$productPrice', '$productImage') ";
            $insert_wlist = $this->db->insert($query_insert);

            if($insert_wlist){
                $alert = "<span style='color: green' class='success'>Thêm vào sản phẩm yêu thích!!!!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm vào sản phẩm yêu thích không thành công!!!</span>";
                    return $alert;
            }
        }
        }

        public function get_wishlist($customer_id){
            $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc "; ////Lay san pham Surface(brandId=8) moi nhat
            $result = $this->db->select($query);
            return $result;
        }

        public function del_wlist($customer_id,$proid){
            $query = "DELETE FROM tbl_wishlist where productId = '$proid' and customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
            
        }

        public function getProduct_Macbook(){
            $query = "SELECT * FROM tbl_product where brandId = '9' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProduct_Surface(){
            $query = "SELECT * FROM tbl_product where brandId = '8' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProduct_Dell(){
            $query = "SELECT * FROM tbl_product where brandId = '1' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProduct_Asus(){
            $query = "SELECT * FROM tbl_product where brandId = '7' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_slider($data, $files){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $sliderType = mysqli_real_escape_string($this->db->link, $data['sliderType']);

            //kiem tra hinh anh va lay hinh anh vao folder uploads

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['sliderImage']['name'];
            $file_size = $_FILES['sliderImage']['size'];
            $file_temp = $_FILES['sliderImage']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($sliderName == "" || $sliderType == ""){
            $alert = "<span class='error'>Các trường không thể trống</span>";
            return $alert;
            }else{
            if(!empty($file_name)){
                //Neu nguoi dung thay doi anh
            if($file_size > 2048000){
                $alert = "<span class='error'>Kích thước ảnh nên nhỏ hơn 2MB</span>";
                return $alert;
            }
            elseif(in_array($file_ext, $permited)===false){
                $alert= "<span class='error'>Bạn chỉ co thể upload:-".implode(',', $permited)."</span>";
                return $alert;
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_slider(sliderName, sliderImage, sliderType) VALUES('$sliderName','$unique_image', '$sliderType')";

            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Thêm slider thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm slider không thành công</span>";
                return $alert;
                    }   
                }
            }
            
        }

        public function show_slider(){
            $query = "SELECT * FROM tbl_slider where sliderType = '1' order by sliderId desc limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider_list(){
            $query = "SELECT * FROM tbl_slider order by sliderId desc limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type_slider($id, $sliderType){
            $sliderType = mysqli_real_escape_string($this->db->link, $sliderType);
            $query = "UPDATE tbl_slider SET sliderType = '$sliderType' where sliderId = '$id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function delete_slider($id){
            $query = "DELETE FROM tbl_slider where sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa slider thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa slider không thành công</span>";
                    return $alert;
            }
        }
        
        ///////////////Comment customer/////////////

        public function show_comment(){
            $query = "SELECT * FROM tbl_comment order by commentId desc";
            $result = $this->db->select($query);
            return $result;
        }



        ///////////////Search product//////////////
        public function search_product($tukhoa){
            $tukhoa = $this->fm->validation($tukhoa);
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' ";
            $result = $this->db->select($query);
            return $result;
        }
    }  
    
?>