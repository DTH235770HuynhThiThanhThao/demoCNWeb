<?php 
include("../inc/top.php"); 

// Đảm bảo kết nối CSDL PDO
if (!isset($db)) {
    $db = DATABASE::connect();
}

// Truy vấn các số liệu đếm thực tế từ CSDL phục vụ Bảng điều khiển
try {
    // 1. Đơn hàng theo các trạng thái
    $cmd_don_cho = $db->query("SELECT COUNT(*) FROM donhang WHERE trangthai = 0");
    $so_don_cho = (int)$cmd_don_cho->fetchColumn();

    $cmd_don_giao = $db->query("SELECT COUNT(*) FROM donhang WHERE trangthai IN (1, 2)");
    $so_don_giao = (int)$cmd_don_giao->fetchColumn();

    $cmd_don_hoanthanh = $db->query("SELECT COUNT(*) FROM donhang WHERE trangthai = 3");
    $so_don_hoanthanh = (int)$cmd_don_hoanthanh->fetchColumn();

    // Doanh thu thực tế từ đơn hàng đã hoàn thành (trangthai = 3)
    $cmd_dt_thucte = $db->query("SELECT COALESCE(SUM(tongtien), 0) FROM donhang WHERE trangthai = 3");
    $doanhthu_thucte = (float)$cmd_dt_thucte->fetchColumn();

    // 2. Yêu cầu bảo hành chờ xử lý (trangthai = 0)
    $cmd_bh_cho = $db->query("SELECT COUNT(*) FROM baohanh WHERE trangthai = 0");
    $so_bh_cho = (int)$cmd_bh_cho->fetchColumn();

    // 3. Tổng số lượng máy điện thoại đang tồn trong kho
    $cmd_ton_may = $db->query("SELECT COALESCE(SUM(soluongton), 0) FROM mathang");
    $tong_soluong_ton = (int)$cmd_ton_may->fetchColumn();
} catch (Exception $e) {
    $so_don_cho = 0;
    $so_don_giao = 0;
    $so_don_hoanthanh = 0;
    $doanhthu_thucte = 0;
    $so_bh_cho = 0;
    $tong_soluong_ton = 0;
}

// Chuẩn bị chuỗi ngày giờ tiếng Việt
$daysOfWeek = [
    'Sunday' => 'Chủ Nhật',
    'Monday' => 'Thứ Hai',
    'Tuesday' => 'Thứ Ba',
    'Wednesday' => 'Thứ Tư',
    'Thursday' => 'Thứ Năm',
    'Friday' => 'Thứ Sáu',
    'Saturday' => 'Thứ Bảy'
];
$currentDateStr = ($daysOfWeek[date('l')] ?? 'Hôm nay') . ', ' . date('d/m/Y');
?>

<style>
/* Hiệu ứng tương tác Dashboard Thảo Mobile */
.kpi-card, .status-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08) !important;
}
.status-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08) !important;
}
.btn-red-action {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    transition: all 0.2s ease;
}
.btn-red-action:hover {
    background-color: #b30012;
    border-color: #b30012;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-outline-red-action {
    border-color: #d70018;
    color: #d70018;
    background-color: #ffffff;
    transition: all 0.2s ease;
}
.btn-outline-red-action:hover {
    background-color: #fff0f1;
    border-color: #d70018;
    color: #d70018;
}
</style>

