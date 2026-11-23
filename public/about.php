<?php
include("inc/top.php");
?>

<style>
.about-hero {
    background: linear-gradient(135deg, #e8edf4 0%, #ffffff 100%);
    border-radius: 16px;
    padding: 40px 32px;
    box-shadow: 0 4px 24px rgba(0,196,235,0.10);
}
.about-hero .hero-logo {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 16px;
    border: 4px solid #142B4A;
    box-shadow: 0 4px 16px rgba(0,196,235,0.25);
}
.commit-card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 2px 14px rgba(0,196,235,0.12);
    transition: transform 0.22s ease, box-shadow 0.22s ease;
    height: 100%;
}
.commit-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 28px rgba(0,196,235,0.22);
}
.commit-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #142B4A 0%, #0d1f35 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px auto;
    font-size: 1.7rem;
    color: #fff;
}
.brand-card {
    border: 2px solid #e8f9fd;
    border-radius: 14px;
    padding: 24px 16px 20px 16px;
    text-align: center;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,196,235,0.09);
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    height: 100%;
}
.brand-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,196,235,0.18);
    border-color: #142B4A;
}
.brand-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #142B4A;
    margin-bottom: 8px;
}
.brand-desc {
    font-size: 0.88rem;
    color: #666;
    min-height: 44px;
}
.section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #142B4A;
    border-left: 5px solid #142B4A;
    padding-left: 12px;
    margin-bottom: 24px;
}
.contact-box {
    background: linear-gradient(135deg, #142B4A 0%, #0d1f35 100%);
    border-radius: 16px;
    color: #fff;
    padding: 36px 32px;
    box-shadow: 0 4px 24px rgba(0,196,235,0.22);
}
.contact-box .contact-info-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 10px;
    font-size: 0.97rem;
}
.contact-box .contact-info-row i {
    font-size: 1.1rem;
    margin-top: 2px;
    flex-shrink: 0;
}
</style>

<!-- ===== HERO ===== -->
<div class="about-hero mb-5 mt-2">
    <div class="d-flex flex-column flex-md-row align-items-center gap-4">
        <img src="../images/logo/<?php echo htmlspecialchars(!empty($logo_shop) ? $logo_shop : "logo2.jpg"); ?>" alt="<?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?>" class="hero-logo flex-shrink-0" onerror="this.src='../images/logo/logo2.jpg';">
        <div>
            <h2 class="fw-bold text-navy mb-2" style="font-size:1.6rem;">
                VỀ <?php echo mb_strtoupper($ten_shop ?? "Thảo Mobile", 'UTF-8'); ?> – CỬA HÀNG ĐIỆN THOẠI CHÍNH HÃNG
            </h2>
            <p class="text-secondary mb-0" style="font-size:1.02rem; line-height:1.75;">
                <?php echo nl2br(htmlspecialchars($thongtin_cuahang["gioithieu"] ?? "Thảo Mobile là hệ thống bán lẻ điện thoại di động chính hãng uy tín, chuyên cung cấp các dòng smartphone mới nhất từ 4 thương hiệu hàng đầu: Apple, Samsung, OPPO và Xiaomi với mức giá cạnh tranh cùng dịch vụ hậu mãi tận tâm.")); ?>
            </p>
        </div>
    </div>
</div>

