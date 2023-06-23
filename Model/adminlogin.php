<?php
    $filepath =realpath(dirname(__FILE__));
    include ($filepath.'/../lib/session.php');
    Session::checkLogin();   //Gọi hàm checkLogin nếu đúng thì đưa đến trang chính
    include ($filepath.'/../lib/database.php');
    include ($filepath.'/../helpers/format.php');
?>


<?php
    class adminlogin 
    {
        private $db;  //Sử dụng riêng
        private $fm;
        public function __construct()
        {
            $this->db = new Database();  //Chỉ chạy trong trang này, gọi class Database từ file database.php
            $this->fm = new Format();
        }
        public function login_admin($adminUser,$adminPass){
            $adminUser = $this->fm->validation($adminUser);      /// Kiem tra cu phap hop le hay khong
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);  //Hàm tạo 2 biến, một biến dữ liệu và một biến kết nối CSDL
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){    //Kiểm tra người dùng có nhập trống dữ liệu hay không
                $alert = "Tên đăng nhập hoặc mật khẩu không thể trống";
                return $alert;
            }else{   //Người dùng đã nhập đầy đủ dữ liệu
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false){   //Nếu người dùng nhập đúng
                    $value = $result->fetch_assoc();  //Hàm lấy kết quả
                    Session::set('adminlogin', true);  //Gọi hàm set trong class session và kiểm tra giá trị
                    Session::set('adminId', $value['adminId']);
                    Session::set('adminUser', $value['adminUser']);
                    Session::set('adminName', $value['adminName']);
                    header('Location:index.php');  //Nếu đúng thì quay về trang chính
                }else{
                    $alert = "Tên đăng nhập hoặc mật khẩu không đúng";
                    return $alert;
                }
            }
        }
    }
    
?>