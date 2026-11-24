<?php include("../inc/top.php"); ?>

<style>
/* Style tùy biến chuẩn Tech Flagship Thảo Mobile - Tối giản, sang trọng */
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
.btn-flagship {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-reset-filter {
    border-radius: 10px;
    border-color: #cbd5e1;
    color: #64748b;
    background-color: #ffffff;
    transition: all 0.2s ease;
}
.btn-reset-filter:hover {
    background-color: #f1f5f9;
    border-color: #94a3b8;
    color: #1e293b;
}
.kpi-card {
    border-radius: 14px !important;
    background-color: #ffffff !important;
    border: 1px solid #f1f5f9 !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05) !important;
}
.kpi-card .card-body {
    padding: 16px 18px !important;
}
.icon-pastel {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.table-flagship-head th {
    background-color: #f8fafc !important;
    color: #475569 !important;
    font-weight: 700 !important;
    font-size: 13px !important;
    border-bottom: 1px solid #e2e8f0 !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}
.brand-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #d70018;
    display: inline-block;
    flex-shrink: 0;
}
</style>

<!-- 1. Thanh tiêu đề & Bộ lọc ngày gọn gàng, thoáng mắt tông Đỏ #d70018 -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0" style="border: 1px solid #f1f5f9 !important;">
            <div class="card-body p-3 p-lg-4">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <div class="brand-title-bar"></div>
                            <div>
                                <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ DOANH THU</h3>
                                <p class="text-muted small mb-0 mt-1">Báo cáo doanh thu thực tế từ các đơn hàng đã hoàn thành</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form method="get" action="index.php" class="d-flex flex-wrap align-items-end justify-content-lg-end gap-2">
                            <input type="hidden" name="nam" value="<?php echo $nam; ?>">
                            <div style="min-width: 150px;" class="flex-grow-1 flex-sm-grow-0">
                                <label class="form-label small text-muted mb-1 fw-semibold">Từ ngày:</label>
                                <input type="date" class="form-control form-control-sm border shadow-none" name="tungay" value="<?php echo htmlspecialchars($tungay); ?>" style="border-radius: 10px; border-color: #cbd5e1; height: 38px; font-size: 13.5px;">
                            </div>
                            <div style="min-width: 150px;" class="flex-grow-1 flex-sm-grow-0">
                                <label class="form-label small text-muted mb-1 fw-semibold">Đến ngày:</label>
                                <input type="date" class="form-control form-control-sm border shadow-none" name="denngay" value="<?php echo htmlspecialchars($denngay); ?>" style="border-radius: 10px; border-color: #cbd5e1; height: 38px; font-size: 13.5px;">
                            </div>
                            <button type="submit" class="btn btn-flagship d-inline-flex align-items-center justify-content-center px-3" style="border-radius: 10px; height: 38px; font-size: 14px;">
                                <i class="align-middle me-1" data-feather="filter" style="width: 16px; height: 16px;"></i>Lọc
                            </button>
                            <a href="index.php?nam=<?php echo $nam; ?>" class="btn btn-reset-filter border d-inline-flex align-items-center justify-content-center" title="Đặt lại bộ lọc thời gian" style="border-radius: 10px; height: 38px; width: 38px; padding: 0;">
                                <i class="align-middle" data-feather="rotate-ccw" style="width: 16px; height: 16px;"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Hàng 1 — 4 Thẻ chỉ số doanh thu (KPI Cards) dịu mắt, không lòe loẹt -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Doanh thu thực tế (Hoàn thành) - Đỏ thương hiệu #d70018 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4 kpi-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold" style="letter-spacing: 0.3px; font-size: 12px; color: #64748b;">Doanh thu thực tế</span>
                    <div class="icon-pastel" style="background-color: #fff1f2; color: #d70018;">
                        <i class="align-middle" data-feather="check-circle" style="width: 18px; height: 18px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #d70018; font-size: 1.45rem; letter-spacing: -0.4px;">
                    <?php echo number_format($doanhthuthucte, 0, ',', '.'); ?>đ
                </h3>
                <div class="mt-2 text-muted" style="color: #64748b !important; font-size: 12.5px;">
                    Từ <strong><?php echo number_format($sodonhoanthanh); ?></strong> đơn hàng hoàn thành
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Doanh thu đang xử lý - Tối sang trọng #0f172a, icon pastel #fef3c7 / #b45309 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4 kpi-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold" style="letter-spacing: 0.3px; font-size: 12px; color: #64748b;">Doanh thu đang xử lý</span>
                    <div class="icon-pastel" style="background-color: #fef3c7; color: #b45309;">
                        <i class="align-middle" data-feather="clock" style="width: 18px; height: 18px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #0f172a; font-size: 1.45rem; letter-spacing: -0.4px;">
                    <?php echo number_format($doanhthuchoxuly, 0, ',', '.'); ?>đ
                </h3>
                <div class="mt-2 text-muted" style="color: #64748b !important; font-size: 12.5px;">
                    Đơn chờ duyệt &amp; đang giao
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Giá trị đơn đã hủy - Xám đậm #475569, icon pastel #f1f5f9 / #64748b -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4 kpi-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold" style="letter-spacing: 0.3px; font-size: 12px; color: #64748b;">Giá trị đơn đã hủy</span>
                    <div class="icon-pastel" style="background-color: #f1f5f9; color: #64748b;">
                        <i class="align-middle" data-feather="x-circle" style="width: 18px; height: 18px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #475569; font-size: 1.45rem; letter-spacing: -0.4px;">
                    <?php echo number_format($tongtienhuy, 0, ',', '.'); ?>đ
                </h3>
                <div class="mt-2 text-muted" style="color: #64748b !important; font-size: 12.5px;">
                    Từ các đơn hàng đã hủy
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Giá trị trung bình / đơn - Tối sang trọng #0f172a, icon pastel #e0f2fe / #0369a1 -->
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-4 kpi-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold" style="letter-spacing: 0.3px; font-size: 12px; color: #64748b;">Giá trị trung bình / đơn</span>
                    <div class="icon-pastel" style="background-color: #e0f2fe; color: #0369a1;">
                        <i class="align-middle" data-feather="trending-up" style="width: 18px; height: 18px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #0f172a; font-size: 1.45rem; letter-spacing: -0.4px;">
                    <?php echo number_format($giatritrungbinh, 0, ',', '.'); ?>đ
                </h3>
                <div class="mt-2 text-muted" style="color: #64748b !important; font-size: 12.5px;">
                    Trung bình mỗi đơn hoàn thành
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. Hàng 2 — Biểu đồ doanh thu 12 tháng & Tỷ trọng doanh thu theo hãng -->
<div class="row g-3 mb-4">
    <!-- Cột trái (col-lg-7): Biểu đồ cột doanh thu 12 tháng -->
    <div class="col-lg-7">
        <div class="card h-100 shadow-sm border-0 rounded-4" style="border: 1px solid #f1f5f9 !important;">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom-0">
                <div class="d-flex align-items-center">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                        BIỂU ĐỒ DOANH THU NĂM <?php echo $nam; ?> (THEO THÁNG)
                    </h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0 fw-semibold">Năm:</label>
                    <select class="form-select form-select-sm shadow-none" style="width: 100px; border-radius: 8px; border-color: #cbd5e1; font-weight: 600; font-size: 13px;" onchange="location.href='index.php?nam=' + this.value + '&tungay=<?php echo urlencode($tungay); ?>&denngay=<?php echo urlencode($denngay); ?>';">
                        <?php 
                        $years_to_show = !empty($danhsachnam) ? $danhsachnam : [(int)date("Y")];
                        if (!in_array($nam, $years_to_show)) {
                            $years_to_show[] = $nam;
                            rsort($years_to_show);
                        }
                        foreach($years_to_show as $y): 
                        ?>
                            <option value="<?php echo $y; ?>" <?php if($y == $nam) echo "selected"; ?>><?php echo $y; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="card-body px-4 pt-1 pb-3">
                <div style="height: 310px; position: relative;">
                    <canvas id="chartDoanhThuThang"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột phải (col-lg-5): Tỷ trọng doanh thu theo hãng điện thoại -->
    <div class="col-lg-5">
        <div class="card h-100 shadow-sm border-0 rounded-4" style="border: 1px solid #f1f5f9 !important;">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center border-bottom-0">
                <div class="section-accent-bar"></div>
                <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                    TỶ TRỌNG DOANH THU THEO HÃNG
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-flagship-head">
                            <tr>
                                <th class="ps-4">Hãng</th>
                                <th class="text-center">Số máy</th>
                                <th class="text-end">Doanh thu</th>
                                <th class="text-center pe-4" style="width: 130px;">Tỷ trọng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($doanhthuhang)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Chưa có dữ liệu giao dịch theo hãng</td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                foreach($doanhthuhang as $h): 
                                    $tytrong = ($doanhthuthucte > 0) ? round(($h["doanhthu"] / $doanhthuthucte) * 100, 1) : 0;
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <span class="brand-dot me-2"></span>
                                            <span class="fw-bold" style="color: #1e293b; font-size: 13.5px;"><?php echo htmlspecialchars($h["tenhang"]); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center fw-semibold" style="color: #475569; font-size: 13.5px;">
                                        <?php echo number_format($h["somay"]); ?>
                                    </td>
                                    <td class="text-end fw-bold" style="color: #0f172a; font-size: 13.5px;">
                                        <?php echo number_format($h["doanhthu"], 0, ',', '.'); ?>đ
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1" style="height: 6px; background-color: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo min(100, $tytrong); ?>%; background-color: #d70018; border-radius: 6px;"></div>
                                            </div>
                                            <small class="ms-2 fw-bold" style="min-width: 44px; text-align: right; font-size: 12.5px; color: #1e293b;"><?php echo $tytrong; ?>%</small>
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
        <div class="card shadow-sm border-0 rounded-4 mb-4" style="border: 1px solid #f1f5f9 !important;">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom-0 flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                        TOP 5 ĐIỆN THOẠI MANG LẠI DOANH THU CAO NHẤT (ĐƠN HOÀN THÀNH)
                    </h5>
                </div>
                <a href="../qldonhang/index.php" class="btn btn-sm d-inline-flex align-items-center" style="border-radius: 8px; font-weight: 600; border: 1px solid #fecaca; color: #d70018; background-color: #fff5f5; padding: 6px 14px;">
                    <i class="align-middle me-1" data-feather="truck" style="width: 15px; height: 15px;"></i>Đối chiếu đơn hàng &rarr;
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-flagship-head">
                            <tr>
                                <th class="text-center ps-3" style="width: 80px;">Hạng</th>
                                <th style="width: 75px;">Ảnh</th>
                                <th>Tên điện thoại</th>
                                <th>Hãng</th>
                                <th class="text-center" style="width: 150px;">Số lượng bán</th>
                                <th class="text-end pe-4" style="width: 200px;">Tổng doanh thu</th>
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
                                    $rank_style = "background-color: #64748b; color: #ffffff;";
                                    if($rank == 1) $rank_style = "background-color: #d70018; color: #ffffff; box-shadow: 0 2px 6px rgba(215, 0, 24, 0.35);";
                                    elseif($rank == 2) $rank_style = "background-color: #f59e0b; color: #ffffff; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.35);";
                                    elseif($rank == 3) $rank_style = "background-color: #0ea5e9; color: #ffffff; box-shadow: 0 2px 6px rgba(14, 165, 233, 0.35);";
                                ?>
                                <tr>
                                    <td class="text-center ps-3">
                                        <span class="badge rounded-circle p-0" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; <?php echo $rank_style; ?>">
                                            <?php echo $rank; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <img src="../../<?php echo htmlspecialchars($sp["hinhanh"]); ?>" 
                                             alt="<?php echo htmlspecialchars($sp["tenmathang"]); ?>" 
                                             width="46" height="46" 
                                             class="rounded-3 border bg-white p-1 shadow-sm" 
                                             style="object-fit: contain;"
                                             onerror="this.src='../../images/products/no-image.png'">
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark d-block" style="font-size: 14px;"><?php echo htmlspecialchars($sp["tenmathang"]); ?></span>
                                        <small class="text-muted"><i class="align-middle me-1 text-success" data-feather="shield" style="width: 12px; height: 12px;"></i>Chính hãng VN/A</small>
                                    </td>
                                    <td>
                                        <span class="fw-semibold" style="color: #334155; font-size: 13px;">
                                            <?php echo htmlspecialchars($sp["tenhang"] ?? 'Điện thoại'); ?>
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold fs-6" style="color: #1e293b;">
                                        <?php echo number_format($sp["tongsoluong"]); ?> <small class="text-muted fw-normal" style="font-size: 13px;">máy</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="fw-bold fs-5" style="color: #d70018; letter-spacing: -0.3px;">
                                            <?php echo number_format($sp["tongdoanhthu"], 0, ',', '.'); ?>đ
                                        </span>
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

<!-- Script khởi tạo biểu đồ Chart.js phong cách Flagship Đỏ #d70018 -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById("chartDoanhThuThang");
    if (!canvas) return;

    var ctx = canvas.getContext("2d");
    var duLieuThang = <?php echo json_encode(array_values($doanhthuthang)); ?>;
    var nhanThang = ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"];

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: nhanThang,
            datasets: [{
                label: "Doanh thu",
                backgroundColor: '#d70018',
                hoverBackgroundColor: '#b91c1c',
                borderColor: '#d70018',
                borderWidth: 0,
                borderRadius: 8,
                borderSkipped: false,
                data: duLieuThang,
                barPercentage: 0.60,
                categoryPercentage: 0.70
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgba(15, 23, 42, 0.92)",
                    titleColor: "#ffffff",
                    titleFont: { size: 13, weight: 'bold' },
                    bodyColor: "#f8fafc",
                    bodyFont: { size: 13, weight: '500' },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        title: function(items) {
                            if (!items.length) return '';
                            var idx = items[0].dataIndex;
                            return "Tháng " + (idx + 1) + " / <?php echo $nam; ?>";
                        },
                        label: function(context) {
                            var val = context.raw || 0;
                            return "Doanh thu: " + new Intl.NumberFormat('vi-VN').format(val) + "đ";
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "#e2e8f0",
                        borderDash: [5, 5],
                        drawBorder: false
                    },
                    ticks: {
                        font: { size: 12 },
                        color: "#64748b",
                        padding: 8,
                        callback: function(value) {
                            if (value >= 1000000000) {
                                return (value / 1000000000).toFixed(1).replace('.0', '') + " tỷ";
                            }
                            if (value >= 1000000) {
                                return (value / 1000000).toFixed(0) + " tr";
                            }
                            return value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: { size: 12, weight: '600' },
                        color: "#475569",
                        padding: 6
                    }
                }
            }
        }
    });
});
</script>

<?php include("../inc/bottom.php"); ?>
