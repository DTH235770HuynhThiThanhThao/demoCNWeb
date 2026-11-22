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

<!-- Thông báo nếu có -->
<?php if(!empty($thongbao)): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="align-middle me-2" data-feather="check-circle"></i><?= $thongbao ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(!empty($loi)): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
    <i class="align-middle me-2" data-feather="alert-circle"></i><?= $loi ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Thanh tiêu đề trang -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h3 class="text-info fw-bold mb-1">
                            <i class="align-middle me-2" data-feather="tag"></i>Chương trình khuyến mãi
                        </h3>
                        <p class="text-muted small mb-0">Thiết lập Flash Sale theo thương hiệu & trợ giá trực tiếp cho từng mẫu điện thoại</p>
                    </div>
                    <div>
                        <span class="badge bg-danger fs-6 px-3 py-2">
                            <i class="align-middle me-1" data-feather="zap"></i>Đang Flash Sale: <?= $so_may_km ?> mẫu máy
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HÀNG 1: 3 Thẻ chỉ số tổng quan khuyến mãi -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Số sản phẩm đang Flash Sale -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card h-100 shadow-sm border-0 border-start border-danger border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title text-muted mb-1">Sản phẩm đang Flash Sale</h5>
                        <h3 class="mt-1 mb-2 text-danger fw-bold"><?= $so_may_km ?> / <?= $tong_so_may ?> <span class="fs-5 text-muted fw-normal">mẫu máy</span></h3>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-danger bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="zap"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-danger-subtle text-danger me-1"><?= $ti_le_km ?>% danh mục</span>
                    <span>Đang hiển thị giá ưu đãi ngoài trang chủ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Mức giảm sâu nhất -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card h-100 shadow-sm border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title text-muted mb-1">Mức giảm sâu nhất</h5>
                        <h3 class="mt-1 mb-2 text-warning fw-bold">
                            <?= $max_pt > 0 ? "Giảm đến " . $max_pt . "%" : "Chưa có" ?>
                        </h3>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-warning bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="percent"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0 text-muted small text-truncate" title="<?= $max_sp ? htmlspecialchars($max_sp['tenmathang']) : '' ?>">
                    <span class="badge bg-warning-subtle text-warning me-1">Hot nhất</span>
                    <span><?= $max_sp ? htmlspecialchars($max_sp["tenmathang"]) : "Chưa có mẫu máy nào giảm giá" ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Tổng mức trợ giá khách hàng -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="card h-100 shadow-sm border-0 border-start border-success border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title text-muted mb-1">Tổng mức trợ giá khách hàng</h5>
                        <h3 class="mt-1 mb-2 text-success fw-bold"><?= number_format($tong_tro_gia, 0, ',', '.') ?>đ</h3>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-success bg-light rounded-circle p-2">
                            <i class="align-middle" data-feather="gift"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0 text-muted small">
                    <span class="badge bg-success-subtle text-success me-1">Tiết kiệm</span>
                    <span>Tổng tiền cửa hàng giảm trừ cho khách</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HÀNG 2: 2 Khung thiết lập khuyến mãi nhanh -->
