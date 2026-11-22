<?php
// Lấy danh sách Banner khuyến mãi dưới từ CSDL
if(!class_exists("HINHANH")){
    require_once("../model/hinhanh.php");
}
$ha_promo = new HINHANH();
$ds_promo_banner = $ha_promo->layhinhanhhienthi("banner_phu");
if(empty($ds_promo_banner)){
    $ds_promo_banner = array(
        array("duongdan" => "h1.jpg", "tieude" => "Điện thoại chính hãng"),
        array("duongdan" => "h2.jpg", "tieude" => "Siêu ưu đãi công nghệ"),
        array("duongdan" => "h3.jpg", "tieude" => "Thảo Mobile Flagship")
    );
}
?>
<!-- Promo Carousel Dưới -->
<div id="promoCarouselBottom" class="carousel slide promo-carousel-card h-100" data-bs-ride="carousel" data-bs-interval="4500">
    <!-- Indicators/dots -->
    <div class="carousel-indicators mb-2">
        <?php foreach($ds_promo_banner as $k => $b): ?>
            <button type="button" data-bs-target="#promoCarouselBottom" data-bs-slide-to="<?php echo $k; ?>" class="<?php echo $k === 0 ? 'active' : ''; ?>" <?php echo $k === 0 ? 'aria-current="true"' : ''; ?> aria-label="Slide <?php echo $k + 1; ?>"></button>
        <?php endforeach; ?>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner h-100">
        <?php foreach($ds_promo_banner as $k => $b): ?>
        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> h-100">
            <img src="../images/carousel/<?php echo htmlspecialchars($b['duongdan']); ?>" alt="<?php echo htmlspecialchars($b['tieude']); ?>" class="d-block w-100" style="height: 100%; min-height: 380px; object-fit: cover; object-position: center;" onerror="this.src='../images/carousel/h1.jpg'">
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#promoCarouselBottom" data-bs-slide="prev" aria-label="Trước">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#promoCarouselBottom" data-bs-slide="next" aria-label="Sau">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>