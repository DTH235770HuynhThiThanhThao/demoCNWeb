<?php include("inc/top.php"); ?>

<div class="container my-3">    
  <div class="row"> 
    <h3 class="mb-4">Vui lòng nhập đầy đủ thông tin</h3>
	<div class="col-sm-6">
	<h4 class="text-navy mb-3">Thông tin khách hàng</h4>
	<?php 
	if(isset($_SESSION["khachhang"])){
	?>
	<form method="post" action="index.php">
		<input type="hidden" name="txtid" value="<?php echo $_SESSION["khachhang"]["id"]; ?>">
		<input type="hidden" name="action" value="luudonhang">
		<?php foreach($giohang as $id => $mh): ?>
		<input type="hidden" name="chon_mathang[]" value="<?php echo $id; ?>">
		<?php endforeach; ?>
		<div class="my-3">
			<label>Email</label>
			<input type="email" class="form-control" name="txtemail" value="<?php echo $_SESSION["khachhang"]["email"]; ?>" readonly>
		</div>
		<div class="my-3">
			<label>Họ tên</label>
			<input type="text" class="form-control" name="txthoten" value="<?php echo $_SESSION["khachhang"]["hoten"]; ?>" readonly>
		</div>
		<div class="my-3">
			<label>Số điện thoại</label>
			<input type="number" class="form-control" name="txtsodienthoai" value="<?php echo $_SESSION["khachhang"]["sodienthoai"] ?>" readonly>
		</div>
		<div class="my-3">
			<label>Địa chỉ giao hàng</label>
			<textarea class="form-control" name="txtdiachi" required><?php echo isset($diachi["diachi"]) ? $diachi["diachi"] : ""; ?></textarea>
		</div>
		<div class="my-3">
			<input type="submit" value="Hoàn tất đơn hàng" class="btn btn-primary">
		</div>
	</form>
	<?php
	}
	else{	
	?>
	<form method="post" action="index.php">
		<input type="hidden" name="action" value="luudonhang">
		<?php foreach($giohang as $id => $mh): ?>
		<input type="hidden" name="chon_mathang[]" value="<?php echo $id; ?>">
		<?php endforeach; ?>
		<div class="my-3">
			<label>Email</label>
			<input type="email" class="form-control" name="txtemail" required>
		</div>
		<div class="my-3">
			<label>Họ tên</label>
			<input type="text" class="form-control" name="txthoten" required>
		</div>
		<div class="my-3">
			<label>Số điện thoại</label>
			<input type="number" class="form-control" name="txtsodienthoai" required>
		</div>
		<div class="my-3">
			<label>Địa chỉ</label>
			<textarea class="form-control" name="txtdiachi" required></textarea>
		</div>
		<div class="my-3">
			<input type="submit" value="Hoàn tất đơn hàng" class="btn btn-primary">
		</div>
	</form>
	<?php	
	}
	?>
	</div>
	<div class="col-sm-6">
	<h4 class="text-navy mb-3">Thông tin đơn hàng</h4>
		<table class="table table-bordered align-middle">
		<tr class="table-info">
		<th>Sản phẩm</th> 
		<th>Đơn giá</th>
		<th>Số lượng</th>
		<th>Thành tiền</th>
		</tr>
		<?php 
		$tongtien_thanhtoan = 0;
		foreach($giohang as $id => $mh): 
			$tongtien_thanhtoan += $mh["thanhtien"];
		?>
		<tr>
		<td><img width="50" src="../<?php echo $mh["hinhanh"]; ?>"> <?php echo $mh["tenmathang"]; ?></td>
		<td><?php echo number_format($mh["giaban"]) . "đ"; ?></td>
		<td><?php echo $mh["soluong"]; ?></td>
		<td><?php echo number_format($mh["thanhtien"]) . "đ"; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr class="table-info">
		<td colspan="3" class="text-end"><b>Tổng tiền</b></td>
		<td><b class="text-danger"><?php echo number_format($tongtien_thanhtoan); ?>đ</b></td>
		</tr>
		</table>
	</div>
    

  </div>
 
</div>

<?php include("inc/bottom.php"); ?>