<!-- ================= 1. HEADER CHÀO MỪNG & LỐI TẮT THAO TÁC NHANH ================= -->
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-xl-7">
        <div class="d-flex align-items-center">
            <div style="width: 5px; height: 42px; background-color: #d70018; border-radius: 4px; margin-right: 14px; flex-shrink: 0;"></div>
            <div>
                <h2 class="h3 fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">BẢNG ĐIỀU KHIỂN HỆ THỐNG</h2>
                <p class="text-muted small mb-0">
                    Chào mừng trở lại, <strong class="text-dark"><?= htmlspecialchars($_SESSION['nguoidung']['hoten'] ?? 'Quản trị viên') ?></strong> • Tổng quan hoạt động kinh doanh Thảo Mobile
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="d-flex flex-wrap align-items-center justify-content-xl-end gap-2">
            <div class="badge bg-white text-secondary border px-3 py-2 d-inline-flex align-items-center shadow-sm" style="border-radius: 10px; font-weight: 500;">
                <i class="align-middle me-2 text-danger" data-feather="calendar" style="width: 15px; height: 15px;"></i>
                <span><?= $currentDateStr ?></span>
            </div>
            <a href="../qlnhaphang/index.php?action=them" class="btn btn-outline-red-action d-inline-flex align-items-center shadow-sm px-3 py-2" style="border-radius: 10px; font-weight: 600; font-size: 13.5px;">
                <i class="align-middle me-1" data-feather="download" style="width: 16px; height: 16px;"></i> + Nhập hàng mới
            </a>
            <a href="../qlmathang/index.php?action=them" class="btn btn-red-action d-inline-flex align-items-center shadow-sm px-3 py-2" style="border-radius: 10px; font-weight: 600; font-size: 13.5px;">
                <i class="align-middle me-1" data-feather="plus-circle" style="width: 16px; height: 16px;"></i> + Thêm điện thoại
            </a>
        </div>
    </div>
</div>

<!-- ================= 2. 4 THẺ CHỈ SỐ KPI NỔI BẬT (4 CỘT ĐỀU NHAU) ================= -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Tổng doanh thu -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 kpi-card" style="border-radius: 14px; border-left: 4px solid #d70018 !important; background-color: #ffffff;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small text-uppercase" style="letter-spacing: 0.5px; font-size: 12px;">Tổng doanh thu</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: rgba(215, 0, 24, 0.1); color: #d70018;">
                            <i data-feather="dollar-sign" style="width: 22px; height: 22px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1" style="color: #d70018; font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($doanhthu_thucte > 0 ? $doanhthu_thucte : ($tongdoanhthu ?? 0), 0, ',', '.') ?>đ
                    </h3>
                    <div class="text-muted small mt-1 mb-3 d-flex align-items-center">
                        <i class="align-middle me-1 text-success" data-feather="check-circle" style="width: 13px; height: 13px;"></i>
                        <span>Đơn đã hoàn thành (<strong><?= number_format($so_don_hoanthanh) ?></strong> đơn)</span>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qldoanhthu/index.php" class="small fw-semibold text-decoration-none d-inline-flex align-items-center" style="color: #d70018;">
                        Xem báo cáo doanh thu <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Tổng đơn hàng -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 kpi-card" style="border-radius: 14px; border-left: 4px solid #0d6efd !important; background-color: #ffffff;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small text-uppercase" style="letter-spacing: 0.5px; font-size: 12px;">Tổng đơn hàng</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                            <i data-feather="shopping-cart" style="width: 22px; height: 22px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1 text-dark" style="font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongdonhang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">đơn</span>
                    </h3>
                    <div class="mt-1 mb-3">
                        <?php if ($so_don_cho > 0): ?>
                            <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11.5px;">
                                <i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i><?= $so_don_cho ?> đơn chờ duyệt
                            </span>
                        <?php else: ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11.5px;">
                                <i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đã xử lý tất cả
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qldonhang/index.php" class="small fw-semibold text-primary text-decoration-none d-inline-flex align-items-center">
                        Quản lý đơn hàng <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Sản phẩm kinh doanh -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 kpi-card" style="border-radius: 14px; border-left: 4px solid #fd7e14 !important; background-color: #ffffff;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small text-uppercase" style="letter-spacing: 0.5px; font-size: 12px;">Sản phẩm kinh doanh</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: rgba(253, 126, 20, 0.12); color: #fd7e14;">
                            <i data-feather="smartphone" style="width: 22px; height: 22px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1 text-dark" style="font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongmathang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">mẫu máy</span>
                    </h3>
                    <div class="text-muted small mt-1 mb-3 d-flex align-items-center">
                        <i class="align-middle me-1 text-warning" data-feather="package" style="width: 13px; height: 13px;"></i>
                        <span>Tồn kho: <strong><?= number_format($tong_soluong_ton ?? 0, 0, ',', '.') ?></strong> máy</span>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qlnhaphang/index.php" class="small fw-semibold text-decoration-none d-inline-flex align-items-center" style="color: #fd7e14;">
                        Quản lý kho <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Khách hàng thành viên -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 kpi-card" style="border-radius: 14px; border-left: 4px solid #198754 !important; background-color: #ffffff;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small text-uppercase" style="letter-spacing: 0.5px; font-size: 12px;">Khách hàng thành viên</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: rgba(25, 135, 84, 0.1); color: #198754;">
                            <i data-feather="users" style="width: 22px; height: 22px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1 text-dark" style="font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongkhachhang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">tài khoản</span>
                    </h3>
                    <div class="text-muted small mt-1 mb-3 d-flex align-items-center">
                        <i class="align-middle me-1 text-success" data-feather="user-check" style="width: 13px; height: 13px;"></i>
                        <span>Thành viên hệ thống</span>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qlkhachhang/index.php" class="small fw-semibold text-success text-decoration-none d-inline-flex align-items-center">
                        Danh sách khách hàng <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= 3. THANH TỔNG QUAN TÌNH TRẠNG ĐƠN HÀNG & BẢO HÀNH (TRUY VẤN THẬT TỪ CSDL) ================= -->
