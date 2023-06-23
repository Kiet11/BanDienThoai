<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class lienhe
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_lienhe(){
            
            $hoten = $_POST['hoten'];
            $email_lienhe = $_POST['email_lienhe'];
            $sodienthoai = $_POST['sodienthoai'];
            $noidunglienhe = $_POST['noidunglienhe'];
            
            
            if($hoten == '' || $email_lienhe == '' || $sodienthoai == '' || $noidunglienhe == ''){
                $alert = "<span style='color: red'; class='error'>Các trường không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_lienhe (hoten, email_lienhe, sodienthoai, noidunglienhe) VALUES('$hoten', '$email_lienhe', '$sodienthoai', '$noidunglienhe')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: green'; class='error'>Cảm ơn bạn đã góp ý với chúng tôi!!!!</span>";
                return $alert;
                }else{
                    $alert = "<span style='color: red';  class='error'>Gửi góp ý thất bại</span>";
                    return $alert;
                }
            }
        }

        public function show_lienhe(){
            $query = "SELECT * FROM tbl_lienhe order by id_lienhe desc";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>