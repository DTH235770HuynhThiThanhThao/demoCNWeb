<?php 
include("inc/top.php"); 

// Xác định tên danh mục hãng
$tendanhmuc_hien = !empty($mhct["tendanhmuc"]) ? $mhct["tendanhmuc"] : "Điện thoại";
if($tendanhmuc_hien == "Điện thoại" && isset($danhmuc) && is_array($danhmuc)){
    foreach($danhmuc as $d){
        if($d["id"] == $mhct["danhmuc_id"]){
            $tendanhmuc_hien = $d["tendanhmuc"];
            break;
        }
    }
}

// 1. Xử lý màu sắc và thư viện ảnh thật của sản phẩm
$ds_anh_that = array();
if(!empty($mhct["hinhanh"])){
    $ds_anh_that[] = $mhct["hinhanh"];
}

if(!empty($mhct["thuvienanh"])){
    $raw_tv = explode(",", $mhct["thuvienanh"]);
    foreach($raw_tv as $tv_item){
        $tv_item = trim($tv_item);
        if(!empty($tv_item)){
            $tv_path = (strpos($tv_item, "images/") === 0) ? $tv_item : "images/products/" . $tv_item;
            if(!in_array($tv_path, $ds_anh_that)){
                $ds_anh_that[] = $tv_path;
            }
        }
    }
}
if(empty($ds_anh_that)){
    $ds_anh_that[] = "images/products/a1.jpg";
}

// Danh sách màu sắc thực tế
$ds_mau_that = array();
if(!empty($mhct["mausac"])){
    $raw_mau = explode(",", $mhct["mausac"]);
    foreach($raw_mau as $m_item){
        $m_item = trim($m_item);
        if(!empty($m_item)){
            $ds_mau_that[] = $m_item;
        }
    }
}

// Nếu chưa có màu sắc được nhập, tự động nhận diện từ tên sản phẩm hoặc gán màu mặc định
if(empty($ds_mau_that)){
    $ten_may = $mhct["tenmathang"];
    if(stripos($ten_may, "Titan Xanh") !== false) $ds_mau_that[] = "Titan Xanh";
    elseif(stripos($ten_may, "Titan Trắng") !== false) $ds_mau_that[] = "Titan Trắng";
    elseif(stripos($ten_may, "Titan Tự Nhiên") !== false) $ds_mau_that[] = "Titan Tự Nhiên";
    elseif(stripos($ten_may, "Titan Đen") !== false) $ds_mau_that[] = "Titan Đen";
    elseif(stripos($ten_may, "Xanh Dương") !== false) $ds_mau_that[] = "Xanh Dương";
    elseif(stripos($ten_may, "Tím") !== false) $ds_mau_that[] = "Tím";
    elseif(stripos($ten_may, "Đen") !== false) $ds_mau_that[] = "Đen";
    elseif(stripos($ten_may, "Trắng") !== false) $ds_mau_that[] = "Trắng";
    elseif(stripos($ten_may, "Vàng") !== false) $ds_mau_that[] = "Vàng Gold";
    else $ds_mau_that[] = "Màu tiêu chuẩn";
}

// Ghép nối danh sách màu sắc kèm ảnh thật tương ứng
$danh_sach_mau_render = array();
foreach($ds_mau_that as $idx_m => $ten_m){
    $img_m = isset($ds_anh_that[$idx_m]) ? $ds_anh_that[$idx_m] : $ds_anh_that[0];
    $danh_sach_mau_render[] = array(
        "ten" => $ten_m,
        "img" => $img_m
    );
}

// 2. Xử lý phiên bản dung lượng thực tế
$ten_may_hientai = $mhct["tenmathang"];
$dungluong_hientai = "Tiêu chuẩn";
if(preg_match('/(\d+\s*(?:GB|TB))/i', $ten_may_hientai, $match_dl)){
    $dungluong_hientai = strtoupper(str_replace(' ', '', $match_dl[1]));
}

// 3. Khởi tạo & nạp dữ liệu đánh giá sản phẩm
if(!isset($thongke_danhgia)){
    if(!class_exists('DANHGIA')) require_once("../model/danhgia.php");
    $dg_tmp = new DANHGIA();
    $thongke_danhgia = $dg_tmp->tinhdiemdanhgia($mhct["id"]);
    $ds_danhgia = $dg_tmp->laydanhgiatheomathang($mhct["id"]);
    $donhang_id_duocdanhgia = false;
    if(isset($_SESSION["khachhang"]["id"])){
        $donhang_id_duocdanhgia = $dg_tmp->kiemtraduocphepdanhgia((int)$_SESSION["khachhang"]["id"], $mhct["id"]);
    }
}
$diem_tb = !empty($thongke_danhgia["diemtrungbinh"]) ? number_format($thongke_danhgia["diemtrungbinh"], 1) : "5.0";
$tong_dg = !empty($thongke_danhgia["tongso"]) ? (int)$thongke_danhgia["tongso"] : 0;

$danh_sach_phienban = array();

