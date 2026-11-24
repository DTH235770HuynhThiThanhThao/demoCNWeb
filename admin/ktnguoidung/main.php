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
/* Phong cách Tech Flagship Thảo Mobile - Tối giản, sang trọng */
.kpi-card {
    background-color: #ffffff;
    border: 1px solid #f1f5f9 !important;
    border-radius: 14px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06) !important;
    border-color: #e2e8f0 !important;
}

.status-card {
    background-color: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.status-card:hover {
    transform: translateY(-2px);
    border-color: #d70018 !important;
    box-shadow: 0 6px 18px rgba(215, 0, 24, 0.08) !important;
}

.kpi-link {
    color: #475569;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: color 0.2s ease;
}
.kpi-link:hover {
    color: #d70018;
}

.btn-header-nhap {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    color: #1e293b;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13.5px;
    padding: 7px 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn-header-nhap:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff1f2;
}

.btn-header-them {
    background-color: #d70018;
    border: 1px solid #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13.5px;
    padding: 7px 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(215, 0, 24, 0.2);
}
.btn-header-them:hover {
    background-color: #b30012;
    border-color: #b30012;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.3);
}

.btn-card-more {
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    color: #334155;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn-card-more:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff1f2;
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
            <div class="badge bg-white border px-3 py-2 d-inline-flex align-items-center shadow-sm" style="border-radius: 10px; font-weight: 500; border-color: #e2e8f0 !important; color: #475569 !important;">
                <i class="align-middle me-2" data-feather="calendar" style="width: 15px; height: 15px; color: #d70018;"></i>
                <span><?= $currentDateStr ?></span>
            </div>
            <a href="../qlnhaphang/index.php?action=them" class="btn-header-nhap shadow-sm">
                <i class="align-middle me-1" data-feather="download" style="width: 15px; height: 15px;"></i>
                <span>Nhập hàng mới</span>
            </a>
            <a href="../qlmathang/index.php?action=them" class="btn-header-them shadow-sm">
                <i class="align-middle me-1" data-feather="plus-circle" style="width: 15px; height: 15px;"></i>
                <span>Thêm điện thoại</span>
            </a>
        </div>
    </div>
</div>

<!-- ================= 2. 4 THẺ CHỈ SỐ KPI NỔI BẬT (4 CỘT ĐỀU NHAU) ================= -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Tổng doanh thu -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 rounded-4 kpi-card">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Tổng doanh thu</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: #fee2e2; color: #d70018;">
                            <i data-feather="dollar-sign" style="width: 20px; height: 20px;"></i>
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
                    <a href="../qldoanhthu/index.php" class="kpi-link">
                        <span>Xem báo cáo doanh thu</span>
                        <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Tổng đơn hàng -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 rounded-4 kpi-card">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Tổng đơn hàng</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: #e0f2fe; color: #0284c7;">
                            <i data-feather="shopping-cart" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1" style="color: #0f172a; font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongdonhang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">đơn</span>
                    </h3>
                    <div class="mt-1 mb-3">
                        <?php if ($so_don_cho > 0): ?>
                            <span class="badge rounded-pill px-2.5 py-1" style="background-color: #fef3c7; color: #b45309; font-size: 11.5px; font-weight: 600;">
                                <i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i><?= $so_don_cho ?> đơn chờ duyệt
                            </span>
                        <?php else: ?>
                            <span class="badge rounded-pill px-2.5 py-1" style="background-color: #dcfce7; color: #15803d; font-size: 11.5px; font-weight: 600;">
                                <i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đã xử lý tất cả
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qldonhang/index.php" class="kpi-link">
                        <span>Quản lý đơn hàng</span>
                        <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Sản phẩm kinh doanh -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 rounded-4 kpi-card">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Sản phẩm kinh doanh</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: #ffedd5; color: #ea580c;">
                            <i data-feather="smartphone" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1" style="color: #0f172a; font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongmathang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">mẫu máy</span>
                    </h3>
                    <div class="text-muted small mt-1 mb-3 d-flex align-items-center">
                        <i class="align-middle me-1 text-warning" data-feather="package" style="width: 13px; height: 13px;"></i>
                        <span>Tồn kho: <strong><?= number_format($tong_soluong_ton ?? 0, 0, ',', '.') ?></strong> máy</span>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qlnhaphang/index.php" class="kpi-link">
                        <span>Quản lý kho</span>
                        <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Khách hàng thành viên -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0 rounded-4 kpi-card">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Khách hàng thành viên</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: #f1f5f9; color: #475569;">
                            <i data-feather="users" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold my-1" style="color: #0f172a; font-size: 1.6rem; letter-spacing: -0.5px;">
                        <?= number_format($tongkhachhang ?? 0, 0, ',', '.') ?> <span class="fs-6 fw-normal text-muted">tài khoản</span>
                    </h3>
                    <div class="text-muted small mt-1 mb-3 d-flex align-items-center">
                        <i class="align-middle me-1 text-success" data-feather="user-check" style="width: 13px; height: 13px;"></i>
                        <span>Thành viên hệ thống</span>
                    </div>
                </div>
                <div class="pt-2 border-top">
                    <a href="../qlkhachhang/index.php" class="kpi-link">
                        <span>Danh sách khách hàng</span>
                        <i class="align-middle ms-1" data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= 3. THANH TỔNG QUAN TÌNH TRẠNG ĐƠN HÀNG & BẢO HÀNH ================= -->
<div class="row g-3 mb-4">
    <!-- 1. Chờ xác nhận (donhang.trangthai = 0) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 shadow-sm status-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px; background-color: #fef3c7; color: #b45309;">
                            <i data-feather="clock" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <div class="small fw-semibold text-muted" style="font-size: 12.5px;">Chờ xác nhận</div>
                            <div class="fs-5 fw-bold" style="color: #0f172a;"><?= number_format($so_don_cho) ?> <span class="small fw-normal text-muted" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #94a3b8;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 2. Đang giao hàng (donhang.trangthai = 1 hoặc 2) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 shadow-sm status-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px; background-color: #e0f2fe; color: #0369a1;">
                            <i data-feather="truck" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <div class="small fw-semibold text-muted" style="font-size: 12.5px;">Đang giao hàng</div>
                            <div class="fs-5 fw-bold" style="color: #0f172a;"><?= number_format($so_don_giao) ?> <span class="small fw-normal text-muted" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #94a3b8;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 3. Đã hoàn thành (donhang.trangthai = 3) -->
    <div class="col-6 col-xl-3">
        <a href="../qldonhang/index.php" class="text-decoration-none d-block h-100">
            <div class="card h-100 shadow-sm status-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px; background-color: #dcfce7; color: #15803d;">
                            <i data-feather="check-circle" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <div class="small fw-semibold text-muted" style="font-size: 12.5px;">Đã hoàn thành</div>
                            <div class="fs-5 fw-bold" style="color: #0f172a;"><?= number_format($so_don_hoanthanh) ?> <span class="small fw-normal text-muted" style="font-size: 12px;">đơn</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #94a3b8;"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- 4. Yêu cầu bảo hành chờ xử lý (baohanh.trangthai = 0) -->
    <div class="col-6 col-xl-3">
        <a href="../qlbaohanh/index.php?trangthai=0" class="text-decoration-none d-block h-100">
            <div class="card h-100 shadow-sm status-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 38px; height: 38px; background-color: #fee2e2; color: #b91c1c;">
                            <i data-feather="shield" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <div class="small fw-semibold text-muted" style="font-size: 12.5px;">Bảo hành chờ xử lý</div>
                            <div class="fs-5 fw-bold" style="color: #0f172a;"><?= number_format($so_bh_cho) ?> <span class="small fw-normal text-muted" style="font-size: 12px;">yêu cầu</span></div>
                        </div>
                    </div>
                    <i data-feather="chevron-right" style="width: 18px; height: 18px; color: #94a3b8;"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- ================= 4. 2 BẢNG DỮ LIỆU PHÍA DƯỚI (TỶ LỆ 7 - 5) ================= -->
<div class="row g-3">
    <!-- Cột trái (col-lg-7) — ĐƠN HÀNG MỚI NHẤT -->
    <div class="col-12 col-lg-7 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 18px; background-color: #d70018; border-radius: 3px; margin-right: 10px; flex-shrink: 0;"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1rem;">Đơn hàng mới nhất</h5>
                </div>
                <a href="../qldonhang/index.php" class="btn-card-more">
                    <span>Xem tất cả</span>
                    <i class="align-middle ms-1" data-feather="arrow-right" style="width: 12px; height: 12px;"></i>
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
                            <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <tr>
                                    <th class="ps-4 py-3 text-muted fw-semibold" style="width: 120px; font-size: 11.5px; text-transform: uppercase;">Mã ĐH</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size: 11.5px; text-transform: uppercase;">Khách hàng</th>
                                    <th class="py-3 text-muted fw-semibold" style="width: 135px; font-size: 11.5px; text-transform: uppercase;">Ngày đặt</th>
                                    <th class="py-3 text-center text-muted fw-semibold" style="width: 140px; font-size: 11.5px; text-transform: uppercase;">Trạng thái</th>
                                    <th class="pe-4 py-3 text-end text-muted fw-semibold" style="width: 130px; font-size: 11.5px; text-transform: uppercase;">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donhangmoinhat as $dh): ?>
                                    <tr>
                                        <!-- Mã ĐH: huy hiệu bấm vào xem chi tiết -->
                                        <td class="ps-4">
                                            <a href="../qldonhang/index.php?action=chitiet&id=<?= $dh["id"] ?>" class="badge text-decoration-none fw-bold" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 12px; padding: 5px 8px; border-radius: 6px;" title="Xem chi tiết đơn hàng">
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

                                        <!-- Trạng thái đơn (Pastel pill dịu mắt) -->
                                        <td class="text-center">
                                            <?php 
                                            $tt = (int)($dh["trangthai"] ?? 0);
                                            if ($tt === 0) {
                                                echo '<span class="badge rounded-pill px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; font-size: 11px; font-weight: 600;"><i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i>Chờ xác nhận</span>';
                                            } elseif ($tt === 1) {
                                                echo '<span class="badge rounded-pill px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; font-size: 11px; font-weight: 600;"><i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đã duyệt</span>';
                                            } elseif ($tt === 2) {
                                                echo '<span class="badge rounded-pill px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; font-size: 11px; font-weight: 600;"><i class="align-middle me-1" data-feather="truck" style="width: 11px; height: 11px;"></i>Đang giao</span>';
                                            } elseif ($tt === 3) {
                                                echo '<span class="badge rounded-pill px-2.5 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; font-size: 11px; font-weight: 600;"><i class="align-middle me-1" data-feather="check-circle" style="width: 11px; height: 11px;"></i>Hoàn thành</span>';
                                            } else {
                                                echo '<span class="badge rounded-pill px-2.5 py-1 text-nowrap" style="background-color: #fee2e2; color: #b91c1c; font-size: 11px; font-weight: 600;"><i class="align-middle me-1" data-feather="x-circle" style="width: 11px; height: 11px;"></i>Đã hủy</span>';
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
        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="background-color: #ffffff;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 18px; background-color: #d70018; border-radius: 3px; margin-right: 10px; flex-shrink: 0;"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1rem;">
                        Cảnh báo tồn kho (Thấp nhất)
                    </h5>
                </div>
                <a href="../qlnhaphang/index.php" class="btn-card-more">
                    <span>Nhập thêm hàng</span>
                    <i class="align-middle ms-1" data-feather="plus" style="width: 12px; height: 12px;"></i>
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
                            <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <tr>
                                    <th class="ps-3 py-3 text-muted fw-semibold" style="width: 60px; font-size: 11.5px; text-transform: uppercase;">Ảnh</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size: 11.5px; text-transform: uppercase;">Tên điện thoại</th>
                                    <th class="pe-4 py-3 text-end text-muted fw-semibold" style="width: 120px; font-size: 11.5px; text-transform: uppercase;">Tồn kho</th>
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

                                        <!-- Huy hiệu phân cấp mức tồn kho dịu mắt pastel -->
                                        <td class="pe-4 text-end">
                                            <?php if ($sp["soluongton"] < 5): ?>
                                                <span class="badge rounded-pill px-2.5 py-1 fw-bold" style="background-color: #fee2e2; color: #b91c1c; font-size: 11.5px;" title="Cần nhập hàng khẩn cấp">
                                                    <i class="align-middle me-1" data-feather="alert-circle" style="width: 11px; height: 11px;"></i>Còn <?= $sp["soluongton"] ?>
                                                </span>
                                            <?php elseif ($sp["soluongton"] <= 12): ?>
                                                <span class="badge rounded-pill px-2.5 py-1 fw-bold" style="background-color: #fef3c7; color: #b45309; font-size: 11.5px;" title="Sắp hết hàng">
                                                    Còn <?= $sp["soluongton"] ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-2.5 py-1 fw-bold" style="background-color: #dcfce7; color: #15803d; font-size: 11.5px;">
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
