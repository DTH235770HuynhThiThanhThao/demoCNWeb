<?php include("inc/top.php"); ?>

<style>
/* ══════════════════════════════════════════════
   ABOUT PAGE — Tech Flagship #d70018 · Thảo Mobile
   ══════════════════════════════════════════════ */

/* Thanh nhấn tiêu đề mục */
.section-label {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
}
.section-label-bar {
    width: 4px;
    height: 22px;
    background: #d70018;
    border-radius: 99px;
    flex-shrink: 0;
}
.section-label-text {
    font-size: 1.05rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: 0.2px;
    text-transform: uppercase;
}

/* Thẻ cam kết */
.commit-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 16px;
    padding: 28px 20px 24px;
    text-align: center;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.commit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 28px rgba(215,0,24,0.10);
    border-color: #fecdd3;
}
.commit-icon-wrap {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #fff1f2;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    font-size: 1.45rem;
    color: #d70018;
}

/* Thẻ thương hiệu */
.brand-card {
    background: #fff;
    border: 1px solid #f1f5f9;
    border-radius: 16px;
    padding: 28px 20px 22px;
    text-align: center;
    height: 100%;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.brand-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 28px rgba(215,0,24,0.10);
    border-color: #d70018;
}
.brand-card .brand-icon {
    font-size: 2.4rem;
    color: #1e293b;
    margin-bottom: 10px;
    transition: color 0.2s;
}
.brand-card:hover .brand-icon {
    color: #d70018;
}
.brand-card .brand-name {
    font-size: 1.1rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
}
.brand-card .brand-desc {
    font-size: 0.84rem;
    color: #64748b;
    flex-grow: 1;
    line-height: 1.6;
    margin-bottom: 14px;
}
.brand-card .brand-cta {
    font-size: 0.84rem;
    font-weight: 700;
    color: #d70018;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Huy hiệu hero */
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fff1f2;
    color: #d70018;
    font-size: 0.78rem;
    font-weight: 700;
    border-radius: 20px;
    padding: 4px 10px;
    border: 1px solid #fecdd3;
}

/* Thẻ bước mua hàng & chính sách */
.buoc-card, .policy-card {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 1.4rem 1.1rem 1.2rem;
    height: 100%;
    text-align: center;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}
.buoc-card:hover, .policy-card:hover {
    border-color: #fecdd3 !important;
    box-shadow: 0 6px 22px rgba(215,0,24,0.10);
    transform: translateY(-4px);
}
.policy-card { text-align: left; }

/* Thẻ liên hệ & thanh toán */
.contact-info-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.95rem;
    color: #334155;
    margin-bottom: 10px;
}
.contact-info-row i {
    color: #d70018;
    font-size: 1rem;
    margin-top: 2px;
    flex-shrink: 0;
}
</style>

<!-- ═══════════════════════════════
     1. HERO GIỚI THIỆU
     ═══════════════════════════════ -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 mt-2">
    <!-- Dải nhấn đỏ phía trên -->
    <div style="height: 4px; background: #d70018;"></div>
    <div class="card-body p-4 p-lg-5">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <!-- Logo TT -->
            <div class="flex-shrink-0 text-center">
                <div style="width:88px; height:88px; border-radius:16px; border:1.5px solid #e2e8f0; box-shadow:0 4px 16px rgba(0,0,0,0.08); background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; margin:0 auto;">
                    <img src="../images/logo/<?php echo htmlspecialchars(!empty($logo_shop) ? $logo_shop : 'logo2.jpg'); ?>"
                         alt="<?php echo htmlspecialchars($ten_shop ?? 'Thảo Mobile'); ?>"
                         style="width:80px; height:80px; object-fit:contain;"
                         onerror="this.src='../images/logo/logo2.jpg';">
                </div>
            </div>
            <!-- Nội dung -->
            <div class="flex-grow-1">
                <h2 class="fw-bold mb-2" style="font-size:1.45rem; color:#0f172a; line-height:1.3;">
                    VỀ <?php echo mb_strtoupper(htmlspecialchars($ten_shop ?? 'Thảo Mobile'), 'UTF-8'); ?> – CỬA HÀNG ĐIỆN THOẠI CHÍNH HÃNG
                </h2>
                <p class="text-secondary mb-3" style="font-size:0.97rem; line-height:1.75;">
                    <?php echo nl2br(htmlspecialchars($thongtin_cuahang["gioithieu"] ?? "Thảo Mobile là hệ thống bán lẻ điện thoại di động chính hãng uy tín, chuyên cung cấp các dòng smartphone mới nhất từ 4 thương hiệu hàng đầu: Apple, Samsung, OPPO và Xiaomi với mức giá cạnh tranh cùng dịch vụ hậu mãi tận tâm.")); ?>
                </p>
                <!-- 3 huy hiệu -->
                <div class="d-flex flex-wrap gap-2">
                    <span class="hero-badge"><i class="bi bi-patch-check-fill"></i> Chính hãng VN/A</span>
                    <span class="hero-badge"><i class="bi bi-lightning-charge-fill"></i> Giao nhanh 2H</span>
                    <span class="hero-badge"><i class="bi bi-qr-code-scan"></i> VietQR &amp; COD tiện lợi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════
     2. CAM KẾT DỊCH VỤ
     ═══════════════════════════════ -->
