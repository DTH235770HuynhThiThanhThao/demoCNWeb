<?php include("inc/top.php"); ?>

<style>
.search-result-box {
    background-color: #ffffff;
    border: 1px solid #eef2f6;
    border-radius: 14px;
    border-left: 4px solid #d70018;
    padding: 14px 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.search-result-title {
    font-size: 1.1rem;
    color: #1e293b;
    margin-bottom: 0;
}
.search-count-badge {
    background-color: #fff1f2;
    color: #d70018;
    font-weight: 700;
    border: 1px solid #fecdd3;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
}
.search-no-result-card {
    background: #ffffff;
    border: 1px solid #e9ecef;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    text-align: center;
    padding: 60px 24px;
    margin: 20px 0 40px 0;
}
.search-no-result-card .icon-wrap {
    width: 80px;
    height: 80px;
    background-color: #fff1f2;
    color: #d70018;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2.4rem;
    margin-bottom: 20px;
}
</style>

<?php
$tukhoa_hien = htmlspecialchars(trim($_REQUEST["q"] ?? ""));
$so_luong = is_array($mathang) ? count($mathang) : 0;
?>

<div class="mb-4">
    <div class="search-result-box d-flex flex-wrap align-items-center justify-content-between gap-2">
        <p class="search-result-title fw-semibold">
            <?php if($tukhoa_hien !== ""): ?>
                Kết quả tìm kiếm cho: <span class="text-dark fw-bold">"<?php echo $tukhoa_hien; ?>"</span>
            <?php else: ?>
                Vui lòng nhập từ khóa để tìm kiếm
            <?php endif; ?>
        </p>
        <?php if($tukhoa_hien !== "" && $so_luong > 0): ?>
            <span class="search-count-badge">
                <i class="bi bi-check2-circle me-1"></i>Tìm thấy <?php echo $so_luong; ?> sản phẩm
            </span>
        <?php endif; ?>
    </div>
</div>

<?php if($tukhoa_hien === ""): ?>
    <div class="search-no-result-card">
        <div class="icon-wrap">
            <i class="bi bi-search"></i>
        </div>
        <h4 class="fw-bold text-dark mb-2">Nhập từ khóa vào ô tìm kiếm</h4>
        <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto;">
            Bạn có thể tìm kiếm theo tên máy, hãng sản xuất (Apple, Samsung, OPPO, Xiaomi) hoặc model điện thoại mong muốn.
        </p>
        <a href="index.php" class="btn text-white px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" 
           style="background-color: #d70018; border-radius: 10px;">
            <i class="bi bi-house-door-fill"></i>
            <span>Quay về trang chủ</span>
        </a>
    </div>
<?php elseif(empty($mathang)): ?>
    <div class="search-no-result-card">
        <div class="icon-wrap">
            <i class="bi bi-search-heart"></i>
        </div>
        <h4 class="fw-bold text-dark mb-2">Không tìm thấy sản phẩm nào!</h4>
        <p class="text-muted mb-2">
            Rất tiếc, không có sản phẩm nào khớp với từ khóa <strong class="text-dark">"<?php echo $tukhoa_hien; ?>"</strong>.
        </p>
        <p class="text-muted small mb-4">
            Quý khách vui lòng kiểm tra lại chính tả, thử từ khóa ngắn hơn hoặc quay về trang chủ để khám phá các dòng điện thoại mới nhất.
        </p>
        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
            <a href="index.php" class="btn text-white px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" 
               style="background-color: #d70018; border-radius: 10px;">
                <i class="bi bi-house-door-fill"></i>
                <span>Quay về trang chủ</span>
            </a>
            <a href="index.php?action=group&id=0" class="btn btn-outline-secondary px-4 py-2 fw-semibold" 
               style="border-radius: 10px;">
                <i class="bi bi-grid-fill me-1"></i>
                <span>Xem tất cả sản phẩm</span>
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="row row-cols-2 row-cols-md-4 g-3">
    <?php
    foreach($mathang as $m):
        $giamgia = 0;
        if($m["giagoc"] > $m["giaban"] && $m["giagoc"] > 0){
            $giamgia = round((($m["giagoc"] - $m["giaban"]) / $m["giagoc"]) * 100);
        }
    ?>
        <div class="col">
            <div class="product-card">
                <?php if($giamgia > 0): ?>
                    <div class="product-card-badge">Giảm <?php echo $giamgia; ?>%</div>
                <?php elseif($m["giaban"] != $m["giagoc"]): ?>
                    <div class="product-card-badge">Ưu đãi</div>
                <?php else: ?>
                    <div class="product-card-badge" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">Hot</div>
                <?php endif; ?>
                <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-img-wrap text-decoration-none">
                    <img class="product-img" src="../<?php echo $m["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($m["tenmathang"]); ?>" loading="lazy" />
                </a>
                <div class="product-card-body">
                    <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-name text-decoration-none" title="<?php echo htmlspecialchars($m["tenmathang"]); ?>"><?php echo $m["tenmathang"]; ?></a>
                    <div class="product-price-row">
                        <span class="product-price-current"><?php echo number_format($m["giaban"]); ?>đ</span>
                        <?php if($m["giaban"] != $m["giagoc"] && $m["giagoc"] > 0): ?>
                            <span class="product-price-original"><?php echo number_format($m["giagoc"]); ?>đ</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-promo-box"><i class="bi bi-gift-fill"></i><span class="text-truncate">VietQR / COD • Bảo hành 12 tháng</span></div>
                    <div class="product-card-footer">
                        <div class="product-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <a class="btn btn-buy-tech text-decoration-none" href="index.php?action=chovaogio&id=<?php echo $m["id"]; ?>"><i class="bi bi-cart-plus me-1"></i>Chọn mua</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include("inc/bottom.php"); ?>