<!-- ===== 4 CAM KẾT ===== -->
<div class="mb-5">
    <div class="section-title">Cam Kết Dịch Vụ</div>
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card commit-card text-center p-3">
                <div class="commit-icon"><i class="bi bi-patch-check-fill"></i></div>
                <h6 class="fw-bold mb-2">100% Hàng Chính Hãng</h6>
                <p class="text-muted small mb-0">Nguyên seal, đầy đủ hóa đơn, nguồn gốc rõ ràng – không lo hàng nhái hàng giả.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card commit-card text-center p-3">
                <div class="commit-icon"><i class="bi bi-shield-check"></i></div>
                <h6 class="fw-bold mb-2">Bảo Hành Uy Tín</h6>
                <p class="text-muted small mb-0">Bảo hành chính hãng 12 tháng, hỗ trợ <strong>1 đổi 1</strong> trong 30 ngày nếu lỗi nhà sản xuất.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card commit-card text-center p-3">
                <div class="commit-icon"><i class="bi bi-tags-fill"></i></div>
                <h6 class="fw-bold mb-2">Giá Tốt & Nhiều Ưu Đãi</h6>
                <p class="text-muted small mb-0">Cập nhật giá tốt mỗi ngày kèm nhiều chương trình giảm giá trực tiếp hấp dẫn.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card commit-card text-center p-3">
                <div class="commit-icon"><i class="bi bi-truck"></i></div>
                <h6 class="fw-bold mb-2">Giao Hàng Nhanh Toàn Quốc</h6>
                <p class="text-muted small mb-0">Đóng gói cẩn thận, kiểm tra hàng trước khi thanh toán – giao tận nơi nhanh chóng.</p>
            </div>
        </div>
    </div>
</div>

<!-- ===== THƯƠNG HIỆU PHÂN PHỐI ===== -->
<div class="mb-5">
    <div class="section-title">Các Thương Hiệu Phân Phối Chính</div>
    <div class="row g-4">
        <?php
        // Map tên danh mục → mô tả ngắn
        $brand_desc = [
            "Apple"   => "Dòng iPhone cao cấp, hệ sinh thái Apple bảo mật và mượt mà. Luôn có các phiên bản mới nhất.",
            "Samsung" => "Smartphone đa dạng từ phân khúc phổ thông đến cao cấp Galaxy S/Z, màn hình sắc nét.",
            "OPPO"    => "Thiết kế thời trang, camera selfie hàng đầu, pin trâu với sạc nhanh SUPERVOOC.",
            "Xiaomi"  => "Hiệu năng mạnh mẽ, giá tối ưu – lựa chọn lý tưởng cho người dùng thực dụng.",
        ];
        $brand_icon = [
            "Apple"   => "bi-apple",
            "Samsung" => "bi-phone-fill",
            "OPPO"    => "bi-camera-fill",
            "Xiaomi"  => "bi-lightning-charge-fill",
        ];
        foreach ($danhmuc as $d):
            $ten = $d["tendanhmuc"];
            $desc = $brand_desc[$ten] ?? "Các sản phẩm chính hãng, chất lượng cao.";
            $icon = $brand_icon[$ten] ?? "bi-phone";
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="brand-card d-flex flex-column">
                <div class="mb-2" style="font-size:2.2rem; color:#142B4A;">
                    <i class="bi <?php echo $icon; ?>"></i>
                </div>
                <div class="brand-name"><?php echo htmlspecialchars($ten); ?></div>
                <p class="brand-desc flex-grow-1"><?php echo $desc; ?></p>
                <a href="index.php?action=group&id=<?php echo $d["id"]; ?>"
                   class="btn btn-outline-navy btn-sm mt-2 rounded-pill fw-semibold">
                    <i class="bi bi-grid me-1"></i>Xem sản phẩm <?php echo htmlspecialchars($ten); ?>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ===== THÔNG TIN CỬA HÀNG & LIÊN HỆ ===== -->