<div class="mb-4">
    <div class="section-label">
        <div class="section-label-bar"></div>
        <span class="section-label-text">Cam Kết Dịch Vụ</span>
    </div>
    <div class="row g-3">
        <div class="col-md-3 col-sm-6">
            <div class="commit-card shadow-sm">
                <div class="commit-icon-wrap"><i class="bi bi-patch-check-fill"></i></div>
                <h6 class="fw-bold mb-2" style="color:#0f172a;">100% Hàng Chính Hãng</h6>
                <p class="text-muted small mb-0" style="line-height:1.6;">Nguyên seal, đầy đủ hóa đơn, nguồn gốc rõ ràng – không lo hàng nhái hàng giả.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="commit-card shadow-sm">
                <div class="commit-icon-wrap"><i class="bi bi-shield-check"></i></div>
                <h6 class="fw-bold mb-2" style="color:#0f172a;">Bảo Hành Uy Tín</h6>
                <p class="text-muted small mb-0" style="line-height:1.6;">Bảo hành chính hãng 12 tháng, hỗ trợ <strong>1 đổi 1</strong> trong 30 ngày nếu lỗi nhà sản xuất.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="commit-card shadow-sm">
                <div class="commit-icon-wrap"><i class="bi bi-tags-fill"></i></div>
                <h6 class="fw-bold mb-2" style="color:#0f172a;">Giá Tốt &amp; Nhiều Ưu Đãi</h6>
                <p class="text-muted small mb-0" style="line-height:1.6;">Cập nhật giá tốt mỗi ngày kèm nhiều chương trình giảm giá trực tiếp hấp dẫn.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="commit-card shadow-sm">
                <div class="commit-icon-wrap"><i class="bi bi-truck"></i></div>
                <h6 class="fw-bold mb-2" style="color:#0f172a;">Giao Hàng Nhanh Toàn Quốc</h6>
                <p class="text-muted small mb-0" style="line-height:1.6;">Đóng gói cẩn thận, kiểm tra hàng trước khi thanh toán – giao tận nơi nhanh chóng.</p>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════
     3. THƯƠNG HIỆU PHÂN PHỐI CHÍNH
     ═══════════════════════════════ -->
<div class="mb-4">
    <div class="section-label">
        <div class="section-label-bar"></div>
        <span class="section-label-text">Các Thương Hiệu Phân Phối Chính</span>
    </div>
    <div class="row g-3">
        <?php
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
            $ten  = $d["tendanhmuc"];
            $desc = $brand_desc[$ten] ?? "Các sản phẩm chính hãng, chất lượng cao.";
            $icon = $brand_icon[$ten] ?? "bi-phone";
        ?>
        <div class="col-md-3 col-sm-6">
            <a href="index.php?action=group&id=<?php echo $d["id"]; ?>" class="brand-card shadow-sm text-decoration-none">
                <div class="brand-icon"><i class="bi <?php echo $icon; ?>"></i></div>
                <div class="brand-name"><?php echo htmlspecialchars($ten); ?></div>
                <p class="brand-desc"><?php echo $desc; ?></p>
                <span class="brand-cta">Xem sản phẩm <i class="bi bi-arrow-right"></i></span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ═══════════════════════════════
     4. THÔNG TIN LIÊN HỆ & THANH TOÁN
     ═══════════════════════════════ -->
