<?php include("../inc/top.php"); ?>

<!-- 1. Thanh tiêu đề & Bộ lọc thời gian -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <h3 class="text-info fw-bold mb-1">
                            <i class="align-middle me-2" data-feather="bar-chart-2"></i>Quản lý doanh thu
                        </h3>
                        <p class="text-muted small mb-0">Báo cáo doanh thu thực tế từ các đơn hàng đã hoàn thành</p>
                    </div>
                    <div class="col-lg-7">
                        <form method="get" action="index.php" class="row g-2 justify-content-lg-end align-items-center">
                            <input type="hidden" name="nam" value="<?php echo $nam; ?>">
                            <div class="col-sm-4 col-6">
                                <label class="form-label small text-muted mb-1">Từ ngày:</label>
                                <input type="date" class="form-control form-control-sm" name="tungay" value="<?php echo htmlspecialchars($tungay); ?>">
                            </div>
                            <div class="col-sm-4 col-6">
                                <label class="form-label small text-muted mb-1">Đến ngày:</label>
                                <input type="date" class="form-control form-control-sm" name="denngay" value="<?php echo htmlspecialchars($denngay); ?>">
                            </div>
                            <div class="col-sm-4 col-12 d-flex gap-1 align-self-end mt-2 mt-sm-0">
                                <button type="submit" class="btn btn-sm btn-primary flex-fill">
                                    <i class="align-middle me-1" data-feather="filter"></i>Lọc
                                </button>
                                <a href="index.php?nam=<?php echo $nam; ?>" class="btn btn-sm btn-outline-secondary" title="Đặt lại bộ lọc thời gian">
                                    <i class="align-middle" data-feather="rotate-ccw"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Hàng 1 — 4 Thẻ chỉ số tài chính logic -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Doanh thu thực tế (Hoàn thành) -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 border-start border-success border-4">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted mb-1">Doanh thu thực tế</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-success bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="check-circle"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-2 text-success fw-bold"><?php echo number_format($doanhthuthucte, 0, ',', '.'); ?>đ</h3>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-success-subtle text-success me-1">Đã thu</span>
                    <span>Từ <b><?php echo number_format($sodonhoanthanh); ?></b> đơn hoàn thành</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Doanh thu đang xử lý -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted mb-1">Doanh thu đang xử lý</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-warning bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="clock"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-2 text-warning fw-bold"><?php echo number_format($doanhthuchoxuly, 0, ',', '.'); ?>đ</h3>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-warning-subtle text-warning me-1">Tạm tính</span>
                    <span>Chờ duyệt / Đang giao hàng</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Giá trị đơn đã hủy -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 border-start border-danger border-4">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted mb-1">Giá trị đơn đã hủy</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-danger bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="x-circle"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-2 text-danger fw-bold"><?php echo number_format($tongtienhuy, 0, ',', '.'); ?>đ</h3>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-danger-subtle text-danger me-1">Thất thoát</span>
                    <span>Từ các đơn hàng bị hủy bỏ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Giá trị trung bình / đơn -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 border-start border-primary border-4">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted mb-1">Giá trị TB / đơn</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-primary bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="trending-up"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-2 text-primary fw-bold"><?php echo number_format($giatritrungbinh, 0, ',', '.'); ?>đ</h3>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-primary-subtle text-primary me-1">AOV</span>
                    <span>Doanh thu / Đơn hoàn thành</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. Hàng 2 — Biểu đồ 12 tháng & Doanh thu theo hãng -->
