<?php include("inc/top.php"); ?>

<!-- Form cập nhật thông tin ng dùng-->
  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <div class="card p-5 shadow-sm">
        <div class="card-header">          
          <h4 class="text-info text-center">HỒ SƠ NGƯỜI DÙNG</h4> 
        </div>
        <div class="card-body">
          <?php if(isset($tb_thanhcong)): ?>
            <div class="alert alert-success" role="alert">
              <i class="bi bi-check-circle-fill"></i> <?php echo $tb_thanhcong; ?>
            </div>
          <?php endif; ?>

          <?php if(isset($tb)): ?>
            <div class="alert alert-danger" role="alert">
              <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $tb; ?>
            </div>
          <?php endif; ?>

          <?php if(isset($_SESSION["khachhang"])): ?>
          <form method="post" enctype="multipart/form-data" action="index.php">
          	<input type="hidden" name="txtid" value="<?php echo $_SESSION["khachhang"]["id"]; ?>">
          	<input type="hidden" name="txthinhanh" value="<?php echo $_SESSION["khachhang"]["hinhanh"]; ?>">
            <input type="hidden" name="action" value="xlhoso">
            <div class="text-center">
              <img class="img-thumbnail" src="<?php if ($_SESSION["khachhang"]["hinhanh"]==NULL) echo "../images/users/user.png"; else echo "../images/users/" . $_SESSION["khachhang"]["hinhanh"]; ?>" alt="<?php echo $_SESSION["khachhang"]["hoten"]; ?>" width="100px">
            </div>
            <div class="my-3">    
            <label class="form-label">Email</label>    
            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["khachhang"]["email"]; ?>" readonly>
            </div>
            <div class="my-3">    
            <label class="form-label">Số điện thoại</label>    
            <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" value="<?php echo $_SESSION["khachhang"]["sodienthoai"]; ?>" required>
            </div>            
            <div class="my-3">
            <label class="form-label">Họ tên</label>
            <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" value="<?php echo $_SESSION["khachhang"]["hoten"]; ?>" required></div>
            <div class="my-3">
              <label class="form-label">Đổi hình đại diện</label>
              <input class="form-control" type="file" name="fhinh">
            </div>
            <div class="my-3 text-center">            
            <input class="btn btn-primary" type="submit" value="Cập nhật">
            <input class="btn btn-warning" type="reset" value="Không">
        	</div>
          </form>
          <?php else: ?>
            <p class="text-center">Bạn chưa đăng nhập. Vui lòng <a href="index.php?action=dangnhap">đăng nhập</a> để xem thông tin tài khoản.</p>
          <?php endif; ?>
        </div>
        
      </div>
    </div>
  </div>

  <?php if(isset($_SESSION["khachhang"]) && isset($donhang)){ $i = 1; ?>
  <br><br>
  <div class="row">
    <div class="col-12 col-md-10 m-auto">
      <h4 class="text-info">Danh sách đơn hàng</h4>
      <table class="table table-hover">
        <tr><th>STT</th><th>Mã đơn hàng</th><th>Ngày đặt</th><th>Số tiền</th><th>Chi tiết đơn hàng</th></tr>
        <?php foreach($donhang as $d){ ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><a href="index.php?action=thongtin&dhid=<?php echo $d["id"]; ?>">DH00000<?php echo $d["id"]; ?></a></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($d["ngay"])); ?></td>
            <td class="text-end fw-bold"><?php echo number_format($d["tongtien"]); ?> đ</td>
            <td><a href="index.php?action=thongtin&dhid=<?php echo $d["id"]; ?>">Xem chi tiết</a></td>
        </tr>
        <?php if(isset($donhangct) && ($d["id"] == $donhangct[0]["donhang_id"])){ ?>
            <tr><td></td><td colspan="4">
                <table class="table table-bordered">
                    <tr class="text-center"><th>Mặt hàng</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th></tr>
                    <?php foreach($donhangct as $dhct){ ?>
                    <tr class="align-middle">
                        <td><a class="text-decoration-none" href="index.php?action=detail&id=<?php echo $dhct["id"]; ?>"><img class="img-thumbnail" width="50" src="../<?php echo $dhct["hinhanh"]; ?>"> <?php echo $dhct["tenmathang"]; ?></a></td>
                        <td class="text-end"><?php echo number_format($dhct["dongia"]); ?> đ</td>
                        <td class="text-end"><?php echo $dhct["soluong"]; ?></td>
                        <td class="text-end"><?php echo number_format($dhct["thanhtien"]); ?> đ</td>
                    </tr>
                    <?php } ?>
                    </table>
            </td></tr>
        <?php }} ?>
      </table>
    </div>
  </div>
  <?php } ?>

<?php include("inc/bottom.php"); ?>
