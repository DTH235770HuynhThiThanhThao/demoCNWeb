<?php include("inc/top.php"); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card border-0 text-center p-5" style="border-radius:20px; box-shadow:0 8px 40px rgba(0,0,0,0.10);">

                <!-- Icon dấu tích xanh lá -->
                <div class="mb-4">
                    <div style="width:88px;height:88px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                        <i class="bi bi-check-lg" style="font-size:3rem;color:#16a34a;line-height:1;"></i>
                    </div>
                </div>

                <h2 class="fw-bold text-dark mb-1" style="font-size:1.6rem;letter-spacing:-0.3px;">ĐẶT HÀNG THÀNH CÔNG!</h2>
                <p class="text-muted mb-4">
                    Cảm ơn quý khách <strong><?= htmlspecialchars($hoten) ?></strong>!<br>
                    <span class="small">Đơn hàng sẽ được xử lý và giao đến bạn trong thời gian sớm nhất.</span>
                </p>

                <!-- Thông tin đơn hàng -->
                <div class="rounded-3 p-4 text-start mb-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <div class="row g-3 small">
                        <div class="col-5 text-muted fw-semibold">Mã đơn hàng:</div>
                        <div class="col-7 fw-bold text-dark">
                            <span class="badge px-3 py-2" style="background:#fff1f2;color:#d70018;border:1px solid #fecdd3;font-size:0.9rem;border-radius:8px;font-family:monospace;">
                                DH<?= str_pad($donhang_id, 6, '0', STR_PAD_LEFT) ?>
                            </span>
                        </div>
                        <div class="col-5 text-muted fw-semibold">Tổng tiền:</div>
                        <div class="col-7 fw-bold fs-5" style="color:#d70018;"><?= number_format($tongtien) ?>đ</div>
                        <div class="col-5 text-muted fw-semibold">Phương thức:</div>
                        <div class="col-7 fw-bold text-dark">
                            <?php if(isset($phuongthuc_thanhtoan) && $phuongthuc_thanhtoan === 'bank'): ?>
                                <i class="bi bi-qr-code-scan text-primary me-1"></i>
                            <?php else: ?>
                                <i class="bi bi-cash-coin text-success me-1"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($ten_phuongthuc ?? 'Thanh toán khi nhận hàng (COD)') ?>
                        </div>
                    </div>
                </div>

                <!-- Thông báo riêng cho chuyển khoản -->
                <?php if(isset($phuongthuc_thanhtoan) && $phuongthuc_thanhtoan === 'bank'): ?>
                <div class="alert alert-info small mb-4 text-start" style="border-radius:10px;">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Đơn hàng sẽ được xác nhận sau khi hệ thống nhận được chuyển khoản. Vui lòng giữ lại biên lai thanh toán.
                </div>
                <?php else: ?>
                <div class="alert small mb-4 text-start" style="border-radius:10px;background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;">
                    <i class="bi bi-truck me-1"></i>
                    Nhân viên giao hàng sẽ liên hệ bạn để xác nhận trước khi giao. Hàng chính hãng, kiểm tra nguyên seal trước khi thanh toán.
                </div>
                <?php endif; ?>

                <!-- Các nút điều hướng -->
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="index.php?action=lichsumuahang"
                       class="btn btn-outline-danger rounded-pill px-4 py-2 fw-semibold"
                       style="border-color:#d70018;color:#d70018;">
                        <i class="bi bi-clock-history me-1"></i>Lịch sử đơn hàng
                    </a>
                    <a href="index.php"
                       class="btn rounded-pill px-4 py-2 fw-semibold text-white"
                       style="background:#d70018;border-color:#d70018;">
                        <i class="bi bi-bag me-1"></i>Tiếp tục mua sắm
                    </a>
                </div>

                <!-- Cam kết dưới cùng -->
                <div class="mt-4 small text-muted">
                    <i class="bi bi-shield-check text-success me-1"></i>Hàng chính hãng 100% &bull; Đổi trả miễn phí 30 ngày
                </div>
            </div>

        </div>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
