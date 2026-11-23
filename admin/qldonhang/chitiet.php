<?php include("../inc/top.php"); ?>

<?php
$tt = (int)($donhang["trangthai"] ?? 0);
$ma_dh = sprintf("DH%06d", $donhang["id"] ?? 0);

// Xác định phương thức thanh toán hiển thị thân thiện
$pttt_raw = strtolower($donhang["phuongthuctt"] ?? $donhang["pttt"] ?? "");
$is_bank = (strpos($pttt_raw, "bank") !== false || strpos($pttt_raw, "chuyenkhoan") !== false || strpos($pttt_raw, "qr") !== false);
?>

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
    height: 20px;
    background-color: #d70018;
    border-radius: 3px;
    margin-right: 10px;
    flex-shrink: 0;
}
.btn-back {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-back:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.table-flagship-head th {
    background-color: #f8fafc !important;
    color: #475569 !important;
    font-weight: 700 !important;
    font-size: 0.78rem !important;
    border-bottom: 1px solid #e2e8f0 !important;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}
.info-box-detail {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px;
    height: 100%;
}
</style>

<!-- 1. Thanh điều hướng quay lại & Tiêu đề chi tiết -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">CHI TIẾT ĐƠN HÀNG #<?= $ma_dh ?></h3>
                                <?php 
                                if($tt === 0){
                                    echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 12px;"><i class="align-middle me-1" data-feather="clock" style="width: 12px; height: 12px;"></i>Chờ xác nhận</span>';
                                } elseif($tt === 1){
                                    echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px;"><i class="align-middle me-1" data-feather="check-circle" style="width: 12px; height: 12px;"></i>Đã duyệt</span>';
                                } elseif($tt === 2){
                                    echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px;"><i class="align-middle me-1" data-feather="truck" style="width: 12px; height: 12px;"></i>Đang giao hàng</span>';
                                } elseif($tt === 3){
                                    echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px;"><i class="align-middle me-1" data-feather="check-square" style="width: 12px; height: 12px;"></i>Hoàn thành</span>';
                                } elseif($tt === 4 || $tt === -1){
                                    echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 12px;"><i class="align-middle me-1" data-feather="x-circle" style="width: 12px; height: 12px;"></i>Đã hủy</span>';
                                }
                                ?>
                            </div>
                            <p class="text-muted small mb-0 mt-1">
                                Thời gian đặt: <strong><?= isset($donhang["ngay"]) ? date("d/m/Y • H:i:s", strtotime($donhang["ngay"])) : "" ?></strong>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="index.php" class="btn btn-sm btn-back d-inline-flex align-items-center px-3 py-2">
                            <i class="align-middle me-1.5" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
                            <span>Quay lại danh sách</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Khối thông tin người nhận, giao hàng & thanh toán -->
<div class="row g-3 mb-4">
    <!-- Khối 1: Thông tin người nhận -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 14.5px;">
                        Thông tin người nhận
                    </h5>
                </div>
                <div class="info-box-detail">
                    <div class="mb-2">
                        <small class="text-muted d-block">Họ và tên:</small>
                        <strong class="text-dark fs-6"><?= htmlspecialchars($donhang["hoten"] ?? "Chưa rõ") ?></strong>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted d-block">Số điện thoại:</small>
                        <span class="fw-semibold text-dark">
                            <i class="align-middle me-1 text-danger" data-feather="phone" style="width: 13px; height: 13px;"></i>
                            <?= htmlspecialchars($donhang["sodienthoai"] ?? "Chưa rõ") ?>
                        </span>
                    </div>
                    <?php if(!empty($donhang["email"])): ?>
                    <div class="mb-0">
                        <small class="text-muted d-block">Email liên hệ:</small>
                        <span class="text-secondary"><?= htmlspecialchars($donhang["email"]) ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Khối 2: Địa chỉ & Vận chuyển -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 14.5px;">
                        Địa chỉ nhận hàng
                    </h5>
                </div>
                <div class="info-box-detail">
                    <div class="mb-2">
                        <small class="text-muted d-block">Địa chỉ giao hàng:</small>
                        <span class="text-dark fw-semibold" style="line-height: 1.5;">
                            <i class="align-middle me-1 text-danger" data-feather="map-pin" style="width: 14px; height: 14px;"></i>
                            <?= htmlspecialchars(!empty($donhang["diachi"]) ? $donhang["diachi"] : "Địa chỉ mặc định của khách hàng") ?>
                        </span>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted d-block">Hình thức nhận:</small>
                        <span class="badge fw-semibold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 6px;">
                            Giao hàng tận nơi toàn quốc
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Khối 3: Phương thức thanh toán & Tổng tiền -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 14.5px;">
                        Thanh toán & Tổng giá trị
                    </h5>
                </div>
                <div class="info-box-detail d-flex flex-column justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Phương thức thanh toán:</small>
                        <?php if($is_bank): ?>
                            <div class="d-flex align-items-center gap-1.5 text-primary fw-semibold">
                                <i class="align-middle" data-feather="credit-card" style="width: 15px; height: 15px;"></i>
                                <span>Chuyển khoản / Quét mã QR</span>
                            </div>
                        <?php else: ?>
                            <div class="d-flex align-items-center gap-1.5 text-success fw-semibold">
                                <i class="align-middle" data-feather="dollar-sign" style="width: 15px; height: 15px;"></i>
                                <span>Thanh toán khi nhận hàng (COD)</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pt-3 mt-2 border-top">
                        <small class="text-muted d-block">Tổng tiền đơn hàng:</small>
                        <span class="fw-bold fs-4" style="color: #d70018; letter-spacing: -0.5px;">
                            <?= number_format($donhang["tongtien"] ?? 0) ?>đ
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. Bảng danh sách sản phẩm điện thoại đã đặt -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <div class="section-accent-bar"></div>
            <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                Danh sách điện thoại đặt mua
            </h5>
        </div>
        <span class="badge fw-semibold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 6px;">
            <?= !empty($chitiet) ? count($chitiet) : 0 ?> mặt hàng
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head">
                    <tr>
                        <th class="text-center ps-4" style="width: 60px;">STT</th>
                        <th style="width: 80px;" class="text-center">Hình ảnh</th>
                        <th style="min-width: 250px;">Tên điện thoại</th>
                        <th class="text-end" style="width: 160px;">Đơn giá</th>
                        <th class="text-center" style="width: 110px;">Số lượng</th>
                        <th class="text-end pe-4" style="width: 170px;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = 1;
                    if(!empty($chitiet)):
                        foreach($chitiet as $ct):
                            $img_src = !empty($ct["hinhanh"]) ? "../../" . $ct["hinhanh"] : "../../images/products/no-image.png";
                    ?>
                    <tr>
                        <td class="text-center ps-4 text-muted fw-semibold"><?= $stt++ ?></td>
                        <td class="text-center">
                            <img src="<?= $img_src ?>" 
                                 class="rounded-3 border bg-white p-1 shadow-sm" 
                                 style="width: 48px; height: 48px; object-fit: contain;" 
                                 alt="<?= htmlspecialchars($ct["tenmathang"]) ?>"
                                 onerror="this.src='../../images/products/no-image.png'">
                        </td>
                        <td>
                            <strong class="text-dark d-block" style="font-size: 14px;"><?= htmlspecialchars($ct["tenmathang"]) ?></strong>
                            <small class="text-muted"><i class="align-middle me-1 text-success" data-feather="shield" style="width: 12px; height: 12px;"></i>Chính hãng VN/A</small>
                        </td>
                        <td class="text-end fw-semibold text-secondary" style="font-size: 13.5px;">
                            <?= number_format($ct["dongia"]) ?>đ
                        </td>
                        <td class="text-center fw-bold text-dark">
                            <?= $ct["soluong"] ?>
                        </td>
                        <td class="text-end pe-4 fw-bold fs-6" style="color: #d70018;">
                            <?= number_format($ct["thanhtien"]) ?>đ
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Không có thông tin chi tiết sản phẩm.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #f8fafc;">
                        <td colspan="5" class="text-end fw-bold ps-4 py-3" style="font-size: 14.5px; color: #1e293b;">
                            Tổng thanh toán:
                        </td>
                        <td class="text-end pe-4 py-3 fw-bold fs-5" style="color: #d70018; letter-spacing: -0.4px;">
                            <?= number_format($donhang["tongtien"] ?? 0) ?>đ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- 4. Thanh xử lý trạng thái đơn hàng nhanh ở cuối trang -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <a href="index.php" class="btn btn-sm btn-back d-inline-flex align-items-center px-3 py-2">
            <i class="align-middle me-1.5" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
            <span>Quay lại danh sách đơn hàng</span>
        </a>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <?php if($tt === 0): ?>
                <a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=1" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 fw-semibold text-white" style="background-color: #16a34a; border-radius: 8px;">
                    <i class="align-middle me-1.5" data-feather="check" style="width: 15px; height: 15px;"></i> Duyệt đơn hàng
                </a>
                <a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=4" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 fw-semibold" style="background-color: #fff5f5; color: #dc2626; border: 1px solid #fecaca; border-radius: 8px;" onclick="return confirm('Xác nhận hủy đơn hàng #<?= $ma_dh ?>?');">
                    <i class="align-middle me-1.5" data-feather="x" style="width: 15px; height: 15px;"></i> Hủy đơn hàng
                </a>
            <?php elseif($tt === 1): ?>
                <a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=2" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 fw-semibold text-white" style="background-color: #0284c7; border-radius: 8px;">
                    <i class="align-middle me-1.5" data-feather="truck" style="width: 15px; height: 15px;"></i> Giao hàng
                </a>
                <a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=4" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 fw-semibold" style="background-color: #fff5f5; color: #dc2626; border: 1px solid #fecaca; border-radius: 8px;" onclick="return confirm('Xác nhận hủy đơn hàng #<?= $ma_dh ?>?');">
                    <i class="align-middle me-1.5" data-feather="x" style="width: 15px; height: 15px;"></i> Hủy đơn hàng
                </a>
            <?php elseif($tt === 2): ?>
                <a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=3" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 fw-semibold text-white" style="background-color: #16a34a; border-radius: 8px;">
                    <i class="align-middle me-1.5" data-feather="check-circle" style="width: 15px; height: 15px;"></i> Xác nhận hoàn thành
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>