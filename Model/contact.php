<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class contact
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_contact($tenTruong,$tenKhoa,$lop,$gvhd,$ttsv){

            $tenTruong = $this->fm->validation($tenTruong);      /// Kiem tra cu phap hop le hay khong
            $tenKhoa = $this->fm->validation($tenKhoa);
            $lop = $this->fm->validation($lop);
            $gvhd = $this->fm->validation($gvhd);
            $ttsv = $this->fm->validation($ttsv);
            $tenTruong = mysqli_real_escape_string($this->db->link, $tenTruong);
            $tenKhoa = mysqli_real_escape_string($this->db->link, $tenKhoa);
            $lop = mysqli_real_escape_string($this->db->link, $lop);
            $gvhd = mysqli_real_escape_string($this->db->link, $gvhd);
            $ttsv = mysqli_real_escape_string($this->db->link, $ttsv);

            if(empty($tenTruong) || empty($tenKhoa) || empty($lop) || empty($gvhd) || empty($ttsv)){
                $alert = "<span class='error'>Tên hoặc mô tả danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_contact(tenTruong, tenKhoa, lop, gvhd, ttsv) VALUES('$tenTruong','$tenKhoa','$lop','$gvhd','$ttsv')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm thông tin liên hệ thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm thông tin không thành công</span>";
                    return $alert;
                }
            }
        }
        public function show_contact(){
            $query = "SELECT * FROM tbl_contact order by contactId desc limit 1 ";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>