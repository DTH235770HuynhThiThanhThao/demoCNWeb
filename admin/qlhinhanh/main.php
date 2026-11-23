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
.section-accent-bar {
    width: 4px;
    height: 20px;
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
.tab-filter-banner {
    border: 1px solid #e2e8f0;
    background-color: #f8fafc;
    color: #475569;
    font-weight: 600;
    font-size: 12.5px;
    padding: 6px 12px;
    border-radius: 8px;
    transition: all 0.2s ease;
    white-space: nowrap;
}
.tab-filter-banner:hover {
    background-color: #f1f5f9;
    color: #1e293b;
}
.tab-filter-banner.active {
    background-color: #d70018 !important;
    border-color: #d70018 !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(215, 0, 24, 0.25);
}
.btn-action-banner {
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
    text-decoration: none;
}
.btn-action-banner:hover {
    background-color: #f1f5f9;
    color: #0f172a;
    border-color: #cbd5e1;
}
.btn-action-banner.btn-delete:hover {
    background-color: #fff5f5;
    color: #dc2626;
    border-color: #fecaca;
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
</style>

<!-- 1. Thanh tiêu đề & Nút xem trang chủ -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ HÌNH ẢNH & BANNER</h3>
                            <p class="text-muted small mb-0 mt-1">Cấu hình logo thương hiệu, slide Hero Banner đầu trang và banner khuyến mãi</p>
                        </div>
                    </div>
                    <div>
                        <a href="../../public/index.php" target="_blank" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center px-3 py-2">
                            <i class="align-middle me-1.5" data-feather="external-link" style="width: 15px; height: 15px;"></i>
                            <span>Xem trang chủ ngoài web</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thông báo trạng thái -->
<?php if(isset($_GET["msg"])): ?>
    <?php if($_GET["msg"] == "them_ok"): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
            <i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
            <div><strong>Thành công!</strong> Đã thêm banner quảng cáo mới vào hệ thống.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "logo_ok"): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
            <i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
            <div><strong>Thành công!</strong> Đã cập nhật Logo thương hiệu mới. Logo đã đồng bộ ra toàn bộ website.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "trangthai_ok"): ?>
        <div class="alert alert-info alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
            <i class="align-middle me-2" data-feather="info" style="width: 20px; height: 20px;"></i>
            <div><strong>Đã cập nhật!</strong> Trạng thái hiển thị banner đã được thay đổi.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif($_GET["msg"] == "xoa_ok"): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
            <i class="align-middle me-2" data-feather="trash-2" style="width: 20px; height: 20px;"></i>
            <div><strong>Đã xóa!</strong> Banner quảng cáo đã được gỡ khỏi danh sách.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($_GET["err"])): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 d-flex align-items-center mb-3" role="alert">
        <i class="align-middle me-2" data-feather="alert-triangle" style="width: 20px; height: 20px;"></i>
        <div>
            <?php 
            if($_GET["err"] == "upload_fail") echo "<strong>Lỗi:</strong> Không thể tải file ảnh lên máy chủ. Vui lòng kiểm tra quyền thư mục.";
            elseif($_GET["err"] == "invalid_file") echo "<strong>Lỗi:</strong> Định dạng file không hợp lệ! Vui lòng chọn ảnh JPG, PNG, WEBP hoặc GIF.";
            elseif($_GET["err"] == "missing_data") echo "<strong>Lỗi:</strong> Vui lòng nhập đầy đủ tiêu đề và chọn file ảnh banner.";
            elseif($_GET["err"] == "no_file") echo "<strong>Lỗi:</strong> Chưa chọn file ảnh để tải lên.";
            else echo "<strong>Lỗi thao tác:</strong> Đã xảy ra lỗi không xác định.";
            ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 2. Hàng 1: 2 Khối upload phía trên (Tỷ lệ 5 - 7, cân đối chiều cao h-100) -->