// Nếu Admin đã nhập trường phienban (ví dụ: "128GB, 256GB, 512GB")
if(!empty($mhct["phienban"])){
    $arr_pb_raw = explode(",", $mhct["phienban"]);
    foreach($arr_pb_raw as $pb_item){
        $pb_item = trim($pb_item);
        if(!empty($pb_item)){
            $is_cur = (strcasecmp($pb_item, $dungluong_hientai) === 0);
            $danh_sach_phienban[$pb_item] = array(
                "id" => $is_cur ? $mhct["id"] : 0,
                "dungluong" => $pb_item,
                "giaban" => (float)$mhct["giaban"],
                "is_current" => $is_cur
            );
        }
    }
    // Nếu chưa có phiên bản nào khớp thì chọn phiên bản đầu tiên làm mặc định
    $co_ban_active = false;
    foreach($danh_sach_phienban as $pb){
        if($pb["is_current"]) { $co_ban_active = true; break; }
    }
    if(!$co_ban_active && !empty($danh_sach_phienban)){
        $first_key = array_key_first($danh_sach_phienban);
        $danh_sach_phienban[$first_key]["is_current"] = true;
    }
} else {
    // Nếu Admin chưa nhập phienban: tự động lấy dung lượng có trong tên máy
    $danh_sach_phienban[$dungluong_hientai] = array(
        "id" => $mhct["id"],
        "dungluong" => $dungluong_hientai,
        "giaban" => (float)$mhct["giaban"],
        "is_current" => true
    );
}

// Tìm liên kết sang các sản phẩm cùng dòng khác dung lượng trong danh mục nếu có
$dong_may_base = trim(preg_replace('/(\d+\s*(?:GB|TB)).*$/i', '', $ten_may_hientai));
if(!empty($dong_may_base) && !empty($mathang)){
    foreach($mathang as $item_mh){
        if($item_mh["danhmuc_id"] == $mhct["danhmuc_id"] && $item_mh["id"] != $mhct["id"]){
            $ten_khac = $item_mh["tenmathang"];
            if(stripos($ten_khac, $dong_may_base) === 0){
                if(preg_match('/(\d+\s*(?:GB|TB))/i', $ten_khac, $match_khac)){
                    $dl_khac = strtoupper(str_replace(' ', '', $match_khac[1]));
                    if(isset($danh_sach_phienban[$dl_khac])){
                        $danh_sach_phienban[$dl_khac]["id"] = $item_mh["id"];
                        $danh_sach_phienban[$dl_khac]["giaban"] = (float)$item_mh["giaban"];
                    } elseif(empty($mhct["phienban"])) {
                        $danh_sach_phienban[$dl_khac] = array(
                            "id" => $item_mh["id"],
                            "dungluong" => $dl_khac,
                            "giaban" => (float)$item_mh["giaban"],
                            "is_current" => false
                        );
                    }
                }
            }
        }
    }
}

// Tính % giảm giá gốc
$giamgia_pt = 0;
if($mhct["giagoc"] > $mhct["giaban"] && $mhct["giagoc"] > 0){
    $giamgia_pt = round((($mhct["giagoc"] - $mhct["giaban"]) / $mhct["giagoc"]) * 100);
}

// Xử lý thông số kỹ thuật từ cột mota
$ds_thongso = array();
if(!empty($mhct["mota"])){
    if(preg_match_all('/<p>\s*<strong>(.*?)<\/strong>:?\s*(.*?)<\/p>/is', $mhct["mota"], $matches, PREG_SET_ORDER)){
        foreach($matches as $m_item){
            $label = trim(str_replace(':', '', strip_tags($m_item[1])));
            $val = trim(strip_tags($m_item[2]));
            if(!empty($label) && !empty($val)){
                $ds_thongso[$label] = $val;
            }
        }
    }
}
?>

<!-- 1. Thanh điều hướng Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-shop">
        <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door me-1"></i>Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="index.php?action=group&id=<?php echo $mhct["danhmuc_id"]; ?>"><?php echo $tendanhmuc_hien; ?></a></li>
        <li class="breadcrumb-item active text-truncate" style="max-width: 400px;" aria-current="page"><?php echo $mhct["tenmathang"]; ?></li>
    </ol>
</nav>

<!-- 2. Thẻ Tiêu đề sản phẩm nổi bật -->
<div class="detail-header-card">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1"><?php echo $mhct["tenmathang"]; ?></h1>
            <div class="d-flex flex-wrap align-items-center gap-3 small text-muted">
                <a href="#khung-danh-gia" class="text-decoration-none d-inline-flex align-items-center text-warning" title="Xem đánh giá sản phẩm">
                    <span class="d-inline-flex align-items-center">
                        <?php 
                        $diem_so = (float)$diem_tb;
                        for($i = 1; $i <= 5; $i++): 
                        ?>
                            <i class="bi bi-star<?= ($i <= round($diem_so)) ? '-fill' : '' ?> me-1" style="color: #ffc107;"></i>
                        <?php endfor; ?>
                    </span>
                    <span class="text-dark fw-bold ms-1"><?= $diem_tb ?>/5</span>
                    <span class="text-muted ms-1">• <?= $tong_dg ?> đánh giá</span>
                </a>
                <span>•</span>
                <span><i class="bi bi-eye text-primary me-1"></i><b><?php echo number_format($mhct["luotxem"]); ?></b> lượt xem</span>
                <span>•</span>
                <span><i class="bi bi-bag-check-fill text-success me-1"></i>Đã bán <b><?php echo number_format($mhct["luotmua"]); ?></b></span>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 fw-bold">
                    <i class="bi bi-shield-check me-1"></i>Chính hãng VN/A
                </span>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-2">
            <span class="badge bg-light text-secondary border px-3 py-2">
                <i class="bi bi-truck text-danger me-1"></i>Giao nhanh 2H miễn phí
            </span>
        </div>
    </div>
