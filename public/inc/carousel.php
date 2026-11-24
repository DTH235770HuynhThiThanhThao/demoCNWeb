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

    <!-- Danh sách slide -->
    <div class="carousel-inner h-100">
        <?php foreach($ds_promo_banner as $k => $b): ?>
        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> h-100">
            <a href="#danh-sach-san-pham"
               class="d-block scroll-to-products"
               style="cursor: pointer;"
               title="Xem danh sách điện thoại chính hãng">
                <img src="../images/carousel/<?php echo htmlspecialchars($b['duongdan']); ?>"
                     alt="<?php echo htmlspecialchars($b['tieude']); ?>"
                     class="d-block w-100 h-100 promo-carousel-img"
                     style="height: 100%; min-height: 310px; object-fit: fill; object-position: center center; background-color: #1a1025;"
                     onerror="this.src='../images/carousel/h1.jpg'">
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Nút điều hướng trái / phải -->
    <button class="carousel-control-prev" type="button" data-bs-target="#promoCarouselBottom" data-bs-slide="prev" aria-label="Trước">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#promoCarouselBottom" data-bs-slide="next" aria-label="Sau">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<script>
// Cuộn mượt lên khu vực danh sách sản phẩm khi click vào banner phụ
(function () {
    function bindSmoothScroll() {
        document.querySelectorAll('a.scroll-to-products').forEach(function (link) {
            // Tránh gắn listener trùng lặp
            if (link.dataset.smoothBound) return;
            link.dataset.smoothBound = '1';
            link.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.getElementById('danh-sach-san-pham');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
    // Chạy ngay sau khi DOM sẵn sàng
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindSmoothScroll);
    } else {
        bindSmoothScroll();
    }
})();
</script>


<script>
// Cuộn mượt lên khu vực danh sách sản phẩm khi click vào banner phụ
(function () {
    function bindSmoothScroll() {
        document.querySelectorAll('a.scroll-to-products').forEach(function (link) {
            // Tránh gắn listener trùng lặp
            if (link.dataset.smoothBound) return;
            link.dataset.smoothBound = '1';
            link.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.getElementById('danh-sach-san-pham');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
    // Chạy ngay sau khi DOM sẵn sàng
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindSmoothScroll);
    } else {
        bindSmoothScroll();
    }
})();
</script>