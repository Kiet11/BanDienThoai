<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../Model/brand.php';?>
<?php include '../Model/category.php';?>
<?php include '../Model/product.php';?>
<?php include_once '../helpers/format.php';?>

<?php
	$pro = new product();
	$fm = new Format();
	if(isset($_GET['productId'])){
        $id = $_GET['productId']; 
		$delPro = $pro->delete_product($id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
			<?php 
				if(isset($delPro)){
					echo $delPro;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên SP</th>
					<th>D.Mục</th>
					<th>T.Hiệu</th>
					<th>H.Ảnh</th>
					<th>Mô tả</th>
					<th>Số lượng</th>
					<th>Giá</th>
					<th>Loại SP</th>
					<th>Thay đổi</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$prolist = $pro->show_product();
					if($prolist){
						$i = 0;
						while($result = $prolist->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><img src="uploads/<?php echo $result['productImage'] ?>" width="80"></td>
					<td><?php 
					echo $fm->textShorten($result['productDesc'], 30);
					 ?></td>
					<td><?php echo $result['productPrice'] ?></td>
					<td><?php echo $result['productSoluong'] ?></td>
					<td><?php 
						if($result['productType']==1){
							echo 'Nổi bật';
						}else{
							echo 'Không nổi bật';
						}
					?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?><">Sửa</a> || 
					<a href="?productId=<?php echo $result['productId'] ?>">Xóa</a></td>
				</tr>
				<?php
						}
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