<div class="mb-4">
    <div class="section-title">Thông Tin Cửa Hàng & Liên Hệ</div>
    <div class="contact-box">
        <div class="row align-items-center g-4">
            <div class="col-md-7">
                <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shop"></i> <?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?> – Cửa hàng điện thoại
                </h5>
                <div class="contact-info-row">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span><?php echo htmlspecialchars($diachi_shop ?? "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp"); ?></span>
                </div>
                <div class="contact-info-row">
                    <i class="bi bi-telephone-fill"></i>
                    <span><a href="tel:<?php echo preg_replace('/[^0-9]/', '', $hotline_shop ?? "0357185269"); ?>" class="text-white text-decoration-none fw-semibold"><?php echo htmlspecialchars($hotline_shop ?? "0357185269"); ?></a></span>
                </div>
                <div class="contact-info-row">
                    <i class="bi bi-envelope-fill"></i>
                    <span><a href="mailto:<?php echo htmlspecialchars($email_shop ?? "thaohuynh1092005@gmail.com"); ?>" class="text-white text-decoration-none"><?php echo htmlspecialchars($email_shop ?? "thaohuynh1092005@gmail.com"); ?></a></span>
                </div>
                <div class="contact-info-row">
                    <i class="bi bi-clock-fill"></i>
                    <span><?php echo htmlspecialchars($giomocua_shop ?? "08:00 – 21:30 (Tất cả các ngày trong tuần)"); ?></span>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <img src="../images/logo/<?php echo htmlspecialchars(!empty($logo_shop) ? $logo_shop : "logo2.jpg"); ?>" alt="<?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?>"
                     class="rounded-3 shadow mb-3"
                     style="width:100px; height:100px; object-fit:cover; border:3px solid rgba(255,255,255,0.6);"
                     onerror="this.src='../images/logo/logo2.jpg';">
                <p class="mb-3 small" style="opacity:0.9;">Chúng tôi luôn sẵn sàng phục vụ bạn với thái độ nhiệt tình và chuyên nghiệp nhất!</p>
                <a href="index.php" class="btn btn-light fw-bold rounded-pill px-4 shadow-sm">
                    <i class="bi bi-bag-heart-fill me-2 text-navy"></i>Khám phá sản phẩm ngay
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== HƯỚNG DẪN MUA HÀNG 4 BƯỚC ===== -->
<div id="huong-dan-mua-hang" style="scroll-margin-top: 90px;" class="mb-5">
    <div style="
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 14px rgba(0,0,0,0.05);
        overflow: hidden;
    ">
        <!-- Tiêu đề với thanh nhấn đỏ -->
        <div style="padding: 1.5rem 1.75rem 1rem; border-bottom: 1.5px solid #f1f5f9; display:flex; align-items:flex-start; gap:12px;">
            <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
            <div>
                <h4 style="font-weight:800; font-size:1.1rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                    <i class="bi bi-bag-check-fill me-2" style="color:#d70018;"></i>HƯỚNG DẪN MUA HÀNG TRỰC TUYẾN TẠI THẢO MOBILE
                </h4>
                <p style="font-size:0.84rem; color:#64748b; margin:0;">Chỉ 4 bước đơn giản – Nhận máy ngay tại nhà, kiểm tra trước khi thanh toán!</p>
            </div>
        </div>

        <!-- 4 thẻ bước ngang -->
        <div style="padding: 1.5rem 1.75rem;">
            <div class="row g-3">

                <!-- Bước 1 -->
                <div class="col-md-6 col-lg-3">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.1rem 1.2rem;
                        height: 100%;
                        text-align: center;
                        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
                        position: relative;
                    " class="buoc-card">
                        <!-- Vòng tròn số thứ tự -->
                        <div style="
                            width: 48px; height: 48px;
                            background: #d70018;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            margin: 0 auto 14px;
                            font-size: 1.35rem; font-weight: 800; color: #fff;
                            box-shadow: 0 4px 14px rgba(215,0,24,0.30);
                        ">1</div>
                        <div style="font-size:1.6rem; color:#d70018; margin-bottom:8px;">
                            <i class="bi bi-search"></i>
                        </div>
                        <h6 style="font-weight:700; color:#1e293b; margin-bottom:8px;">Chọn máy &amp; Phiên bản</h6>
                        <p style="font-size:0.83rem; color:#64748b; margin:0; line-height:1.6;">
                            Tìm kiếm điện thoại theo hãng <strong>Apple, Samsung, OPPO, Xiaomi</strong>, chọn đúng phiên bản dung lượng và màu sắc yêu thích.
                        </p>
                    </div>
                </div>

                <!-- Bước 2 -->
                <div class="col-md-6 col-lg-3">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.1rem 1.2rem;
                        height: 100%;
                        text-align: center;
                        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
                    " class="buoc-card">
                        <div style="
                            width: 48px; height: 48px;
                            background: #d70018;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            margin: 0 auto 14px;
                            font-size: 1.35rem; font-weight: 800; color: #fff;
                            box-shadow: 0 4px 14px rgba(215,0,24,0.30);
                        ">2</div>
                        <div style="font-size:1.6rem; color:#d70018; margin-bottom:8px;">
                            <i class="bi bi-cart-plus-fill"></i>
                        </div>
                        <h6 style="font-weight:700; color:#1e293b; margin-bottom:8px;">Đặt mua nhanh chóng</h6>
                        <p style="font-size:0.83rem; color:#64748b; margin:0; line-height:1.6;">
                            Bấm <strong>Thêm vào giỏ</strong> nếu chọn nhiều sản phẩm, hoặc bấm <strong>Mua ngay</strong> để chuyển thẳng sang bước thanh toán.
                        </p>
                    </div>
                </div>

                <!-- Bước 3 -->
                <div class="col-md-6 col-lg-3">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.1rem 1.2rem;
                        height: 100%;
                        text-align: center;
                        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
                    " class="buoc-card">
                        <div style="
                            width: 48px; height: 48px;
                            background: #d70018;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            margin: 0 auto 14px;
                            font-size: 1.35rem; font-weight: 800; color: #fff;
                            box-shadow: 0 4px 14px rgba(215,0,24,0.30);
                        ">3</div>
                        <div style="font-size:1.6rem; color:#d70018; margin-bottom:8px;">
                            <i class="bi bi-credit-card-2-front-fill"></i>
                        </div>
                        <h6 style="font-weight:700; color:#1e293b; margin-bottom:8px;">Thanh toán linh hoạt</h6>
                        <p style="font-size:0.83rem; color:#64748b; margin:0; line-height:1.6;">
                            Nhập địa chỉ nhận hàng, chọn <strong>Thanh toán khi nhận hàng (COD)</strong> hoặc <strong>Quét mã VietQR</strong> tự động điền đúng số tiền.
                        </p>
                    </div>
                </div>

                <!-- Bước 4 -->
                <div class="col-md-6 col-lg-3">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.1rem 1.2rem;
                        height: 100%;
                        text-align: center;
                        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
                    " class="buoc-card">
                        <div style="
                            width: 48px; height: 48px;
                            background: #d70018;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            margin: 0 auto 14px;
                            font-size: 1.35rem; font-weight: 800; color: #fff;
                            box-shadow: 0 4px 14px rgba(215,0,24,0.30);
                        ">4</div>
                        <div style="font-size:1.6rem; color:#d70018; margin-bottom:8px;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h6 style="font-weight:700; color:#1e293b; margin-bottom:8px;">Nhận máy &amp; Bảo hành</h6>
                        <p style="font-size:0.83rem; color:#64748b; margin:0; line-height:1.6;">
                            Nhận hàng hỏa tốc, kiểm tra máy <strong>nguyên seal</strong> trước khi thanh toán và kích hoạt bảo hành điện tử <strong>12 tháng</strong>.
                        </p>
                    </div>
                </div>

            </div><!-- /.row -->

            <!-- Mũi tên kết nối (responsive, ẩn trên mobile) -->
            <div class="d-none d-lg-flex justify-content-center align-items-center gap-1 mt-3">
                <small style="color:#d70018; font-weight:700; font-size:0.82rem; letter-spacing:0.5px;">
                    <i class="bi bi-arrow-right-circle-fill me-1"></i>Chọn máy
                    &nbsp;<i class="bi bi-arrow-right" style="color:#94a3b8;"></i>&nbsp;
                    <i class="bi bi-arrow-right-circle-fill me-1"></i>Đặt mua
                    &nbsp;<i class="bi bi-arrow-right" style="color:#94a3b8;"></i>&nbsp;
                    <i class="bi bi-arrow-right-circle-fill me-1"></i>Thanh toán
                    &nbsp;<i class="bi bi-arrow-right" style="color:#94a3b8;"></i>&nbsp;
                    <i class="bi bi-arrow-right-circle-fill me-1"></i>Nhận máy
                </small>
            </div>

            <!-- Nút CTA -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn fw-bold px-4 py-2 rounded-pill" style="background:#d70018; color:#fff; font-size:0.95rem; box-shadow:0 4px 14px rgba(215,0,24,0.28); text-decoration:none; transition:background 0.2s;"
                   onmouseover="this.style.background='#b80014'" onmouseout="this.style.background='#d70018'">
                    <i class="bi bi-bag-heart-fill me-2"></i>Mua sắm ngay tại Thảo Mobile
                </a>
            </div>
        </div><!-- /.padding -->
    </div><!-- /.card -->