<div class="row g-3 mb-4">
    <!-- Cột trái (col-lg-7): Biểu đồ cột doanh thu 12 tháng -->
    <div class="col-lg-7">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-primary" data-feather="calendar"></i>
                    Biểu đồ doanh thu năm <?php echo $nam; ?> (Theo tháng)
                </h5>
                <div class="d-flex align-items-center gap-1">
                    <label class="small text-muted mb-0 me-1">Năm:</label>
                    <select class="form-select form-select-sm" style="width: 90px;" onchange="location.href='index.php?nam=' + this.value + '&tungay=<?php echo urlencode($tungay); ?>&denngay=<?php echo urlencode($denngay); ?>';">
                        <?php 
                        $nam_hientai = (int)date("Y");
                        for($y = $nam_hientai; $y >= $nam_hientai - 3; $y--): 
                        ?>
                            <option value="<?php echo $y; ?>" <?php if($y == $nam) echo "selected"; ?>><?php echo $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 300px; position: relative;">
                    <canvas id="chartDoanhThuThang"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột phải (col-lg-5): Bảng Doanh thu theo hãng điện thoại -->
    <div class="col-lg-5">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-info" data-feather="pie-chart"></i>
                    Tỷ trọng doanh thu theo hãng
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Hãng</th>
                                <th class="text-center">Số máy</th>
                                <th class="text-end">Doanh thu</th>
                                <th class="text-center pe-3" style="width: 100px;">Tỷ trọng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($doanhthuhang)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Chưa có dữ liệu</td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                foreach($doanhthuhang as $h): 
                                    $tytrong = ($doanhthuthucte > 0) ? round(($h["doanhthu"] / $doanhthuthucte) * 100, 1) : 0;
                                    
                                    // Phân màu theo hãng
                                    $hang_lower = strtolower($h["tenhang"]);
                                    $badge_class = "bg-secondary";
                                    $bar_class = "bg-secondary";
                                    if(strpos($hang_lower, "apple") !== false) {
                                        $badge_class = "bg-dark";
                                        $bar_class = "bg-dark";
                                    } elseif(strpos($hang_lower, "samsung") !== false) {
                                        $badge_class = "bg-primary";
                                        $bar_class = "bg-primary";
                                    } elseif(strpos($hang_lower, "oppo") !== false) {
                                        $badge_class = "bg-success";
                                        $bar_class = "bg-success";
                                    } elseif(strpos($hang_lower, "xiaomi") !== false) {
                                        $badge_class = "bg-warning text-dark";
                                        $bar_class = "bg-warning";
                                    }
                                ?>
                                <tr>
                                    <td class="ps-3 fw-bold">
                                        <span class="badge <?php echo $badge_class; ?> me-1"><?php echo $h["tenhang"]; ?></span>
                                    </td>
                                    <td class="text-center fw-semibold"><?php echo number_format($h["somay"]); ?></td>
                                    <td class="text-end fw-bold text-danger"><?php echo number_format($h["doanhthu"]); ?>đ</td>
                                    <td class="pe-3">
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1" style="height: 6px;">
                                                <div class="progress-bar <?php echo $bar_class; ?>" role="progressbar" style="width: <?php echo min(100, $tytrong); ?>%"></div>
                                            </div>
                                            <small class="ms-2 text-muted fw-bold" style="min-width: 38px; text-align: right;"><?php echo $tytrong; ?>%</small>
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
    </div>
</div>

<!-- 4. Hàng 3 — Bảng Top 5 điện thoại doanh thu cao nhất -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-danger" data-feather="award"></i>
                    Top 5 điện thoại mang lại doanh thu cao nhất (Đơn hoàn thành)
                </h5>
                <a href="../qldonhang/index.php" class="btn btn-sm btn-outline-primary">
                    <i class="align-middle me-1" data-feather="truck"></i>Đối chiếu đơn hàng &rarr;
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 70px;">Hạng</th>
                                <th style="width: 70px;">Ảnh</th>
                                <th>Tên điện thoại</th>
                                <th>Hãng</th>
                                <th class="text-center" style="width: 140px;">Số lượng bán</th>
                                <th class="text-end pe-4" style="width: 180px;">Tổng doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($topsanpham)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Chưa có sản phẩm nào hoàn thành giao dịch trong khoảng thời gian này.</td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                $rank = 0;
                                foreach($topsanpham as $sp): 
                                    $rank++;
                                    $rank_class = "bg-secondary text-white";
                                    if($rank == 1) $rank_class = "bg-danger text-white";
                                    elseif($rank == 2) $rank_class = "bg-warning text-dark";
                                    elseif($rank == 3) $rank_class = "bg-info text-white";
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge rounded-circle p-2 <?php echo $rank_class; ?>" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 800;">
                                            <?php echo $rank; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <img src="../../<?php echo htmlspecialchars($sp["hinhanh"]); ?>" 
                                             alt="<?php echo htmlspecialchars($sp["tenmathang"]); ?>" 
                                             width="44" height="44" 
                                             class="rounded border bg-white p-1" 
                                             style="object-fit: contain;"
                                             onerror="this.src='../../images/products/no-image.png'">
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark d-block"><?php echo htmlspecialchars($sp["tenmathang"]); ?></span>
                                        <small class="text-muted">Chính hãng VN/A</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($sp["tenhang"] ?? 'Điện thoại'); ?></span>
                                    </td>
                                    <td class="text-center fw-bold fs-6">
                                        <?php echo number_format($sp["tongsoluong"]); ?> <small class="text-muted fw-normal">máy</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="text-danger fw-bold fs-5"><?php echo number_format($sp["tongdoanhthu"]); ?>đ</span>
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

<!-- Nạp Chart.js từ CDN dự phòng đảm bảo vẽ biểu đồ 100% chuẩn xác -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script khởi tạo biểu đồ Chart.js -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("chartDoanhThuThang");
    if (!ctx) return;

    var duLieuThang = <?php echo json_encode(array_values($doanhthuthang)); ?>;
    var nhanThang = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: nhanThang,
            datasets: [{
                label: "Doanh thu (VNĐ)",
                backgroundColor: "#3b7ddd",
                borderColor: "#3b7ddd",
                hoverBackgroundColor: "#2c64b5",
                hoverBorderColor: "#2c64b5",
                borderRadius: 6,
                data: duLieuThang,
                barPercentage: 0.65,
                categoryPercentage: 0.7
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var val = context.raw || 0;
                            return "Doanh thu: " + new Intl.NumberFormat('vi-VN').format(val) + "đ";
                        }
                    }
                }
            },
            scales: {
                y: {
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) {
                                return (value / 1000000) + " tr";
                            }
                            return value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

<?php include("../inc/bottom.php"); ?>
