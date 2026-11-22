<?php include("inc/top.php"); ?>

<!-- 1. Thanh điều hướng Breadcrumb trên cùng -->
<div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-shop mb-0">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door me-1"></i>Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="index.php?action=giohang">Giỏ hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh toán đơn hàng</li>
        </ol>
    </nav>
    <a href="index.php?action=giohang" class="text-decoration-none small fw-semibold text-danger">
        <i class="bi bi-arrow-left me-1"></i>Quay lại giỏ hàng
    </a>
</div>

<!-- Form thanh toán lưu đơn hàng (action=luudonhang) bao trọn 2 cột -->
<form method="post" action="index.php" id="form-checkout">
    <!-- Các input ẩn lưu đơn hàng giữ đúng 100% logic của giảng viên -->
    <input type="hidden" name="action" value="luudonhang">
    <?php if(isset($_SESSION["khachhang"])): ?>
        <input type="hidden" name="txtid" value="<?php echo $_SESSION["khachhang"]["id"]; ?>">
    <?php endif; ?>
    <?php foreach($giohang as $id => $mh): ?>
        <input type="hidden" name="chon_mathang[]" value="<?php echo $id; ?>">
    <?php endforeach; ?>

    <div class="row g-4 mb-4">
        <!-- CỘT TRÁI (col-lg-7): THÔNG TIN NGƯỜI NHẬN & HÌNH THỨC THANH TOÁN -->
        <div class="col-lg-7">
            <!-- 1. Thẻ Thông tin giao hàng -->
            <div class="checkout-card mb-4">
                <div class="checkout-card-header">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>THÔNG TIN NHẬN HÀNG</span>
                </div>

                <div class="row g-3">
                    <?php if(isset($_SESSION["khachhang"])): ?>
                        <!-- Khách hàng đã đăng nhập -->
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Họ và tên người nhận (*)</label>
                            <input type="text" class="form-control form-control-checkout" name="txthoten" value="<?php echo htmlspecialchars($_SESSION["khachhang"]["hoten"]); ?>" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Số điện thoại (*)</label>
                            <input type="number" class="form-control form-control-checkout" name="txtsodienthoai" value="<?php echo htmlspecialchars($_SESSION["khachhang"]["sodienthoai"]); ?>" readonly required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Email xác nhận đơn hàng (*)</label>
                            <input type="email" class="form-control form-control-checkout" name="txtemail" value="<?php echo htmlspecialchars($_SESSION["khachhang"]["email"]); ?>" readonly required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Địa chỉ giao hàng chi tiết (*)</label>
                            <textarea class="form-control form-control-checkout" name="txtdiachi" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." required><?php echo isset($diachi["diachi"]) ? htmlspecialchars($diachi["diachi"]) : ""; ?></textarea>
                            <div class="form-text small text-muted mt-1">
                                <i class="bi bi-info-circle text-primary me-1"></i>Địa chỉ chính xác sẽ giúp đơn hàng được giao nhanh trong vòng 2H.
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Khách hàng vãng lai -->
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Họ và tên người nhận (*)</label>
                            <input type="text" class="form-control form-control-checkout" name="txthoten" placeholder="Nhập họ và tên..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Số điện thoại (*)</label>
                            <input type="number" class="form-control form-control-checkout" name="txtsodienthoai" placeholder="Nhập số điện thoại..." required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Email xác nhận đơn hàng (*)</label>
                            <input type="email" class="form-control form-control-checkout" name="txtemail" placeholder="example@gmail.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Địa chỉ giao hàng chi tiết (*)</label>
                            <textarea class="form-control form-control-checkout" name="txtdiachi" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." required></textarea>
                            <div class="form-text small text-muted mt-1">
                                <i class="bi bi-info-circle text-primary me-1"></i>Địa chỉ chính xác sẽ giúp đơn hàng được giao nhanh trong vòng 2H.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 2. Thẻ Phương thức thanh toán -->
            <div class="checkout-card">
                <div class="checkout-card-header">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                    <span>PHƯƠNG THỨC THANH TOÁN</span>
                </div>

                <!-- Lựa chọn 1: COD -->
                <div class="payment-method-card active" onclick="chonPhuongThuc(this, 'cod')">
                    <div class="payment-method-icon text-success">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="fw-bold text-dark">Thanh toán khi nhận hàng (COD)</div>
                            <input class="form-check-input cart-checkbox m-0" type="radio" name="payment_method" value="cod" checked>
                        </div>
                        <div class="text-muted small mt-1">Kiểm tra máy nguyên seal trước khi thanh toán cho nhân viên giao hàng.</div>
                    </div>
                </div>

                <!-- Lựa chọn 2: Chuyển khoản ngân hàng / QR -->
                <div class="payment-method-card" onclick="chonPhuongThuc(this, 'bank')">
                    <div class="payment-method-icon text-primary">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="fw-bold text-dark">Chuyển khoản ngân hàng / Quét mã QR</div>
                            <input class="form-check-input cart-checkbox m-0" type="radio" name="payment_method" value="bank">
                        </div>
                        <div class="text-muted small mt-1">Xác nhận nhanh chóng, miễn phí vận chuyển hỏa tốc toàn quốc.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CỘT PHẢI (col-lg-5): TÓM TẮT ĐƠN HÀNG & NÚT HOÀN TẤT ĐẶT HÀNG (STICKY-TOP) -->
        <div class="col-lg-5">
            <div class="checkout-card sticky-top" style="top: 85px;">
                <div class="checkout-card-header">
                    <i class="bi bi-bag-check-fill"></i>
                    <span>ĐƠN HÀNG CỦA BẠN (<?php echo count($giohang); ?> sản phẩm)</span>
                </div>

                <!-- Danh sách sản phẩm thanh toán -->
                <div class="mb-3" style="max-height: 280px; overflow-y: auto;">
                    <?php 
                    $tongtien_thanhtoan = 0;
                    foreach($giohang as $id => $mh): 
                        $tongtien_thanhtoan += $mh["thanhtien"];
                    ?>
                    <div class="checkout-item-row">
                        <!-- Ảnh đại diện có badge số lượng -->
                        <div class="checkout-thumb-box">
                            <img src="../<?php echo $mh["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($mh["tenmathang"]); ?>">
                            <span class="checkout-qty-badge">x<?php echo $mh["soluong"]; ?></span>
                        </div>

                        <!-- Tên sản phẩm & nhãn -->
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-bold text-dark text-truncate small" title="<?php echo htmlspecialchars($mh["tenmathang"]); ?>">
                                <?php echo $mh["tenmathang"]; ?>
                            </div>
                            <div class="text-muted" style="font-size: 0.74rem;">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-1 py-0" style="font-size: 0.68rem;">Chính hãng VN/A</span>
                            </div>
                        </div>

                        <!-- Thành tiền -->
                        <div class="text-end flex-shrink-0">
                            <span class="fw-bold text-danger"><?php echo number_format($mh["thanhtien"]); ?>đ</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Khung tính tiền -->
                <div class="d-flex justify-content-between align-items-center mb-2 small">
                    <span class="text-muted">Tạm tính:</span>
                    <span class="fw-bold text-dark"><?php echo number_format($tongtien_thanhtoan); ?>đ</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2 small">
                    <span class="text-muted">Phí vận chuyển:</span>
                    <span class="text-success fw-bold"><i class="bi bi-check2-circle me-1"></i>Miễn phí</span>
                </div>

                <hr class="my-3" style="border-style: dashed; border-color: #cbd5e1;">

                <div class="d-flex justify-content-between align-items-baseline mb-3">
                    <span class="fw-bold text-dark fs-6">Tổng cộng thanh toán:</span>
                    <span class="fw-bold text-danger fs-4"><?php echo number_format($tongtien_thanhtoan); ?>đ</span>
                </div>

                <!-- Nút đặt hàng chính -->
                <button type="submit" class="btn btn-buy-now-lg w-100 py-3 shadow" id="btn-hoantat">
                    <i class="bi bi-check2-circle me-2 fs-5"></i>
                    <span>HOÀN TẤT ĐẶT HÀNG</span>
                </button>

                <!-- Cam kết nhỏ -->
                <div class="mt-3 p-2 bg-light rounded-2 text-center small text-muted">
                    <i class="bi bi-shield-lock-fill text-success me-1"></i>Cam kết hàng chính hãng 100% • Hỗ trợ đổi trả trong 30 ngày
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript chọn phương thức thanh toán -->
<script>
function chonPhuongThuc(el, phuongThuc) {
    document.querySelectorAll('.payment-method-card').forEach(function(card) {
        card.classList.remove('active');
        var radio = card.querySelector('input[type="radio"]');
        if (radio) radio.checked = false;
    });

    el.classList.add('active');
    var currentRadio = el.querySelector('input[type="radio"]');
    if (currentRadio) currentRadio.checked = true;
}
</script>

<?php include("inc/bottom.php"); ?>
