<?php include("../inc/top.php"); ?>

<?php 
$avatar = !empty($khachhang["hinhanh"]) ? "../../" . $khachhang["hinhanh"] : "../../images/users/user.png";
$tongtien = (float)($khachhang["tongchitieu"] ?? 0);
$sodon = !empty($donhang) ? count($donhang) : (int)($khachhang["sodonhang"] ?? 0);
$trangthai = (int)($khachhang["trangthai"] ?? 1);
$firstChar = mb_strtoupper(mb_substr(trim($khachhang["hoten"] ?? 'K'), 0, 1, "UTF-8"), "UTF-8");
?>

<style>
.breadcrumb-custom {
    list-style: none !important;
}
.breadcrumb-link {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.15s ease-in-out;
}
.breadcrumb-link:hover {
    color: #d70018 !important;
}
</style>

<div class="row align-items-center mb-3">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom d-flex flex-row align-items-center gap-2 list-unstyled p-0 mb-2 small">
                <li class="d-inline-flex align-items-center">
                    <a href="index.php" class="breadcrumb-link text-secondary text-decoration-none">Quản lý khách hàng</a>
                </li>
                <li class="d-inline-flex align-items-center text-muted" aria-hidden="true">/</li>
                <li class="d-inline-flex align-items-center fw-semibold" style="color: #d70018;" aria-current="page">
                    Chi tiết khách hàng
                </li>
            </ol>
        </nav>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center">
                <div style="width: 5px; height: 38px; background-color: #d70018; border-radius: 4px; margin-right: 14px; flex-shrink: 0;"></div>
                <div>
                    <h2 class="h3 fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">HỒ SƠ KHÁCH HÀNG</h2>
                    <p class="text-muted small mb-0">Xem chi tiết thông tin cá nhân và lịch sử giao dịch mua sắm</p>
                </div>
            </div>
            <a href="index.php" class="btn btn-outline-secondary d-inline-flex align-items-center px-3 py-2" style="border-radius: 10px; font-weight: 500; font-size: 13px;">
                <i class="align-middle me-1" data-feather="arrow-left" style="width: 15px; height: 15px;"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Cột trái: Hồ sơ khách hàng -->
    <div class="col-lg-4 col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-0" style="border-bottom: 1px solid #f1f5f9;">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 20px; background-color: #d70018; border-radius: 3px; margin-right: 10px;"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark">
                        Thông tin tài khoản
                    </h5>
                </div>
            </div>
            <div class="card-body text-center p-4">
                <div class="position-relative d-inline-block mb-3">
                    <img src="<?= $avatar ?>" class="rounded-circle border p-1 shadow-sm" style="width: 90px; height: 90px; object-fit: cover;" alt="<?= htmlspecialchars($khachhang["hoten"]) ?>" onerror="this.src='../../images/users/user.png';">
                </div>
                <h4 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($khachhang["hoten"]) ?></h4>
                <div class="mb-3">
                    <span class="badge fw-bold" style="background-color: #f1f3f5; color: #1971c2; border: 1px solid #dee2e6; font-size: 12px; padding: 5px 9px; border-radius: 6px;">
                        #<?= sprintf("KH%05d", $khachhang["id"]) ?>
                    </span>
                </div>
                
                <div class="d-flex justify-content-center align-items-center gap-2 mb-3 flex-wrap">
                    <?php if($trangthai === 1): ?>
                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #dcfce7; color: #15803d; font-size: 11.5px; border: 1px solid #bbf7d0;">
                            ● Hoạt động
                        </span>
                    <?php else: ?>
                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #ffedd5; color: #c2410c; font-size: 11.5px; border: 1px solid #fed7aa;">
                            ● Đã khóa
                        </span>
                    <?php endif; ?>

                    <?php if($tongtien >= 30000000): ?>
                        <span class="badge px-2 py-1 fw-bold text-dark" style="background-color: #fef08a; border: 1px solid #fde047; font-size: 11px;">
                            <i class="align-middle me-1 text-warning" data-feather="star" style="width: 11px; height: 11px;"></i>★ Khách VIP
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Thống kê nhanh đơn và chi tiêu -->
                <div class="row g-2 text-center my-3 py-2 rounded-3 border" style="background-color: #f8fafc;">
                    <div class="col-6 border-end">
                        <div class="text-muted small" style="font-size: 11.5px;">Tổng đơn hàng</div>
                        <div class="fw-bold fs-5 text-dark"><?= number_format($sodon) ?></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small" style="font-size: 11.5px;">Chi tiêu tích lũy</div>
                        <div class="fw-bold fs-5" style="color: #d70018;"><?= number_format($tongtien, 0, ',', '.') ?>đ</div>
                    </div>
                </div>

                <!-- Chi tiết liên hệ -->
                <ul class="list-group list-group-flush text-start small mt-3">
                    <li class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="align-middle me-2 text-secondary" data-feather="mail" style="width: 14px; height: 14px;"></i>Email:</span>
                        <span class="fw-semibold text-dark text-break"><?= htmlspecialchars($khachhang["email"]) ?></span>
                    </li>
                    <li class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="align-middle me-2" data-feather="phone" style="width: 14px; height: 14px; color: #d70018;"></i>Điện thoại:</span>
                        <span class="fw-bold text-dark"><?= htmlspecialchars($khachhang["sodienthoai"]) ?></span>
                    </li>
                    <li class="list-group-item px-0 py-2">
                        <div class="text-muted mb-1"><i class="align-middle me-2 text-secondary" data-feather="map-pin" style="width: 14px; height: 14px;"></i>Địa chỉ nhận hàng:</div>
                        <?php if(!empty($khachhang["diachi"])): ?>
                            <?php foreach($khachhang["diachi"] as $dc): ?>
                                <div class="p-2 mb-1 rounded border" style="background-color: #f8fafc; font-size: 12px;">
                                    <?= htmlspecialchars($dc["diachi"]) ?>
                                    <?php if(!empty($dc["macdinh"])): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-1" style="font-size: 10px;">Mặc định</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted fst-italic" style="font-size: 12px;">Chưa có địa chỉ lưu trong hệ thống.</span>
                        <?php endif; ?>
                    </li>
                </ul>

                <!-- Nút thao tác Khóa / Mở khóa -->
                <div class="mt-4 pt-2 border-top">
                    <?php if($trangthai === 1): ?>
                        <a href="index.php?action=doitrangthai&id=<?= $khachhang["id"] ?>&trangthai=0&from=chitiet" class="btn btn-outline-danger w-100 d-inline-flex align-items-center justify-content-center py-2 fw-semibold" style="border-radius: 10px; font-size: 13px;" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản khách hàng <?= htmlspecialchars($khachhang['hoten']) ?> không?');">
                            <i class="align-middle me-2" data-feather="lock" style="width: 15px; height: 15px;"></i> Khóa tài khoản này
                        </a>
                    <?php else: ?>
                        <a href="index.php?action=doitrangthai&id=<?= $khachhang["id"] ?>&trangthai=1&from=chitiet" class="btn btn-outline-success w-100 d-inline-flex align-items-center justify-content-center py-2 fw-semibold" style="border-radius: 10px; font-size: 13px;" onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản khách hàng <?= htmlspecialchars($khachhang['hoten']) ?> không?');">
                            <i class="align-middle me-2" data-feather="unlock" style="width: 15px; height: 15px;"></i> Mở khóa tài khoản này
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột phải: Lịch sử đơn hàng -->
    <div class="col-lg-8 col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-0 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #f1f5f9;">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 20px; background-color: #d70018; border-radius: 3px; margin-right: 10px;"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark">
                        Lịch sử đơn hàng
                    </h5>
                </div>
                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px; font-weight: 600;">
                    <?= !empty($donhang) ? count($donhang) : 0 ?> đơn hàng
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 110px;">MÃ ĐH</th>
                                <th class="py-3" style="width: 145px;">NGÀY ĐẶT</th>
                                <th class="py-3 text-end" style="width: 140px;">TỔNG TIỀN</th>
                                <th class="py-3 text-center" style="width: 150px;">TRẠNG THÁI</th>
                                <th class="pe-4 py-3 text-center" style="width: 100px;">CHI TIẾT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($donhang)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i data-feather="inbox" style="width: 40px; height: 40px; stroke-width: 1.5; color: #adb5bd;" class="mb-2"></i>
                                    <p class="mb-0 fw-semibold">Khách hàng này chưa có đơn hàng nào trong hệ thống.</p>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach($donhang as $d): ?>
                            <tr>
                                <td class="ps-4 text-center">
                                    <span class="badge fw-bold" style="background-color: #f1f3f5; color: #1971c2; border: 1px solid #dee2e6; font-size: 12px; padding: 5px 8px; border-radius: 6px;">
                                        #<?= sprintf("DH%06d", $d["id"]) ?>
                                    </span>
                                </td>
                                <td class="text-muted small" style="font-size: 12.5px;">
                                    <?= date("d/m/Y H:i", strtotime($d["ngay"])) ?>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold" style="color: #d70018; font-size: 13.5px;"><?= number_format($d["tongtien"], 0, ',', '.') ?>đ</span>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $tt = (int)($d["trangthai"] ?? 0);
                                    if($tt === 0){
                                        echo '<span class="badge bg-warning text-dark px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i>Chờ xác nhận</span>';
                                    } elseif($tt === 1){
                                        echo '<span class="badge bg-primary px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đã duyệt</span>';
                                    } elseif($tt === 2){
                                        echo '<span class="badge bg-info text-white px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="truck" style="width: 11px; height: 11px;"></i>Đang giao</span>';
                                    } elseif($tt === 3){
                                        echo '<span class="badge bg-success px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="check-circle" style="width: 11px; height: 11px;"></i>Hoàn thành</span>';
                                    } elseif($tt === 4){
                                        echo '<span class="badge bg-secondary px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="x-circle" style="width: 11px; height: 11px;"></i>Đã hủy</span>';
                                    }
                                    ?>
                                </td>
                                <td class="pe-4 text-center">
                                    <a href="../qldonhang/index.php?action=chitiet&id=<?= $d["id"] ?>" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center p-1" title="Xem chi tiết đơn hàng" style="border-radius: 8px; width: 32px; height: 32px;">
                                        <i class="align-middle" data-feather="eye" style="width: 15px; height: 15px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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
