<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class blog 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_blog($data,$files){

            $title_blog = mysqli_real_escape_string($this->db->link, $data['title_blog']);
            $category = mysqli_real_escape_string($this->db->link, $data['category_post']);
            $description_blog = mysqli_real_escape_string($this->db->link, $data['description_blog']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);

            //kiem tra hinh anh va lay hinh anh vao folder uploads

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($title_blog == "" || $category == "" || $description_blog == "" || $content == "" || 
            $status == "" || $file_name = ""){
                $alert = "<span class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_blog(title_blog,category_post,description_blog,content,status,image) 
                VALUES('$title_blog','$category','$description_blog','$content','$status','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm tin tức thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm tin tức không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_blog(){
            $query = "SELECT tbl_blog.*, tbl_category_post.title_post FROM tbl_blog
             INNER JOIN tbl_category_post ON tbl_category_post.id_cat_post = tbl_blog.category_post order by tbl_blog.id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getblogbyId($id){
            $query = "SELECT * FROM tbl_blog where id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_blog($data,$files,$id){

            $title_blog = mysqli_real_escape_string($this->db->link, $data['title_blog']);
            $category = mysqli_real_escape_string($this->db->link, $data['category_post']);
            $description_blog = mysqli_real_escape_string($this->db->link, $data['description_blog']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);

            //kiem tra hinh anh va lay hinh anh vao folder uploads

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($title_blog == "" || $category == "" || $description_blog == "" || $content == "" || 
            $status == "" || $file_name = ""){
                $alert = "<span class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);{
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
                $query = "UPDATE tbl_blog SET 
                title_blog = '$title_blog',
                category_post = '$category',
                description_blog = '$description_blog',
                status = '$status',         
                image = '$unique_image'
                WHERE id = '$id'";

                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa tin tức thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa tin tức không thành công</span>";
                    return $alert;
                }

            }else{
                ////Neu nguoi dung khong thay doi anh

                $query = "UPDATE tbl_blog SET 
                    title_blog = '$title_blog',
                    category_post = '$category',
                    description_blog = '$description_blog',
                    status = '$status'
                    WHERE id = '$id'";
            }
            
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa tin tức thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa tin tức không thành công</span>";
                    return $alert;
                }
            }
        }
    }

        public function delete_blog($id){
            $query = "DELETE FROM tbl_blog where id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa tin tức thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa tin tức không thành công</span>";
                    return $alert;
            }
        }
    }
    ///////// END BACKEND////////
?>
        