<div class="row g-3 mb-4">
    <!-- Cột trái: Giảm giá hàng loạt theo Hãng -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="align-middle me-2" data-feather="layers"></i>Flash Sale theo Hãng điện thoại
                </h5>
                <span class="badge bg-primary-subtle text-primary">Áp dụng hàng loạt</span>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?action=apdungtheohang">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Chọn hãng điện thoại áp dụng:</label>
                        <select name="danhmuc_id" class="form-select">
                            <option value="0">⚡ Toàn bộ cửa hàng (Tất cả điện thoại)</option>
                            <?php foreach($danhmuc as $dm_item): ?>
                                <option value="<?= $dm_item["id"] ?>">Thương hiệu <?= htmlspecialchars($dm_item["tendanhmuc"]) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Mức giảm giá (%):</label>
                        <div class="input-group">
                            <input type="number" id="input_hang_pt" name="phantramgiam" class="form-control" min="1" max="90" placeholder="Nhập mức giảm (VD: 10)..." required>
                            <span class="input-group-text fw-bold">%</span>
                        </div>
                        <!-- Nút chọn nhanh % -->
                        <div class="d-flex gap-1 mt-2 flex-wrap">
                            <span class="small text-muted align-self-center me-1">Chọn nhanh:</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 btn-quick-hang" data-val="5">5%</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 btn-quick-hang" data-val="10">10%</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 btn-quick-hang" data-val="15">15%</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 btn-quick-hang" data-val="20">20%</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 btn-quick-hang" data-val="25">25%</button>
                        </div>
                    </div>

                    <div class="p-2 mb-3 bg-light rounded border small text-muted">
                        <i class="align-middle me-1 text-info" data-feather="info" style="width: 14px; height: 14px;"></i>
                        Hệ thống sẽ giữ nguyên giá niêm yết ban đầu và tự động làm tròn giá bán mới đến hàng chục nghìn đồng.
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold" onclick="return confirm('Xác nhận áp dụng mức giảm giá hàng loạt cho danh mục đã chọn?');">
                        <i class="align-middle me-1" data-feather="check-circle"></i>Áp dụng giảm giá hàng loạt
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Cột phải: Thiết lập giá sốc cho từng mẫu máy -->
    <div class="col-lg-6 col-12">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 fw-bold text-success">
                    <i class="align-middle me-2" data-feather="smartphone"></i>Thiết lập giá sốc cho từng mẫu máy
                </h5>
                <span class="badge bg-success-subtle text-success">Tùy biến chi tiết</span>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?action=apdungmay">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Chọn mẫu điện thoại:</label>
                        <select id="select_mathang" name="mathang_id" class="form-select" required>
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
                            <span id="preview_giagoc" class="small text-muted">Chưa chọn máy</span>
                        </div>
                        <div class="input-group">
                            <input type="number" id="input_giabanmoi" name="giabanmoi" class="form-control" step="10000" min="10000" placeholder="Nhập giá bán mới (VD: 25000000)..." required>
                            <span class="input-group-text fw-bold">đ</span>
                        </div>
                        <!-- Nút tính nhanh theo % -->
                        <div class="d-flex gap-1 mt-2 flex-wrap">
                            <span class="small text-muted align-self-center me-1">Giảm nhanh:</span>
                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-2 btn-quick-sp" data-pt="5">-5%</button>
                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-2 btn-quick-sp" data-pt="10">-10%</button>
                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-2 btn-quick-sp" data-pt="15">-15%</button>
                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-2 btn-quick-sp" data-pt="20">-20%</button>
                            <button type="button" class="btn btn-sm btn-outline-success py-0 px-2 btn-quick-sp" data-pt="30">-30%</button>
                        </div>
                    </div>

                    <div id="box_preview_tietkiem" class="p-2 mb-3 bg-light rounded border small text-success d-flex justify-content-between align-items-center" style="display: none !important;">
                        <span><i class="align-middle me-1" data-feather="trending-down" style="width: 14px; height: 14px;"></i>Khách tiết kiệm: <strong id="val_tietkiem">0đ</strong></span>
                        <span class="badge bg-danger text-white" id="val_ptgiam">-0%</span>
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-semibold">
                        <i class="align-middle me-1" data-feather="save"></i>Cập nhật giá khuyến mãi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- HÀNG 3: Bảng danh sách điện thoại đang khuyến mãi -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="card-title mb-0 fw-bold text-info">
            <i class="align-middle me-2" data-feather="list"></i>Danh sách điện thoại đang áp dụng khuyến mãi
        </h5>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-secondary fs-6"><?= $so_may_km ?> sản phẩm</span>
            <?php if($so_may_km > 0): ?>
                <a href="index.php?action=huykhuyenmai&id=0" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn kết thúc khuyến mãi của TẤT CẢ điện thoại và đưa về giá gốc ban đầu?');">
                    <i class="align-middle me-1" data-feather="rotate-ccw" style="width: 14px; height: 14px;"></i>Đưa tất cả về giá gốc
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="min-width: 250px;">Sản phẩm</th>
                        <th style="width: 110px;" class="text-center">Hãng</th>
                        <th style="width: 140px;" class="text-end">Giá niêm yết</th>
                        <th style="width: 140px;" class="text-end">Giá khuyến mãi</th>
                        <th style="width: 180px;" class="text-center">Mức giảm</th>
                        <th style="width: 150px;" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dskhuyenmai)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="align-middle mb-2 text-warning" data-feather="tag" style="width: 36px; height: 36px;"></i>
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

                        // Phân màu badge theo hãng
                        $brand = strtolower($km["tendanhmuc"] ?? "");
                        $badge_class = "bg-secondary";
                        if(strpos($brand, "apple") !== false) $badge_class = "bg-dark text-white";
                        elseif(strpos($brand, "samsung") !== false) $badge_class = "bg-primary text-white";
                        elseif(strpos($brand, "oppo") !== false) $badge_class = "bg-success text-white";
                        elseif(strpos($brand, "xiaomi") !== false) $badge_class = "bg-warning text-dark";
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= $hinhanh ?>" class="rounded border p-1 me-2" style="width: 42px; height: 42px; object-fit: contain;" alt="<?= htmlspecialchars($km["tenmathang"]) ?>" onerror="this.src='../../images/products/a1.jpg';">
                                <div>
                                    <strong class="text-dark d-block"><?= htmlspecialchars($km["tenmathang"]) ?></strong>
                                    <small class="text-muted">Mã SP: #<?= sprintf("SP%04d", $km["id"]) ?> | Tồn kho: <?= $km["soluongton"] ?></small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge <?= $badge_class ?> px-2 py-1"><?= htmlspecialchars($km["tendanhmuc"] ?? "Khác") ?></span>
                        </td>
                        <td class="text-end">
                            <span class="text-decoration-line-through text-muted small"><?= number_format($giagoc, 0, ',', '.') ?>đ</span>
                        </td>
                        <td class="text-end">
                            <span class="text-danger fw-bold fs-6"><?= number_format($giaban, 0, ',', '.') ?>đ</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-danger px-2 py-1 fw-bold fs-6">-<?= $phantram ?>%</span>
                            <div class="small text-success mt-1 fw-semibold">Tiết kiệm <?= number_format($tietkiem, 0, ',', '.') ?>đ</div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
                                <a href="../../public/index.php?action=detail&id=<?= $km["id"] ?>" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" title="Xem trên website (mở tab mới)" style="padding: 5px 8px;">
                                    <i class="align-middle" data-feather="external-link" style="width: 14px; height: 14px;"></i>
                                </a>
                                <a href="index.php?action=huykhuyenmai&id=<?= $km["id"] ?>" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center text-nowrap" onclick="return confirm('Kết thúc khuyến mãi và đưa mẫu máy <?= htmlspecialchars(addslashes($km["tenmathang"])) ?> về giá gốc?');" title="Đưa về giá gốc" style="padding: 5px 9px;">
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
            var val = this.getAttribute("data-val");
            if(inputHangPt) {
                inputHangPt.value = val;
                inputHangPt.focus();
            }
        });
    });

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
            previewGiagoc.innerHTML = "Giá gốc: <strong class='text-primary'>" + giagoc.toLocaleString('vi-VN') + "đ</strong>";
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
        inputGiabanmoi.addEventListener("input", updatePreview);
    }

    quickSpBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            if(!selectMathang || !selectMathang.value) {
                alert("Vui lòng chọn một mẫu điện thoại trước!");
                selectMathang.focus();
                return;
            }
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
