<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<?php
    class staff 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_staff($ma_nhanvien, $ten_nhanvien, $chuc_vu, $bo_phan, $luong_chinh, $phu_cap, $tong_luong, $ngay_nhanluong){

            $ma_nhanvien = $this->fm->validation($ma_nhanvien);      /// Kiem tra cu phap hop le hay khong
            $ten_nhanvien = $this->fm->validation($ten_nhanvien);
            $chuc_vu = $this->fm->validation($chuc_vu);
            $bo_phan = $this->fm->validation($bo_phan);
            $luong_chinh = $this->fm->validation($luong_chinh);
            $phu_cap = $this->fm->validation($phu_cap);
            $tong_luong = $this->fm->validation($tong_luong);
            $ngay_nhanluong = $this->fm->validation($ngay_nhanluong);

            $ma_nhanvien = mysqli_real_escape_string($this->db->link, $ma_nhanvien);  //Hàm tạo 2 biến, một biến dữ liệu và một biến kết nối CSDL
            $ten_nhanvien = mysqli_real_escape_string($this->db->link, $ten_nhanvien);
            $chuc_vu = mysqli_real_escape_string($this->db->link, $chuc_vu);
            $bo_phan = mysqli_real_escape_string($this->db->link, $bo_phan);
            $luong_chinh = mysqli_real_escape_string($this->db->link, $luong_chinh);
            $phu_cap = mysqli_real_escape_string($this->db->link, $phu_cap);
            $tong_luong = mysqli_real_escape_string($this->db->link, $tong_luong);
            $ngay_nhanluong = mysqli_real_escape_string($this->db->link, $ngay_nhanluong);

            if(empty($ma_nhanvien) || empty($ten_nhanvien) || empty($chuc_vu) || empty($bo_phan) 
            || empty($luong_chinh) || empty($phu_cap) || empty($tong_luong) || empty($ngay_nhanluong)){
                $alert = "<span class='error'>Tên danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_staff(ma_nhanvien, ten_nhanvien, chuc_vu, bo_phan, luong_chinh, 
                phu_cap, tong_luong, ngay_nhanluong) VALUES('$ma_nhanvien', '$ten_nhanvien', '$chuc_vu', '$bo_phan', '$luong_chinh', 
                '$phu_cap', '$tong_luong', '$ngay_nhanluong')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm thông tin nhân viên thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm thông tin nhân viên không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_staff(){
            $query = "SELECT * FROM tbl_staff order by id_nhanvien desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getStaffById($id){
            $query = "SELECT * FROM tbl_staff where id_nhanvien = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_staff($ma_nhanvien, $ten_nhanvien, $chuc_vu, $bo_phan, $luong_chinh, $phu_cap, $tong_luong, $ngay_nhanluong, $id){

            $ma_nhanvien = $this->fm->validation($ma_nhanvien);      /// Kiem tra cu phap hop le hay khong
            $ten_nhanvien = $this->fm->validation($ten_nhanvien);
            $chuc_vu = $this->fm->validation($chuc_vu);
            $bo_phan = $this->fm->validation($bo_phan);
            $luong_chinh = $this->fm->validation($luong_chinh);
            $phu_cap = $this->fm->validation($phu_cap);
            $tong_luong = $this->fm->validation($tong_luong);
            $ngay_nhanluong = $this->fm->validation($ngay_nhanluong);

            $ma_nhanvien = mysqli_real_escape_string($this->db->link, $ma_nhanvien);  //Hàm tạo 2 biến, một biến dữ liệu và một biến kết nối CSDL
            $ten_nhanvien = mysqli_real_escape_string($this->db->link, $ten_nhanvien);
            $chuc_vu = mysqli_real_escape_string($this->db->link, $chuc_vu);
            $bo_phan = mysqli_real_escape_string($this->db->link, $bo_phan);
            $luong_chinh = mysqli_real_escape_string($this->db->link, $luong_chinh);
            $phu_cap = mysqli_real_escape_string($this->db->link, $phu_cap);
            $tong_luong = mysqli_real_escape_string($this->db->link, $tong_luong);
            $ngay_nhanluong = mysqli_real_escape_string($this->db->link, $ngay_nhanluong);

            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($ma_nhanvien) || empty($ten_nhanvien) || empty($chuc_vu) || empty($bo_phan) 
            || empty($luong_chinh) || empty($phu_cap) || empty($tong_luong) || empty($ngay_nhanluong)){
                $alert = "<span class='error'>Tên danh mục không thể trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_staff SET ma_nhanvien = '$ma_nhanvien', ten_nhanvien = '$ten_nhanvien', 
                chuc_vu = '$chuc_vu', bo_phan = '$bo_phan', luong_chinh = '$luong_chinh', phu_cap = '$phu_cap',
                tong_luong = '$tong_luong', ngay_nhanluong = '$ngay_nhanluong' WHERE id_nhanvien = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa thông tin nhân viên thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Sửa thông tin nhân viên không thành công</span>";
                    return $alert;
                }
            }
        }

        public function delete_staff($id){
            $query = "DELETE FROM tbl_staff where id_nhanvien = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xóa thông tin nhân viên thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xóa thông tin nhân viên không thành công</span>";
                    return $alert;
            }
        }
    }
    
?>