<?php
include("inc/top.php");
?>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="p-3 shadow">
		<h3 class="text-center text-info">ĐĂNG KÝ TÀI KHOẢN</h3>
		
		<?php if(isset($tb)): ?>
			<div class="alert alert-danger" role="alert">
				<i class="bi bi-exclamation-triangle-fill"></i> <?php echo $tb; ?>
			</div>
		<?php endif; ?>

		<form method="post" action="index.php">
		
		<input class="form-control" type="text" name="txthoten" placeholder="Họ và tên" required value="<?php echo isset($hoten) ? htmlspecialchars($hoten) : ''; ?>"><br>
		<input class="form-control" type="email" name="txtemail" placeholder="Email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"><br>
		<input class="form-control" type="tel" name="txtsodienthoai" placeholder="Số điện thoại (10 chữ số)" pattern="[0-9]{10}" title="Vui lòng nhập đúng 10 số" required value="<?php echo isset($sodienthoai) ? htmlspecialchars($sodienthoai) : ''; ?>"><br>
		<input class="form-control" type="password" name="txtmatkhau" placeholder="Mật khẩu" required><br>
		<input class="form-control" type="password" name="txtmatkhauxacnhan" placeholder="Nhập lại mật khẩu" required><br>

		<input type="hidden" name="action" value="xldangky">
		<div class="d-grid">
		<input class="btn btn-info text-white btn-block" type="submit" value="Đăng ký tài khoản">
		</div>
		</form>
		<div class="text-center p-3">
			Đã có tài khoản? <a href="index.php?action=dangnhap">Đăng nhập</a>
		</div>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<?php
include("inc/bottom.php");
?>
