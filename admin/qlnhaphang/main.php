<?php include("../inc/top.php"); ?>

<?php
$tab_hien_tai = isset($tab) ? $tab : "tonkho";
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
.btn-reset-filter {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-reset-filter:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.btn-action-outline {
    border: 1px solid #e2e8f0;
    color: #475569;
    background-color: #ffffff;
    border-radius: 8px;
    font-weight: 500;
    font-size: 12.5px;
    transition: all 0.2s ease;
}
.btn-action-outline:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff5f5;
}
.kpi-card {
    border: 1px solid #f1f5f9 !important;
    background: #ffffff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05) !important;
}
.kpi-icon-box {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.nav-pills-flagship .nav-link {
    border-radius: 10px;
    color: #475569;
    font-weight: 600;
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 8px 16px;
    font-size: 13.5px;
    transition: all 0.2s ease;
}
.nav-pills-flagship .nav-link:hover {
    background-color: #f1f5f9;
    color: #1e293b;
}
.nav-pills-flagship .nav-link.active {
    background-color: #d70018 !important;
    border-color: #d70018 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 10px rgba(215, 0, 24, 0.2);
}
.nav-pills-flagship .nav-link.active .badge {
    background-color: rgba(255, 255, 255, 0.25) !important;
    color: #ffffff !important;
    border-color: transparent !important;
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
.search-control-flagship {
    border-color: #cbd5e1;
    border-radius: 10px;
    font-size: 13.5px;
    height: 38px;
}
.search-control-flagship:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215, 0, 24, 0.1);
}
</style>

<!-- 1. HEADER ĐẦU TRANG & NÚT LẬP PHIẾU NHẬP -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center">
        <div class="brand-title-bar"></div>
        <div>
            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ KHO & NHẬP HÀNG</h3>
            <p class="text-muted small mb-0 mt-1">Theo dõi chi tiết số lượng tồn kho thực tế, đối soát nhập – bán và lịch sử nhập hàng của Thảo Mobile</p>
        </div>
    </div>
    <div>
        <a href="index.php?action=them" class="btn btn-flagship-red d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm">
            <i class="align-middle" data-feather="plus" style="width: 16px; height: 16px;"></i> 
            <span>Lập phiếu nhập mới</span>
        </a>
    </div>
</div>