<div class="mb-4">
    <div class="section-label">
        <div class="section-label-bar"></div>
        <span class="section-label-text">Thông Tin Liên Hệ &amp; Cửa Hàng</span>
    </div>
    <div class="row g-3">
        <!-- Cột trái: Thông tin liên hệ trực tiếp -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width:36px; height:36px; background:#fff1f2; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1rem;">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h6 class="fw-bold mb-0" style="color:#0f172a; font-size:0.97rem;">
                            <?php echo htmlspecialchars($ten_shop ?? 'Thảo Mobile'); ?> – Cửa hàng điện thoại chính hãng
                        </h6>
                    </div>
                    <div class="contact-info-row">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span><?php echo htmlspecialchars($diachi_shop ?? 'Số 57, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp'); ?></span>
                    </div>
                    <div class="contact-info-row">
                        <i class="bi bi-telephone-fill"></i>
                        <span>
                            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $hotline_shop ?? '0357185269'); ?>"
                               class="fw-bold text-decoration-none" style="color:#d70018;">
                                <?php echo htmlspecialchars($hotline_shop ?? '0357185269'); ?>
                            </a>
                            <span class="text-muted small ms-2">(Hỗ trợ 7 ngày/tuần)</span>
                        </span>
                    </div>
                    <div class="contact-info-row">
                        <i class="bi bi-envelope-fill"></i>
                        <span>
                            <a href="mailto:<?php echo htmlspecialchars($email_shop ?? 'thaohuynh1092005@gmail.com'); ?>"
                               class="text-decoration-none" style="color:#334155;">
                                <?php echo htmlspecialchars($email_shop ?? 'thaohuynh1092005@gmail.com'); ?>
                            </a>
                        </span>
                    </div>
                    <div class="contact-info-row">
                        <i class="bi bi-clock-fill"></i>
                        <span><?php echo htmlspecialchars($giomocua_shop ?? '08:00 – 21:30 (Tất cả các ngày trong tuần)'); ?></span>
                    </div>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-sm fw-bold px-4 py-2 rounded-pill"
                           style="background:#d70018; color:#fff; font-size:0.88rem; box-shadow:0 3px 10px rgba(215,0,24,0.25);">
                            <i class="bi bi-bag-heart-fill me-1"></i>Mua sắm ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột phải: Hình thức thanh toán & hậu mãi -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width:36px; height:36px; background:#fff1f2; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1rem;">
                            <i class="bi bi-credit-card-2-front-fill"></i>
                        </div>
                        <h6 class="fw-bold mb-0" style="color:#0f172a; font-size:0.97rem;">Hình thức thanh toán &amp; Hậu mãi</h6>
                    </div>

                    <!-- Thanh toán VietQR -->
                    <div class="d-flex align-items-start gap-3 p-3 rounded-3 mb-2" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <div style="width:38px; height:38px; background:#fff1f2; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1.1rem; flex-shrink:0;">
                            <i class="bi bi-qr-code-scan"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="color:#0f172a; font-size:0.9rem;">Chuyển khoản VietQR</div>
                            <div class="text-muted small" style="line-height:1.5;">Quét mã QR tự động điền đúng số tiền – thanh toán nhanh, an toàn, không nhầm lẫn.</div>
                        </div>
                    </div>

                    <!-- COD -->
                    <div class="d-flex align-items-start gap-3 p-3 rounded-3 mb-2" style="background:#f8fafc; border:1px solid #e2e8f0;">
                        <div style="width:38px; height:38px; background:#fff1f2; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1.1rem; flex-shrink:0;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="color:#0f172a; font-size:0.9rem;">Thanh toán khi nhận hàng (COD)</div>
                            <div class="text-muted small" style="line-height:1.5;">Nhận hàng, <strong>kiểm tra máy nguyên seal trước</strong> rồi mới thanh toán – hoàn toàn yên tâm.</div>
                        </div>
                    </div>

                    <!-- Lưu ý -->
                    <div class="d-flex align-items-start gap-2 p-3 rounded-3" style="background:#fff1f2; border:1px solid #fecdd3;">
                        <i class="bi bi-info-circle-fill text-danger mt-1" style="font-size:0.9rem; flex-shrink:0;"></i>
                        <div class="small" style="color:#9f1239; line-height:1.55;">
                            Thảo Mobile <strong>không hỗ trợ trả góp 0%</strong>. Chỉ áp dụng 2 hình thức thanh toán trên để đảm bảo giá tốt nhất cho khách hàng.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════
     5. HƯỚNG DẪN MUA HÀNG 4 BƯỚC
     ═══════════════════════════════ -->
