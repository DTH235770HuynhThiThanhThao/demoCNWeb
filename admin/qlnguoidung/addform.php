<?php include("../inc/top.php"); ?>

<style>
.btn-red-user {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    transition: all 0.2s ease;
}
.btn-red-user:hover {
    background-color: #b30012;
    border-color: #b30012;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.form-tech-label {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 6px;
}
.form-tech-control {
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    padding: 10px 14px;
    font-size: 14px;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
.form-tech-control:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 0.25rem rgba(215, 0, 24, 0.15);
}
</style>

<!-- ================= BREADCRUMB & HEADER ================= -->
<div class="row mb-3">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-2">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Quản lý người dùng</a></li>
                <li class="breadcrumb-item active fw-semibold text-danger" aria-current="page">Thêm tài khoản</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ================= FORM THÊM NGƯỜI DÙNG ================= -->
<div class="row justify-content-center mb-5">
    <div class="col-12 col-md-10 col-lg-8" style="max-width: 680px;">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: #ffffff;">
            <!-- Header của thẻ -->
            <div class="card-header bg-white py-3 px-4 border-0" style="border-bottom: 1px solid #f1f5f9;">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 24px; background-color: #d70018; border-radius: 3px; margin-right: 12px;"></div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark" style="font-size: 1.15rem;">THÊM TÀI KHOẢN NGƯỜI DÙNG</h4>
                        <div class="text-muted small" style="font-size: 12px;">Cấp quyền đăng nhập hệ thống cho quản trị, nhân viên hoặc khách hàng</div>
                    </div>
                </div>
            </div>

            <!-- Nội dung Form -->
            <div class="card-body p-4">
                <form method="post" action="index.php">
                    <input type="hidden" name="action" value="xlthem">

                    <!-- Họ và tên -->
                    <div class="mb-3">
                        <label class="form-tech-label">Họ và tên <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="align-middle text-muted" data-feather="user" style="width: 16px; height: 16px;"></i>
                            </span>
                            <input class="form-control form-tech-control border-start-0" style="border-radius: 0 10px 10px 0;" type="text" name="txthoten" placeholder="Ví dụ: Nguyễn Văn A" required>
                        </div>
                    </div>

                    <!-- Email đăng nhập -->
                    <div class="mb-3">
                        <label class="form-tech-label">Địa chỉ Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="align-middle text-muted" data-feather="mail" style="width: 16px; height: 16px;"></i>
                            </span>
                            <input class="form-control form-tech-control border-start-0" style="border-radius: 0 10px 10px 0;" type="email" name="txtemail" placeholder="example@thaomobile.vn" required>
                        </div>
                    </div>

                    <!-- Mật khẩu khởi tạo -->
                    <div class="mb-3">
                        <label class="form-tech-label">Mật khẩu đăng nhập <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="align-middle text-muted" data-feather="key" style="width: 16px; height: 16px;"></i>
                            </span>
                            <input class="form-control form-tech-control border-start-0" style="border-radius: 0 10px 10px 0;" type="password" name="txtmatkhau" placeholder="Nhập mật khẩu ít nhất 6 ký tự" required>
                        </div>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="mb-3">
                        <label class="form-tech-label">Số điện thoại liên hệ <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="align-middle text-muted" data-feather="phone" style="width: 16px; height: 16px;"></i>
                            </span>
                            <input class="form-control form-tech-control border-start-0" style="border-radius: 0 10px 10px 0;" type="tel" name="txtdienthoai" placeholder="Ví dụ: 0912345678" pattern="[0-9]{10,11}" required>
                        </div>
                    </div>

                    <!-- Chọn quyền hạn -->
                    <div class="mb-4">
                        <label class="form-tech-label">Phân quyền tài khoản <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="align-middle text-muted" data-feather="shield" style="width: 16px; height: 16px;"></i>
                            </span>
                            <select class="form-select form-tech-control border-start-0" style="border-radius: 0 10px 10px 0;" name="optloaind" required>
                                <option value="1">Quản trị viên (Toàn quyền hệ thống)</option>
                                <option value="2" selected>Nhân viên (Quản lý đơn hàng, kho & sản phẩm)</option>
                                <option value="3">Khách hàng thành viên</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nút thao tác -->
                    <div class="d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                        <a href="index.php" class="btn btn-outline-secondary px-4 py-2 fw-semibold" style="border-radius: 10px; font-size: 13.5px;">
                            <i class="align-middle me-1" data-feather="arrow-left" style="width: 15px; height: 15px;"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-red-user px-4 py-2 fw-semibold shadow-sm" style="border-radius: 10px; font-size: 13.5px;">
                            <i class="align-middle me-1" data-feather="check" style="width: 15px; height: 15px;"></i> Lưu người dùng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>

<?php include("../inc/bottom.php"); ?>
