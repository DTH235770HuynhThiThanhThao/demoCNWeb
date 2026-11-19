<?php
include("inc/top.php");
?>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="p-3 shadow">
		<h3 class="text-center text-info">QUÊN MẬT KHẨU</h3>
		
		<?php if(isset($tb)): ?>
			<div class="alert alert-danger" role="alert">
				<i class="bi bi-exclamation-triangle-fill"></i> <?php echo $tb; ?>
			</div>
		<?php endif; ?>

		<p class="text-muted small text-center mb-3">Nhập Email và Số điện thoại đã đăng ký cùng Mật khẩu mới để đặt lại mật khẩu.</p>

		<form method="post" action="index.php">
		
		<input class="form-control" type="email" name="txtemail" placeholder="Email đã đăng ký" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"><br>
		<input class="form-control" type="tel" name="txtsodienthoai" placeholder="Số điện thoại đã đăng ký" pattern="[0-9]{10}" title="Vui lòng nhập đúng 10 số" required value="<?php echo isset($sodienthoai) ? htmlspecialchars($sodienthoai) : ''; ?>"><br>
		<input class="form-control" type="password" name="txtmatkhaumoi" placeholder="Mật khẩu mới" required><br>
		<input class="form-control" type="password" name="txtxacnhanmatkhau" placeholder="Nhập lại mật khẩu mới" required><br>

		<input type="hidden" name="action" value="xlquenmatkhau">
		<div class="d-grid">
		<input class="btn btn-info text-white btn-block" type="submit" value="Đặt lại mật khẩu">
		</div>
		</form>
		<div class="text-center p-3">
			<a href="index.php?action=dangnhap">Quay lại đăng nhập</a> | <a href="index.php?action=dangky">Đăng ký tài khoản</a>
		</div>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<?php
include("inc/bottom.php");
?>