<div id="huong-dan-mua-hang" style="scroll-margin-top: 90px;" class="mb-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom" style="border-color:#f1f5f9!important;">
            <div class="d-flex align-items-start gap-3">
                <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
                <div>
                    <h4 style="font-weight:800; font-size:1.05rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                        <i class="bi bi-bag-check-fill me-2" style="color:#d70018;"></i>Hướng Dẫn Mua Hàng Trực Tuyến Tại Thảo Mobile
                    </h4>
                    <p style="font-size:0.83rem; color:#64748b; margin:0;">Chỉ 4 bước đơn giản – Nhận máy ngay tại nhà, kiểm tra trước khi thanh toán!</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <?php
                $buoc_list = [
                    ["so"=>"1","icon"=>"bi-search",                 "title"=>"Chọn máy &amp; Phiên bản",   "desc"=>"Tìm kiếm điện thoại theo hãng <strong>Apple, Samsung, OPPO, Xiaomi</strong>, chọn đúng phiên bản dung lượng và màu sắc yêu thích."],
                    ["so"=>"2","icon"=>"bi-cart-plus-fill",         "title"=>"Đặt mua nhanh chóng",         "desc"=>"Bấm <strong>Thêm vào giỏ</strong> nếu chọn nhiều sản phẩm, hoặc bấm <strong>Mua ngay</strong> để chuyển thẳng sang bước thanh toán."],
                    ["so"=>"3","icon"=>"bi-credit-card-2-front-fill","title"=>"Thanh toán linh hoạt",        "desc"=>"Nhập địa chỉ nhận hàng, chọn <strong>Thanh toán khi nhận hàng (COD)</strong> hoặc <strong>Quét mã VietQR</strong> tự động điền đúng số tiền."],
                    ["so"=>"4","icon"=>"bi-box-seam-fill",          "title"=>"Nhận máy &amp; Bảo hành",     "desc"=>"Nhận hàng hỏa tốc, kiểm tra máy <strong>nguyên seal</strong> trước khi thanh toán và kích hoạt bảo hành điện tử <strong>12 tháng</strong>."],
                ];
                foreach($buoc_list as $b):
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="buoc-card">
                        <div style="width:48px; height:48px; background:#d70018; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:1.3rem; font-weight:800; color:#fff; box-shadow:0 4px 14px rgba(215,0,24,0.28);">
                            <?php echo $b["so"]; ?>
                        </div>
                        <div style="font-size:1.5rem; color:#d70018; margin-bottom:8px;">
                            <i class="bi <?php echo $b["icon"]; ?>"></i>
                        </div>
                        <h6 style="font-weight:700; color:#1e293b; margin-bottom:8px; font-size:0.92rem;"><?php echo $b["title"]; ?></h6>
                        <p style="font-size:0.82rem; color:#64748b; margin:0; line-height:1.6;"><?php echo $b["desc"]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Luồng mũi tên (desktop) -->
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

            <!-- CTA -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn fw-bold px-4 py-2 rounded-pill"
                   style="background:#d70018; color:#fff; font-size:0.93rem; box-shadow:0 4px 14px rgba(215,0,24,0.28);"
                   onmouseover="this.style.background='#b80014'" onmouseout="this.style.background='#d70018'">
                    <i class="bi bi-bag-heart-fill me-2"></i>Mua sắm ngay tại Thảo Mobile
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════
     6. CHÍNH SÁCH BẢO HÀNH 1 ĐỔI 1
     ═══════════════════════════════ -->
