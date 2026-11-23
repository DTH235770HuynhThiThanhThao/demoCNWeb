<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, thanh thoát */
.brand-title-bar {
    width: 5px;
    height: 38px;
    background-color: #d70018;
    border-radius: 4px;
    margin-right: 14px;
    flex-shrink: 0;
}
.section-accent-bar {
    width: 4px;
    height: 18px;
    background-color: #d70018;
    border-radius: 3px;
    margin-right: 10px;
    flex-shrink: 0;
}
.btn-flagship-red {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship-red:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-outline-flagship {
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    background-color: #ffffff;
    transition: all 0.2s ease;
}
.btn-outline-flagship:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff5f5;
}
.btn-reset-form {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-reset-form:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.input-group-custom .input-group-text {
    background-color: #f8fafc;
    border-color: #cbd5e1;
    color: #64748b;
    border-radius: 10px 0 0 10px;
}
.input-group-custom .form-control {
    border-color: #cbd5e1;
    border-radius: 0 10px 10px 0;
    height: 40px;
    font-size: 13.5px;
}
.input-group-custom .form-control:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215, 0, 24, 0.1);
}
.textarea-custom {
    border-color: #cbd5e1;
    border-radius: 10px;
    font-size: 13.5px;
}
.textarea-custom:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215, 0, 24, 0.1);
}
</style>

<!-- 1. Thanh tiêu đề & Nút xem trang Giới thiệu ngoài web (Gọn gàng, thoáng mắt, không lặp card) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center">
        <div class="brand-title-bar"></div>
        <div>
            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">CẤU HÌNH THÔNG TIN WEBSITE</h3>
            <p class="text-muted small mb-0 mt-1">Quản lý thương hiệu, số hotline, địa chỉ, giờ mở cửa và nội dung giới thiệu cửa hàng</p>
        </div>
    </div>
    <div>
        <a href="../../public/index.php?action=gioithieu" target="_blank" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center px-3 py-2 shadow-sm">
            <i class="align-middle me-1.5" data-feather="external-link" style="width: 15px; height: 15px;"></i>
            <span>Xem trang Giới thiệu ngoài web</span>
        </a>
    </div>
</div>

