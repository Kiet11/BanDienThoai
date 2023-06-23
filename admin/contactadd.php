<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/contact.php'?>
<?php
    $cont = new contact();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$tenTruong = $_POST['tenTruong']; 
        $tenKhoa = $_POST['tenKhoa']; 
        $lop = $_POST['lop']; 
        $gvhd = $_POST['gvhd']; 
        $ttsv = $_POST['ttsv']; 
		$insertContact = $cont->insert_contact($tenTruong,$tenKhoa,$lop,$gvhd,$ttsv);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm TT Liên Hệ</h2>
                <?php
                    if(isset($insertContact)){
                        echo $insertContact;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="contactadd.php" method="POST" autocomplete="off">
                    <table class="form">					
                    <tr>
                            <td>
                                <input type="text" name="tenTruong" placeholder="Nhập tên" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="tenKhoa" placeholder="Nhập địa chỉ" class="medium" />
                            </td>
                        </tr>

                <tr>
                            <td>
                                <input type="text" name="lop" placeholder="số điện thoại" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="gvhd" placeholder="Quê quán" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="ttsv" placeholder="Nhập tên cửa hàng" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm thông tin" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php';?>