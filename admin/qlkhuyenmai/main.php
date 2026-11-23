<?php include("../inc/top.php"); ?>

<?php
// Tính toán các chỉ số tổng quan
$tong_so_may = count($tatcamathang);
$so_may_km = count($dskhuyenmai);
$ti_le_km = ($tong_so_may > 0) ? round(($so_may_km / $tong_so_may) * 100) : 0;

$max_pt = 0;
$max_sp = null;
$tong_tro_gia = 0;
foreach($dskhuyenmai as $km){
    $giam_gia = (float)($km["giagoc"] - $km["giaban"]);
    $tong_tro_gia += $giam_gia;
    $pt = ($km["giagoc"] > 0) ? round(($giam_gia / $km["giagoc"]) * 100) : 0;
    if($pt > $max_pt){
        $max_pt = $pt;
        $max_sp = $km;
    }
}
?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, sạch sẽ */
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
.kpi-km-card {
    border-radius: 14px !important;
    background-color: #ffffff;
    border: 1px solid #f1f5f9 !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-km-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05) !important;
}
.kpi-km-card .card-body {
    padding: 14px 16px !important;
}
.icon-km-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.btn-quick-pill {
    border-radius: 8px;
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 12.5px;
    font-weight: 600;
    padding: 3px 10px;
    transition: all 0.2s ease;
}
.btn-quick-pill:hover, .btn-quick-pill.active {
    border-color: #d70018;
    color: #d70018;
    background-color: #fee2e2;
}
.btn-flagship-red {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    height: 42px;
    transition: all 0.2s ease;
}
.btn-flagship-red:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-flagship-dark {
    background-color: #1e293b;
    border-color: #1e293b;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    height: 42px;
    transition: all 0.2s ease;
}
.btn-flagship-dark:hover {
    background-color: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
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
</style>

<!-- Thông báo trạng thái -->
<?php if(!empty($thongbao)): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-3 d-flex align-items-center" role="alert">
    <i class="align-middle me-2" data-feather="check-circle"></i>
    <div><?= $thongbao ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(!empty($loi)): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-3 d-flex align-items-center" role="alert">
    <i class="align-middle me-2" data-feather="alert-circle"></i>
    <div><?= $loi ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- 1. Thanh tiêu đề & Huy hiệu Flash Sale -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">CHƯƠNG TRÌNH KHUYẾN MÃI</h3>
                            <p class="text-muted small mb-0 mt-1">Thiết lập Flash Sale theo thương hiệu & trợ giá trực tiếp cho từng mẫu điện thoại</p>
                        </div>
                    </div>
                    <div>
                        <span class="badge fw-bold px-3 py-2" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 8px; font-size: 13.5px;">
                            <i class="align-middle me-1" data-feather="zap" style="width: 16px; height: 16px;"></i>Đang Flash Sale: <?= $so_may_km ?> mẫu máy
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Hàng 1: 3 Thẻ chỉ số tổng quan khuyến mãi (Gọn nhẹ, không lòe loẹt) -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Số sản phẩm đang Flash Sale -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card h-100 shadow-sm border-0 kpi-km-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.3px; font-size: 11.5px;">Sản phẩm đang giảm giá</span>
                    <div class="icon-km-circle" style="background-color: #fee2e2; color: #d70018;">
                        <i class="align-middle" data-feather="zap" style="width: 17px; height: 17px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #d70018; font-size: 1.4rem; letter-spacing: -0.4px;">
                    <?= $so_may_km ?> / <?= $tong_so_may ?> <span class="fs-6 text-muted fw-normal">mẫu máy</span>
                </h3>
                <div class="d-flex align-items-center flex-wrap gap-1 mt-1 text-muted small" style="font-size: 12px;">
                    <span class="badge fw-bold px-1.5 py-0.5" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 5px; font-size: 11px;"><?= $ti_le_km ?>% danh mục</span>
                    <span>Đang hiển thị ưu đãi trang chủ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Mức giảm sâu nhất -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card h-100 shadow-sm border-0 kpi-km-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.3px; font-size: 11.5px;">Mức giảm sâu nhất</span>
                    <div class="icon-km-circle" style="background-color: #f1f5f9; color: #475569;">
                        <i class="align-middle" data-feather="percent" style="width: 17px; height: 17px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1 text-dark" style="font-size: 1.4rem; letter-spacing: -0.4px;">
                    <?= $max_pt > 0 ? "Giảm đến " . $max_pt . "%" : "Chưa có" ?>
                </h3>
                <div class="d-flex align-items-center flex-wrap gap-1 mt-1 text-muted small text-truncate" style="font-size: 12px;" title="<?= $max_sp ? htmlspecialchars($max_sp['tenmathang']) : '' ?>">
                    <span class="badge fw-bold px-1.5 py-0.5" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; border-radius: 5px; font-size: 11px;">Hot nhất</span>
                    <span class="text-truncate"><?= $max_sp ? htmlspecialchars($max_sp["tenmathang"]) : "Chưa có mẫu máy nào giảm giá" ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Tổng mức trợ giá khách hàng -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="card h-100 shadow-sm border-0 kpi-km-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.3px; font-size: 11.5px;">Tổng mức trợ giá khách hàng</span>
                    <div class="icon-km-circle" style="background-color: #f1f5f9; color: #475569;">
                        <i class="align-middle" data-feather="gift" style="width: 17px; height: 17px;"></i>
                    </div>
                </div>
                <h3 class="fw-bold my-1" style="color: #1e293b; font-size: 1.4rem; letter-spacing: -0.4px;">
                    <?= number_format($tong_tro_gia, 0, ',', '.') ?>đ
                </h3>
                <div class="d-flex align-items-center flex-wrap gap-1 mt-1 text-muted small" style="font-size: 12px;">
                    <span class="badge fw-bold px-1.5 py-0.5" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; border-radius: 5px; font-size: 11px;">Tiết kiệm</span>
                    <span>Tổng tiền trực tiếp giảm cho khách</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. Hàng 2: Đồng bộ 2 khối thiết lập giảm giá (Tỷ lệ 6 - 6 bằng chiều cao h-100) -->
<div class="row g-3 mb-4">
    <!-- Cột trái: Flash Sale theo Hãng điện thoại -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm h-100 border-0 rounded-4">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom-0">
                <div class="d-flex align-items-center">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                        Flash Sale theo Hãng điện thoại
                    </h5>
                </div>
                <span class="badge fw-normal" style="background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 11.5px;">
                    Áp dụng hàng loạt
                </span>
            </div>
            <div class="card-body px-4 pt-1 pb-4 d-flex flex-column justify-content-between">
                <form method="post" action="index.php?action=apdungtheohang" class="d-flex flex-column h-100 justify-content-between">
                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted mb-1">Chọn hãng điện thoại áp dụng:</label>
                            <select name="danhmuc_id" class="form-select shadow-none" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                                <option value="0">⚡ Toàn bộ cửa hàng (Tất cả điện thoại)</option>
                                <?php foreach($danhmuc as $dm_item): ?>
                                    <option value="<?= $dm_item["id"] ?>">Thương hiệu <?= htmlspecialchars($dm_item["tendanhmuc"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted mb-1">Mức giảm giá (%):</label>
                            <div class="input-group">
                                <input type="number" id="input_hang_pt" name="phantramgiam" class="form-control shadow-none" min="1" max="90" placeholder="Nhập mức giảm (VD: 10)..." required style="border-radius: 8px 0 0 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                                <span class="input-group-text fw-bold text-muted" style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; background-color: #f8fafc;">%</span>
                            </div>
                            <!-- Nút chọn nhanh % -->
                            <div class="d-flex gap-1.5 mt-2 flex-wrap align-items-center">
                                <span class="small text-muted me-1" style="font-size: 12px;">Chọn nhanh:</span>
                                <button type="button" class="btn btn-quick-pill btn-quick-hang" data-val="5">5%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-hang" data-val="10">10%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-hang" data-val="15">15%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-hang" data-val="20">20%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-hang" data-val="25">25%</button>
                            </div>
                        </div>

                        <div class="p-2.5 mb-3 rounded-3 small text-muted d-flex align-items-start" style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px;">
                            <i class="align-middle me-2 mt-0.5 text-danger" data-feather="info" style="width: 15px; height: 15px; flex-shrink: 0;"></i>
                            <span>Hệ thống giữ nguyên giá niêm yết và tự động làm tròn giá bán mới đến hàng chục nghìn đồng.</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-flagship-red w-100 d-inline-flex align-items-center justify-content-center mt-2" onclick="return confirm('Xác nhận áp dụng mức giảm giá hàng loạt cho danh mục đã chọn?');">
                        <i class="align-middle me-1.5" data-feather="check-circle" style="width: 16px; height: 16px;"></i>Áp dụng giảm giá hàng loạt
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Cột phải: Thiết lập giá sốc cho từng mẫu máy -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm h-100 border-0 rounded-4">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom-0">
                <div class="d-flex align-items-center">
                    <div class="section-accent-bar"></div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                        Thiết lập giá sốc cho từng mẫu máy
                    </h5>
                </div>
                <span class="badge fw-normal" style="background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 11.5px;">
                    Tùy biến chi tiết
                </span>
            </div>
            <div class="card-body px-4 pt-1 pb-4 d-flex flex-column justify-content-between">
                <form method="post" action="index.php?action=apdungmay" class="d-flex flex-column h-100 justify-content-between">
                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted mb-1">Chọn mẫu điện thoại:</label>
                            <select id="select_mathang" name="mathang_id" class="form-select shadow-none" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                                <option value="">-- Chọn điện thoại cần giảm giá --</option>
                                <?php foreach($tatcamathang as $mh_item): 
                                    $goc = (float)$mh_item["giagoc"];
                                    $ban = (float)$mh_item["giaban"];
                                    if($goc <= 0 || $goc < $ban) { $goc = $ban; }
                                ?>
                                    <option value="<?= $mh_item["id"] ?>" data-giagoc="<?= $goc ?>" data-giaban="<?= $ban ?>" data-ten="<?= htmlspecialchars($mh_item["tenmathang"]) ?>">
                                        <?= htmlspecialchars($mh_item["tenmathang"]) ?> (Giá gốc: <?= number_format($goc) ?>đ)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label fw-semibold small text-muted mb-0">Giá khuyến mãi mới (VNĐ):</label>
                                <span id="preview_giagoc" class="small text-muted" style="font-size: 12px;">Chưa chọn máy</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="input_giabanmoi" name="giabanmoi" class="form-control shadow-none" step="10000" min="10000" placeholder="Nhập giá bán mới (VD: 25000000)..." required style="border-radius: 8px 0 0 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                                <span class="input-group-text fw-bold text-muted" style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; background-color: #f8fafc;">đ</span>
                            </div>
                            <!-- Nút tính nhanh theo % -->
                            <div class="d-flex gap-1.5 mt-2 flex-wrap align-items-center">
                                <span class="small text-muted me-1" style="font-size: 12px;">Giảm nhanh:</span>
                                <button type="button" class="btn btn-quick-pill btn-quick-sp" data-pt="5">-5%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-sp" data-pt="10">-10%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-sp" data-pt="15">-15%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-sp" data-pt="20">-20%</button>
                                <button type="button" class="btn btn-quick-pill btn-quick-sp" data-pt="30">-30%</button>
                            </div>
                        </div>

                        <div id="box_preview_tietkiem" class="p-2.5 mb-3 rounded-3 small d-flex justify-content-between align-items-center" style="display: none !important; background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px;">
                            <span class="text-dark"><i class="align-middle me-1 text-danger" data-feather="trending-down" style="width: 15px; height: 15px;"></i>Khách tiết kiệm: <strong id="val_tietkiem" class="text-danger">0đ</strong></span>
                            <span class="badge fw-bold px-2 py-1" id="val_ptgiam" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 6px;">-0%</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-flagship-dark w-100 d-inline-flex align-items-center justify-content-center mt-2">
                        <i class="align-middle me-1.5" data-feather="save" style="width: 16px; height: 16px;"></i>Cập nhật giá khuyến mãi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 4. Hàng 3: Bảng danh sách điện thoại đang khuyến mãi -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <div class="section-accent-bar"></div>
            <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                Danh sách điện thoại đang áp dụng khuyến mãi
            </h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge fw-semibold px-2.5 py-1.5" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 12px;">
                <?= $so_may_km ?> sản phẩm
            </span>
            <?php if($so_may_km > 0): ?>
                <a href="index.php?action=huykhuyenmai&id=0" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center" style="border-radius: 8px; font-size: 12.5px; font-weight: 600;" onclick="return confirm('Bạn có chắc muốn kết thúc khuyến mãi của TẤT CẢ điện thoại và đưa về giá gốc ban đầu?');">
                    <i class="align-middle me-1" data-feather="rotate-ccw" style="width: 14px; height: 14px;"></i>Đưa tất cả về giá gốc
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head">
                    <tr>
                        <th class="ps-4" style="min-width: 250px;">Sản phẩm</th>
                        <th style="width: 120px;" class="text-center">Hãng</th>
                        <th style="width: 140px;" class="text-end">Giá niêm yết</th>
                        <th style="width: 140px;" class="text-end">Giá khuyến mãi</th>
                        <th style="width: 180px;" class="text-center">Mức giảm</th>
                        <th style="width: 140px;" class="text-center pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dskhuyenmai)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="align-middle mb-2 text-muted" data-feather="tag" style="width: 36px; height: 36px;"></i>
                            <div class="fw-semibold">Hiện chưa có mẫu điện thoại nào đang áp dụng khuyến mãi.</div>
                            <div class="small text-muted mt-1">Sử dụng 2 khung phía trên để kích hoạt Flash Sale theo hãng hoặc giảm giá máy bất kỳ!</div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($dskhuyenmai as $km): 
                        $giagoc = (float)$km["giagoc"];
                        $giaban = (float)$km["giaban"];
                        $tietkiem = $giagoc - $giaban;
                        $phantram = ($giagoc > 0) ? round(($tietkiem / $giagoc) * 100) : 0;
                        $hinhanh = !empty($km["hinhanh"]) ? "../../" . $km["hinhanh"] : "../../images/products/a1.jpg";

                        // Phân màu badge theo hãng nhẹ nhàng
                        $brand = strtolower($km["tendanhmuc"] ?? "");
                        $badge_style = "background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;";
                        if(strpos($brand, "apple") !== false) {
                            $badge_style = "background-color: #111827; color: #ffffff;";
                        } elseif(strpos($brand, "samsung") !== false) {
                            $badge_style = "background-color: #0d6efd; color: #ffffff;";
                        } elseif(strpos($brand, "oppo") !== false) {
                            $badge_style = "background-color: #10b981; color: #ffffff;";
                        } elseif(strpos($brand, "xiaomi") !== false) {
                            $badge_style = "background-color: #f97316; color: #ffffff;";
                        }
                    ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="<?= $hinhanh ?>" class="rounded-3 border bg-white p-1 shadow-sm me-2.5" style="width: 44px; height: 44px; object-fit: contain;" alt="<?= htmlspecialchars($km["tenmathang"]) ?>" onerror="this.src='../../images/products/a1.jpg';">
                                <div>
                                    <strong class="text-dark d-block" style="font-size: 14px;"><?= htmlspecialchars($km["tenmathang"]) ?></strong>
                                    <small class="text-muted" style="font-size: 12px;">Mã SP: #<?= sprintf("SP%04d", $km["id"]) ?> | Tồn kho: <?= $km["soluongton"] ?></small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge fw-bold px-2 py-1" style="<?= $badge_style ?> border-radius: 6px; font-size: 11.5px;"><?= htmlspecialchars($km["tendanhmuc"] ?? "Khác") ?></span>
                        </td>
                        <td class="text-end">
                            <span class="text-decoration-line-through text-muted small" style="font-size: 13px;"><?= number_format($giagoc, 0, ',', '.') ?>đ</span>
                        </td>
                        <td class="text-end">
                            <span class="fw-bold fs-6" style="color: #d70018;"><?= number_format($giaban, 0, ',', '.') ?>đ</span>
                        </td>
                        <td class="text-center">
                            <span class="badge fw-bold px-2 py-1" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 6px; font-size: 12px;">-<?= $phantram ?>%</span>
                            <div class="small text-muted mt-1" style="font-size: 12px;">Tiết kiệm <span class="fw-semibold text-danger"><?= number_format($tietkiem, 0, ',', '.') ?>đ</span></div>
                        </td>
                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center align-items-center gap-1.5 flex-nowrap">
                                <a href="../../public/index.php?action=detail&id=<?= $km["id"] ?>" target="_blank" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center justify-content-center" title="Xem trên website (mở tab mới)" style="padding: 5px 8px; border-radius: 7px;">
                                    <i class="align-middle" data-feather="external-link" style="width: 14px; height: 14px;"></i>
                                </a>
                                <a href="index.php?action=huykhuyenmai&id=<?= $km["id"] ?>" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center text-nowrap" onclick="return confirm('Kết thúc khuyến mãi và đưa mẫu máy <?= htmlspecialchars(addslashes($km["tenmathang"])) ?> về giá gốc?');" title="Đưa về giá gốc" style="padding: 5px 10px; border-radius: 7px; font-weight: 500;">
                                    <i class="align-middle me-1" data-feather="x-circle" style="width: 14px; height: 14px;"></i>Hủy KM
                                </a>
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
    // 1. Xử lý nút chọn nhanh % ở form giảm giá theo Hãng
    var quickHangBtns = document.querySelectorAll(".btn-quick-hang");
    var inputHangPt = document.getElementById("input_hang_pt");
    quickHangBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            quickHangBtns.forEach(function(b){ b.classList.remove("active"); });
            this.classList.add("active");
            var val = this.getAttribute("data-val");
            if(inputHangPt) {
                inputHangPt.value = val;
                inputHangPt.focus();
            }
        });
    });

    if(inputHangPt) {
        inputHangPt.addEventListener("input", function() {
            var curVal = this.value;
            quickHangBtns.forEach(function(b){
                if(b.getAttribute("data-val") === curVal) {
                    b.classList.add("active");
                } else {
                    b.classList.remove("active");
                }
            });
        });
    }

    // 2. Xử lý form giảm giá từng mẫu máy
    var selectMathang = document.getElementById("select_mathang");
    var previewGiagoc = document.getElementById("preview_giagoc");
    var inputGiabanmoi = document.getElementById("input_giabanmoi");
    var boxPreviewTietkiem = document.getElementById("box_preview_tietkiem");
    var valTietkiem = document.getElementById("val_tietkiem");
    var valPtgiam = document.getElementById("val_ptgiam");
    var quickSpBtns = document.querySelectorAll(".btn-quick-sp");

    function updatePreview() {
        if(!selectMathang) return;
        var opt = selectMathang.options[selectMathang.selectedIndex];
        if(!opt || !opt.value) {
            if(previewGiagoc) previewGiagoc.innerHTML = "Chưa chọn máy";
            if(boxPreviewTietkiem) boxPreviewTietkiem.setAttribute("style", "display: none !important;");
            return;
        }

        var giagoc = parseFloat(opt.getAttribute("data-giagoc")) || 0;
        var giabanHienTai = parseFloat(opt.getAttribute("data-giaban")) || 0;
        if(previewGiagoc) {
            previewGiagoc.innerHTML = "Giá gốc: <strong class='text-dark'>" + giagoc.toLocaleString('vi-VN') + "đ</strong>";
        }

        var giabanmoi = parseFloat(inputGiabanmoi.value) || 0;
        if(giabanmoi > 0 && giagoc > 0 && giabanmoi < giagoc) {
            var tietkiem = giagoc - giabanmoi;
            var pt = Math.round((tietkiem / giagoc) * 100);
            if(valTietkiem) valTietkiem.innerText = tietkiem.toLocaleString('vi-VN') + "đ";
            if(valPtgiam) valPtgiam.innerText = "-" + pt + "%";
            if(boxPreviewTietkiem) boxPreviewTietkiem.removeAttribute("style");
        } else {
            if(boxPreviewTietkiem) boxPreviewTietkiem.setAttribute("style", "display: none !important;");
        }
    }

    if(selectMathang) {
        selectMathang.addEventListener("change", function() {
            var opt = this.options[this.selectedIndex];
            if(opt && opt.value) {
                var giagoc = parseFloat(opt.getAttribute("data-giagoc")) || 0;
                var giabanHienTai = parseFloat(opt.getAttribute("data-giaban")) || 0;
                // Nếu máy đã có giá bán nhỏ hơn giá gốc thì điền sẵn giá bán
                if(giabanHienTai < giagoc && giabanHienTai > 0) {
                    inputGiabanmoi.value = giabanHienTai;
                } else {
                    // Mặc định đề xuất giảm 10%
                    var defaultNew = Math.round((giagoc * 0.9) / 10000) * 10000;
                    inputGiabanmoi.value = defaultNew;
                }
            } else {
                inputGiabanmoi.value = "";
            }
            updatePreview();
        });
    }

    if(inputGiabanmoi) {
        inputGiabanmoi.addEventListener("input", function() {
            quickSpBtns.forEach(function(b){ b.classList.remove("active"); });
            updatePreview();
        });
    }

    quickSpBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            if(!selectMathang || !selectMathang.value) {
                alert("Vui lòng chọn một mẫu điện thoại trước!");
                selectMathang.focus();
                return;
            }
            quickSpBtns.forEach(function(b){ b.classList.remove("active"); });
            this.classList.add("active");
            var opt = selectMathang.options[selectMathang.selectedIndex];
            var giagoc = parseFloat(opt.getAttribute("data-giagoc")) || 0;
            var pt = parseFloat(this.getAttribute("data-pt")) || 0;
            if(giagoc > 0 && pt > 0) {
                var giaMoi = Math.round((giagoc * (100 - pt) / 100) / 10000) * 10000;
                inputGiabanmoi.value = giaMoi;
                updatePreview();
            }
        });
    });
});
</script>

<?php include("../inc/bottom.php"); ?>