<!-- Thông báo cập nhật thành công -->
<?php if(isset($_GET["msg"]) && $_GET["msg"] == "capnhat_ok"): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
        <div>
            <strong>Cập nhật thành công!</strong> Thông tin cửa hàng đã được lưu và tự động đồng bộ lên thanh Top-bar, chân trang Footer và trang Giới thiệu.
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row g-4 mb-4">
    <!-- CỘT TRÁI (col-lg-8): FORM CHỈNH SỬA THÔNG TIN CỬA HÀNG -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <div class="section-accent-bar"></div>
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Thông tin chi tiết cửa hàng</h5>
            </div>

            <form method="post" action="index.php" id="formThongTin">
                <input type="hidden" name="action" value="capnhat">

                <!-- Hàng 1: Tên cửa hàng & Hotline -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted mb-1">
                            Tên cửa hàng / Thương hiệu <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="align-middle" data-feather="home" style="width: 15px; height: 15px;"></i></span>
                            <input type="text" class="form-control shadow-none" name="txttencuahang" id="inputTenCuaHang" 
                                   value="<?= htmlspecialchars($thongtin["tencuahang"] ?? "Thảo Mobile") ?>" 
                                   required placeholder="Nhập tên thương hiệu...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted mb-1">
                            Số điện thoại Hotline <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="align-middle" data-feather="phone-call" style="width: 15px; height: 15px;"></i></span>
                            <input type="text" class="form-control shadow-none" name="txtsodienthoai" id="inputHotline" 
                                   value="<?= htmlspecialchars($thongtin["sodienthoai"] ?? "0357185269") ?>" 
                                   required placeholder="Ví dụ: 0357185269...">
                        </div>
                    </div>
                </div>

                <!-- Hàng 2: Email liên hệ & Giờ mở cửa -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted mb-1">
                            Email liên hệ hỗ trợ <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="align-middle" data-feather="mail" style="width: 15px; height: 15px;"></i></span>
                            <input type="email" class="form-control shadow-none" name="txtemail" id="inputEmail" 
                                   value="<?= htmlspecialchars($thongtin["email"] ?? "thanhthaoshop@gmail.com") ?>" 
                                   required placeholder="Ví dụ: hotro@shop.com...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted mb-1">
                            Giờ mở cửa phục vụ
                        </label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text"><i class="align-middle" data-feather="clock" style="width: 15px; height: 15px;"></i></span>
                            <input type="text" class="form-control shadow-none" name="txtgiomocua" id="inputGioMoCua" 
                                   value="<?= htmlspecialchars($thongtin["giomocua"] ?? "08:00 - 21:30 (Tất cả các ngày trong tuần)") ?>" 
                                   placeholder="Ví dụ: 08:00 - 21:30...">
                        </div>
                    </div>
                </div>

                <!-- Hàng 3: Slogan thông báo Top-bar -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted mb-1">
                        Thông báo chạy trên thanh Top-bar (Slogan khuyến mãi)
                    </label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="align-middle" data-feather="volume-2" style="width: 15px; height: 15px;"></i></span>
                        <input type="text" class="form-control shadow-none" name="txtslogan" id="inputSlogan" 
                               value="<?= htmlspecialchars($thongtin["slogan"] ?? "Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng") ?>" 
                               placeholder="Nhập thông báo ưu đãi nổi bật trên đầu trang...">
                    </div>
                </div>

                <!-- Hàng 4: Địa chỉ cửa hàng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted mb-1">
                        Địa chỉ cửa hàng / Showroom <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="align-middle" data-feather="map-pin" style="width: 15px; height: 15px;"></i></span>
                        <input type="text" class="form-control shadow-none" name="txtdiachi" id="inputDiaChi" 
                               value="<?= htmlspecialchars($thongtin["diachi"] ?? "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp") ?>" 
                               required placeholder="Nhập địa chỉ showroom...">
                    </div>
                </div>

                <!-- Hàng 5: Nội dung giới thiệu cửa hàng -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted mb-1">
                        Nội dung giới thiệu cửa hàng
                    </label>
                    <textarea class="form-control shadow-none textarea-custom" name="txtgioithieu" id="inputGioiThieu" rows="4" placeholder="Nhập câu chuyện thương hiệu, cam kết chất lượng sản phẩm và dịch vụ hậu mãi..."><?= htmlspecialchars($thongtin["gioithieu"] ?? "") ?></textarea>
                </div>

                <!-- Nút bấm hành động -->
                <div class="d-flex align-items-center gap-2 pt-3 border-top mt-2">
                    <button type="submit" class="btn btn-flagship-red px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="align-middle" data-feather="save" style="width: 16px; height: 16px;"></i>
                        <span>Lưu thay đổi</span>
                    </button>
                    <button type="reset" class="btn btn-reset-form px-3 py-2" onclick="setTimeout(capNhatLivePreview, 50)">
                        Khôi phục ban đầu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CỘT PHẢI (col-lg-4): KHUNG XEM TRƯỚC TRỰC QUAN (LIVE PREVIEW) -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <div class="section-accent-bar"></div>
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Xem trước trực quan</h5>
            </div>

            <!-- Thẻ mô phỏng Footer Thảo Mobile -->
            <div class="p-3.5 rounded-3 text-white shadow-sm mb-3" style="background: linear-gradient(135deg, #181c24 0%, #111827 100%); border: 1px solid rgba(255,255,255,0.06);">
                <div class="d-flex align-items-center gap-2.5 mb-3">
                    <img src="../../images/logo/logo2.jpg" alt="Logo" class="rounded-3 shadow-sm bg-white p-1" style="width: 46px; height: 46px; object-fit: cover;" onerror="this.src='../../images/logo/logo.jpg';">
                    <div>
                        <h6 class="fw-bold mb-0 text-white" id="pvTenCuaHang" style="font-size: 15px; letter-spacing: -0.2px;"><?= htmlspecialchars($thongtin["tencuahang"] ?? "Thảo Mobile") ?></h6>
                        <small class="text-white-50" style="font-size: 11px;">Hệ thống bán lẻ smartphone chính hãng</small>
                    </div>
                </div>

                <div class="small border-top border-secondary border-opacity-25 pt-2.5 mt-2" style="font-size: 12.5px; line-height: 1.5;">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="align-middle text-danger mt-0.5" data-feather="phone-call" style="width: 13px; height: 13px; flex-shrink: 0;"></i>
                        <span>Hotline: <strong style="color: #ff4d6d;" id="pvHotline"><?= htmlspecialchars($thongtin["sodienthoai"] ?? "0357185269") ?></strong></span>
                    </div>
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="align-middle text-info mt-0.5" data-feather="mail" style="width: 13px; height: 13px; flex-shrink: 0;"></i>
                        <span class="text-truncate" id="pvEmail"><?= htmlspecialchars($thongtin["email"] ?? "thanhthaoshop@gmail.com") ?></span>
                    </div>
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="align-middle text-warning mt-0.5" data-feather="map-pin" style="width: 13px; height: 13px; flex-shrink: 0;"></i>
                        <span id="pvDiaChi" style="font-size: 12px;"><?= htmlspecialchars($thongtin["diachi"] ?? "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp") ?></span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="align-middle text-success mt-0.5" data-feather="clock" style="width: 13px; height: 13px; flex-shrink: 0;"></i>
                        <span id="pvGioMoCua" style="font-size: 12px;"><?= htmlspecialchars($thongtin["giomocua"] ?? "08:00 - 21:30") ?></span>
                    </div>
                </div>
            </div>

            <!-- Mô phỏng Top Announcement Bar -->
            <div class="rounded-3 p-2.5 mb-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="small text-muted fw-semibold mb-1" style="font-size: 11.5px;">Mô phỏng Top-bar ngoài web:</div>
                <div class="p-2 rounded-2 text-white small d-flex align-items-center" style="background-color: #0f172a; font-size: 11.5px;">
                    <i class="align-middle text-danger me-1.5" data-feather="bell" style="width: 13px; height: 13px; flex-shrink: 0;"></i>
                    <span id="pvSlogan" class="text-truncate"><?= htmlspecialchars($thongtin["slogan"] ?? "Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng") ?></span>
                </div>
            </div>

            <div class="d-grid mb-3">
                <a href="../../public/index.php?action=gioithieu" target="_blank" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center justify-content-center gap-1.5 py-2">
                    <span>Xem trực tiếp ngoài website</span>
                    <i class="align-middle" data-feather="arrow-up-right" style="width: 14px; height: 14px;"></i>
                </a>
            </div>

            <!-- Khối ghi chú vị trí hiển thị ngắn gọn, thanh lịch -->
            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="fw-semibold text-dark small mb-1 d-flex align-items-center">
                    <i class="align-middle me-1.5 text-danger" data-feather="info" style="width: 14px; height: 14px;"></i>
                    <span>Vị trí hiển thị trên hệ thống</span>
                </div>
                <p class="text-muted small mb-0" style="font-size: 12px; line-height: 1.5;">
                    Thông tin trên sẽ được tự động đồng bộ lên thanh Top-bar, Hotline, Chân trang (Footer) và trang Giới thiệu của website.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Cập nhật Live Preview khi người dùng nhập liệu