<div class="row g-3 mb-4">
    <!-- 1. Chờ xác nhận (donhang.trangthai = 0) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 border shadow-sm status-card" style="border-radius: 12px; background-color: #fff9db; border-color: #ffe066 !important;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px; background-color: #fff3bf; color: #b45309;">
                            <i data-feather="clock" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <div class="small fw-bold" style="color: #854d0e; font-size: 13px;">Chờ xác nhận</div>
                            <div class="fs-5 fw-bold" style="color: #92400e;"><?= number_format($so_don_cho) ?> <span class="small fw-normal" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #b45309;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 2. Đang giao hàng (donhang.trangthai = 1 hoặc 2) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 border shadow-sm status-card" style="border-radius: 12px; background-color: #e7f5ff; border-color: #a5d8ff !important;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px; background-color: #d0ebff; color: #1971c2;">
                            <i data-feather="truck" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <div class="small fw-bold" style="color: #1864ab; font-size: 13px;">Đang giao hàng</div>
                            <div class="fs-5 fw-bold" style="color: #1971c2;"><?= number_format($so_don_giao) ?> <span class="small fw-normal" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #1971c2;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 3. Đã hoàn thành (donhang.trangthai = 3) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 border shadow-sm status-card" style="border-radius: 12px; background-color: #ebfbee; border-color: #b2f2bb !important;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px; background-color: #d3f9d8; color: #2b8a3e;">
                            <i data-feather="check-circle" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <div class="small fw-bold" style="color: #2b8a3e; font-size: 13px;">Đã hoàn thành</div>
                            <div class="fs-5 fw-bold" style="color: #2b8a3e;"><?= number_format($so_don_hoanthanh) ?> <span class="small fw-normal" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #2b8a3e;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 4. Yêu cầu bảo hành chờ xử lý (baohanh.trangthai = 0) -->
    <div class="col-6 col-xl-3">
        <a href="../qlbaohanh/index.php?trangthai=0" class="text-decoration-none d-block h-100">
            <div class="card h-100 border shadow-sm status-card" style="border-radius: 12px; background-color: #fff5f5; border-color: #ffc9c9 !important;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px; background-color: #ffe3e3; color: #c92a2a;">
                            <i data-feather="shield" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <div class="small fw-bold" style="color: #c92a2a; font-size: 13px;">Bảo hành chờ xử lý</div>
                            <div class="fs-5 fw-bold" style="color: #c92a2a;"><?= number_format($so_bh_cho) ?> <span class="small fw-normal" style="font-size: 12px;">yêu cầu</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #c92a2a;"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- ================= 4. 2 BẢNG DỮ LIỆU PHÍA DƯỚI (TỶ LỆ 7 - 5) ================= -->
