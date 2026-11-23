<?php include("inc/top.php"); ?>

<style>
/* =====================================================
   TRANG HỒ SƠ NGƯỜI DÙNG – THẢO MOBILE
   ===================================================== */

/* Wrapper toàn trang */
.profile-page {
    background: var(--bg-page, #f4f6f8);
    min-height: 70vh;
    padding: 1.5rem 0 3rem;
}

/* Breadcrumb */
.profile-breadcrumb {
    font-size: 0.84rem;
    margin-bottom: 1.25rem;
    color: #64748b;
}
.profile-breadcrumb a {
    color: #64748b;
    text-decoration: none;
}
.profile-breadcrumb a:hover { color: #d70018; }
.profile-breadcrumb .sep {
    margin: 0 6px;
    color: #94a3b8;
}
.profile-breadcrumb .current {
    color: #1e293b;
    font-weight: 600;
}

/* Card chung */
.profile-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 3px 14px rgba(0,0,0,0.05);
    overflow: hidden;
}

/* ---- CỘT TRÁI: avatar + info + nav ---- */
.profile-sidebar-top {
    border-top: 4px solid #d70018;
    padding: 2rem 1.5rem 0;
    text-align: center;
}

/* Khung ảnh tròn */
.avatar-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 1rem;
}
.avatar-wrap img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 18px rgba(0,0,0,0.13);
    display: block;
}
/* Nút máy ảnh nhỏ */
.avatar-cam-btn {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 32px;
    height: 32px;
    background: #d70018;
    border: 2px solid #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(215,0,24,0.30);
    transition: background 0.2s;
}
.avatar-cam-btn:hover { background: #b00014; }
.avatar-cam-btn i { color: #fff; font-size: 0.85rem; }

/* Tên + badge + email + sdt */
.sidebar-name {
    font-weight: 800;
    font-size: 1.1rem;
    color: #1e293b;
    margin-bottom: 2px;
}
.sidebar-badge {
    display: inline-block;
    background: #fff1f2;
    color: #d70018;
    border: 1px solid #fecdd3;
    border-radius: 50px;
    font-size: 0.74rem;
    font-weight: 700;
    padding: 2px 10px;
    margin-bottom: 10px;
    letter-spacing: 0.2px;
}
.sidebar-info-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 0.84rem;
    color: #475569;
    margin-bottom: 4px;
}
.sidebar-info-row i { color: #d70018; font-size: 0.88rem; }

/* Menu điều hướng nhanh */
.profile-nav {
    border-top: 1px solid #f1f5f9;
    margin-top: 1.2rem;
    padding: 0.5rem 0;
}
.profile-nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 1.5rem;
    font-size: 0.90rem;
    font-weight: 600;
    color: #374151;
    text-decoration: none;
    border-left: 3px solid transparent;
    transition: all 0.18s ease;
}
.profile-nav-item:hover {
    background: #f8fafc;
    color: #d70018;
    border-left-color: #d70018;
    padding-left: calc(1.5rem + 4px);
    text-decoration: none;
}
.profile-nav-item.active {
    background: #fff1f2;
    color: #d70018;
    border-left-color: #d70018;
    font-weight: 700;
}
.profile-nav-item i { font-size: 1rem; width: 18px; text-align: center; }

/* ---- CỘT PHẢI: form cập nhật ---- */
.profile-form-header {
    padding: 1.5rem 1.75rem 1rem;
    border-bottom: 1.5px solid #f1f5f9;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.profile-form-accent {
    width: 5px;
    height: 42px;
    background: #d70018;
    border-radius: 4px;
    flex-shrink: 0;
    margin-top: 2px;
}
.profile-form-title {
    font-weight: 800;
    font-size: 1.08rem;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 2px;
}
.profile-form-desc {
    font-size: 0.82rem;
    color: #64748b;
    margin: 0;
}

/* Form controls */
.profile-form-body { padding: 1.5rem 1.75rem; }

.profile-label {
    font-weight: 600;
    font-size: 0.87rem;
    color: #374151;
    margin-bottom: 0.35rem;
    display: block;
}
.profile-label .req { color: #d70018; margin-left: 2px; }

.profile-input {
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    height: 44px;
    padding: 0 14px;
    font-size: 0.93rem;
    color: #1e293b;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fff;
}
.profile-input:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215,0,24,0.10);
    outline: none;
}
.profile-input[readonly] {
    background: #f8fafc;
    color: #64748b;
    cursor: default;
}

.profile-file-input {
    border: 1.5px dashed #d1d5db;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.88rem;
    width: 100%;
    cursor: pointer;
    transition: border-color 0.2s;
    background: #fafafa;
}
.profile-file-input:hover { border-color: #d70018; }
.file-hint {
    font-size: 0.77rem;
    color: #94a3b8;
    margin-top: 4px;
}

.form-gap { margin-bottom: 1.1rem; }

/* Nút hành động */
.profile-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.6rem;
    flex-wrap: wrap;
}
.btn-profile-save {
    flex: 1;
    min-width: 150px;
    height: 44px;
    background: #d70018;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
}
.btn-profile-save:hover {
    background: #b80014;
    box-shadow: 0 4px 14px rgba(215,0,24,0.28);
    transform: translateY(-1px);
}
.btn-profile-back {
    flex: 1;
    min-width: 150px;
    height: 44px;
    background: #f3f4f6;
    color: #374151;
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s;
}
.btn-profile-back:hover {
    background: #e5e7eb;
    border-color: #9ca3af;
    color: #111827;
    text-decoration: none;
}