<!-- THÔNG BÁO NHẬP KHO THÀNH CÔNG -->
<?php if(isset($_GET["msg"]) && $_GET["msg"] == "them_ok"): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
        <div>
            <strong>Nhập kho thành công!</strong> Phiếu nhập <strong><?= sprintf("PN%05d", (int)($_GET["id"] ?? 0)) ?></strong> đã được lưu và hệ thống đã <strong>tự động cộng dồn số lượng tồn kho</strong> cho các mẫu điện thoại.
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 2. HÀNG 4 THẺ THỐNG KÊ GỌN NHẸ (padding: 14px 16px) -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Tổng máy tồn kho -->
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center justify-content-between" style="padding: 14px 16px;">
                <div>
                    <div class="text-muted small fw-semibold mb-1" style="font-size: 12.5px;">Tổng máy tồn kho</div>
                    <div class="fs-4 fw-bold text-dark mb-0">
                        <?= number_format($thongketon["tongmayton"] ?? 0) ?> <span class="fs-6 fw-normal text-muted">máy</span>
                    </div>
                </div>
                <div class="kpi-icon-box" style="background-color: #f1f5f9; color: #475569;">
                    <i class="align-middle" data-feather="package" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Cảnh báo sắp hết / Hết hàng -->
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center justify-content-between" style="padding: 14px 16px;">
                <div>
                    <div class="text-muted small fw-semibold mb-1" style="font-size: 12.5px;">Cảnh báo sắp hết (≤15)</div>
                    <div class="fs-4 fw-bold mb-0" style="color: #d97706;">
                        <?= number_format($thongketon["maysaphet"] ?? 0) ?> <span class="fs-6 fw-normal text-muted">mẫu máy</span>
                    </div>
                    <?php if(!empty($thongketon["mayhethang"])): ?>
                        <div class="small fw-semibold mt-0.5" style="color: #dc2626; font-size: 11px;">
                            • <?= $thongketon["mayhethang"] ?> mẫu đã hết hàng
                        </div>
                    <?php endif; ?>
                </div>
                <div class="kpi-icon-box" style="background-color: #fef3c7; color: #d97706;">
                    <i class="align-middle" data-feather="alert-triangle" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Tổng phiếu nhập kho -->
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center justify-content-between" style="padding: 14px 16px;">
                <div>
                    <div class="text-muted small fw-semibold mb-1" style="font-size: 12.5px;">Tổng phiếu nhập kho</div>
                    <div class="fs-4 fw-bold text-dark mb-0">
                        <?= count($phieunhap) ?> <span class="fs-6 fw-normal text-muted">phiếu</span>
                    </div>
                </div>
                <div class="kpi-icon-box" style="background-color: #f1f5f9; color: #475569;">
                    <i class="align-middle" data-feather="file-text" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Tổng giá trị nhập kho -->
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card shadow-sm rounded-4 h-100">
            <div class="card-body d-flex align-items-center justify-content-between" style="padding: 14px 16px;">
                <div>
                    <div class="text-muted small fw-semibold mb-1" style="font-size: 12.5px;">Tổng giá trị nhập kho</div>
                    <div class="fs-4 fw-bold mb-0 text-truncate" style="color: #d70018;" title="<?= number_format($tongtiennhap ?? 0, 0, ',', '.') ?>đ">
                        <?= number_format($tongtiennhap ?? 0, 0, ',', '.') ?>đ
                    </div>
                </div>
                <div class="kpi-icon-box" style="background-color: #fee2e2; color: #d70018;">
                    <i class="align-middle" data-feather="dollar-sign" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. THANH TAB CHUYỂN ĐỔI (ĐỒNG BỘ TÔNG ĐỎ #d70018) -->
<div class="mb-3">
    <ul class="nav nav-pills nav-pills-flagship gap-2" id="tabKhoNhap" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link d-flex align-items-center gap-2 <?= $tab_hien_tai === 'tonkho' ? 'active' : '' ?>" 
                    id="tab-tonkho-btn" 
                    data-bs-toggle="pill" 
                    data-bs-target="#tab-tonkho" 
                    type="button" 
                    role="tab">
                <i class="align-middle" data-feather="layers" style="width: 15px; height: 15px;"></i>
                <span>Tồn kho hiện tại</span>
                <span class="badge rounded-pill bg-light text-dark border ms-1" style="font-size: 11px;"><?= count($dastonkho) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link d-flex align-items-center gap-2 <?= $tab_hien_tai === 'phieunhap' ? 'active' : '' ?>" 
                    id="tab-phieunhap-btn" 
                    data-bs-toggle="pill" 
                    data-bs-target="#tab-phieunhap" 
                    type="button" 
                    role="tab">
                <i class="align-middle" data-feather="clock" style="width: 15px; height: 15px;"></i>
                <span>Lịch sử phiếu nhập</span>
                <span class="badge rounded-pill bg-light text-dark border ms-1" style="font-size: 11px;"><?= count($phieunhap) ?></span>
            </button>
        </li>
    </ul>
</div>

<!-- NỘI DUNG 2 TAB -->
<div class="tab-content" id="tabKhoNhapContent">

    <!-- ========================================== -->
    <!-- TAB 1: TỒN KHO HIỆN TẠI                    -->
    <!-- ========================================== -->
    <div class="tab-pane fade <?= $tab_hien_tai === 'tonkho' ? 'show active' : '' ?>" id="tab-tonkho" role="tabpanel">
        <!-- Bộ lọc tìm kiếm & mức tồn kho -->
        <div class="card border-0 shadow-sm rounded-4 p-3 mb-3">
            <form method="GET" action="index.php" class="row g-2 align-items-center">
                <input type="hidden" name="action" value="danhsach">
                <input type="hidden" name="tab" value="tonkho">

                <!-- Ô tìm kiếm tên máy / mã SP -->
                <div class="col-12 col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                            <i class="align-middle text-muted" data-feather="search" style="width: 14px; height: 14px;"></i>
                        </span>
                        <input type="text" class="form-control search-control-flagship border-start-0" style="border-radius: 0 10px 10px 0;" name="tukhoa" placeholder="Tìm theo tên điện thoại, mã SP, hãng..." value="<?= htmlspecialchars($tukhoa ?? '') ?>">
                    </div>
                </div>

                <!-- Dropdown lọc mức tồn kho -->
                <div class="col-12 col-md-4">
                    <select name="muctonkho" class="form-select search-control-flagship">
                        <option value="tatca" <?= (!isset($muctonkho) || $muctonkho === 'tatca') ? 'selected' : '' ?>>-- Tất cả mức tồn kho --</option>
                        <option value="hethang" <?= (isset($muctonkho) && $muctonkho === 'hethang') ? 'selected' : '' ?>>Hết hàng (Tồn = 0)</option>
                        <option value="saphet" <?= (isset($muctonkho) && $muctonkho === 'saphet') ? 'selected' : '' ?>>Sắp hết hàng (Tồn ≤ 15)</option>
                        <option value="conhang" <?= (isset($muctonkho) && $muctonkho === 'conhang') ? 'selected' : '' ?>>Còn nhiều hàng (Tồn > 15)</option>
                    </select>
                </div>

                <!-- Nút Lọc và Xóa lọc -->
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-flagship-red flex-fill d-inline-flex align-items-center justify-content-center py-2">
                        <i class="align-middle me-1.5" data-feather="filter" style="width: 14px; height: 14px;"></i>Lọc
                    </button>
                    <a href="index.php?tab=tonkho" class="btn btn-reset-filter flex-fill d-inline-flex align-items-center justify-content-center py-2 text-decoration-none">
                        Xóa lọc
                    </a>
                </div>
            </form>
        </div>

        <!-- Bảng Tồn kho thực tế -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="bangTonKho">
                        <thead class="table-flagship-head">
                            <tr>
                                <th class="ps-4 py-3 text-center" style="width: 95px;">MÃ SP</th>
                                <th class="py-3" style="min-width: 260px;">TÊN ĐIỆN THOẠI</th>
                                <th class="py-3 text-end" style="width: 140px;">GIÁ BÁN</th>
                                <th class="py-3 text-center" style="width: 120px;">TỔNG NHẬP</th>
                                <th class="py-3 text-center" style="width: 120px;">ĐÃ BÁN</th>
                                <th class="py-3 text-center" style="width: 160px;">TỒN KHO THỰC TẾ</th>
                                <th class="pe-4 py-3 text-center" style="width: 130px;">THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($dastonkho)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 42px; height: 42px; opacity: 0.4;"></i>
                                    <div class="fw-semibold">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</div>
                                    <div class="small mt-1"><a href="index.php?tab=tonkho" class="text-decoration-none text-danger fw-semibold">Bấm vào đây để xem tất cả</a></div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dastonkho as $sp): 
                                $ton = (int)$sp["soluongton"];
                                $tong_nhap = (int)$sp["tongnhap"];
                                $da_ban = (int)$sp["daban"];
                                $ma_sp = sprintf("SP-%03d", $sp["id"]);
                            ?>
                            <tr>
                                <!-- 1. Mã SP -->
                                <td class="ps-4 py-3 text-center">
                                    <span class="badge fw-bold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 11.5px; padding: 4px 8px; border-radius: 6px; font-family: monospace;">
                                        <?= $ma_sp ?>
                                    </span>
                                </td>

                                <!-- 2. Tên điện thoại + Ảnh + Hãng -->
                                <td class="py-3">
                                    <?php
                                    $hinh_anh = $sp['hinhanh'] ?? 'images/products/a1.jpg';
                                    if(strpos($hinh_anh, 'images/') === false){
                                        $hinh_anh = 'images/products/' . $hinh_anh;
                                    }
                                    ?>
                                    <div class="d-flex align-items-center gap-2.5">
                                        <img src="../../<?= htmlspecialchars($hinh_anh) ?>"
                                             onerror="this.src='../../images/products/a1.jpg'"
                                             alt="" style="width: 42px; height: 42px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; background: #fff; padding: 2px; flex-shrink: 0;">
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px; line-height: 1.3;">
                                                <?= htmlspecialchars($sp["tenmathang"]) ?>
                                            </div>
                                            <?php if(!empty($sp["tenhang"])): ?>
                                                <span class="badge rounded-pill bg-light text-secondary border px-2 py-0.5 mt-1" style="font-size: 10.5px;">
                                                    <?= htmlspecialchars($sp["tenhang"]) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- 3. Giá bán -->
                                <td class="py-3 text-end">
                                    <span class="fw-bold" style="color: #d70018; font-size: 13.5px;">
                                        <?= number_format($sp["giaban"], 0, ',', '.') ?>đ
                                    </span>
                                </td>

                                <!-- 4. Tổng nhập -->
                                <td class="py-3 text-center">
                                    <span class="fw-semibold text-secondary small">
                                        <?= number_format($tong_nhap) ?>
                                    </span>
                                </td>

                                <!-- 5. Đã bán -->
                                <td class="py-3 text-center">
                                    <span class="fw-bold text-dark small">
                                        <?= number_format($da_ban) ?>
                                    </span>
                                </td>

                                <!-- 6. Tồn kho thực tế (Huy hiệu Pastel dịu mắt) -->
                                <td class="py-3 text-center">
                                    <?php if($ton == 0): ?>
                                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 11.5px;">
                                            ● 0 - Hết hàng
                                        </span>
                                    <?php elseif($ton <= 15): ?>
                                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px;">
                                            ● <?= $ton ?> - Sắp hết
                                        </span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px;">
                                            ● <?= $ton ?> - Còn hàng
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- 7. Thao tác -->
                                <td class="pe-4 py-3 text-center">
                                    <a href="index.php?action=them&mathang_id=<?= $sp['id'] ?>" 
                                       class="btn btn-sm btn-action-outline d-inline-flex align-items-center gap-1 text-nowrap px-2.5 py-1.5 shadow-sm"
                                       title="Lập phiếu nhập thêm hàng cho mẫu máy này">
                                        <i class="align-middle" data-feather="plus" style="width: 14px; height: 14px;"></i>
                                        <span>Nhập thêm</span>
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

    <!-- ========================================== -->
    <!-- TAB 2: LỊCH SỬ PHIẾU NHẬP                 -->
    <!-- ========================================== -->
    <div class="tab-pane fade <?= $tab_hien_tai === 'phieunhap' ? 'show active' : '' ?>" id="tab-phieunhap" role="tabpanel">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div style="width: 4px; height: 18px; background-color: #d70018; border-radius: 3px; margin-right: 10px;"></div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Danh sách phiếu nhập kho</h5>
                </div>
                <div class="d-flex align-items-center gap-2" style="max-width: 360px; width: 100%;">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;">
                            <i class="align-middle text-muted" data-feather="search" style="width: 13px; height: 13px;"></i>
                        </span>
                        <input type="text" id="inputTimKiemPN" class="form-control border-start-0" style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-size: 13px;" placeholder="Tìm nhanh mã phiếu, nhà cung cấp..." onkeyup="locBangPhieuNhap()">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="bangPhieuNhap">
                        <thead class="table-flagship-head">
                            <tr>
                                <th class="ps-4 py-3" style="width: 120px;">MÃ PHIẾU</th>
                                <th class="py-3">NHÀ CUNG CẤP</th>
                                <th class="py-3" style="width: 190px;">NGƯỜI LẬP PHIẾU</th>
                                <th class="py-3" style="width: 150px;">NGÀY NHẬP</th>
                                <th class="py-3 text-center" style="width: 140px;">SỐ LƯỢNG NHẬP</th>
                                <th class="py-3 text-end" style="width: 160px;">TỔNG TIỀN NHẬP</th>
                                <th class="pe-4 py-3 text-center" style="width: 100px;">THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($phieunhap)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 44px; height: 44px; opacity: 0.4;"></i>
                                    <div class="fw-semibold">Chưa có phiếu nhập hàng nào.</div>
                                    <div class="small mt-1">Bấm vào nút "Lập phiếu nhập mới" để tiến hành nhập hàng vào kho.</div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($phieunhap as $pn): 
                                $ma_pn = sprintf("PN%05d", $pn["id"]);
                                $so_luong_may = (int)($pn["tongsoluong"] ?? 0);
                            ?>
                            <tr class="dong-phieu-nhap">
                                <!-- Mã phiếu -->
                                <td class="ps-4 py-3">
                                    <a href="index.php?action=chitiet&id=<?= $pn["id"] ?>" class="text-decoration-none">
                                        <span class="badge fw-bold" style="background-color: #f1f5f9; color: #1e293b; border: 1px solid #e2e8f0; font-size: 11.5px; padding: 4px 8px; border-radius: 6px; font-family: monospace;">
                                            <?= $ma_pn ?>
                                        </span>
                                    </a>
                                </td>

                                <!-- Nhà cung cấp + Ghi chú -->
                                <td class="py-3">
                                    <div class="fw-bold text-dark cot-ncc" style="font-size: 13.5px;"><?= htmlspecialchars($pn["nhacungcap"]) ?></div>
                                    <?php if(!empty($pn["ghichu"])): ?>
                                        <div class="text-muted small mt-1" style="font-size: 11.5px;">
                                            <i class="align-middle me-1" data-feather="message-square" style="width: 11px; height: 11px;"></i><?= htmlspecialchars($pn["ghichu"]) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- Người lập phiếu -->
                                <td class="py-3">
                                    <div class="fw-semibold text-dark cot-nguoi" style="font-size: 13px;"><?= htmlspecialchars($pn["hoten"] ?? "Quản trị viên") ?></div>
                                    <?php if(!empty($pn["email"])): ?>
                                        <div class="text-muted small" style="font-size: 11px;"><?= htmlspecialchars($pn["email"]) ?></div>
                                    <?php endif; ?>
                                </td>

                                <!-- Ngày nhập -->
                                <td class="py-3 text-muted small" style="font-size: 12.5px;">
                                    <i class="align-middle me-1" data-feather="calendar" style="width: 12px; height: 12px;"></i><?= date("d/m/Y H:i", strtotime($pn["ngaynhap"])) ?>
                                </td>

                                <!-- Số lượng máy -->
                                <td class="py-3 text-center">
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 11.5px;">
                                        <?= number_format($so_luong_may) ?> máy
                                    </span>
                                </td>

                                <!-- Tổng tiền -->
                                <td class="py-3 text-end">
                                    <span class="fw-bold" style="color: #d70018; font-size: 13.5px;">
                                        <?= number_format($pn["tongtien"], 0, ',', '.') ?>đ
                                    </span>
                                </td>

                                <!-- Thao tác -->
                                <td class="pe-4 py-3 text-center">
                                    <a href="index.php?action=chitiet&id=<?= $pn["id"] ?>" 
                                       class="btn btn-sm btn-action-outline d-inline-flex align-items-center justify-content-center p-1" 
                                       style="width: 32px; height: 32px; border-radius: 8px;"
                                       title="Xem chi tiết phiếu nhập">
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
function locBangPhieuNhap() {
    var input = document.getElementById("inputTimKiemPN");
    var filter = input.value.toLowerCase().trim();
    var rows = document.querySelectorAll("#bangPhieuNhap tbody tr.dong-phieu-nhap");

    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        if (text.indexOf(filter) > -1) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>

<?php include("../inc/bottom.php"); ?>
