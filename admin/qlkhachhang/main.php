<?php 
include("../inc/top.php"); 

// Tính toán 3 chỉ số thống kê trực tiếp từ danh sách khách hàng hiện có
$tong_khachhang = !empty($khachhang) ? count($khachhang) : 0;
$khach_hoatdong = 0;
$tong_doanhthu_kh = 0;
if (!empty($khachhang)) {
    foreach ($khachhang as $k_item) {
        if ((int)($k_item["trangthai"] ?? 1) === 1) {
            $khach_hoatdong++;
        }
        $tong_doanhthu_kh += (float)($k_item["tongchitieu"] ?? 0);
    }
}
?>

<style>
.column-table-header {
    color: #475569;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
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
</style>

<!-- ================= 1. HEADER TRANG & Ô TÌM KIẾM ĐỒNG BỘ ================= -->
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-md-7">
        <div class="d-flex align-items-center">
            <div style="width: 5px; height: 42px; background-color: #d70018; border-radius: 4px; margin-right: 14px; flex-shrink: 0;"></div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <h2 class="h3 fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">QUẢN LÝ KHÁCH HÀNG</h2>
                    <span class="badge bg-white text-secondary border px-2 py-1 shadow-sm" style="border-radius: 8px; font-weight: 500; font-size: 12px;">
                        Tổng cộng: <strong class="text-dark"><?= number_format($tong_khachhang) ?></strong> khách hàng
                    </span>
                </div>
                <p class="text-muted small mb-0">
                    Theo dõi lịch sử mua sắm, tổng chi tiêu và trạng thái tài khoản khách hàng tại Thảo Mobile
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <form class="d-flex justify-content-md-end align-items-center gap-2" method="get" action="index.php">
            <div class="input-group" style="max-width: 320px;">
                <input type="text" name="tukhoa" class="form-control" placeholder="Tìm theo tên, SĐT, email..." value="<?= htmlspecialchars($tukhoa ?? '') ?>" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1; font-size: 13.5px;">
                <button class="btn btn-red-action px-3" type="submit" title="Tìm kiếm" style="border-radius: <?= empty($tukhoa) ? '0 10px 10px 0' : '0' ?>;">
                    <i class="align-middle" data-feather="search" style="width: 15px; height: 15px;"></i>
                </button>
                <?php if(!empty($tukhoa)): ?>
                    <a href="index.php" class="btn btn-outline-secondary d-flex align-items-center px-2" title="Xóa tìm kiếm" style="border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
                        <i class="align-middle" data-feather="x" style="width: 15px; height: 15px;"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- ================= 2. HÀNG 3 THẺ THỐNG KÊ NHANH ================= -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Tổng khách hàng thành viên -->
    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4" style="background-color: #ffffff; border-left: 4px solid #0d6efd !important;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-bold small text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Tổng khách hàng</span>
                    <h3 class="fw-bold my-1 text-dark" style="font-size: 1.55rem;"><?= number_format($tong_khachhang) ?> <span class="fs-6 fw-normal text-muted">thành viên</span></h3>
                    <div class="text-muted small" style="font-size: 12px;"><i class="align-middle me-1 text-primary" data-feather="users" style="width: 13px; height: 13px;"></i>Tài khoản hệ thống</div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background-color: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                    <i data-feather="user" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Khách hàng đang hoạt động -->
    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4" style="background-color: #ffffff; border-left: 4px solid #198754 !important;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-bold small text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Đang hoạt động</span>
                    <h3 class="fw-bold my-1 text-dark" style="font-size: 1.55rem;"><?= number_format($khach_hoatdong) ?> <span class="fs-6 fw-normal text-muted">tài khoản</span></h3>
                    <div class="text-muted small" style="font-size: 12px;"><i class="align-middle me-1 text-success" data-feather="check-circle" style="width: 13px; height: 13px;"></i>Sẵn sàng giao dịch</div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background-color: rgba(25, 135, 84, 0.1); color: #198754;">
                    <i data-feather="user-check" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Tổng doanh thu từ khách hàng -->
    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4" style="background-color: #ffffff; border-left: 4px solid #d70018 !important;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-bold small text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Tổng chi tiêu</span>
                    <h3 class="fw-bold my-1" style="color: #d70018; font-size: 1.55rem;"><?= number_format($tong_doanhthu_kh, 0, ',', '.') ?>đ</h3>
                    <div class="text-muted small" style="font-size: 12px;"><i class="align-middle me-1 text-danger" data-feather="shopping-bag" style="width: 13px; height: 13px;"></i>Đơn hàng hoàn thành</div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background-color: rgba(215, 0, 24, 0.1); color: #d70018;">
                    <i data-feather="dollar-sign" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= 3. BẢNG DANH SÁCH KHÁCH HÀNG ================= -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #ffffff;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <tr>
                        <th class="ps-4 py-3 text-center" style="width: 110px;">
                            <span class="column-table-header">MÃ KH</span>
                        </th>
                        <th class="py-3" style="min-width: 220px;">
                            <span class="column-table-header">KHÁCH HÀNG</span>
                        </th>
                        <th class="py-3" style="min-width: 150px;">
                            <span class="column-table-header">SỐ ĐIỆN THOẠI</span>
                        </th>
                        <th class="py-3 text-center" style="width: 110px;">
                            <span class="column-table-header">ĐƠN HÀNG</span>
                        </th>
                        <th class="py-3 text-end" style="width: 160px;">
                            <span class="column-table-header">TỔNG CHI TIÊU</span>
                        </th>
                        <th class="py-3 text-center" style="width: 140px;">
                            <span class="column-table-header">TRẠNG THÁI</span>
                        </th>
                        <th class="pe-4 py-3 text-center" style="width: 160px; white-space: nowrap;">
                            <span class="column-table-header">THAO TÁC</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($khachhang)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i data-feather="users" style="width: 44px; height: 44px; stroke-width: 1.5; color: #adb5bd;" class="mb-2"></i>
                                <?php if(!empty($tukhoa)): ?>
                                    <p class="mb-1 fw-semibold">Không tìm thấy khách hàng nào khớp với từ khóa "<strong><?= htmlspecialchars($tukhoa) ?></strong>".</p>
                                    <a href="index.php" class="btn btn-sm btn-outline-danger mt-2" style="border-radius: 8px;">Xem tất cả khách hàng</a>
                                <?php else: ?>
                                    <p class="mb-0 fw-semibold">Chưa có dữ liệu khách hàng nào trong hệ thống.</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($khachhang as $k): 
                            $avatar = !empty($k["hinhanh"]) ? "../../" . $k["hinhanh"] : "../../images/users/user.png";
                            $sodon = (int)($k["sodonhang"] ?? 0);
                            $tongtien = (float)($k["tongchitieu"] ?? 0);
                            $trangthai = (int)($k["trangthai"] ?? 1);
                            $firstChar = mb_strtoupper(mb_substr(trim($k["hoten"] ?? 'K'), 0, 1, "UTF-8"), "UTF-8");
                        ?>
                        <tr>
                            <!-- Mã KH -->
                            <td class="ps-4 text-center">
                                <span class="badge fw-bold" style="background-color: #f1f3f5; color: #1971c2; border: 1px solid #dee2e6; font-size: 12px; padding: 6px 9px; border-radius: 6px;">
                                    #<?= sprintf("KH%05d", $k["id"]) ?>
                                </span>
                            </td>

                            <!-- Khách hàng: Avatar + Họ tên + Email -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3 position-relative" style="width: 38px; height: 38px; flex-shrink: 0;">
                                        <?php if (!empty($k["hinhanh"])): ?>
                                            <img src="<?= $avatar ?>" alt="<?= htmlspecialchars($k["hoten"]) ?>" 
                                                 class="rounded-circle border" width="38" height="38" 
                                                 style="object-fit: cover;" 
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="rounded-circle align-items-center justify-content-center text-white fw-bold shadow-sm" 
                                                 style="width: 38px; height: 38px; background: linear-gradient(135deg, #d70018 0%, #b91c1c 100%); display: none; font-size: 14px;">
                                                <?= $firstChar ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                                 style="width: 38px; height: 38px; background: #e0f2fe; color: #0369a1; font-size: 14px; border: 1px solid #bae6fd;">
                                                <?= $firstChar ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 13.5px;">
                                            <?= htmlspecialchars($k["hoten"]) ?>
                                        </div>
                                        <div class="text-muted small" style="font-size: 12px;">
                                            <?= htmlspecialchars($k["email"]) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Số điện thoại -->
                            <td>
                                <div class="d-flex align-items-center text-dark" style="font-size: 13px;">
                                    <i class="align-middle me-2" data-feather="phone" style="width: 14px; height: 14px; color: #d70018; flex-shrink: 0;"></i>
                                    <span class="fw-semibold"><?= htmlspecialchars($k["sodienthoai"]) ?></span>
                                </div>
                            </td>

                            <!-- Đơn hàng -->
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px; font-weight: 600;">
                                    <?= $sodon ?> đơn
                                </span>
                            </td>

                            <!-- Tổng chi tiêu & VIP -->
                            <td class="text-end">
                                <div class="fw-bold fs-6" style="color: #d70018;">
                                    <?= number_format($tongtien, 0, ',', '.') ?>đ
                                </div>
                                <?php if($tongtien >= 30000000): ?>
                                    <span class="badge px-2 py-1 mt-1 fw-bold text-dark" style="background-color: #fef08a; border: 1px solid #fde047; font-size: 10.5px;">
                                        <i class="align-middle me-1 text-warning" data-feather="star" style="width: 10px; height: 10px;"></i>★ VIP
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Trạng thái -->
                            <td class="text-center">
                                <?php if($trangthai === 1): ?>
                                    <span class="badge rounded-pill fw-bold px-2 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; font-size: 11.5px; border: 1px solid #bbf7d0;">
                                        ● Hoạt động
                                    </span>
                                <?php else: ?>
                                    <span class="badge rounded-pill fw-bold px-2 py-1 text-nowrap" style="background-color: #ffedd5; color: #c2410c; font-size: 11.5px; border: 1px solid #fed7aa;">
                                        ● Đã khóa
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Thao tác: Xem chi tiết & Khóa / Mở khóa -->
                            <td class="pe-4 text-center text-nowrap">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <a href="index.php?action=chitiet&id=<?= $k["id"] ?>" 
                                       class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center p-1" 
                                       title="Xem chi tiết & lịch sử mua" 
                                       style="border-radius: 8px; width: 32px; height: 32px;">
                                        <i class="align-middle" data-feather="eye" style="width: 15px; height: 15px;"></i>
                                    </a>

                                    <?php if($trangthai === 1): ?>
                                        <a href="index.php?action=doitrangthai&id=<?= $k["id"] ?>&trangthai=0<?= !empty($tukhoa) ? '&tukhoa=' . urlencode($tukhoa) : '' ?>" 
                                           class="btn btn-sm btn-outline-danger d-inline-flex align-items-center py-1 px-2" 
                                           onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản khách hàng <?= htmlspecialchars($k['hoten']) ?> không?');" 
                                           title="Khóa tài khoản" 
                                           style="border-radius: 8px; font-size: 12px; font-weight: 500;">
                                            <i class="align-middle me-1" data-feather="lock" style="width: 12px; height: 12px;"></i>Khóa
                                        </a>
                                    <?php else: ?>
                                        <a href="index.php?action=doitrangthai&id=<?= $k["id"] ?>&trangthai=1<?= !empty($tukhoa) ? '&tukhoa=' . urlencode($tukhoa) : '' ?>" 
                                           class="btn btn-sm btn-outline-success d-inline-flex align-items-center py-1 px-2" 
                                           onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản khách hàng <?= htmlspecialchars($k['hoten']) ?> không?');" 
                                           title="Mở khóa tài khoản" 
                                           style="border-radius: 8px; font-size: 12px; font-weight: 500;">
                                            <i class="align-middle me-1" data-feather="unlock" style="width: 12px; height: 12px;"></i>Mở khóa
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