/* Alert */
.profile-alert-success {
    background: #edfaf3;
    border: 1.5px solid #2ecc71;
    border-radius: 10px;
    color: #1a7a45;
    padding: 0.7rem 1rem;
    font-size: 0.90rem;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.profile-alert-danger {
    background: #fff2f2;
    border: 1.5px solid #d70018;
    border-radius: 10px;
    color: #d70018;
    padding: 0.7rem 1rem;
    font-size: 0.90rem;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

@media (max-width: 991px) {
    .profile-sidebar-top { padding: 1.5rem 1.25rem 0; }
    .profile-nav-item { padding: 10px 1.25rem; }
    .profile-form-body { padding: 1.25rem; }
    .profile-form-header { padding: 1.25rem 1.25rem 0.85rem; }
    .btn-profile-save, .btn-profile-back { flex: none; width: 100%; }
}
</style>

<div class="profile-page">
  <div class="container" style="max-width: 960px;">

    <!-- Breadcrumb -->
    <div class="profile-breadcrumb">
      <a href="index.php"><i class="bi bi-house-door-fill me-1"></i>Trang chủ</a>
      <span class="sep">›</span>
      <span class="current">Hồ sơ tài khoản</span>
    </div>

    <?php if(isset($_SESSION["khachhang"])): ?>

    <?php
      /* Lấy ảnh đại diện */
      $hinhanh_hientai = $_SESSION["khachhang"]["hinhanh"] ?? null;
      $avatar_src = ($hinhanh_hientai)
          ? "../images/users/" . htmlspecialchars($hinhanh_hientai)
          : "../images/users/user.png";
    ?>

    <div class="row g-4 align-items-start">

      <!-- ========== CỘT TRÁI: Sidebar tổng quan ========== -->
      <div class="col-lg-4">
        <div class="profile-card">

          <div class="profile-sidebar-top">

            <!-- Ảnh đại diện tròn + nút camera -->
            <div class="avatar-wrap" id="avatarWrap">
              <img id="avatarPreview"
                   src="<?php echo $avatar_src; ?>"
                   alt="<?php echo htmlspecialchars($_SESSION["khachhang"]["hoten"] ?? ''); ?>">
              <label class="avatar-cam-btn" for="fhinh" title="Thay ảnh đại diện">
                <i class="bi bi-camera-fill"></i>
              </label>
            </div>

            <!-- Tên + badge -->
            <div class="sidebar-name"><?php echo htmlspecialchars($_SESSION["khachhang"]["hoten"] ?? ''); ?></div>
            <div class="sidebar-badge"><i class="bi bi-patch-check-fill me-1"></i>Khách hàng Thảo Mobile</div>

            <!-- Email -->
            <div class="sidebar-info-row">
              <i class="bi bi-envelope-fill"></i>
              <span><?php echo htmlspecialchars($_SESSION["khachhang"]["email"] ?? ''); ?></span>
            </div>
            <!-- Số điện thoại -->
            <div class="sidebar-info-row" style="margin-bottom: 1rem;">
              <i class="bi bi-phone-fill"></i>
              <span><?php echo htmlspecialchars($_SESSION["khachhang"]["sodienthoai"] ?? ''); ?></span>
            </div>

          </div><!-- /.profile-sidebar-top -->

          <!-- Menu điều hướng nhanh -->
          <nav class="profile-nav">
            <a href="index.php?action=thongtin" class="profile-nav-item active">
              <i class="bi bi-person-lines-fill"></i> Thông tin cá nhân
            </a>
            <a href="index.php?action=doimatkhau" class="profile-nav-item">
              <i class="bi bi-shield-lock-fill"></i> Đổi mật khẩu
            </a>
            <a href="index.php?action=lichsumuahang" class="profile-nav-item">
              <i class="bi bi-bag-check-fill"></i> Lịch sử đơn hàng
            </a>
            <a href="index.php?action=baohanh" class="profile-nav-item">
              <i class="bi bi-tools"></i> Tra cứu bảo hành
            </a>
          </nav>

        </div><!-- /.profile-card -->
      </div><!-- /.col-lg-4 -->

      <!-- ========== CỘT PHẢI: Form cập nhật hồ sơ ========== -->
      <div class="col-lg-8">
        <div class="profile-card">

          <!-- Tiêu đề với thanh nhấn đỏ -->
          <div class="profile-form-header">
            <div class="profile-form-accent"></div>
            <div>
              <div class="profile-form-title">
                <i class="bi bi-pencil-square me-1"></i>CẬP NHẬT HỒ SƠ CÁ NHÂN
              </div>
              <p class="profile-form-desc">Quản lý thông tin hồ sơ để bảo mật tài khoản và giao hàng chính xác</p>
            </div>
          </div>

          <div class="profile-form-body">

            <!-- Thông báo thành công -->
            <?php if(isset($tb_thanhcong)): ?>
              <div class="profile-alert-success">
                <i class="bi bi-check-circle-fill" style="font-size:1.1rem;flex-shrink:0;"></i>
                <span><?php echo $tb_thanhcong; ?></span>
              </div>
            <?php endif; ?>

            <!-- Thông báo lỗi -->
            <?php if(isset($tb)): ?>
              <div class="profile-alert-danger">
                <i class="bi bi-exclamation-triangle-fill" style="font-size:1.1rem;flex-shrink:0;"></i>
                <span><?php echo $tb; ?></span>
              </div>
            <?php endif; ?>

            <!-- Form — giữ 100% name/action/enctype của giảng viên -->
            <form method="post" enctype="multipart/form-data" action="index.php">
              <input type="hidden" name="txtid"      value="<?php echo $_SESSION["khachhang"]["id"]; ?>">
              <input type="hidden" name="txthinhanh" value="<?php echo htmlspecialchars($_SESSION["khachhang"]["hinhanh"] ?? ''); ?>">
              <input type="hidden" name="action"     value="xlhoso">

              <!-- Họ và tên -->
              <div class="form-gap">
                <label class="profile-label" for="txthoten">
                  <i class="bi bi-person me-1 text-danger"></i>Họ và tên <span class="req">*</span>
                </label>
                <input class="profile-input"
                       id="txthoten"
                       type="text"
                       name="txthoten"
                       placeholder="Nhập họ và tên của bạn..."
                       value="<?php echo htmlspecialchars($_SESSION["khachhang"]["hoten"] ?? ''); ?>"
                       required>
              </div>

              <!-- Địa chỉ Email -->
              <div class="form-gap">
                <label class="profile-label" for="txtemail">
                  <i class="bi bi-envelope me-1 text-danger"></i>Địa chỉ Email <span class="req">*</span>
                </label>
                <input class="profile-input"
                       id="txtemail"
                       type="email"
                       name="txtemail"
                       placeholder="Địa chỉ email..."
                       value="<?php echo htmlspecialchars($_SESSION["khachhang"]["email"] ?? ''); ?>"
                       readonly>
              </div>

              <!-- Số điện thoại -->
              <div class="form-gap">
                <label class="profile-label" for="txtdienthoai">
                  <i class="bi bi-phone me-1 text-danger"></i>Số điện thoại <span class="req">*</span>
                </label>
                <input class="profile-input"
                       id="txtdienthoai"
                       type="tel"
                       name="txtdienthoai"
                       placeholder="Số điện thoại liên hệ..."
                       value="<?php echo htmlspecialchars($_SESSION["khachhang"]["sodienthoai"] ?? ''); ?>"
                       required>
              </div>

              <!-- Cập nhật ảnh đại diện -->
              <div class="form-gap">
                <label class="profile-label" for="fhinh">
                  <i class="bi bi-image me-1 text-danger"></i>Cập nhật ảnh đại diện mới
                </label>
                <input class="profile-file-input"
                       id="fhinh"
                       type="file"
                       name="fhinh"
                       accept="image/*"
                       onchange="xemTruocAnh(this)">
                <p class="file-hint">
                  <i class="bi bi-info-circle me-1"></i>Hỗ trợ định dạng JPG, PNG, WEBP. Bỏ trống nếu giữ nguyên ảnh cũ.
                </p>
              </div>

              <!-- Nút hành động -->
              <div class="profile-actions">
                <button type="submit" class="btn-profile-save">
                  <i class="bi bi-check2-circle"></i> Lưu thay đổi
                </button>
                <a href="index.php" class="btn-profile-back">
                  <i class="bi bi-house-door"></i> Quay lại trang chủ
                </a>
              </div>

            </form>
          </div><!-- /.profile-form-body -->
        </div><!-- /.profile-card -->
      </div><!-- /.col-lg-8 -->

    </div><!-- /.row -->

    <?php else: ?>
      <div class="profile-card p-5 text-center">
        <i class="bi bi-person-x" style="font-size:3rem;color:#d70018;"></i>
        <p class="mt-3 mb-2 fw-semibold text-secondary">Bạn chưa đăng nhập</p>
        <a href="index.php?action=dangnhap" class="btn-profile-save" style="display:inline-flex;width:auto;padding:0 2rem;">
          <i class="bi bi-box-arrow-in-right"></i> Đăng nhập ngay
        </a>
      </div>
    <?php endif; ?>

  </div><!-- /.container -->
</div><!-- /.profile-page -->

<script>
/* Xem trước ảnh đại diện khi người dùng chọn tệp từ máy tính */
function xemTruocAnh(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include("inc/bottom.php"); ?>