<div id="chinh-sach-bao-hanh" style="scroll-margin-top: 90px;" class="mb-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom" style="border-color:#f1f5f9!important;">
            <div class="d-flex align-items-start gap-3">
                <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
                <div>
                    <h4 style="font-weight:800; font-size:1.05rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                        <i class="bi bi-shield-check me-2" style="color:#d70018;"></i>Chính Sách Bảo Hành 1 Đổi 1 Tại Thảo Mobile
                    </h4>
                    <p style="font-size:0.83rem; color:#64748b; margin:0;">Cam kết 100% điện thoại chính hãng • Bảo hành 12 tháng • Đổi mới 30 ngày an tâm tuyệt đối</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <!-- Cột 1 -->
                <div class="col-md-4">
                    <div class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:44px; height:44px; background:#fff1f2; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1.3rem; flex-shrink:0;">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0; font-size:0.9rem;">Bảo hành chính hãng 12T</h6>
                                <small class="text-muted">Chuẩn nhà sản xuất</small>
                            </div>
                        </div>
                        <p style="font-size:0.84rem; color:#475569; line-height:1.65; margin:0;">
                            Tất cả điện thoại tại <strong>Thảo Mobile</strong> đều là máy <strong>mới 100%, nguyên seal hộp</strong>, bảo hành chính hãng <strong>12 tháng</strong> từ Apple, Samsung, Xiaomi, OPPO.
                        </p>
                    </div>
                </div>
                <!-- Cột 2 -->
                <div class="col-md-4">
                    <div class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:44px; height:44px; background:#fff1f2; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1.3rem; flex-shrink:0;">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0; font-size:0.9rem;">Lỗi 1 đổi 1 trong 30 ngày</h6>
                                <small class="text-danger fw-bold">Đặc quyền Thảo Mobile</small>
                            </div>
                        </div>
                        <p style="font-size:0.84rem; color:#475569; line-height:1.65; margin:0;">
                            Phát sinh lỗi phần cứng trong <strong>30 ngày đầu</strong> → <strong>đổi ngay máy mới</strong> miễn phí 100% (giữ nguyên hộp, phụ kiện, máy không rơi vỡ hoặc vào nước).
                        </p>
                    </div>
                </div>
                <!-- Cột 3 -->
                <div class="col-md-4">
                    <div class="policy-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:44px; height:44px; background:#fff1f2; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#d70018; font-size:1.3rem; flex-shrink:0;">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700; color:#1e293b; margin:0; font-size:0.9rem;">Hỗ trợ tiếp nhận &amp; Tra cứu</h6>
                                <small class="text-muted">Đa kênh tiện lợi</small>
                            </div>
                        </div>
                        <p style="font-size:0.84rem; color:#475569; line-height:1.65; margin:0;">
                            Mang máy đến <strong>Số 57, ấp An Hòa, Lai Vung, Đồng Tháp</strong>, gọi hotline <strong>0357185269</strong>, hoặc gửi yêu cầu tại mục <strong>Tra cứu bảo hành</strong> trên website.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2"
                 style="background:#fef2f2; border:1px dashed #f87171;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-danger fs-5"></i>
                    <span style="font-size:0.87rem; color:#991b1b;">Quý khách có thể theo dõi tiến độ bảo hành theo số điện thoại hoặc mã IMEI tại website bất cứ lúc nào.</span>
                </div>
                <a href="index.php?action=baohanh" class="btn btn-sm btn-danger fw-bold rounded-pill px-3 py-2 text-nowrap shadow-sm">
                    <i class="bi bi-search me-1"></i>Tra cứu &amp; Gửi bảo hành
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════
     7. QUY ĐỊNH KIỂM TRA HÀNG KHI NHẬN
     ═══════════════════════════════ -->
