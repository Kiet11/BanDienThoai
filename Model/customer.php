<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class customer 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($name == "" || $address == "" || $city == "" ||  $phone == "" ||$email == "" ||  $password == ""){
            $alert = "<span class='error'>Các trường không thể trống</span>";
            return $alert;
            }else{
                $check_email = "SELECT * from tbl_customer where email = '$email' limit 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='success'>E-mail đã tồn tại!!</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_customer(name,address,city,phone,email,password) 
                    VALUES('$name','$address','$city','$phone','$email','$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Tạo tài khoản thành công!!!!</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Tạo tài khoản không không thành công</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if(empty($email) || empty($password)){
            $alert = "<span class='error'>E-mail hoặc mật khẩu không thể trống</span>";
            return $alert;
            }else{
                $check_login = "SELECT * from tbl_customer where email = '$email' AND password = '$password'";
                $result_check = $this->db->select($check_login);
                if($result_check != false){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id', $value['id']);
                    Session::set('customer_name', $value['name']);
                    header('Location:order.php');
                }else{
                    $alert = "<span class='success'>E-mail hoặc mật khẩu không đúng!!</span>";
                    return $alert;
                }
            }
        }

        public function show_customer($id){
            $query = "SELECT * from tbl_customer where id = '$id' limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_customer($data,$id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            if($name == "" || $address == "" || $city == "" || 
            $phone == "" || $email == ""){
                $alert = "<span class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_customer SET name='$name',address='$address',city='$city',phone='$phone',email='$email' WHERE id='$id' ";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Sửa thông tin thành công!!!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa thông tin không không thành công</span>";
                    return $alert;
                }
            }
        }

        public function insert_comment(){
            $product_id_comment = $_POST['proId_comment'];
            $commentName = $_POST['commentName'];
            $commentDesc = $_POST['binhluan'];
            
            if($commentName == '' || $commentDesc == ''){
                $alert = "<span style='color: red'; class='error'>Tên hoặc nọi dung bình luận không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_comment (commentName, commentDesc, productId) VALUES('$commentName', '$commentDesc', '$product_id_comment')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: green'; class='error'>Cảm ơn bạn đã bình luận về sản phẩm của chúng tôi!!!!</span>";
                return $alert;
                }else{
                    $alert = "<span style='color: red';  class='error'>Gửi bình luận thất bại</span>";
                    return $alert;
                }
            }
        }

    }
    
?>