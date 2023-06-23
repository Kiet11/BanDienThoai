<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class post 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category_post($catName,$catDesc,$catStatus){

            $catName = $this->fm->validation($catName);      /// Kiem tra cu phap hop le hay khong
            $catDesc = $this->fm->validation($catDesc);
            $catStatus = $this->fm->validation($catStatus);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
            $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);

            if(empty($catName) || empty($catDesc)){
                $alert = "<span class='error'>Tên hoặc mô tả danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_category_post(title_post, description_post, status) VALUES('$catName','$catDesc','$catStatus')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm danh mục tin tức thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm danh mục không thành công</span>";
                    return $alert;
                }
            }
        }
        public function show_category_post(){
            $query = "SELECT * FROM tbl_category_post order by id_cat_post desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getcatpostbyId($id){
            $query = "SELECT * FROM tbl_category_post where id_cat_post = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category_post($catName,$catDesc,$catStatus,$id){

            $catName = $this->fm->validation($catName);      /// Kiem tra cu phap hop le hay khong
            $catDesc = $this->fm->validation($catDesc);
            $catStatus = $this->fm->validation($catStatus);

            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
            $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName) || empty($catDesc)){
                $alert = "<span class='error'>Tên danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category_post SET title_post = '$catName', description_post = '$catDesc', status = '$catStatus'
                 WHERE id_cat_post = '$id'";
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
        public function delete_category_post($id){
            $query = "DELETE FROM tbl_category_post where id_cat_post = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa danh mục tin tức thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa danh mục tin tức không thành công</span>";
                    return $alert;
            }
        }

        /////END BACKEND

        public function get_cat_post_byId($id){
            $query = "SELECT tbl_category_post.* FROM tbl_category_post where tbl_category_post.id_cat_post = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_category_frontend(){
            $query = "SELECT * FROM tbl_cartegory order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_post_by_cat($id){
            $query = "SELECT tbl_blog.* FROM tbl_blog where tbl_blog.category_post = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_cart($id){
            $query = "SELECT tbl_product.*,tbl_cartegory.catName,tbl_cartegory.catId FROM tbl_product, tbl_cartegory
            WHERE tbl_product.catId = tbl_cartegory.catId AND tbl_product.catId = '$id' LIMIT 1 ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_post_byId($id){
            $query = "SELECT * FROM tbl_blog where tbl_blog.id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>