<div id="quy-dinh-kiem-tra-hang" style="scroll-margin-top: 90px;" class="mb-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom" style="border-color:#f1f5f9!important;">
            <div class="d-flex align-items-start gap-3">
                <div style="width:5px; min-height:48px; background:#d70018; border-radius:4px; flex-shrink:0; margin-top:2px;"></div>
                <div>
                    <h4 style="font-weight:800; font-size:1.05rem; color:#1e293b; text-transform:uppercase; letter-spacing:0.4px; margin:0 0 4px 0;">
                        <i class="bi bi-box-seam me-2" style="color:#d70018;"></i>Quy Định Kiểm Tra Hàng Khi Nhận (Đồng Kiểm)
                    </h4>
                    <p style="font-size:0.83rem; color:#64748b; margin:0;">Quyền lợi tối đa – Mở gói kiểm tra ngoại quan trước khi ký nhận &amp; thanh toán!</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <!-- Khối quyền đồng kiểm -->
            <div class="p-3 mb-4 rounded-3 d-flex align-items-center gap-3"
                 style="background:linear-gradient(135deg,rgba(215,0,24,0.04) 0%,rgba(215,0,24,0.10) 100%); border-left:4px solid #d70018;">
                <i class="bi bi-shield-lock-fill fs-2" style="color:#d70018;"></i>
                <div>
                    <h6 class="fw-bold mb-1" style="color:#1e293b;">Quyền đồng kiểm 100% trước khi thanh toán</h6>
                    <p class="mb-0" style="font-size:0.85rem; color:#475569; line-height:1.6;">
                        <strong>Thảo Mobile</strong> hỗ trợ khách hàng <strong>mở gói hàng kiểm tra ngoại quan</strong> cùng nhân viên giao hàng trước khi ký nhận và thanh toán (áp dụng cho cả COD và VietQR).
                    </p>
                </div>
            </div>

            <h6 class="fw-bold mb-3" style="color:#1e293b; font-size:0.93rem;">
                <i class="bi bi-check2-circle text-danger me-1"></i>Các bước kiểm tra tiêu chuẩn:
            </h6>

            <div class="row g-3 mb-4">
                <?php
                $check_steps = [
                    ["so"=>"1","title"=>"Hộp máy &amp; Tem niêm phong","desc"=>"Kiểm tra tính nguyên vẹn của hộp sản phẩm, tem niêm phong (seal) và thông tin tên máy, dung lượng, màu sắc khớp với đơn đặt hàng."],
                    ["so"=>"2","title"=>"Ngoại quan thân máy",         "desc"=>"Kiểm tra thân máy, màn hình, khung viền không bị trầy xước, cấn móp do quá trình vận chuyển."],
                    ["so"=>"3","title"=>"Phụ kiện chuẩn đi kèm",      "desc"=>"Kiểm tra đầy đủ phụ kiện chuẩn trong hộp theo công bố của hãng (cáp sạc, que chọc sim, tài liệu hướng dẫn...)."],
                ];
                foreach($check_steps as $cs):
                ?>
                <div class="col-md-4">
                    <div style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:1.2rem; height:100%;" class="policy-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge" style="background:#d70018; font-size:0.78rem; border-radius:50%; width:24px; height:24px; display:inline-flex; align-items:center; justify-content:center;"><?php echo $cs["so"]; ?></span>
                            <strong style="color:#1e293b; font-size:0.88rem;"><?php echo $cs["title"]; ?></strong>
                        </div>
                        <p style="font-size:0.82rem; color:#475569; line-height:1.6; margin:0;"><?php echo $cs["desc"]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Xử lý khi phát hiện bất thường -->
            <div style="background:#fff1f2; border:1.5px solid #fecdd3; border-radius:12px; padding:1.25rem 1.4rem;">
                <div class="d-flex align-items-start gap-3">
                    <div style="width:36px; height:36px; background:#d70018; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; flex-shrink:0; margin-top:2px;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#9f1239;">Xử lý khi phát hiện bất thường</h6>
                        <p style="font-size:0.84rem; color:#4c0519; line-height:1.65; margin:0;">
                            Nếu hộp hàng có dấu hiệu bị rách niêm phong, móp méo hoặc giao sai phiên bản/màu sắc, quý khách vui lòng <strong>từ chối nhận hàng</strong> và liên hệ ngay hotline <strong class="text-danger">0357185269</strong> để cửa hàng đổi gửi lại sản phẩm mới ngay lập tức mà <strong>không phát sinh bất kỳ chi phí nào</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
