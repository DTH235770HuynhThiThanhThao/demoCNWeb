<?php include("../inc/top.php"); ?>

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
.btn-tool-pill {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #334155;
    font-size: 11.5px;
    font-weight: 600;
    padding: 4px 9px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn-tool-pill:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fee2e2;
}
.btn-tool-icon {
    width: 34px;
    height: 34px;
    padding: 6px 8px;
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s ease;
}
.btn-tool-icon:hover {
    background-color: #f1f5f9;
    color: #0f172a;
    border-color: #cbd5e1;
}
.btn-tool-delete:hover {
    border-color: #fecaca;
    color: #dc2626;
    background-color: #fff5f5;
}
</style>

<!-- 1. Thanh tiêu đề & Nút Thêm mặt hàng mới -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ MẶT HÀNG</h3>
                            <p class="text-muted small mb-0 mt-1">Quản lý danh sách điện thoại, phiên bản dung lượng, màu sắc và thư viện ảnh</p>
                        </div>
                    </div>
                    <div>
                        <a href="index.php?action=them" class="btn btn-flagship-red d-inline-flex align-items-center px-3 py-2 shadow-sm">
                            <i class="align-middle me-1.5" data-feather="plus-circle" style="width: 17px; height: 17px;"></i>
                            <span>Thêm mặt hàng mới</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thông báo trạng thái -->
<?php if(isset($_GET["msg"])): ?>
    <?php if($_GET["msg"] == "bienthe_ok"): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center mb-3" style="border-radius: 10px;" role="alert">
            <i class="align-middle me-2" data-feather="check-circle"></i>
            <div>Cập nhật <strong>Phiên bản & Màu sắc</strong> thành công!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "anhmau_ok"): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center mb-3" style="border-radius: 10px;" role="alert">
            <i class="align-middle me-2" data-feather="check-circle"></i>
            <div>Cập nhật <strong>Thư viện ảnh màu</strong> thành công!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "xoa_ok"): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center mb-3" style="border-radius: 10px;" role="alert">
            <i class="align-middle me-2" data-feather="check-circle"></i>
            <div><strong>Đã xóa mặt hàng thành công!</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "xoa_loi_rangbuoc"): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center mb-3" style="border-radius: 10px; background-color: #fff1f2; border: 1px solid #fecdd3; color: #9f1239;" role="alert">
            <i class="align-middle me-2 text-danger flex-shrink-0" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
            <div><strong>Không thể xóa mặt hàng này vì đã phát sinh lịch sử nhập kho, đơn hàng hoặc bảo hành trên hệ thống!</strong></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- 2. Thanh công cụ phía trên bảng (Tổng số sản phẩm & Tìm kiếm) -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="badge fw-semibold px-3 py-2" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 8px; font-size: 13px;">
                Tổng: <?= count($mathang) ?> điện thoại
            </span>
        </div>
        <div class="d-flex align-items-center gap-2" style="min-width: 250px;">
            <div class="input-group input-group-sm w-100">
                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;">
                    <i class="align-middle" data-feather="search" style="width: 14px; height: 14px;"></i>
                </span>
                <input type="text" id="inputTimKiemSP" class="form-control shadow-none border-start-0" placeholder="Tìm theo tên máy, hãng..." style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; height: 36px; font-size: 13px;" onkeyup="locBangSanPham()">
            </div>
        </div>
    </div>
</div>