<div class="row g-3">
    <!-- Cột trái (col-lg-7) — ĐƠN HÀNG MỚI NHẤT -->
    <div class="col-12 col-lg-7 mb-4">
        <div class="card h-100 shadow-sm border-0" style="border-radius: 14px; background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-0 d-flex justify-content-between align-items-center" style="border-top-left-radius: 14px; border-top-right-radius: 14px;">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 20px; background-color: #d70018; border-radius: 3px; margin-right: 10px;"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="align-middle me-2 text-danger" data-feather="clock" style="width: 18px; height: 18px;"></i>
                        Đơn hàng mới nhất
                    </h5>
                </div>
                <a href="../qldonhang/index.php" class="btn btn-sm btn-outline-danger px-3 py-1" style="border-radius: 8px; font-weight: 500; font-size: 12.5px;">
                    Xem tất cả <i class="align-middle ms-1" data-feather="arrow-right" style="width: 13px; height: 13px;"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($donhangmoinhat)): ?>
                    <div class="text-center py-5 text-muted">
                        <i data-feather="inbox" style="width: 42px; height: 42px; stroke-width: 1.5; color: #adb5bd;" class="mb-2"></i>
                        <p class="mb-0 fw-semibold">Chưa có đơn hàng nào trong hệ thống</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 py-3" style="width: 120px;">Mã ĐH</th>
                                    <th class="py-3">Khách hàng</th>
                                    <th class="py-3" style="width: 135px;">Ngày đặt</th>
                                    <th class="py-3 text-center" style="width: 140px;">Trạng thái</th>
                                    <th class="pe-4 py-3 text-end" style="width: 130px;">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donhangmoinhat as $dh): ?>
                                    <tr>
                                        <!-- Mã ĐH: huy hiệu bấm vào xem chi tiết -->
                                        <td class="ps-4">
                                            <a href="../qldonhang/index.php?action=chitiet&id=<?= $dh["id"] ?>" class="badge text-decoration-none fw-bold" style="background-color: #f1f3f5; color: #1971c2; border: 1px solid #dee2e6; font-size: 12px; padding: 6px 9px; border-radius: 6px;" title="Xem chi tiết đơn hàng">
                                                #<?= sprintf("DH%06d", $dh["id"]) ?>
                                            </a>
                                        </td>

                                        <!-- Khách hàng: tên in đậm + SĐT bên dưới -->
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px;"><?= htmlspecialchars($dh["hoten"] ?? 'Khách vãng lai') ?></div>
                                            <?php if (!empty($dh["sodienthoai"])): ?>
                                                <div class="text-muted small mt-0 d-flex align-items-center" style="font-size: 11.5px;">
                                                    <i class="align-middle me-1" data-feather="phone" style="width: 11px; height: 11px;"></i><?= htmlspecialchars($dh["sodienthoai"]) ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Ngày đặt -->
                                        <td class="text-muted small" style="font-size: 12.5px;">
                                            <?= !empty($dh["ngay"]) ? date("d/m/Y H:i", strtotime($dh["ngay"])) : "—" ?>
                                        </td>

                                        <!-- Trạng thái đơn -->
                                        <td class="text-center">
                                            <?php 
                                            $tt = (int)($dh["trangthai"] ?? 0);
                                            if ($tt === 0) {
                                                echo '<span class="badge bg-warning text-dark px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i>Chờ xác nhận</span>';
                                            } elseif ($tt === 1) {
                                                echo '<span class="badge bg-primary px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đã duyệt</span>';
                                            } elseif ($tt === 2) {
                                                echo '<span class="badge bg-info text-white px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="truck" style="width: 11px; height: 11px;"></i>Đang giao</span>';
                                            } elseif ($tt === 3) {
                                                echo '<span class="badge bg-success px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="check-circle" style="width: 11px; height: 11px;"></i>Hoàn thành</span>';
                                            } else {
                                                echo '<span class="badge bg-secondary px-2 py-1 text-nowrap" style="font-size: 11px;"><i class="align-middle me-1" data-feather="x-circle" style="width: 11px; height: 11px;"></i>Đã hủy</span>';
                                            }
                                            ?>
                                        </td>

                                        <!-- Tổng tiền -->
                                        <td class="pe-4 text-end">
                                            <span class="fw-bold" style="color: #d70018; font-size: 13.5px;">
                                                <?= number_format($dh["tongtien"] ?? 0, 0, ',', '.') ?>đ
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Cột phải (col-lg-5) — CẢNH BÁO TỒN KHO (THẤP NHẤT) -->
    <div class="col-12 col-lg-5 mb-4">
        <div class="card h-100 shadow-sm border-0" style="border-radius: 14px; background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-0 d-flex justify-content-between align-items-center" style="border-top-left-radius: 14px; border-top-right-radius: 14px;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; background-color: #fff3bf; color: #f59f00;">
                        <i data-feather="alert-triangle" style="width: 16px; height: 16px;"></i>
                    </div>
                    <h5 class="card-title mb-0 fw-bold text-dark">
                        Cảnh báo tồn kho (Thấp nhất)
                    </h5>
                </div>
                <a href="../qlnhaphang/index.php" class="btn btn-sm btn-outline-warning text-dark px-3 py-1" style="border-radius: 8px; font-weight: 500; font-size: 12.5px;">
                    Nhập thêm hàng <i class="align-middle ms-1" data-feather="plus" style="width: 13px; height: 13px;"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($mathangsaphet)): ?>
                    <div class="text-center py-5 text-muted">
                        <i data-feather="check-circle" style="width: 42px; height: 42px; stroke-width: 1.5; color: #2b8a3e;" class="mb-2"></i>
                        <p class="mb-0 fw-semibold text-success">Kho hàng hiện đang đủ số lượng an toàn</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3 py-3" style="width: 60px;">Ảnh</th>
                                    <th class="py-3">Tên điện thoại</th>
                                    <th class="pe-4 py-3 text-end" style="width: 120px;">Tồn kho</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mathangsaphet as $sp): ?>
                                    <tr>
                                        <!-- Ảnh thu nhỏ bo góc đẹp -->
                                        <td class="ps-3">
                                            <img src="../../<?= htmlspecialchars($sp["hinhanh"] ?? '') ?>" 
                                                 alt="<?= htmlspecialchars($sp["tenmathang"] ?? '') ?>" 
                                                 width="44" height="44" 
                                                 class="rounded-3 border" 
                                                 style="object-fit: cover; background: #fff;" 
                                                 onerror="this.src='../../images/products/no-image.png'">
                                        </td>

                                        <!-- Tên máy & giá bán -->
                                        <td>
                                            <a href="../qlmathang/index.php?action=chitiet&id=<?= $sp["id"] ?>" class="text-dark text-decoration-none fw-semibold text-truncate d-block" style="max-width: 190px; font-size: 13px;" title="<?= htmlspecialchars($sp["tenmathang"]) ?>">
                                                <?= htmlspecialchars($sp["tenmathang"]) ?>
                                            </a>
                                            <div class="small fw-semibold mt-0" style="color: #d70018; font-size: 12px;">
                                                <?= number_format($sp["giaban"] ?? 0, 0, ',', '.') ?>đ
                                            </div>
                                        </td>

                                        <!-- Huy hiệu phân cấp mức tồn kho -->
                                        <td class="pe-4 text-end">
                                            <?php if ($sp["soluongton"] < 5): ?>
                                                <span class="badge bg-danger px-2 py-1 fw-bold shadow-sm" style="font-size: 11.5px;" title="Cần nhập hàng khẩn cấp">
                                                    <i class="align-middle me-1" data-feather="alert-circle" style="width: 11px; height: 11px;"></i>Còn <?= $sp["soluongton"] ?>
                                                </span>
                                            <?php elseif ($sp["soluongton"] <= 12): ?>
                                                <span class="badge bg-warning text-dark px-2 py-1 fw-bold" style="font-size: 11.5px;" title="Sắp hết hàng">
                                                    Còn <?= $sp["soluongton"] ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-success px-2 py-1 fw-bold" style="font-size: 11.5px;">
                                                    Còn <?= $sp["soluongton"] ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Đảm bảo icon Feather luôn được render chuẩn xác
document.addEventListener('DOMContentLoaded', function () {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>

<?php include("../inc/bottom.php"); ?>