</div>

<!-- 3. Khối 2 cột chính phía trên -->
<div class="row g-4 mb-5">
    <!-- CỘT TRÁI (col-lg-5): KHUNG TRƯNG BÀY ẢNH & BẢNG THÔNG SỐ KỸ THUẬT -->
    <div class="col-lg-5">
        <!-- Khung ảnh sản phẩm chính -->
        <div class="main-img-box">
            <?php if($giamgia_pt > 0): ?>
                <div class="product-card-badge">Giảm <?php echo $giamgia_pt; ?>%</div>
            <?php endif; ?>
            <img id="anh-san-pham-chinh" src="../<?php echo $mhct["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($mhct["tenmathang"]); ?>">
        </div>

        <!-- Dải ảnh nhỏ Gallery bên dưới -->
        <div class="thumb-gallery">
            <?php 
            foreach($ds_anh_that as $idx => $img_path): 
                $src_thumb = (strpos($img_path, "images/") === 0) ? "../" . $img_path : "../images/products/" . $img_path;
            ?>
                <img class="thumb-item <?php if($idx == 0) echo 'active'; ?>" 
                     src="<?php echo $src_thumb; ?>" 
                     alt="Ảnh góc nhìn <?php echo $idx + 1; ?>"
                     onclick="doiAnhChinh(this, '<?php echo $src_thumb; ?>')"
                     onerror="this.src='../images/products/a1.jpg';">
            <?php endforeach; ?>
        </div>

        <!-- Hộp Thông số kỹ thuật / Mô tả nổi bật -->
        <div class="spec-box">
            <div class="spec-box-header">
                <i class="bi bi-cpu-fill text-danger fs-5"></i>
                <span>THÔNG SỐ KỸ THUẬT NỔI BẬT</span>
            </div>
            <?php if(!empty($ds_thongso)): ?>
                <table class="table spec-table">
                    <tbody>
                        <?php foreach($ds_thongso as $spec_label => $spec_value): ?>
                        <tr>
                            <td class="spec-name"><?php echo $spec_label; ?></td>
                            <td class="spec-val"><?php echo $spec_value; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="p-3 text-muted small">
                    <?php echo $mhct["mota"]; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CỘT PHẢI (col-lg-7): GIÁ BÁN, PHIÊN BẢN, MÀU SẮC, KHUYẾN MÃI & NÚT MUA HÀNG -->
    <div class="col-lg-7">
        <div class="bg-white p-4 rounded-3 border shadow-sm">
            <!-- 1. Khung Giá bán nổi bật -->
            <div class="price-hero-box d-flex flex-wrap align-items-baseline justify-content-between">
                <div>
                    <span class="price-main" id="gia-ban-hien-tai"><?php echo number_format($mhct["giaban"]); ?>đ</span>
                    <?php if($mhct["giaban"] != $mhct["giagoc"] && $mhct["giagoc"] > 0): ?>
                        <span class="price-orig" id="gia-goc-hien-tai"><?php echo number_format($mhct["giagoc"]); ?>đ</span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if($giamgia_pt > 0): ?>
                        <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill shadow-sm" id="badge-giam-gia">
                            Tiết kiệm <?php echo $giamgia_pt; ?>%
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                            Giá tốt nhất
                        </span>
                    <?php endif; ?>
                </div>
                <div class="w-100 mt-2 small text-muted">
                    <i class="bi bi-check-circle-fill text-success me-1"></i>Giá đã bao gồm VAT & Bảo hành chính hãng 12 tháng.
                </div>
            </div>

            <!-- 2. Chọn Phiên bản dung lượng THỰC TẾ -->
            <div class="mb-4">
                <label class="form-label fw-bold text-dark mb-2">
                    <i class="bi bi-hdd-network me-1 text-danger"></i>Phiên bản dung lượng:
                </label>
                <div class="row g-2">
                    <?php foreach($danh_sach_phienban as $pb): ?>
                        <div class="col-6 col-md-4">
                            <?php if($pb["is_current"]): ?>
                                <div class="option-capacity-card active" onclick="chonPhienBan(this, <?php echo $pb['giaban']; ?>, '<?php echo htmlspecialchars($pb['dungluong']); ?>')">
                                    <span class="badge-check"><i class="bi bi-check"></i></span>
                                    <div class="fw-bold fs-6"><?php echo htmlspecialchars($pb["dungluong"]); ?></div>
                                    <small class="text-danger fw-semibold capacity-price"><?php echo number_format($pb["giaban"]); ?>đ</small>
                                </div>
                            <?php elseif(!empty($pb["id"]) && $pb["id"] != $mhct["id"]): ?>
                                <a href="index.php?action=detail&id=<?php echo $pb["id"]; ?>" class="text-decoration-none d-block">
                                    <div class="option-capacity-card">
                                        <div class="fw-bold fs-6 text-dark"><?php echo htmlspecialchars($pb["dungluong"]); ?></div>
                                        <small class="text-muted fw-semibold capacity-price"><?php echo number_format($pb["giaban"]); ?>đ</small>
                                    </div>
                                </a>
                            <?php else: ?>
                                <div class="option-capacity-card" onclick="chonPhienBan(this, <?php echo $pb['giaban']; ?>, '<?php echo htmlspecialchars($pb['dungluong']); ?>')">
                                    <span class="badge-check"><i class="bi bi-check"></i></span>
                                    <div class="fw-bold fs-6 text-dark"><?php echo htmlspecialchars($pb["dungluong"]); ?></div>
                                    <small class="text-danger fw-semibold capacity-price"><?php echo number_format($pb["giaban"]); ?>đ</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- 3. Chọn Màu sắc THỰC TẾ CÓ ẢNH THẬT -->
            <div class="mb-4">
                <label class="form-label fw-bold text-dark mb-2">
                    <i class="bi bi-palette me-1 text-danger"></i>Màu sắc thực tế:
                </label>
                <div class="row g-2">
                    <?php 
                    foreach($danh_sach_mau_render as $idx_c => $mau_item):
                        $is_active_color = ($idx_c === 0);
                        $src_mau = (strpos($mau_item["img"], "images/") === 0) ? "../" . $mau_item["img"] : "../images/products/" . $mau_item["img"];
                    ?>
                    <div class="col-6 col-md-6">
                        <div class="color-option-card <?php if($is_active_color) echo 'active'; ?>" 
                             onclick="chonMau(this, '<?php echo $src_mau; ?>')">
                            <span class="badge-check"><i class="bi bi-check"></i></span>
                            <img src="<?php echo $src_mau; ?>" alt="<?php echo htmlspecialchars($mau_item["ten"]); ?>" class="color-thumb" onerror="this.src='../images/products/a1.jpg';">
                            <div class="overflow-hidden">
                                <div class="fw-bold text-truncate small text-dark"><?php echo htmlspecialchars($mau_item["ten"]); ?></div>
                                <div class="text-danger small fw-semibold color-price-display"><?php echo number_format($mhct["giaban"]); ?>đ</div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- 4. Khung Khuyến mãi & Cam kết mua hàng -->
            <div class="promo-gift-box">
                <div class="promo-gift-header">
                    <i class="bi bi-gift-fill fs-5"></i>
                    <span>ƯU ĐÃI ĐẶC QUYỀN TẠI <?php echo mb_strtoupper($ten_shop ?? "Thảo Mobile", 'UTF-8'); ?></span>
                </div>
                <div class="promo-gift-body">
                    <ul>
                        <li><b>Bảo hành toàn diện:</b> 12 tháng chính hãng, lỗi 1 đổi 1 trong 30 ngày đầu tiên.</li>
                        <li><b>Giao hàng siêu tốc:</b> Miễn phí giao hàng 2H toàn quốc, kiểm tra hàng kỹ lưỡng trước khi thanh toán.</li>
                    </ul>
                </div>
            </div>

            <!-- CSS tùy chỉnh 2 nút Mua hàng & Thêm vào giỏ với độ ưu tiên cao -->
            <style>
            .btn-detail-add-cart:hover {
                background-color: #d70018 !important;
                color: #ffffff !important;
                border-color: #d70018 !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 14px rgba(215, 0, 24, 0.25);
            }
            .btn-detail-buy-now:hover {
                background-color: #b80014 !important;
                border-color: #b80014 !important;
                color: #ffffff !important;
                transform: translateY(-2px);
                box-shadow: 0 8px 22px rgba(215, 0, 24, 0.45);
            }
            </style>

            <!-- 5. Form Chọn số lượng & Nút Mua hàng (Giữ nguyên 100% action gửi form của giảng viên) -->
            <form method="post" action="index.php" class="mt-3">
                <input type="hidden" name="action" value="chovaogio">
                <input type="hidden" name="id" value="<?php echo $mhct["id"]; ?>">

                <div class="d-flex align-items-center gap-3">
                    <!-- Ô tăng giảm số lượng -->
                    <div>
                        <label class="small text-muted d-block mb-1 fw-semibold">Số lượng:</label>
                        <div class="quantity-stepper">
                            <button type="button" class="btn-step" onclick="giamSoLuong()"><i class="bi bi-dash"></i></button>
                            <input type="number" id="input-so-luong" name="soluong" value="1" min="1" max="99">
                            <button type="button" class="btn-step" onclick="tangSoLuong()"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>

                    <!-- 2 nút: Thêm vào giỏ & Mua ngay -->
                    <div class="flex-grow-1">
                        <label class="small text-muted d-block mb-1 invisible">Mua:</label>
                        <div class="d-flex gap-2 flex-grow-1">
                            <!-- Nút 1: Thêm vào giỏ -->
                            <button type="submit" 
                                    name="btn_themgio" 
                                    class="btn-detail-add-cart" 
                                    style="flex: 1; height: 50px !important; background-color: #fff1f2 !important; border: 2px solid #d70018 !important; color: #d70018 !important; border-radius: 10px !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; font-weight: 700 !important; font-size: 0.98rem !important; cursor: pointer !important; text-decoration: none !important; transition: all 0.2s ease !important;">
                                <i class="bi bi-cart-plus fs-5"></i>
                                <span>Thêm vào giỏ</span>
                            </button>
                            <!-- Nút 2: Mua ngay -->
                            <button type="submit" 
                                    name="btn_muangay" 
                                    class="btn-detail-buy-now" 
                                    style="flex: 1; height: 50px !important; background-color: #d70018 !important; border: 2px solid #d70018 !important; color: #ffffff !important; border-radius: 10px !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important; font-weight: 700 !important; font-size: 1.02rem !important; cursor: pointer !important; text-decoration: none !important; box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25) !important; transition: all 0.2s ease !important;">
                                <i class="bi bi-lightning-charge-fill fs-5"></i>
                                <span>Mua ngay</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <small class="text-muted">
                        <i class="bi bi-telephone-fill text-danger me-1"></i>Hotline tư vấn nhanh: <b><?php echo htmlspecialchars($hotline_shop ?? "0357185269"); ?></b> (8:00 - 21:30)
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 4. KHU VỰC "SẢN PHẨM LIÊN QUAN" Ở PHÍA DƯỚI -->
<div class="mt-5 pt-3">
    <!-- Tiêu đề Section -->
    <div class="section-brand-header">
        <div class="section-brand-title">
            <span class="brand-accent"></span>
            <span>SẢN PHẨM LIÊN QUAN</span>
        </div>
        <a href="index.php?action=group&id=<?php echo $mhct["danhmuc_id"]; ?>" class="btn-view-all-brand text-decoration-none">
            Xem tất cả <?php echo $tendanhmuc_hien; ?> <i class="bi bi-chevron-right ms-1"></i>
        </a>
    </div>

    <!-- Lưới 4 sản phẩm cùng danh mục chuẩn Product Card CellphoneS -->
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
        <?php 
        $so_luong_lienquan = 0;
        if(!empty($mathang)):
            foreach($mathang as $m):
                if($m["id"] != $mhct["id"] && $so_luong_lienquan < 4):
                    $so_luong_lienquan++;
                    // Tính phần trăm giảm giá tự động
                    $giamgia_rel = 0;
                    if($m["giagoc"] > $m["giaban"] && $m["giagoc"] > 0){
                        $giamgia_rel = round((($m["giagoc"] - $m["giaban"]) / $m["giagoc"]) * 100);
                    }
        ?>
            <div class="col">
                <div class="product-card">
                    <!-- Tem giảm giá góc trên bên trái -->
                    <?php if($giamgia_rel > 0): ?>
                        <div class="product-card-badge">Giảm <?php echo $giamgia_rel; ?>%</div>
                    <?php elseif($m["giaban"] != $m["giagoc"]): ?>
                        <div class="product-card-badge">Ưu đãi</div>
                    <?php else: ?>
                        <div class="product-card-badge" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">Hot</div>
                    <?php endif; ?>

                    <!-- Khung ảnh sản phẩm -->
                    <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-img-wrap text-decoration-none">
                        <img class="product-img" src="../<?php echo $m["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($m["tenmathang"]); ?>" loading="lazy">
                    </a>

                    <!-- Chi tiết sản phẩm -->
                    <div class="product-card-body">
                        <!-- Tên điện thoại giới hạn 2 dòng -->
                        <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-name text-decoration-none" title="<?php echo htmlspecialchars($m["tenmathang"]); ?>">
                            <?php echo $m["tenmathang"]; ?>
                        </a>

                        <!-- Khu vực giá bán -->
                        <div class="product-price-row">
                            <span class="product-price-current"><?php echo number_format($m["giaban"]); ?>đ</span>
                            <?php if ($m["giaban"] != $m["giagoc"] && $m["giagoc"] > 0): ?>
                                <span class="product-price-original"><?php echo number_format($m["giagoc"]); ?>đ</span>
                            <?php endif; ?>
                        </div>

                        <!-- Khung ưu đãi nhỏ chuẩn CellphoneS -->
                        <div class="product-promo-box">
                            <i class="bi bi-gift-fill"></i>
                            <span class="text-truncate">Tặng gói bảo hành rơi vỡ & giao nhanh</span>
                        </div>

                        <!-- Đánh giá sao & Nút chọn mua -->
                        <div class="product-card-footer">
                            <div class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <a class="btn btn-buy-tech text-decoration-none" href="index.php?action=chovaogio&id=<?php echo $m["id"]; ?>">
                                <i class="bi bi-cart-plus me-1"></i>Chọn mua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                endif;
            endforeach;
        endif; 
        ?>
    </div>
