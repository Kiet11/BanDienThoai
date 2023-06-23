<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class category 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category($catName){

            $catName = $this->fm->validation($catName);      /// Kiem tra cu phap hop le hay khong

            $catName = mysqli_real_escape_string($this->db->link, $catName);  //Hàm tạo 2 biến, một biến dữ liệu và một biến kết nối CSDL

            if(empty($catName)){
                $alert = "<span class='error'>Tên danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_cartegory(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm danh mục thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm danh mục không thành công</span>";
                    return $alert;
                }
            }
        }
        public function show_category(){
            $query = "SELECT * FROM tbl_cartegory order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_cartegory where catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_category($catName,$id){

            $catName = $this->fm->validation($catName);      /// Kiem tra cu phap hop le hay khong

            $catName = mysqli_real_escape_string($this->db->link, $catName);

            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)){
                $alert = "<span class='error'>Tên danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_cartegory SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa danh mục thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa danh mục không thành công</span>";
                    return $alert;
                }
            }
        }
        public function delete_category($id){
            $query = "DELETE FROM tbl_cartegory where catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa danh mục không thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa danh mục thành công</span>";
                    return $alert;
            }
        }

        /////END BACKEND

        public function show_category_frontend(){
            $query = "SELECT * FROM tbl_cartegory order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cart($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id' order by catId desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_cart($id){
            $query = "SELECT tbl_product.*,tbl_cartegory.catName,tbl_cartegory.catId FROM tbl_product, tbl_cartegory
            WHERE tbl_product.catId = tbl_cartegory.catId AND tbl_product.catId = '$id' LIMIT 1 ";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>