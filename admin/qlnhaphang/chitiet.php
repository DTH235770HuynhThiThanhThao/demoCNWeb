<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile */
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
    height: 18px;
    background-color: #d70018;
    border-radius: 3px;
    margin-right: 10px;
    flex-shrink: 0;
}
.btn-flagship-red {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship-red:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-outline-flagship {
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    background-color: #ffffff;
    transition: all 0.2s ease;
}
.btn-outline-flagship:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff5f5;
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
.info-detail-box {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px;
    height: 100%;
}
</style>

<?php 
$ma_pn = sprintf("PN%05d", $pn["id"]);
$tong_sl_may = 0;
foreach($chitiet as $c){
    $tong_sl_may += (int)$c["soluong"];
}

// Trích xuất các biến thể từ ghi chú nếu có dạng [Tên máy - Phiên bản - Màu sắc x SL]
$bienthe_tags = array();
if(!empty($pn["ghichu"]) && preg_match_all('/\[(.*?)\]/', $pn["ghichu"], $matches)){
    $bienthe_tags = $matches[1];
}
?>

<!-- 1. Thanh tiêu đề & nút điều hướng -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center">
        <div class="brand-title-bar"></div>
        <div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">CHI TIẾT PHIẾU NHẬP <?= $ma_pn ?></h3>
                <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px;">
                    <i class="align-middle me-1" data-feather="check-circle" style="width: 12px; height: 12px;"></i>Đã nhập kho
                </span>
            </div>
            <p class="text-muted small mb-0 mt-1">Xem thông tin chứng từ, nhà cung cấp và danh sách máy đã nhập</p>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="index.php?tab=phieunhap" class="btn btn-sm btn-back d-inline-flex align-items-center px-3 py-2 shadow-sm">
            <i class="align-middle me-1.5" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
            <span>Quay lại danh sách</span>
        </a>
        <button type="button" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center px-3 py-2 shadow-sm" onclick="window.print()">
            <i class="align-middle me-1.5" data-feather="printer" style="width: 15px; height: 15px;"></i>
            <span>In phiếu nhập</span>
        </button>
        <a href="index.php?action=them" class="btn btn-sm btn-flagship-red d-inline-flex align-items-center px-3 py-2 shadow-sm">
            <i class="align-middle me-1.5" data-feather="plus" style="width: 15px; height: 15px;"></i>
            <span>Lập phiếu mới</span>
        </a>
    </div>
</div>

<!-- 2. THÔNG TIN CHUNG PHIẾU NHẬP (2 CỘT GỌN GÀNG) -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="info-detail-box shadow-sm">
            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <div class="section-accent-bar"></div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 14.5px;">Thông tin nguồn hàng</h6>
            </div>
            <div class="small" style="font-size: 13px; line-height: 1.8;">
                <div class="d-flex justify-content-between mb-1.5">
                    <span class="text-muted">Nhà cung cấp:</span>
                    <strong class="text-dark"><?= htmlspecialchars($pn["nhacungcap"]) ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-1.5">
                    <span class="text-muted">Thời gian nhập kho:</span>
                    <strong class="text-dark"><?= date("d/m/Y H:i:s", strtotime($pn["ngaynhap"])) ?></strong>
                </div>
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <span class="text-muted text-nowrap">Ghi chú kho:</span>
                    <span class="text-dark text-end" style="word-break: break-word;"><?= !empty($pn["ghichu"]) ? nl2br(htmlspecialchars($pn["ghichu"])) : "<span class='text-muted fst-italic'>Không có ghi chú</span>" ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="info-detail-box shadow-sm">
            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <div class="section-accent-bar"></div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 14.5px;">Người phụ trách nhập kho</h6>
            </div>
            <div class="small" style="font-size: 13px; line-height: 1.8;">
                <div class="d-flex justify-content-between mb-1.5">
                    <span class="text-muted">Người lập phiếu:</span>
                    <strong class="text-dark"><?= htmlspecialchars($pn["hoten"] ?? "Quản trị viên") ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-1.5">
                    <span class="text-muted">Email liên hệ:</span>
                    <span class="text-dark"><?= htmlspecialchars($pn["email"] ?? "admin@shop.com") ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Số điện thoại:</span>
                    <span class="text-dark"><?= htmlspecialchars($pn["sodienthoai"] ?? "Chưa cập nhật") ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- THẺ CHI TIẾT BIẾN THỂ PHIÊN BẢN & MÀU SẮC (NẾU CÓ) -->
<?php if(!empty($bienthe_tags)): ?>
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #fecaca !important; background-color: #fffafb;">
        <div class="card-body p-3.5">
            <div class="d-flex align-items-center mb-2">
                <div class="section-accent-bar"></div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">Chi tiết cấu hình phiên bản dung lượng &amp; màu sắc nhập kho:</h6>
            </div>
            <div class="d-flex flex-wrap gap-2 pt-1">
                <?php foreach($bienthe_tags as $bt): ?>
                    <span class="badge fw-semibold px-2.5 py-1.5 rounded-3 d-inline-flex align-items-center" style="background-color: #ffffff; color: #d70018; border: 1px solid #fecaca; font-size: 12px; box-shadow: 0 1px 3px rgba(215, 0, 24, 0.08);">
                        <i class="align-middle me-1.5" data-feather="check-circle" style="width: 13px; height: 13px;"></i><?= htmlspecialchars($bt) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- 3. BẢNG CHI TIẾT CÁC MẶT HÀNG NHẬP -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <div class="section-accent-bar"></div>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Danh sách điện thoại trong phiếu nhập</h5>
        </div>
        <span class="badge rounded-pill fw-semibold px-3 py-1.5" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 12px;">
            <?= count($chitiet) ?> dòng sản phẩm &bull; <?= number_format($tong_sl_may) ?> máy
        </span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head text-center">
                    <tr>
                        <th class="ps-4" style="width: 60px;">STT</th>
                        <th style="width: 70px;">ẢNH</th>
                        <th class="text-start">MẶT HÀNG ĐIỆN THOẠI</th>
                        <th class="text-end" style="width: 170px;">GIÁ NHẬP</th>
                        <th class="text-center" style="width: 140px;">SỐ LƯỢNG NHẬP</th>
                        <th class="text-end" style="width: 180px;">THÀNH TIỀN</th>
                        <th class="pe-4 text-center" style="width: 140px;">TỒN KHO HIỆN TẠI</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $stt = 0;
                foreach($chitiet as $c): 
                    $stt++;
                    $img_src = !empty($c["hinhanh"]) ? "../../" . $c["hinhanh"] : "../../images/products/a1.jpg";
                ?>
                <tr>
                    <td class="text-center fw-bold text-muted ps-4"><?= $stt ?></td>
                    <td class="text-center">
                        <img src="<?= $img_src ?>" 
                             alt="<?= htmlspecialchars($c["tenmathang"]) ?>" 
                             class="rounded-3 border bg-white p-1" 
                             style="width: 44px; height: 44px; object-fit: contain; border-color: #e2e8f0;"
                             onerror="this.src='../../images/products/a1.jpg';">
                    </td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 13.5px;"><?= htmlspecialchars($c["tenmathang"]) ?></div>
                        <div class="small text-muted mt-1 d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge fw-bold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 10.5px; padding: 2px 6px; border-radius: 4px; font-family: monospace;">SP-<?= sprintf("%03d", $c["mathang_id"]) ?></span>
                            <span style="font-size: 11.5px;">Giá niêm yết: <strong class="text-dark"><?= number_format($c["giaban"]) ?>đ</strong></span>
                        </div>
                    </td>
                    <td class="text-end fw-semibold text-dark">
                        <?= number_format($c["gianhap"], 0, ',', '.') ?>đ
                    </td>
                    <td class="text-center">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 11.5px;">
                            <?= number_format($c["soluong"]) ?> máy
                        </span>
                    </td>
                    <td class="text-end">
                        <span class="fw-bold" style="color: #d70018; font-size: 13.5px;">
                            <?= number_format($c["thanhtien"], 0, ',', '.') ?>đ
                        </span>
                    </td>
                    <td class="pe-4 text-center">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px;">
                            <?= (int)$c["soluongton"] ?> máy
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <tr>
                        <td colspan="4" class="text-end fw-bold py-3 text-secondary ps-4">
                            TỔNG CỘNG PHIẾU NHẬP:
                        </td>
                        <td class="text-center fw-bold py-3">
                            <span class="badge rounded-pill fw-bold px-3 py-1.5" style="background-color: #f1f5f9; color: #1e293b; border: 1px solid #e2e8f0; font-size: 12.5px;"><?= number_format($tong_sl_may) ?> máy</span>
                        </td>
                        <td class="text-end fw-bold py-3">
                            <span class="fw-bold fs-5" style="color: #d70018;"><?= number_format($pn["tongtien"], 0, ',', '.') ?>đ</span>
                        </td>
                        <td class="pe-4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>