</div>

<!-- ================================================================= -->
<!-- KHUNG ĐÁNH GIÁ & NHẬN XÉT SẢN PHẨM - TÔNG ĐỎ TECH FLAGSHIP #d70018 -->
<!-- ================================================================= -->
<div id="khung-danh-gia" class="card border-0 shadow-sm mb-5" style="border-radius: 14px; scroll-margin-top: 90px; overflow: hidden; background: #ffffff;">
    <!-- Thanh nhấn đỏ Tech Flagship #d70018 ở trên đầu thẻ -->
    <div style="height: 4px; background: linear-gradient(90deg, #d70018 0%, #ff4d4f 100%);"></div>

    <div class="card-body p-4 p-md-5">
        <!-- Tiêu đề thẻ -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3 mb-4 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-3 text-white shadow-sm" style="width: 42px; height: 42px; background-color: #d70018;">
                    <i class="bi bi-star-half fs-5"></i>
                </div>
                <div>
                    <h3 class="h5 fw-bold mb-0 text-dark" style="letter-spacing: 0.5px;">ĐÁNH GIÁ & NHẬN XÉT SẢN PHẨM</h3>
                    <div class="text-muted small">Nhận xét khách quan từ khách hàng đã mua và sử dụng tại Thảo Mobile</div>
                </div>
            </div>
            <div>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-shield-check me-1"></i>100% đánh giá từ người mua thật
                </span>
            </div>
        </div>

        <!-- Thông báo sau khi gửi đánh giá -->
        <?php if(isset($_GET["msg"])): ?>
            <?php if($_GET["msg"] === "danhgia_ok"): ?>
                <div class="alert alert-dismissible fade show d-flex align-items-center justify-content-between mb-4" 
                     style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-radius: 10px; padding: 12px 16px;" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Cảm ơn bạn đã gửi đánh giá!</strong> Nhận xét của bạn đã được ghi nhận và hiển thị công khai trên hệ thống Thảo Mobile.
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0;"></button>
                </div>
            <?php elseif($_GET["msg"] === "danhgia_trong"): ?>
                <div class="alert alert-warning alert-dismissible fade show mb-4" style="border-radius: 10px;" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Vui lòng nhập nội dung nhận xét của bạn trước khi bấm gửi!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif($_GET["msg"] === "danhgia_loi"): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" style="border-radius: 10px;" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i>Chỉ đơn hàng đã giao thành công (Hoàn thành) và chưa từng đánh giá mới có thể gửi nhận xét.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- 1. KHỐI TỔNG QUAN ĐIỂM SAO -->
        <div class="row g-4 align-items-center p-4 rounded-3 mb-4" style="background-color: #fafafa; border: 1px solid #f0f0f0;">
            <!-- Cột trái: Điểm số trung bình -->
            <div class="col-md-4 text-center border-end-md pb-3 pb-md-0">
                <div class="display-3 fw-bold text-dark lh-1 mb-2"><?= $diem_tb ?></div>
                <div class="text-warning fs-5 mb-2">
                    <?php 
                    $diem_so = (float)$diem_tb;
                    for($i = 1; $i <= 5; $i++): 
                    ?>
                        <i class="bi bi-star<?= ($i <= round($diem_so)) ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <div class="text-muted fw-semibold">
                    <i class="bi bi-person-check me-1"></i><b><?= $tong_dg ?></b> đánh giá & nhận xét
                </div>
            </div>

            <!-- Cột phải: Thanh tiến trình 5 sao -> 1 sao -->
            <div class="col-md-8">
                <?php 
                $cac_muc_sao = [
                    5 => $thongke_danhgia["sao5"] ?? 0,
                    4 => $thongke_danhgia["sao4"] ?? 0,
                    3 => $thongke_danhgia["sao3"] ?? 0,
                    2 => $thongke_danhgia["sao2"] ?? 0,
                    1 => $thongke_danhgia["sao1"] ?? 0,
                ];
                foreach($cac_muc_sao as $so_sao => $so_luong):
                    $pt = ($tong_dg > 0) ? round(($so_luong / $tong_dg) * 100) : 0;
                ?>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="d-flex align-items-center text-nowrap" style="width: 55px; font-size: 13px;">
                        <span class="fw-bold me-1 text-dark"><?= $so_sao ?></span>
                        <i class="bi bi-star-fill text-warning" style="font-size: 11px;"></i>
                    </div>
                    <div class="progress flex-grow-1" style="height: 8px; border-radius: 99px; background-color: #e9ecef;">
                        <div class="progress-bar" role="progressbar" 
                             style="width: <?= $pt ?>%; background-color: #d70018; border-radius: 99px;" 
                             aria-valuenow="<?= $pt ?>" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="text-end text-muted small" style="width: 80px; font-size: 12px;">
                        <span class="fw-bold text-dark"><?= $so_luong ?></span> (<?= $pt ?>%)
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 2. FORM GỬI ĐÁNH GIÁ (CÓ ĐIỀU KIỆN) -->
        <div class="mb-5">
            <?php if($donhang_id_duocdanhgia !== false): ?>
                <!-- Đủ điều kiện gửi đánh giá -->
                <div class="p-4 rounded-3 border" style="background-color: #fff9f9; border-color: #ffccd0 !important;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center">
                            <i class="bi bi-pencil-square me-2" style="color: #d70018;"></i>
                            Viết đánh giá cho sản phẩm này (Đơn hàng #<?= sprintf("DH%06d", $donhang_id_duocdanhgia) ?>)
                        </h6>
                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 11px;">
                            <i class="bi bi-patch-check-fill me-1"></i>Đã xác thực đã mua hàng
                        </span>
                    </div>

                    <form action="index.php?action=guidanhgia" method="post" id="formDanhGia">
                        <input type="hidden" name="mathang_id" value="<?= $mhct["id"] ?>">
                        <input type="hidden" name="sosao" id="inputSoSao" value="5">

                        <!-- Chọn số sao tương tác JS -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Mức độ hài lòng của bạn:</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rating-stars-picker d-flex gap-1" id="starContainer" style="cursor: pointer; font-size: 26px;">
                                    <i class="bi bi-star-fill text-warning star-item" data-value="1" title="1 sao"></i>
                                    <i class="bi bi-star-fill text-warning star-item" data-value="2" title="2 sao"></i>
                                    <i class="bi bi-star-fill text-warning star-item" data-value="3" title="3 sao"></i>
                                    <i class="bi bi-star-fill text-warning star-item" data-value="4" title="4 sao"></i>
                                    <i class="bi bi-star-fill text-warning star-item" data-value="5" title="5 sao"></i>
                                </div>
                                <span class="badge px-3 py-2 fw-bold text-dark border bg-white" id="starLabel" style="font-size: 13px;">
                                    Tuyệt vời
                                </span>
                            </div>
                        </div>

                        <!-- Ô textarea nhập cảm nhận -->
                        <div class="mb-3">
                            <label for="txtNoiDungDanhGia" class="form-label small fw-bold text-secondary mb-1">Cảm nhận và nhận xét:</label>
                            <textarea class="form-control" name="noidung" id="txtNoiDungDanhGia" rows="3" 
                                      placeholder="Chia sẻ cảm nhận của bạn về sản phẩm này (chất lượng máy, camera, thời lượng pin, dịch vụ giao hàng...)" 
                                      required style="border-radius: 10px; resize: vertical;"></textarea>
                        </div>

                        <!-- Nút gửi đánh giá đỏ Tech Flagship -->
                        <div class="text-end">
                            <button type="submit" class="btn text-white px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" 
                                    style="background-color: #d70018; border-radius: 10px; font-size: 14px;">
                                <i class="bi bi-send-fill"></i>
                                <span>Gửi đánh giá</span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <!-- Chưa mua hoặc chưa có đơn hàng hoàn thành -->
                <div class="p-3 p-md-4 rounded-3 d-flex align-items-center gap-3" 
                     style="background-color: #f8f9fa; border: 1px dashed #d0d5dd;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" 
                         style="width: 44px; height: 44px; background-color: #eef2f6; color: #475467;">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold text-dark mb-1" style="font-size: 14px;">
                            Chỉ khách hàng đã đặt mua và nhận hàng thành công sản phẩm này tại Thảo Mobile mới có thể gửi đánh giá.
                        </div>
                        <div class="text-muted small">
                            Chính sách này nhằm đảm bảo tính khách quan và trải nghiệm thực tế 100% cho cộng đồng khách hàng.
                        </div>
                    </div>
                    <?php if(!isset($_SESSION["khachhang"])): ?>
                        <a href="index.php?action=dangnhap" class="btn btn-sm btn-outline-danger px-3 py-2 text-nowrap fw-bold" style="border-radius: 8px;">
                            Đăng nhập
                        </a>
                    <?php else: ?>
                        <a href="index.php?action=lichsumuahang" class="btn btn-sm btn-outline-secondary px-3 py-2 text-nowrap fw-semibold" style="border-radius: 8px;">
                            Xem đơn hàng
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 3. DANH SÁCH NHẬN XÉT CỦA KHÁCH HÀNG -->
        <div>
            <h6 class="fw-bold text-dark mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                <i class="bi bi-chat-left-text-fill text-danger"></i>
                <span>KHÁCH HÀNG NHẬN XÉT (<?= count($ds_danhgia) ?>)</span>
            </h6>

            <?php if(!empty($ds_danhgia)): ?>
                <div class="review-list d-flex flex-column gap-3">
                    <?php foreach($ds_danhgia as $dg_item): 
                        $avatar_url = !empty($dg_item["hinhanh"]) ? "../" . $dg_item["hinhanh"] : "";
                        $ten_kh = !empty($dg_item["hoten"]) ? $dg_item["hoten"] : "Khách hàng";
                        $chu_dau = mb_strtoupper(mb_substr($ten_kh, 0, 1, "UTF-8"), "UTF-8");
                        $sao = (int)$dg_item["sosao"];
                    ?>
                    <div class="p-3 p-md-4 rounded-3 border bg-white shadow-sm" style="border-radius: 12px !important;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Avatar -->
                                <?php if(!empty($avatar_url) && file_exists("../" . $dg_item["hinhanh"])): ?>
                                    <img src="<?= $avatar_url ?>" alt="<?= htmlspecialchars($ten_kh) ?>" 
                                         class="rounded-circle object-fit-cover border" style="width: 42px; height: 42px;">
                                <?php else: ?>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" 
                                         style="width: 42px; height: 42px; background: linear-gradient(135deg, #d70018 0%, #ff4d4f 100%); font-size: 16px;">
                                        <?= $chu_dau ?>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span class="fw-bold text-dark"><?= htmlspecialchars($ten_kh) ?></span>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0 fw-semibold" style="font-size: 11px;">
                                            <i class="bi bi-check-circle-fill me-1"></i>Đã mua hàng tại Thảo Mobile
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <!-- Dãy sao vàng -->
                                        <div class="text-warning small">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi bi-star<?= ($i <= $sao) ? '-fill' : '' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-muted" style="font-size: 11px;">&bull;</span>
                                        <span class="text-muted" style="font-size: 12px;">
                                            <i class="bi bi-clock me-1"></i><?= date("d/m/Y H:i", strtotime($dg_item["ngaydanhgia"])) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nội dung nhận xét -->
                        <div class="text-dark mt-2 ps-md-5 ms-md-2" style="font-size: 14.5px; line-height: 1.6;">
                            <?= nl2br(htmlspecialchars($dg_item["noidung"])) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5 rounded-3 bg-light border">
                    <i class="bi bi-chat-square-dots text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted fw-semibold mt-2 mb-1">Chưa có đánh giá nào cho sản phẩm này.</p>
                    <p class="small text-muted mb-0">Hãy là người đầu tiên trải nghiệm và chia sẻ cảm nhận về chiếc điện thoại này nhé!</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- JavaScript thuần tương tác mượt mà chuẩn CellphoneS -->
<script>
// Định dạng tiền tệ VNĐ
function dinhDangTien(so) {
    return new Intl.NumberFormat('vi-VN').format(so) + 'đ';
}

// 1. Đổi ảnh chính từ gallery thumbnail
function doiAnhChinh(el, srcAnh) {
    var anhChinh = document.getElementById('anh-san-pham-chinh');
    if (anhChinh) {
        anhChinh.style.opacity = '0.4';
        anhChinh.src = srcAnh;
        setTimeout(function() {
            anhChinh.style.opacity = '1';
        }, 150);
    }
    document.querySelectorAll('.thumb-item').forEach(function(item) {
        item.classList.remove('active');
    });
    if (el) el.classList.add('active');

    // Đồng bộ highlight với ô màu tương ứng nếu có
    document.querySelectorAll('.color-option-card').forEach(function(item) {
        var cardImg = item.querySelector('.color-thumb');
        if (cardImg && (cardImg.src === srcAnh || cardImg.getAttribute('src') === srcAnh)) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

// 2. Chọn phiên bản dung lượng (Cập nhật giá bán)
function chonPhienBan(el, giaMoi, dungLuong) {
    document.querySelectorAll('.option-capacity-card').forEach(function(item) {
        item.classList.remove('active');
    });
    el.classList.add('active');

    var giaHienTai = document.getElementById('gia-ban-hien-tai');
    if (giaHienTai) {
        giaHienTai.innerText = dinhDangTien(giaMoi);
    }

    document.querySelectorAll('.color-price-display').forEach(function(item) {
        item.innerText = dinhDangTien(giaMoi);
    });
}

// 3. Chọn màu sắc (Đổi ảnh lớn và viền đỏ ô màu)
function chonMau(el, srcAnh) {
    document.querySelectorAll('.color-option-card').forEach(function(item) {
        item.classList.remove('active');
    });
    el.classList.add('active');

    var anhChinh = document.getElementById('anh-san-pham-chinh');
    if (anhChinh) {
        anhChinh.style.opacity = '0.4';
        anhChinh.src = srcAnh;
        setTimeout(function() {
            anhChinh.style.opacity = '1';
        }, 150);
    }

    // Đồng bộ highlight với thumbnail bên dưới
    document.querySelectorAll('.thumb-item').forEach(function(item) {
        if (item.src === srcAnh || item.getAttribute('src') === srcAnh) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

// 4. Tăng / Giảm số lượng
function tangSoLuong() {
    var input = document.getElementById('input-so-luong');
    if (input) {
        var val = parseInt(input.value) || 1;
        if (val < 99) input.value = val + 1;
    }
}

function giamSoLuong() {
    var input = document.getElementById('input-so-luong');
    if (input) {
        var val = parseInt(input.value) || 1;
        if (val > 1) input.value = val - 1;
    }
}

// 5. JavaScript tương tác chọn số sao đánh giá (1 - 5 sao)
(function initRatingStars() {
    var starContainer = document.getElementById('starContainer');
    if (!starContainer) return;

    var inputSoSao = document.getElementById('inputSoSao');
    var starLabel = document.getElementById('starLabel');
    var starItems = starContainer.querySelectorAll('.star-item');
    var labels = {
        1: 'Rất tệ',
        2: 'Tệ',
        3: 'Bình thường',
        4: 'Hài lòng',
        5: 'Tuyệt vời'
    };
    var currentRating = parseInt(inputSoSao.value) || 5;

    function renderStars(rating) {
        starItems.forEach(function(star) {
            var val = parseInt(star.getAttribute('data-value'));
            if (val <= rating) {
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill');
            } else {
                star.classList.remove('bi-star-fill');
                star.classList.add('bi-star');
            }
        });
        if (starLabel && labels[rating]) {
            starLabel.innerText = labels[rating];
        }
    }

    starItems.forEach(function(star) {
        star.addEventListener('mouseenter', function() {
            var val = parseInt(this.getAttribute('data-value'));
            renderStars(val);
        });

        star.addEventListener('click', function() {
            currentRating = parseInt(this.getAttribute('data-value'));
            inputSoSao.value = currentRating;
            renderStars(currentRating);
        });
    });

    starContainer.addEventListener('mouseleave', function() {
        renderStars(currentRating);
    });

    renderStars(currentRating);
})();
</script>

<?php include("inc/bottom.php"); ?>
