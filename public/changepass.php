<?php include("inc/top.php"); ?>

<style>
/* ===== TRANG ĐỔI MẬT KHẨU – THẢO MOBILE ===== */
.changepass-wrapper {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
.changepass-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.10), 0 1.5px 6px rgba(215,0,24,0.07);
    width: 100%;
    max-width: 520px;
    overflow: hidden;
}
.changepass-card-header {
    background: linear-gradient(135deg, #d70018 0%, #a8001a 100%);
    padding: 1.5rem 2rem 1.2rem 2rem;
    text-align: center;
}
.changepass-card-header h4 {
    color: #fff;
    font-weight: 700;
    font-size: 1.3rem;
    letter-spacing: 1px;
    margin: 0;
}
.changepass-card-header p {
    color: rgba(255,255,255,0.80);
    font-size: 0.88rem;
    margin: 0.3rem 0 0 0;
}
.changepass-card-body {
    padding: 2rem 2rem 1.5rem 2rem;
}
.changepass-card-body .form-label {
    font-weight: 600;
    font-size: 0.90rem;
    color: #333;
    margin-bottom: 0.3rem;
}
.changepass-card-body .form-label .req {
    color: #d70018;
    margin-left: 2px;
}
.changepass-card-body .form-control {
    border-radius: 8px;
    border: 1.5px solid #ddd;
    font-size: 0.95rem;
    padding: 0.55rem 0.9rem;
    transition: border-color 0.2s;
}
.changepass-card-body .form-control:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215,0,24,0.10);
    outline: none;
}
.changepass-card-body .form-control[readonly] {
    background: #f5f5f5;
    color: #888;
    cursor: not-allowed;
}
/* Ô mật khẩu + nút con mắt */
.pw-wrapper {
    position: relative;
}
.pw-wrapper .form-control {
    padding-right: 2.6rem;
}
.pw-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #aaa;
    font-size: 1.05rem;
    padding: 0;
    line-height: 1;
    transition: color 0.2s;
}
.pw-toggle:hover { color: #d70018; }

/* Nút hành động */
.changepass-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
}
.btn-luu {
    flex: 1;
    background: #d70018;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.6rem 1rem;
    font-weight: 600;
    font-size: 0.97rem;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
}
.btn-luu:hover { background: #b5001a; box-shadow: 0 2px 10px rgba(215,0,24,0.20); }
.btn-huy {
    flex: 1;
    background: #f0f0f0;
    color: #555;
    border: none;
    border-radius: 8px;
    padding: 0.6rem 1rem;
    font-weight: 600;
    font-size: 0.97rem;
    cursor: pointer;
    transition: background 0.2s;
    text-align: center;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-huy:hover { background: #e0e0e0; color: #333; text-decoration: none; }

/* Alert tùy chỉnh */
.changepass-alert-success {
    background: #edfaf3;
    border: 1.5px solid #2ecc71;
    border-radius: 8px;
    color: #1a7a45;
    padding: 0.65rem 1rem;
    font-size: 0.93rem;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.changepass-alert-danger {
    background: #fff2f2;
    border: 1.5px solid #d70018;
    border-radius: 8px;
    color: #d70018;
    padding: 0.65rem 1rem;
    font-size: 0.93rem;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.form-group-gap { margin-bottom: 1.1rem; }
</style>

<div class="changepass-wrapper">
  <div class="changepass-card">

    <!-- Header đỏ -->
    <div class="changepass-card-header">
      <h4><i class="bi bi-shield-lock-fill me-1"></i> ĐỔI MẬT KHẨU</h4>
      <p>Thảo Mobile – Bảo mật tài khoản của bạn</p>
    </div>

    <!-- Body -->
    <div class="changepass-card-body">

      <?php if(isset($tb_thanhcong)): ?>
        <div class="changepass-alert-success">
          <i class="bi bi-check-circle-fill"></i>
          <span><?php echo $tb_thanhcong; ?></span>
        </div>
      <?php endif; ?>

      <?php if(isset($tb)): ?>
        <div class="changepass-alert-danger">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <span><?php echo $tb; ?></span>
        </div>
      <?php endif; ?>

      <!-- Form đổi mật khẩu (3 trường bắt buộc) -->
      <!--
        autocomplete="off" trên <form> + autocomplete="new-password" trên các ô password
        giúp ngăn trình duyệt tự điền mật khẩu cũ vào ô mật khẩu mới.
      -->
      <form method="post" action="index.php" autocomplete="off">
        <input type="hidden" name="action" value="xldoimatkhau">

        <!-- Email (readonly) -->
        <div class="form-group-gap">
          <label class="form-label">
            <i class="bi bi-envelope me-1"></i>Email tài khoản
          </label>
          <input class="form-control"
                 type="text"
                 value="<?php echo htmlspecialchars($_SESSION["khachhang"]["email"] ?? ''); ?>"
                 readonly>
        </div>

        <!-- Số điện thoại (readonly) -->
        <div class="form-group-gap">
          <label class="form-label">
            <i class="bi bi-phone me-1"></i>Số điện thoại
          </label>
          <input class="form-control"
                 type="text"
                 value="<?php echo htmlspecialchars($_SESSION["khachhang"]["sodienthoai"] ?? ''); ?>"
                 readonly>
        </div>

        <!-- Mật khẩu hiện tại -->
        <div class="form-group-gap">
          <label class="form-label">
            <i class="bi bi-lock me-1"></i>Mật khẩu hiện tại <span class="req">*</span>
          </label>
          <div class="pw-wrapper">
            <input class="form-control"
                   id="matkhaucu"
                   type="password"
                   name="matkhaucu"
                   autocomplete="current-password"
                   placeholder="Nhập mật khẩu hiện tại của bạn..."
                   required>
            <button type="button" class="pw-toggle" onclick="togglePw('matkhaucu', this)" title="Hiện/ẩn mật khẩu">
              <i class="bi bi-eye-slash"></i>
            </button>
          </div>
        </div>

        <!-- Mật khẩu mới -->
        <div class="form-group-gap">
          <label class="form-label">
            <i class="bi bi-lock-fill me-1"></i>Mật khẩu mới <span class="req">*</span>
          </label>
          <div class="pw-wrapper">
            <input class="form-control"
                   id="matkhaumoi"
                   type="password"
                   name="matkhaumoi"
                   autocomplete="new-password"
                   value=""
                   placeholder="Nhập mật khẩu mới..."
                   required>
            <button type="button" class="pw-toggle" onclick="togglePw('matkhaumoi', this)" title="Hiện/ẩn mật khẩu">
              <i class="bi bi-eye-slash"></i>
            </button>
          </div>
        </div>

        <!-- Nhập lại mật khẩu mới -->
        <div class="form-group-gap">
          <label class="form-label">
            <i class="bi bi-lock-fill me-1"></i>Nhập lại mật khẩu mới <span class="req">*</span>
          </label>
          <div class="pw-wrapper">
            <input class="form-control"
                   id="nhaplaimatkhau"
                   type="password"
                   name="nhaplaimatkhau"
                   autocomplete="new-password"
                   placeholder="Nhập lại mật khẩu mới để xác nhận..."
                   required>
            <button type="button" class="pw-toggle" onclick="togglePw('nhaplaimatkhau', this)" title="Hiện/ẩn mật khẩu">
              <i class="bi bi-eye-slash"></i>
            </button>
          </div>
        </div>

        <!-- Nút hành động -->
        <div class="changepass-actions">
          <button type="submit" class="btn-luu">
            <i class="bi bi-floppy2-fill me-1"></i> Lưu mật khẩu mới
          </button>
          <a href="index.php?action=thongtin" class="btn-huy">
            <i class="bi bi-arrow-left me-1"></i> Hủy bỏ
          </a>
        </div>

      </form>
    </div><!-- /.changepass-card-body -->
  </div><!-- /.changepass-card -->
</div><!-- /.changepass-wrapper -->

<script>
// Toggle ẩn/hiện mật khẩu
function togglePw(fieldId, btn) {
    var input = document.getElementById(fieldId);
    var icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    }
}
</script>

<?php include("inc/bottom.php"); ?>
