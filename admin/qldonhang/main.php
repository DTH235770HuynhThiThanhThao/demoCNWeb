<?php include("../inc/top.php"); ?>

<?php
// Đếm số lượng đơn theo từng trạng thái
$count_all = !empty($donhang) ? count($donhang) : 0;
$count_cho = 0;
$count_giao = 0;
$count_xong = 0;
$count_huy = 0;

if(!empty($donhang)){
    foreach($donhang as $d){
        $st = (int)($d["trangthai"] ?? 0);
        if($st === 0) $count_cho++;
        elseif($st === 1 || $st === 2) $count_giao++;
        elseif($st === 3) $count_xong++;
        elseif($st === 4 || $st === -1) $count_huy++;
    }
}
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
.tab-filter-btn {
    border: none;
    background: transparent;
    color: #475569;
    font-weight: 600;
    font-size: 13.5px;
    padding: 7px 14px;
    border-radius: 8px;
    transition: all 0.2s ease;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.tab-filter-btn:hover {
    background-color: #f1f5f9;
    color: #1e293b;
}
.tab-filter-btn.active {
    background-color: #d70018 !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(215, 0, 24, 0.25);
}
.tab-filter-btn .badge-count {
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0.08);
}
.tab-filter-btn.active .badge-count {
    background-color: rgba(255, 255, 255, 0.25);
    color: #ffffff;
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
.btn-action-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    color: #475569;
    transition: all 0.2s ease;
}
.btn-action-icon:hover {
    background-color: #f1f5f9;
    color: #0f172a;
    border-color: #cbd5e1;
}
.btn-confirm-order {
    background-color: #16a34a;
    color: #ffffff;
    border: 1px solid #16a34a;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-confirm-order:hover {
    background-color: #15803d;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(22, 163, 74, 0.3);
}
.btn-cancel-order {
    background-color: #fff5f5;
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-cancel-order:hover {
    background-color: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
}
.btn-ship-order {
    background-color: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-ship-order:hover {
    background-color: #0284c7;
    color: #ffffff;
    border-color: #0284c7;
}
.btn-done-order {
    background-color: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12.5px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-done-order:hover {
    background-color: #16a34a;
    color: #ffffff;
    border-color: #16a34a;
}
</style>

<!-- 1. Thanh tiêu đề & Tổng số đơn hàng -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ ĐƠN HÀNG</h3>
                            <p class="text-muted small mb-0 mt-1">Theo dõi, xác nhận đơn đặt hàng và cập nhật tiến độ giao hàng tại Thảo Mobile</p>
                        </div>
                    </div>
                    <div>
                        <span class="badge fw-bold px-3 py-2" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 8px; font-size: 13.5px;">
                            Tổng cộng: <?= $count_all ?> đơn hàng
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Thanh Tab lọc trạng thái nhanh & Tìm kiếm 1 hàng gọn đẹp -->
<div class="card border-0 shadow-sm rounded-4 p-2 mb-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <!-- Các tab lọc trạng thái -->
        <div class="d-flex align-items-center gap-1 flex-wrap">
            <button type="button" class="tab-filter-btn active" data-filter="all">
                <span>Tất cả</span>
                <span class="badge-count"><?= $count_all ?></span>
            </button>
            <button type="button" class="tab-filter-btn" data-filter="0">
                <span>Chờ xác nhận</span>
                <span class="badge-count"><?= $count_cho ?></span>
            </button>
            <button type="button" class="tab-filter-btn" data-filter="giao">
                <span>Đang giao</span>
                <span class="badge-count"><?= $count_giao ?></span>
            </button>
            <button type="button" class="tab-filter-btn" data-filter="3">
                <span>Hoàn thành</span>
                <span class="badge-count"><?= $count_xong ?></span>
            </button>
            <button type="button" class="tab-filter-btn" data-filter="4">
                <span>Đã hủy</span>
                <span class="badge-count"><?= $count_huy ?></span>
            </button>
        </div>

        <!-- Ô tìm kiếm nhanh -->
        <div style="min-width: 240px;" class="ms-auto">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;">
                    <i class="align-middle" data-feather="search" style="width: 14px; height: 14px;"></i>
                </span>
                <input type="text" id="inputTimKiemDonHang" class="form-control shadow-none border-start-0" placeholder="Tìm mã ĐH, khách, SĐT..." style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; height: 35px; font-size: 13px;">
            </div>
        </div>
    </div>
</div>

<!-- 3. Bảng danh sách đơn hàng (Soft Pastel Badges & Nút tinh gọn) -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="bangDonHang">
                <thead class="table-flagship-head">
                    <tr>
                        <th class="text-center ps-3" style="width: 110px;">Mã ĐH</th>
                        <th style="min-width: 210px;">Khách hàng</th>
                        <th style="width: 160px;">Ngày đặt</th>
                        <th class="text-end" style="width: 150px;">Tổng tiền</th>
                        <th class="text-center" style="width: 160px;">Trạng thái</th>
                        <th class="text-center pe-3" style="width: 190px; white-space: nowrap;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($donhang)): ?>
                    <tr class="row-empty">
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="align-middle text-muted mb-2" data-feather="inbox" style="width: 36px; height: 36px; opacity: 0.4;"></i>
                            <div class="fw-semibold">Chưa có đơn hàng nào trong hệ thống.</div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($donhang as $d): 
                        $tt = (int)($d["trangthai"] ?? 0);
                        $ma_dh = sprintf("DH%06d", $d["id"]);
                        $hoten = $d["hoten"] ?? "Khách vãng lai";
                        $sdt = $d["sodienthoai"] ?? "";
                        $ngay_fmt = date("d/m/Y • H:i", strtotime($d["ngay"]));
                        
                        // Xác định nhóm trạng thái cho bộ lọc tab
                        $group_filter = "other";
                        if($tt === 0) $group_filter = "0";
                        elseif($tt === 1 || $tt === 2) $group_filter = "giao";
                        elseif($tt === 3) $group_filter = "3";
                        elseif($tt === 4 || $tt === -1) $group_filter = "4";
                    ?>
                    <tr class="don-row" data-status="<?= $group_filter ?>" data-search="<?= strtolower(htmlspecialchars($ma_dh . ' ' . $hoten . ' ' . $sdt)) ?>">
                        <!-- Cột 1: Mã ĐH (bấm vào mở thẳng chi tiết) -->
                        <td class="text-center ps-3">
                            <a href="index.php?action=chitiet&id=<?= $d["id"] ?>" class="fw-bold text-decoration-none" style="color: #d70018; letter-spacing: -0.3px; font-size: 13.5px;" title="Xem chi tiết đơn hàng">
                                #<?= $ma_dh ?>
                            </a>
                        </td>

                        <!-- Cột 2: Khách hàng -->
                        <td>
                            <strong class="text-dark d-block" style="font-size: 13.5px;"><?= htmlspecialchars($hoten) ?></strong>
                            <?php if(!empty($sdt)): ?>
                                <small class="text-muted"><i class="align-middle me-1" data-feather="phone" style="width: 12px; height: 12px;"></i><?= htmlspecialchars($sdt) ?></small>
                            <?php else: ?>
                                <small class="text-muted fst-italic">Chưa có SĐT</small>
                            <?php endif; ?>
                        </td>

                        <!-- Cột 3: Ngày đặt -->
                        <td>
                            <span class="text-secondary" style="font-size: 13px; font-weight: 500;">
                                <?= $ngay_fmt ?>
                            </span>
                        </td>

                        <!-- Cột 4: Tổng tiền -->
                        <td class="text-end">
                            <span class="fw-bold fs-6" style="color: #d70018; letter-spacing: -0.3px;">
                                <?= number_format($d["tongtien"]) ?>đ
                            </span>
                        </td>

                        <!-- Cột 5: Trạng thái (Soft Pastel Badges bo tròn rounded-pill) -->
                        <td class="text-center">
                            <?php 
                            if($tt === 0){
                                echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 12px;"><i class="align-middle me-1" data-feather="clock" style="width: 12px; height: 12px;"></i>Chờ xác nhận</span>';
                            } elseif($tt === 1){
                                echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px;"><i class="align-middle me-1" data-feather="check-circle" style="width: 12px; height: 12px;"></i>Đã duyệt</span>';
                            } elseif($tt === 2){
                                echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px;"><i class="align-middle me-1" data-feather="truck" style="width: 12px; height: 12px;"></i>Đang giao</span>';
                            } elseif($tt === 3){
                                echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px;"><i class="align-middle me-1" data-feather="check-square" style="width: 12px; height: 12px;"></i>Hoàn thành</span>';
                            } elseif($tt === 4 || $tt === -1){
                                echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 12px;"><i class="align-middle me-1" data-feather="x-circle" style="width: 12px; height: 12px;"></i>Đã hủy</span>';
                            }
                            ?>
                        </td>

                        <!-- Cột 6: Thao tác tinh gọn -->
                        <td class="text-center pe-3 text-nowrap">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2 flex-nowrap">
                                <!-- Nút xem chi tiết -->
                                <a href="index.php?action=chitiet&id=<?= $d["id"] ?>" class="btn-action-icon" title="Xem chi tiết đơn hàng">
                                    <i class="align-middle" data-feather="eye" style="width: 14px; height: 14px;"></i>
                                </a>

                                <?php if($tt === 0): ?>
                                    <!-- Nút Duyệt -->
                                    <a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=1" class="btn-confirm-order d-inline-flex align-items-center" title="Duyệt đơn hàng">
                                        <i class="align-middle me-1" data-feather="check" style="width: 13px; height: 13px;"></i>Duyệt
                                    </a>
                                    <!-- Nút Hủy -->
                                    <a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=4" class="btn-cancel-order d-inline-flex align-items-center" onclick="return confirm('Xác nhận hủy đơn hàng #<?= $ma_dh ?>?');" title="Hủy đơn hàng">
                                        <i class="align-middle me-1" data-feather="x" style="width: 13px; height: 13px;"></i>Hủy
                                    </a>
                                <?php elseif($tt === 1): ?>
                                    <!-- Nút Giao hàng -->
                                    <a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=2" class="btn-ship-order d-inline-flex align-items-center" title="Bắt đầu giao hàng">
                                        <i class="align-middle me-1" data-feather="truck" style="width: 13px; height: 13px;"></i>Giao
                                    </a>
                                    <!-- Nút Hủy -->
                                    <a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=4" class="btn-cancel-order d-inline-flex align-items-center" onclick="return confirm('Xác nhận hủy đơn hàng #<?= $ma_dh ?>?');" title="Hủy đơn hàng">
                                        <i class="align-middle me-1" data-feather="x" style="width: 13px; height: 13px;"></i>Hủy
                                    </a>
                                <?php elseif($tt === 2): ?>
                                    <!-- Nút Hoàn thành -->
                                    <a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=3" class="btn-done-order d-inline-flex align-items-center" title="Xác nhận hoàn thành">
                                        <i class="align-middle me-1" data-feather="check-circle" style="width: 13px; height: 13px;"></i>Hoàn thành
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
document.addEventListener("DOMContentLoaded", function() {
    var tabBtns = document.querySelectorAll(".tab-filter-btn");
    var searchInput = document.getElementById("inputTimKiemDonHang");
    var rows = document.querySelectorAll("#bangDonHang tbody tr.don-row");
    var currentTab = "all";

    function filterTable() {
        var keyword = (searchInput ? searchInput.value : "").trim().toLowerCase();
        var visibleCount = 0;

        rows.forEach(function(row) {
            var rowStatus = row.getAttribute("data-status");
            var rowSearch = row.getAttribute("data-search") || "";

            var matchStatus = (currentTab === "all") || (rowStatus === currentTab);
            var matchSearch = (keyword === "") || (rowSearch.indexOf(keyword) !== -1);

            if(matchStatus && matchSearch) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });
    }

    tabBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            tabBtns.forEach(function(b) { b.classList.remove("active"); });
            this.classList.add("active");
            currentTab = this.getAttribute("data-filter") || "all";
            filterTable();
        });
    });

    if(searchInput) {
        searchInput.addEventListener("input", filterTable);
    }
});
</script>

<?php include("../inc/bottom.php"); ?>