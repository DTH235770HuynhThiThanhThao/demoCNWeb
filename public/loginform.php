<?php
include("inc/top.php");
?>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="p-3 shadow">
		<h3 class="text-center text-info">ĐĂNG NHẬP</h3>
		
		<?php if(isset($thongbao)): ?>
			<div class="alert alert-warning" role="alert">
				<i class="bi bi-exclamation-triangle-fill"></i> <?php echo $thongbao; ?>
			</div>
		<?php endif; ?>

		<?php if(isset($tb)): ?>
			<div class="alert alert-danger" role="alert">
				<i class="bi bi-exclamation-triangle-fill"></i> <?php echo $tb; ?>
			</div>
		<?php endif; ?>

		<?php if(isset($tb_thanhcong)): ?>
			<div class="alert alert-success" role="alert">
				<i class="bi bi-check-circle-fill"></i> <?php echo $tb_thanhcong; ?>
			</div>
		<?php endif; ?>

		<form method="post" action="index.php">
		
		<input class="form-control" type="text" name="txtemail" placeholder="Email hoặc Số điện thoại" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"><br>
		<input class="form-control" type="password" name="txtmatkhau" placeholder="Mật khẩu" required><br>

		<input type="hidden" name="action" value="xldangnhap">
		<div class="d-grid">
		<input class="btn btn-info text-white btn-block" type="submit" value="Đăng nhập">
		</div>
		</form>
		<div class="text-center p-3">
			<a href="index.php?action=quenmatkhau">Quên mật khẩu?</a> | <a href="index.php?action=dangky">Đăng ký tài khoản</a>
		</div>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<?php
include("inc/bottom.php");
?>
