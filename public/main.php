<?php
include("inc/top.php");

// Lấy danh sách Hero Banner từ CSDL
if(!class_exists("HINHANH")){
    require_once("../model/hinhanh.php");
}
$ha_main = new HINHANH();
$ds_hero_banner = $ha_main->layhinhanhhienthi("banner_chinh");
if(empty($ds_hero_banner)){
    $ds_hero_banner = array(
        array("duongdan" => "h4.jpg", "tieude" => "Siêu phẩm công nghệ mới"),
        array("duongdan" => "h5.jpg", "tieude" => "Lễ hội mua sắm giảm sốc"),
        array("duongdan" => "h6.jpg", "tieude" => "Ưu đãi trả góp 0%"),
        array("duongdan" => "h7.jpg", "tieude" => "Thu cũ đổi mới trợ giá")
    );
}
?>

<!-- Hero Section (Bố cục CellphoneS / Hoàng Hà Mobile) -->
<div class="row g-3 mb-4 align-items-stretch">
    <!-- Cột trái: Bảng Danh mục thương hiệu nổi bật (col-lg-3, ẩn trên mobile) -->
    <div class="col-lg-3 d-none d-lg-block">
        <div class="hero-category-card">
            <div class="hero-category-header">
                <i class="bi bi-grid-fill text-danger fs-5"></i>
                <span>DANH MỤC THƯƠNG HIỆU</span>
            </div>
            <div class="d-flex flex-column">
                <?php 
                foreach($danhmuc as $d): 
                    $brand_lower = strtolower($d["tendanhmuc"]);
                    $brand_icon = "bi-phone";
                    $brand_label = $d["tendanhmuc"];
                    if(strpos($brand_lower, 'apple') !== false) {
                        $brand_icon = "bi-apple";
                        $brand_label = "Apple iPhone";
                    } elseif(strpos($brand_lower, 'samsung') !== false) {
                        $brand_icon = "bi-phone";
                        $brand_label = "Samsung Galaxy";
                    } elseif(strpos($brand_lower, 'oppo') !== false) {
                        $brand_icon = "bi-phone-fill";
                        $brand_label = "OPPO Flagship";
                    } elseif(strpos($brand_lower, 'xiaomi') !== false) {
                        $brand_icon = "bi-phone-vibrate";
                        $brand_label = "Xiaomi Redmi";
                    }
                ?>
                <a href="index.php?action=group&id=<?php echo $d["id"]; ?>" class="hero-category-item text-decoration-none">
                    <span class="d-flex align-items-center">
                        <i class="bi <?php echo $brand_icon; ?> me-2 text-danger fs-6"></i>
                        <span><?php echo $brand_label; ?></span>
                    </span>
                    <i class="bi bi-chevron-right chevron-icon"></i>
                </a>
                <?php endforeach; ?>
                <a href="#danh-sach-san-pham" class="hero-category-item text-decoration-none text-muted">
                    <span class="d-flex align-items-center">
                        <i class="bi bi-stars me-2 text-warning fs-6"></i>
                        <span>Tất cả sản phẩm Hot</span>
                    </span>
                    <i class="bi bi-arrow-down-short chevron-icon fs-5"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Cột phải: Hero Carousel lớn (col-lg-9, dùng h4, h5, h6, h7) -->
    <div class="col-lg-9 col-12">
        <div id="heroBannerCarousel" class="carousel slide hero-carousel h-100 shadow-sm" data-bs-ride="carousel" data-bs-interval="4000">
            <!-- Carousel Indicators -->
            <div class="carousel-indicators mb-2">
                <?php foreach($ds_hero_banner as $k => $b): ?>
                    <button type="button" data-bs-target="#heroBannerCarousel" data-bs-slide-to="<?php echo $k; ?>" class="<?php echo $k === 0 ? 'active' : ''; ?>" <?php echo $k === 0 ? 'aria-current="true"' : ''; ?> aria-label="Slide <?php echo $k + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            
            <!-- Slides -->
            <div class="carousel-inner h-100">
                <?php foreach($ds_hero_banner as $k => $b): ?>
                <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> h-100">
                    <a href="#danh-sach-san-pham">
                        <img src="../images/carousel/<?php echo htmlspecialchars($b['duongdan']); ?>" class="d-block w-100 h-100" alt="<?php echo htmlspecialchars($b['tieude']); ?>" onerror="this.src='../images/carousel/h4.jpg'">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Trước</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sau</span>
            </button>
        </div>
    </div>