<!-- 3. Bảng danh sách sản phẩm (Tech Flagship, không rối mắt) -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="bangSanPham">
                <thead class="table-flagship-head">
                    <tr>
                        <th style="min-width: 260px;" class="ps-3">Sản phẩm</th>
                        <th style="min-width: 140px;">Giá bán</th>
                        <th style="min-width: 150px;">Tồn kho / Biến thể</th>
                        <th style="min-width: 330px;" class="text-end pe-3">Thao tác nhanh</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($mathang)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <i class="align-middle text-muted mb-2" data-feather="inbox" style="width: 36px; height: 36px; opacity: 0.4;"></i>
                        <div class="fw-semibold">Chưa có mặt hàng nào trong danh sách.</div>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach($mathang as $m): 
                    // Tách phiên bản & màu sắc để đếm
                    $ds_pb = !empty($m["phienban"]) ? array_filter(array_map('trim', explode(',', $m["phienban"]))) : [];
                    $ds_mau = !empty($m["mausac"]) ? array_filter(array_map('trim', explode(',', $m["mausac"]))) : [];
                    $so_bienthe = count($ds_pb) + count($ds_mau);

                    // Tách thư viện ảnh để đếm
                    $ds_anh_mau = !empty($m["thuvienanh"]) ? array_filter(array_map('trim', explode(',', $m["thuvienanh"]))) : [];
                    $so_anh = count($ds_anh_mau);

                    $ma_sp = sprintf("SP-%03d", $m['id']);
                    $ten_hang = !empty($m['tendanhmuc']) ? $m['tendanhmuc'] : "Chưa rõ";
                ?>
                <tr class="dong-san-pham">
                    <!-- Cột 1: Sản phẩm (Ảnh + Tên + Mã SP + Hãng) -->
                    <td class="ps-3 py-2.5">
                        <div class="d-flex align-items-center gap-3">
                            <a href="index.php?action=chitiet&id=<?= $m['id'] ?>" class="flex-shrink-0" title="Xem chi tiết nội bộ">
                                <img src="../../<?= $m["hinhanh"] ?>" 
                                     alt="<?= htmlspecialchars($m["tenmathang"]) ?>" 
                                     class="rounded-3 border bg-white p-1 shadow-sm" 
                                     style="width: 46px; height: 46px; object-fit: contain;"
                                     onerror="this.src='../../images/products/a1.jpg';">
                            </a>
                            <div class="overflow-hidden">
                                <a href="index.php?action=chitiet&id=<?= $m['id'] ?>" class="text-dark fw-bold text-decoration-none d-block text-truncate tieu-de-sp" style="max-width: 300px; font-size: 14px;" title="<?= htmlspecialchars($m["tenmathang"]) ?>">
                                    <?= htmlspecialchars($m["tenmathang"]) ?>
                                </a>
                                <div class="text-muted small mt-1 thong-tin-phu" style="font-size: 12px;">
                                    <span class="badge fw-normal" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 5px;">Mã: <?= $ma_sp ?></span>
                                    <span class="ms-1">&bull; Hãng: <strong class="text-dark"><?= htmlspecialchars($ten_hang) ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Cột 2: Giá bán -->
                    <td class="py-2.5">
                        <div class="fw-bold fs-6" style="color: #d70018; letter-spacing: -0.3px;"><?= number_format($m["giaban"], 0, ',', '.') ?>đ</div>
                        <?php if($m["giagoc"] > $m["giaban"]): ?>
                            <del class="text-muted small d-block" style="font-size: 12px;"><?= number_format($m["giagoc"], 0, ',', '.') ?>đ</del>
                        <?php endif; ?>
                    </td>

                    <!-- Cột 3: Tồn kho / Biến thể -->
                    <td class="py-2.5">
                        <div class="d-flex flex-column gap-1">
                            <?php if($so_bienthe > 0): ?>
                                <span class="badge rounded-pill fw-semibold px-2 py-0.5 align-self-start" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 11px;" title="<?= count($ds_pb) ?> bản dung lượng, <?= count($ds_mau) ?> màu">
                                    <i class="align-middle me-1" data-feather="layers" style="width: 10px; height: 10px;"></i><?= $so_bienthe ?> biến thể
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill fw-normal px-2 py-0.5 align-self-start" style="background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; font-size: 11px;">
                                    0 biến thể
                                </span>
                            <?php endif; ?>

                            <?php if((int)$m["soluongton"] <= 5): ?>
                                <div class="text-warning fw-bold small mt-0.5" style="font-size: 12px;">
                                    <i class="align-middle me-1" data-feather="alert-triangle" style="width: 11px; height: 11px;"></i>Sắp hết: <?= $m["soluongton"] ?>
                                </div>
                            <?php else: ?>
                                <div class="text-success fw-bold small mt-0.5" style="font-size: 12px;">
                                    <i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Tồn: <?= $m["soluongton"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Cột 4: Thao tác nhanh tinh gọn (đồng nhất phong cách trung tính sang trọng) -->
                    <td class="pe-3 py-2.5 text-end">
                        <div class="d-inline-flex align-items-center gap-2 flex-nowrap">
                            <!-- Nút Biến thể: mở trang quản lý nhanh phiên bản & màu sắc -->
                            <a class="btn-tool-pill" 
                               href="index.php?action=bienthe&id=<?= $m['id'] ?>" 
                               title="Quản lý nhanh phiên bản dung lượng & màu sắc">
                                <i class="align-middle me-1" data-feather="sliders" style="width: 12px; height: 12px;"></i>
                                <span>Biến thể (<?= $so_bienthe ?>)</span>
                            </a>

                            <!-- Nút Ảnh màu: mở trang quản lý thư viện ảnh màu (me-2 ngăn cách nhẹ sang cụm nút icon) -->
                            <a class="btn-tool-pill me-2" 
                               href="index.php?action=anhmau&id=<?= $m['id'] ?>" 
                               title="Quản lý thư viện ảnh theo màu">
                                <i class="align-middle me-1" data-feather="image" style="width: 12px; height: 12px;"></i>
                                <span>Ảnh màu (<?= $so_anh ?>)</span>
                            </a>

                            <!-- Nút Web: mở ngoài trang chi tiết khách hàng -->
                            <a class="btn-tool-icon" 
                               href="../../public/index.php?action=detail&id=<?= $m['id'] ?>" 
                               target="_blank" 
                               title="Mở xem trực tiếp trên website">
                                <i class="align-middle" data-feather="external-link" style="width: 13px; height: 13px;"></i>
                            </a>

                            <!-- Nút Sửa: mở form sửa toàn diện -->
                            <a class="btn-tool-icon" 
                               href="index.php?action=sua&id=<?= $m['id'] ?>" 
                               title="Sửa toàn bộ thông tin">
                                <i class="align-middle" data-feather="edit-2" style="width: 13px; height: 13px;"></i>
                            </a>

                            <!-- Nút Xóa: xóa mặt hàng -->
                            <a class="btn-tool-icon btn-tool-delete" 
                               href="index.php?action=xoa&id=<?= $m['id'] ?>" 
                               onclick="return confirm('Xác nhận xóa mặt hàng này?');" 
                               title="Xóa sản phẩm">
                                <i class="align-middle" data-feather="trash-2" style="width: 13px; height: 13px;"></i>
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
function locBangSanPham() {
    var input = document.getElementById("inputTimKiemSP");
    var filter = input.value.toLowerCase().trim();
    var rows = document.querySelectorAll("#bangSanPham tbody tr.dong-san-pham");

    rows.forEach(function(row) {
        var textTitle = row.querySelector(".tieu-de-sp") ? row.querySelector(".tieu-de-sp").textContent.toLowerCase() : "";
        var textSub = row.querySelector(".thong-tin-phu") ? row.querySelector(".thong-tin-phu").textContent.toLowerCase() : "";
        if (textTitle.indexOf(filter) > -1 || textSub.indexOf(filter) > -1) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>

<?php include("../inc/bottom.php"); ?>