<div class="row g-3 mb-4">
    <!-- CỘT TRÁI (col-lg-5): Quản lý Logo thương hiệu -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Logo thương hiệu</h5>
            </div>
            <div class="card-body px-4 pt-1 pb-4 d-flex flex-column justify-content-between">
                <div>
                    <label class="form-label fw-semibold text-muted small text-uppercase mb-2" style="font-size: 11.5px; letter-spacing: 0.3px;">Mô phỏng hiển thị trên Header</label>
                    <!-- Khung mô phỏng thanh Header Navbar màu đỏ (#d70018) -->
                    <div class="rounded-3 p-3 mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2 shadow-sm" 
                         style="background-color: #d70018; border: 1px solid rgba(0,0,0,0.1);">
                        <div class="d-flex align-items-center">
                            <?php 
                            $logo_file = !empty($logo_info["duongdan"]) ? $logo_info["duongdan"] : "logo2.jpg";
                            ?>
                            <img src="../../images/logo/<?= htmlspecialchars($logo_file) ?>" 
                                 id="previewLogoImg"
                                 alt="Logo Thảo Mobile" 
                                 class="me-2.5 rounded-3 shadow-sm bg-white p-1" 
                                 style="height: 46px; max-width: 140px; object-fit: contain;"
                                 onerror="this.src='../../images/logo/logo2.jpg'">
                            <div class="text-white">
                                <div class="fw-bold fs-6 lh-1">THẢO MOBILE</div>
                                <span class="small opacity-75" style="font-size: 11px;">Hệ thống bán lẻ chính hãng</span>
                            </div>
                        </div>
                        <span class="badge fw-bold px-2 py-1" style="background-color: #ffffff; color: #d70018; border-radius: 6px; font-size: 11px;">
                            Đang kích hoạt
                        </span>
                    </div>

                    <div class="text-muted small mb-3" style="font-size: 12px;">
                        <i class="align-middle me-1" data-feather="info" style="width: 13px; height: 13px;"></i>
                        File logo hiện hành: <code class="fw-bold" style="color: #d70018;"><?= htmlspecialchars($logo_file) ?></code>
                    </div>
                </div>

                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="doilogo">
                    <div class="mb-3">
                        <label for="filelogo" class="form-label fw-semibold small text-muted mb-1">Chọn ảnh Logo mới</label>
                        <input class="form-control shadow-none" type="file" id="filelogo" name="filelogo" accept="image/*" required onchange="xemTruocLogo(this)" style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                        <div class="text-muted small mt-1" style="font-size: 11.5px;">Hỗ trợ định dạng JPG, PNG, WEBP, SVG. Khuyên dùng tỉ lệ ngang hoặc vuông (cao 50-80px).</div>
                    </div>
                    <button type="submit" class="btn btn-flagship-dark w-100 d-inline-flex align-items-center justify-content-center gap-1.5 shadow-sm">
                        <i class="align-middle" data-feather="upload-cloud" style="width: 16px; height: 16px;"></i>
                        <span>Cập nhật Logo</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- CỘT PHẢI (col-lg-7): Thêm Banner quảng cáo mới -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Thêm Banner quảng cáo mới</h5>
            </div>
            <div class="card-body px-4 pt-1 pb-4">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="thembanner">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted mb-1">Tiêu đề / Thông điệp quảng cáo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none" name="txttieude" required placeholder="Ví dụ: Siêu hội Apple iPhone 16 Pro Max - Giảm ngay 2 triệu..." style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold small text-muted mb-1">Vị trí hiển thị <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" name="cboloai" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                                <option value="banner_chinh" selected>Hero Banner đầu trang (Slide chính lớn)</option>
                                <option value="banner_phu">Banner khuyến mãi phía dưới (Promo Carousel)</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold small text-muted mb-1">Thứ tự hiển thị</label>
                            <input type="number" class="form-control shadow-none" name="numthutu" value="1" min="1" max="99" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted mb-1">Chọn file ảnh banner <span class="text-danger">*</span></label>
                        <input class="form-control shadow-none" type="file" id="filehinhanh" name="filehinhanh" accept="image/*" required onchange="xemTruocBanner(this)" style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                        <div class="text-muted small mt-1" style="font-size: 11.5px;">Gợi ý kích thước: <strong>1200x450px</strong> (Hero Banner) hoặc <strong>600x600px</strong> (Banner khuyến mãi). Tối đa 5MB.</div>
                    </div>

                    <!-- Khung preview banner khi vừa chọn file -->
                    <div id="boxPreviewBanner" class="mb-3 d-none">
                        <label class="form-label small fw-semibold text-muted mb-1">Xem trước ảnh vừa chọn:</label>
                        <div class="rounded-3 border p-1 bg-light text-center" style="max-height: 120px; overflow: hidden;">
                            <img id="imgPreviewBanner" src="#" alt="Preview" style="max-height: 110px; width: auto; max-width: 100%; object-fit: contain;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-flagship-red px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="align-middle" data-feather="plus" style="width: 16px; height: 16px;"></i>
                        <span>Tải lên Banner</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 3. Hàng 2: Bảng danh sách Banner đang quản lý -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center">
            <div class="section-accent-bar"></div>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Danh sách Banner đang quản lý</h5>
        </div>

        <!-- 3 Tab lọc tiện lợi -->
        <div class="d-flex align-items-center gap-1.5 flex-wrap">
            <button type="button" class="tab-filter-banner active" data-filter="all" onclick="locBanner('all', this)">
                Tất cả banner (<span id="countAll">0</span>)
            </button>
            <button type="button" class="tab-filter-banner" data-filter="banner_chinh" onclick="locBanner('banner_chinh', this)">
                Hero Banner đầu trang (<span id="countChinh">0</span>)
            </button>
            <button type="button" class="tab-filter-banner" data-filter="banner_phu" onclick="locBanner('banner_phu', this)">
                Banner khuyến mãi dưới (<span id="countPhu">0</span>)
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head">
                    <tr>
                        <th class="text-center ps-3" style="width: 50px;">#</th>
                        <th style="width: 150px;">Hình ảnh xem trước</th>
                        <th>Tiêu đề & Tên file</th>
                        <th style="width: 210px;">Vị trí hiển thị</th>
                        <th class="text-center" style="width: 90px;">Thứ tự</th>
                        <th class="text-center" style="width: 150px;">Trạng thái</th>
                        <th class="text-center pe-3" style="width: 120px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="tbodyBanner">
                    <?php 
                    $dem = 0;
                    $ds_banner = array();
                    foreach($tatca as $b){
                        if($b["loai"] != "logo"){
                            $ds_banner[] = $b;
                        }
                    }

                    if(count($ds_banner) == 0):
                    ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 36px; height: 36px; opacity: 0.4;"></i>
                                <div class="fw-semibold">Chưa có banner nào được cấu hình.</div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($ds_banner as $item): 
                            $dem++;
                            $is_chinh = ($item["loai"] == "banner_chinh");
                        ?>
                        <tr class="banner-row" data-loai="<?= htmlspecialchars($item["loai"]) ?>">
                            <td class="text-center ps-3 text-muted fw-bold"><?= $dem ?></td>
                            <td>
                                <a href="../../images/carousel/<?= htmlspecialchars($item["duongdan"]) ?>" target="_blank" title="Bấm xem ảnh kích thước đầy đủ">
                                    <img src="../../images/carousel/<?= htmlspecialchars($item["duongdan"]) ?>" 
                                         alt="<?= htmlspecialchars($item["tieude"]) ?>" 
                                         class="rounded-3 shadow-sm border" 
                                         style="width: 110px; height: 54px; object-fit: cover;"
                                         onerror="this.src='../../images/carousel/h1.jpg'">
                                </a>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1" style="font-size: 13.5px;"><?= htmlspecialchars($item["tieude"]) ?></div>
                                <div class="text-muted small d-flex align-items-center gap-1" style="font-size: 11.5px;">
                                    <i class="align-middle" data-feather="file" style="width: 12px; height: 12px;"></i>
                                    <code><?= htmlspecialchars($item["duongdan"]) ?></code>
                                </div>
                            </td>
                            <td>
                                <?php if($is_chinh): ?>
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 11.5px;">
                                        <i class="align-middle me-1" data-feather="layout" style="width: 11px; height: 11px;"></i>Hero Banner đầu trang
                                    </span>
                                <?php else: ?>
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11.5px;">
                                        <i class="align-middle me-1" data-feather="tag" style="width: 11px; height: 11px;"></i>Banner khuyến mãi dưới
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center fw-bold text-dark">
                                <?= $item["thutu"] ?>
                            </td>
                            <td class="text-center">
                                <?php if($item["trangthai"] == 1): ?>
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px;">
                                        <i class="align-middle me-1" data-feather="check" style="width: 11px; height: 11px;"></i>Đang hiển thị
                                    </span>
                                <?php else: ?>
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; font-size: 11.5px;">
                                        <i class="align-middle me-1" data-feather="eye-off" style="width: 11px; height: 11px;"></i>Đang ẩn
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2 flex-nowrap">
                                    <?php if($item["trangthai"] == 1): ?>
                                        <a href="index.php?action=doitrangthai&id=<?= $item["id"] ?>&trangthai=0" 
                                           class="btn-action-banner" 
                                           title="Bấm để ẩn banner này">
                                            <i class="align-middle" data-feather="eye-off" style="width: 14px; height: 14px;"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="index.php?action=doitrangthai&id=<?= $item["id"] ?>&trangthai=1" 
                                           class="btn-action-banner" 
                                           title="Bấm để kích hoạt hiển thị">
                                            <i class="align-middle" data-feather="eye" style="width: 14px; height: 14px;"></i>
                                        </a>
                                    <?php endif; ?>

                                    <a href="index.php?action=xoa&id=<?= $item["id"] ?>" 
                                       class="btn-action-banner btn-delete" 
                                       title="Xóa banner này"
                                       onclick="return confirm('Xác nhận xóa banner này khỏi hệ thống?');">
                                        <i class="align-middle" data-feather="trash-2" style="width: 14px; height: 14px;"></i>
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
// Xem trước Logo khi chọn file
function xemTruocLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewLogoImg');
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Xem trước Banner khi chọn file
function xemTruocBanner(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const box = document.getElementById('boxPreviewBanner');
            const img = document.getElementById('imgPreviewBanner');
            if (box && img) {
                img.src = e.target.result;
                box.classList.remove('d-none');
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Lọc Banner theo tab
function locBanner(type, btn) {
    document.querySelectorAll('.tab-filter-banner').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const rows = document.querySelectorAll('.banner-row');
    rows.forEach(row => {
        const loai = row.getAttribute('data-loai');
        if (type === 'all' || loai === type) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Cập nhật số lượng trên các tab lọc khi tải trang
document.addEventListener('DOMContentLoaded', function() {
    const allRows = document.querySelectorAll('.banner-row');
    let countChinh = 0;
    let countPhu = 0;

    allRows.forEach(row => {
        const loai = row.getAttribute('data-loai');
        if (loai === 'banner_chinh') countChinh++;
        if (loai === 'banner_phu') countPhu++;
    });

    const elAll = document.getElementById('countAll');
    const elChinh = document.getElementById('countChinh');
    const elPhu = document.getElementById('countPhu');

    if (elAll) elAll.textContent = allRows.length;
    if (elChinh) elChinh.textContent = countChinh;
    if (elPhu) elPhu.textContent = countPhu;

    if (window.feather) {
        feather.replace();
    }
});
</script>

<?php include("../inc/bottom.php"); ?>