</div>

<!-- Dải 4 thẻ Cam kết dịch vụ ngay dưới Hero Banner -->
<div class="row g-3 mb-5">
    <div class="col-6 col-md-3">
        <div class="commitment-card">
            <div class="commitment-icon-wrap">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="commitment-text">
                <div class="commit-title">Chính hãng 100%</div>
                <div class="commit-desc">Bảo hành 12 tháng chính hãng</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="commitment-card">
            <div class="commitment-icon-wrap">
                <i class="bi bi-truck"></i>
            </div>
            <div class="commitment-text">
                <div class="commit-title">Giao nhanh 2H</div>
                <div class="commit-desc">Miễn phí giao hàng toàn quốc</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="commitment-card">
            <div class="commitment-icon-wrap">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div class="commitment-text">
                <div class="commit-title">Đổi trả 30 ngày</div>
                <div class="commit-desc">Lỗi 1 đổi 1 nhanh chóng</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="commitment-card">
            <div class="commitment-icon-wrap">
                <i class="bi bi-credit-card-2-front"></i>
            </div>
            <div class="commitment-text">
                <div class="commit-title">Trả góp 0%</div>
                <div class="commit-desc">Thủ tục đơn giản qua thẻ</div>
            </div>
        </div>
    </div>
</div>

<!-- Danh sách sản phẩm theo danh mục (CellphoneS Product Grid) -->
<div id="danh-sach-san-pham" style="scroll-margin-top: 80px;">
<?php 
foreach($danhmuc as $d){ 
    $i = 0;
?>
    <div class="mb-5">
        <!-- Header danh mục -->
        <div class="section-brand-header">
            <div class="section-brand-title">
                <span class="brand-accent"></span>
                <span><?php echo $d["tendanhmuc"]; ?></span>
            </div>
            <a href="index.php?action=group&id=<?php echo $d["id"]; ?>" class="btn-view-all-brand text-decoration-none">
                Xem tất cả <?php echo $d["tendanhmuc"]; ?> <i class="bi bi-chevron-right ms-1"></i>
            </a>
        </div>

        <!-- Lưới sản phẩm 4 cột chuẩn -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3">
        <?php 
            foreach($mathang as $m){ 
                if($m["danhmuc_id"] == $d["id"] && $i < 4){
                    $i++;
                    // Tính phần trăm giảm giá tự động
                    $giamgia = 0;
                    if($m["giagoc"] > $m["giaban"] && $m["giagoc"] > 0){
                        $giamgia = round((($m["giagoc"] - $m["giaban"]) / $m["giagoc"]) * 100);
                    }
        ?>
            <div class="col">
                <div class="product-card">
                    <!-- Tem giảm giá góc trên bên trái -->
                    <?php if($giamgia > 0): ?>
                        <div class="product-card-badge">Giảm <?php echo $giamgia; ?>%</div>
                    <?php elseif($m["giaban"] != $m["giagoc"]): ?>
                        <div class="product-card-badge">Ưu đãi</div>
                    <?php else: ?>
                        <div class="product-card-badge" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">Hot</div>
                    <?php endif; ?>

                    <!-- Khung ảnh sản phẩm -->
                    <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-img-wrap text-decoration-none">
                        <img class="product-img" src="../<?php echo $m["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($m["tenmathang"]); ?>" loading="lazy" />
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
                            <span class="text-truncate">Tặng gói bảo hành rơi vỡ & giao nhanh miễn phí</span>
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
                }
            } 
        ?>
        </div>

        <?php if($i == 0): ?>
            <div class="alert alert-light border text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Danh mục hiện chưa có sản phẩm.
            </div>
        <?php endif; ?>
    </div>
<?php
} 
?>
</div>

<?php
include("inc/bottom.php");
?>