</div>

<!-- ===== CHÍNH SÁCH BẢO HÀNH 1 ĐỔI 1 ===== -->
<div id="chinh-sach-bao-hanh" style="scroll-margin-top: 90px;" class="mb-5">
    <div style="
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 14px rgba(0,0,0,0.05);
        overflow: hidden;
    ">
        <!-- Tiêu đề với thanh nhấn đỏ -->
        <div style="padding: 1.5rem 1.75rem 1rem; border-bottom: 1.5px solid #f1f5f9; display:flex; align-items:flex-start; gap:12px;">
            <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
            <div>
                <h4 style="font-weight:800; font-size:1.1rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                    <i class="bi bi-shield-check me-2" style="color:#d70018;"></i>CHÍNH SÁCH BẢO HÀNH 1 ĐỔI 1 TẠI THẢO MOBILE
                </h4>
                <p style="font-size:0.84rem; color:#64748b; margin:0;">Cam kết 100% điện thoại chính hãng • Bảo hành 12 tháng • Đổi mới 30 ngày an tâm tuyệt đối</p>
            </div>
        </div>

        <div style="padding: 1.5rem 1.75rem;">
            <div class="row g-3">
                <!-- Cột 1: Thời hạn bảo hành -->
                <div class="col-md-4">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.2rem;
                        height: 100%;
                        transition: all 0.2s;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="
                                width: 44px; height: 44px;
                                background: rgba(215, 0, 24, 0.1);
                                border-radius: 12px;
                                display: flex; align-items: center; justify-content: center;
                                color: #d70018; font-size: 1.4rem;
                            ">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0;">Bảo hành chính hãng 12T</h6>
                                <small class="text-muted">Chuẩn nhà sản xuất</small>
                            </div>
                        </div>
                        <p style="font-size:0.85rem; color:#475569; line-height:1.65; margin:0;">
                            Tất cả điện thoại bán ra tại <strong>Thảo Mobile</strong> đều là máy <strong>mới 100%, nguyên seal hộp</strong>, được bảo hành chính hãng đầy đủ <strong>12 tháng</strong> theo tiêu chuẩn khắt khe từ các thương hiệu hàng đầu: <strong>Apple, Samsung, Xiaomi, OPPO</strong>.
                        </p>
                    </div>
                </div>

                <!-- Cột 2: Đặc quyền 1 đổi 1 trong 30 ngày -->
                <div class="col-md-4">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.2rem;
                        height: 100%;
                        transition: all 0.2s;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="
                                width: 44px; height: 44px;
                                background: rgba(215, 0, 24, 0.1);
                                border-radius: 12px;
                                display: flex; align-items: center; justify-content: center;
                                color: #d70018; font-size: 1.4rem;
                            ">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0;">Lỗi 1 đổi 1 trong 30 ngày</h6>
                                <small class="text-danger fw-bold">Đặc quyền Thảo Mobile</small>
                            </div>
                        </div>
                        <p style="font-size:0.85rem; color:#475569; line-height:1.65; margin:0;">
                            Nếu phát sinh lỗi phần cứng từ nhà sản xuất (màn hình, nguồn, loa, mic, camera, pin...) trong vòng <strong>30 ngày đầu</strong> kể từ ngày nhận hàng, quý khách được <strong>đổi ngay máy mới tương đương</strong> miễn phí 100% (giữ nguyên hộp, phụ kiện, máy không rơi vỡ, cấn móp hoặc vào nước).
                        </p>
                    </div>
                </div>

                <!-- Cột 3: Tiếp nhận & Tra cứu trực tuyến -->
                <div class="col-md-4">
                    <div style="
                        background: #fff;
                        border: 1.5px solid #e5e7eb;
                        border-radius: 14px;
                        padding: 1.4rem 1.2rem;
                        height: 100%;
                        transition: all 0.2s;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="
                                width: 44px; height: 44px;
                                background: rgba(215, 0, 24, 0.1);
                                border-radius: 12px;
                                display: flex; align-items: center; justify-content: center;
                                color: #d70018; font-size: 1.4rem;
                            ">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0;">Hỗ trợ tiếp nhận &amp; Tra cứu</h6>
                                <small class="text-muted">Đa kênh tiện lợi</small>
                            </div>
                        </div>
                        <p style="font-size:0.85rem; color:#475569; line-height:1.65; margin:0;">
                            Khách hàng có thể mang máy trực tiếp đến cửa hàng tại <strong>Số 57, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp</strong>, gọi hotline <strong>0357185269</strong>, hoặc gửi yêu cầu ngay tại mục <strong>Tra cứu &amp; Gửi yêu cầu bảo hành</strong> trên website.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="background:#fef2f2; border:1px dashed #f87171;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-danger fs-5"></i>
                    <span style="font-size:0.88rem; color:#991b1b;">Quý khách có thể theo dõi tiến độ bảo hành theo số điện thoại hoặc mã IMEI tại website bất cứ lúc nào.</span>
                </div>
                <a href="index.php?action=baohanh" class="btn btn-sm btn-danger fw-bold rounded-pill px-3 py-2 text-nowrap shadow-sm">
                    <i class="bi bi-search me-1"></i>Tra cứu &amp; Gửi bảo hành
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== QUY ĐỊNH KIỂM TRA HÀNG KHI NHẬN ===== -->
<div id="quy-dinh-kiem-tra-hang" style="scroll-margin-top: 90px;" class="mb-5">
    <div style="
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 14px rgba(0,0,0,0.05);
        overflow: hidden;
    ">
        <!-- Tiêu đề với thanh nhấn đỏ -->
        <div style="padding: 1.5rem 1.75rem 1rem; border-bottom: 1.5px solid #f1f5f9; display:flex; align-items:flex-start; gap:12px;">
            <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
            <div>
                <h4 style="font-weight:800; font-size:1.1rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                    <i class="bi bi-box-seam me-2" style="color:#d70018;"></i>QUY ĐỊNH KIỂM TRA HÀNG KHI NHẬN (ĐỒNG KIỂM)
                </h4>
                <p style="font-size:0.84rem; color:#64748b; margin:0;">Quyền lợi tối đa cho khách hàng – Mở gói hàng kiểm tra ngoại quan trước khi ký nhận &amp; thanh toán!</p>
            </div>
        </div>

        <div style="padding: 1.5rem 1.75rem;">
            <!-- Khối quyền đồng kiểm nổi bật -->
            <div class="p-3 mb-4 rounded-3 d-flex align-items-center gap-3" style="background: linear-gradient(135deg, rgba(215,0,24,0.05) 0%, rgba(215,0,24,0.12) 100%); border-left: 4px solid #d70018;">
                <i class="bi bi-shield-lock-fill fs-2" style="color: #d70018;"></i>
                <div>
                    <h6 class="fw-bold mb-1" style="color:#1e293b;">Quyền đồng kiểm 100% trước khi thanh toán</h6>
                    <p class="mb-0" style="font-size:0.86rem; color:#475569; line-height:1.6;">
                        <strong>Thảo Mobile</strong> hỗ trợ khách hàng <strong>mở gói hàng kiểm tra ngoại quan</strong> cùng nhân viên giao hàng trước khi ký nhận và thanh toán tiền (áp dụng cho cả đơn thanh toán khi nhận hàng COD và chuyển khoản VietQR).
                    </p>
                </div>
            </div>

            <h6 class="fw-bold mb-3" style="color:#1e293b; font-size:0.95rem;">
                <i class="bi bi-check2-circle text-danger me-1"></i>Các bước kiểm tra tiêu chuẩn:
            </h6>

            <div class="row g-3 mb-4">
                <!-- Bước 1 -->
                <div class="col-md-4">
                    <div style="
                        background: #f8fafc;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 12px;
                        padding: 1.2rem;
                        height: 100%;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge" style="background:#d70018; font-size:0.8rem; border-radius:50%; width:24px; height:24px; display:inline-flex; align-items:center; justify-content:center;">1</span>
                            <strong style="color:#1e293b; font-size:0.9rem;">Hộp máy &amp; Tem niêm phong</strong>
                        </div>
                        <p style="font-size:0.83rem; color:#475569; line-height:1.6; margin:0;">
                            Kiểm tra tính nguyên vẹn của hộp sản phẩm, tem niêm phong (seal) của hãng và thông tin tên máy, dung lượng, màu sắc in trên vỏ hộp khớp với đơn đặt hàng.
                        </p>
                    </div>
                </div>

                <!-- Bước 2 -->
                <div class="col-md-4">
                    <div style="
                        background: #f8fafc;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 12px;
                        padding: 1.2rem;
                        height: 100%;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge" style="background:#d70018; font-size:0.8rem; border-radius:50%; width:24px; height:24px; display:inline-flex; align-items:center; justify-content:center;">2</span>
                            <strong style="color:#1e293b; font-size:0.9rem;">Ngoại quan thân máy</strong>
                        </div>
                        <p style="font-size:0.83rem; color:#475569; line-height:1.6; margin:0;">
                            Kiểm tra ngoại quan thân máy, màn hình, khung viền không bị trầy xước, cấn móp do quá trình vận chuyển.
                        </p>
                    </div>
                </div>

                <!-- Bước 3 -->
                <div class="col-md-4">
                    <div style="
                        background: #f8fafc;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 12px;
                        padding: 1.2rem;
                        height: 100%;
                    " class="policy-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge" style="background:#d70018; font-size:0.8rem; border-radius:50%; width:24px; height:24px; display:inline-flex; align-items:center; justify-content:center;">3</span>
                            <strong style="color:#1e293b; font-size:0.9rem;">Phụ kiện chuẩn đi kèm</strong>
                        </div>
                        <p style="font-size:0.83rem; color:#475569; line-height:1.6; margin:0;">
                            Kiểm tra đầy đủ phụ kiện chuẩn đi kèm bên trong hộp theo công bố của hãng (cáp sạc, que chọc sim, tài liệu hướng dẫn...).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Xử lý khi phát hiện bất thường -->
            <div style="background:#fff1f2; border:1.5px solid #fecdd3; border-radius:12px; padding:1.25rem 1.4rem;">
                <div class="d-flex align-items-start gap-3">
                    <div style="width:36px; height:36px; background:#d70018; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; flex-shrink:0; margin-top:2px;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#9f1239;">Xử lý khi phát hiện bất thường</h6>
                        <p style="font-size:0.85rem; color:#4c0519; line-height:1.65; margin:0;">
                            Nếu hộp hàng có dấu hiệu bị rách niêm phong, móp méo hoặc giao sai phiên bản/màu sắc, quý khách vui lòng <strong>từ chối nhận hàng</strong> và liên hệ ngay hotline <strong class="text-danger">0357185269</strong> để cửa hàng đổi gửi lại sản phẩm mới ngay lập tức mà <strong>không phát sinh bất kỳ chi phí nào</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.buoc-card:hover, .policy-card:hover {
    border-color: #fecdd3 !important;
    box-shadow: 0 6px 22px rgba(215,0,24,0.10);
    transform: translateY(-4px);
}
</style>

<?php
include("inc/bottom.php");
?>