function capNhatLivePreview() {
    var ten = document.getElementById("inputTenCuaHang").value.trim() || "Thảo Mobile";
    var hotline = document.getElementById("inputHotline").value.trim() || "0357185269";
    var email = document.getElementById("inputEmail").value.trim() || "thaomobile@gmail.com";
    var diachi = document.getElementById("inputDiaChi").value.trim() || "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp";
    var giomocua = document.getElementById("inputGioMoCua").value.trim() || "08:00 - 21:30";
    var slogan = document.getElementById("inputSlogan").value.trim() || "Giao nhanh 2H • Bảo hành 12 tháng";

    var pvTen = document.getElementById("pvTenCuaHang");
    var pvHot = document.getElementById("pvHotline");
    var pvMail = document.getElementById("pvEmail");
    var pvDia = document.getElementById("pvDiaChi");
    var pvGio = document.getElementById("pvGioMoCua");
    var pvSlo = document.getElementById("pvSlogan");

    if (pvTen) pvTen.innerText = ten;
    if (pvHot) pvHot.innerText = hotline;
    if (pvMail) pvMail.innerText = email;
    if (pvDia) pvDia.innerText = diachi;
    if (pvGio) pvGio.innerText = giomocua;
    if (pvSlo) pvSlo.innerText = slogan;
}

// Lắng nghe sự kiện input để cập nhật tức thì
document.addEventListener("DOMContentLoaded", function() {
    var inputs = ["inputTenCuaHang", "inputHotline", "inputEmail", "inputDiaChi", "inputGioMoCua", "inputSlogan"];
    inputs.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", capNhatLivePreview);
        }
    });
});
</script>

<?php include("../inc/bottom.php"); ?>
