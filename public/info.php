<?php include("inc/top.php"); ?>

<!-- Form cập nhật thông tin người dùng -->
<div class="row my-4">
  <div class="col-12 col-md-10 col-lg-8 m-auto">
    <div class="card p-4 p-md-5 shadow-sm">
      <div class="card-header bg-transparent border-0 pb-0">          
        <h4 class="text-navy text-center fw-bold"><i class="bi bi-person-circle me-2"></i>HỒ SƠ NGƯỜI DÙNG</h4> 
      </div>
      <div class="card-body">
        <?php if(isset($tb_thanhcong)): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo $tb_thanhcong; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if(isset($tb)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $tb; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if(isset($_SESSION["khachhang"])): ?>
        <form method="post" enctype="multipart/form-data" action="index.php">
          <input type="hidden" name="txtid" value="<?php echo $_SESSION["khachhang"]["id"]; ?>">
          <input type="hidden" name="txthinhanh" value="<?php echo $_SESSION["khachhang"]["hinhanh"]; ?>">
          <input type="hidden" name="action" value="xlhoso">
          <div class="text-center mb-3">
            <img class="img-thumbnail rounded-circle" src="<?php if ($_SESSION["khachhang"]["hinhanh"]==NULL) echo "../images/users/user.png"; else echo "../images/users/" . $_SESSION["khachhang"]["hinhanh"]; ?>" alt="<?php echo $_SESSION["khachhang"]["hoten"]; ?>" width="110px" height="110px" style="object-fit: cover;">
          </div>
          <div class="my-3">    
            <label class="form-label fw-semibold">Email</label>    
            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["khachhang"]["email"]; ?>" readonly>
          </div>
          <div class="my-3">    
            <label class="form-label fw-semibold">Số điện thoại</label>    
            <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" value="<?php echo $_SESSION["khachhang"]["sodienthoai"]; ?>" required>
          </div>            
          <div class="my-3">
            <label class="form-label fw-semibold">Họ tên</label>
            <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" value="<?php echo $_SESSION["khachhang"]["hoten"]; ?>" required>
          </div>
          <div class="my-3">
            <label class="form-label fw-semibold">Đổi hình đại diện</label>
            <input class="form-control" type="file" name="fhinh" accept="image/*">
          </div>
          <div class="my-4 text-center">            
            <input class="btn btn-primary px-4 me-2" type="submit" value="Cập nhật">
            <input class="btn btn-warning px-4" type="reset" value="Không">
          </div>
        </form>
        <?php else: ?>
          <p class="text-center">Bạn chưa đăng nhập. Vui lòng <a href="index.php?action=dangnhap">đăng nhập</a> để xem thông tin tài khoản.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php include("inc/bottom.php"); ?>
