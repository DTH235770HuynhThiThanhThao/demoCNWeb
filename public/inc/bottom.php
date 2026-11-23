            </div>
        </section>
        
        <!-- Top Products & Promo Section -->
        <section class="mb-5">            
            <div class="container">
                <div class="row align-items-stretch g-4">                    
                    <div class="col-lg-6 mb-3 mb-lg-0 d-flex flex-column">
                        <?php include("inc/carousel.php"); ?>    
                    </div>
                    <div class="col-lg-6 d-flex flex-column">
                        <?php include("inc/topview.php"); ?>
                    </div>
                </div>
            </div>
        </section> 

        <!-- Modern Tech Footer (CellphoneS Style) -->
        <footer class="site-footer">
            <div class="container">
                <!-- Nút cuộn lên đầu trang -->
                <div class="text-center mb-4">
                    <a href="#top" class="btn-scroll-top text-decoration-none" title="Lên đầu trang">
                        <i class="bi bi-chevron-up"></i>
                    </a>
                </div>

                <div class="row g-4">
                    <!-- Cột 1: Thông tin thương hiệu & Liên hệ -->
                    <div class="col-lg-5 col-md-6">
                        <a href="index.php" class="text-decoration-none d-flex align-items-center mb-3">
                            <img src="../images/logo/<?php echo htmlspecialchars(!empty($logo_shop) ? $logo_shop : "logo1.jpg"); ?>" alt="<?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?>" class="rounded-3 me-3 shadow-sm" style="height: 52px; width: 52px; object-fit: cover; border: 2px solid rgba(255,255,255,0.2);" onerror="this.src='../images/logo/logo1.jpg'">
                            <div>
                                <h5 class="mb-0 fw-bold text-white"><?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?></h5>
                                <small class="text-white-50">Hệ thống bán lẻ điện thoại chính hãng</small>
                            </div>
                        </a>
                        <p class="text-white-50 small mb-3"><?php echo htmlspecialchars($thongtin_cuahang["gioithieu"] ?? "Chuyên cung cấp các dòng điện thoại cao cấp từ Apple, Samsung, OPPO, Xiaomi với chính sách giá và hậu mãi hàng đầu."); ?></p>
                        
                        <div class="footer-contact-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span><b>Địa chỉ:</b> <?php echo htmlspecialchars($diachi_shop ?? "18 Ung Văn Khiêm, phường Đông Xuyên, TP Long Xuyên, An Giang"); ?></span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span><b>Điện thoại:</b> <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $hotline_shop ?? "0763841190"); ?>" class="text-white text-decoration-none"><?php echo htmlspecialchars($hotline_shop ?? "076 3841190"); ?></a> (Hỗ trợ <?php echo htmlspecialchars($giomocua_shop ?? "8:00 - 21:30"); ?>)</span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span><b>Email:</b> <a href="mailto:<?php echo htmlspecialchars($email_shop ?? "thanhthaoshop@gmail.com"); ?>" class="text-white-50 text-decoration-none"><?php echo htmlspecialchars($email_shop ?? "thanhthaoshop@gmail.com"); ?></a></span>
                        </div>
                    </div>

                    <!-- Cột 2: Danh mục hãng -->
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">DANH MỤC HÃNG</h5>
                        <?php if(!empty($danhmuc)): foreach ($danhmuc as $d): ?>
                            <a class="footer-link" href="?action=group&id=<?php echo $d["id"]; ?>">
                                <i class="bi bi-chevron-right me-1" style="font-size: 0.75rem;"></i>Điện thoại <?php echo $d["tendanhmuc"]; ?>
                            </a>
                        <?php endforeach; endif; ?>
                    </div>

                    <!-- Cột 3: Hỗ trợ khách hàng -->
                    <div class="col-lg-4 col-md-12">
                        <h5 class="footer-title">HỖ TRỢ KHÁCH HÀNG</h5>
                        <a href="index.php?action=baohanh" class="footer-link text-white fw-bold d-inline-flex align-items-center py-1">
                            <i class="bi bi-shield-check text-warning me-2 fs-6"></i>Tra cứu & Gửi yêu cầu bảo hành
                        </a>
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-1" style="font-size: 0.75rem;"></i>Hướng dẫn mua hàng trực tuyến
                        </a>
                        <a href="index.php?action=gioithieu" class="footer-link">
                            <i class="bi bi-chevron-right me-1" style="font-size: 0.75rem;"></i>Giới thiệu & Liên hệ cửa hàng
                        </a>
                        <a href="../admin/index.php" class="footer-link text-warning">
                            <i class="bi bi-shield-lock me-1"></i>Quản trị hệ thống (Dành cho Admin / NV)
                        </a>
                        
                        <div class="mt-3 pt-2">
                            <div class="d-flex gap-2">
                                <span class="badge bg-secondary p-2"><i class="bi bi-credit-card-2-front me-1"></i> Visa / Master</span>
                                <span class="badge bg-secondary p-2"><i class="bi bi-qr-code-scan me-1"></i> VNPAY-QR</span>
                                <span class="badge bg-secondary p-2"><i class="bi bi-cash me-1"></i> COD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="m-0 text-white-50 small">&copy; <?php echo date("Y"); ?> <b><?php echo htmlspecialchars($ten_shop ?? "Thảo Mobile"); ?></b>. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <small class="text-white-50">Thương hiệu bán lẻ công nghệ uy tín hàng đầu</small>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
