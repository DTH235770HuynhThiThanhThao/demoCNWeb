<?php include("inc/top.php"); ?>

<style>
.search-result-title {
    font-size: 1.1rem;
    color: #142B4A;
    border-left: 4px solid #142B4A;
    padding-left: 12px;
}
.search-no-result {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}
.search-no-result i {
    font-size: 3.5rem;
    color: #dee2e6;
    display: block;
    margin-bottom: 16px;
}
</style>

<?php
$tukhoa_hien = htmlspecialchars(trim($_REQUEST["q"] ?? ""));
?>

<div class="mb-4">
    <p class="search-result-title fw-semibold">
        <?php if($tukhoa_hien !== ""): ?>
            Kết quả tìm kiếm cho: <span class="text-dark">"<?php echo $tukhoa_hien; ?>"</span>
            <?php if(is_array($mathang) && count($mathang) > 0): ?>
                &nbsp;<span class="badge bg-navy text-dark"><?php echo count($mathang); ?> sản phẩm</span>
            <?php endif; ?>
        <?php else: ?>
            Vui lòng nhập từ khóa để tìm kiếm
        <?php endif; ?>
    </p>
</div>

<?php if($tukhoa_hien === ""): ?>
    <div class="search-no-result">
        <i class="bi bi-search"></i>
        <h5>Nhập từ khóa vào ô tìm kiếm trên thanh menu</h5>
        <p>Bạn có thể tìm theo tên sản phẩm, thương hiệu hoặc model điện thoại.</p>
        <a href="index.php" class="btn btn-navy text-white mt-2"><i class="bi bi-house-fill me-1"></i> Về trang chủ</a>
    </div>
<?php elseif(empty($mathang)): ?>
    <div class="search-no-result">
        <i class="bi bi-emoji-frown"></i>
        <h5>Không tìm thấy sản phẩm nào</h5>
        <p>Không có sản phẩm nào khớp với từ khóa <strong>"<?php echo $tukhoa_hien; ?>"</strong>.</p>
        <p class="text-muted small">Thử tìm với từ khóa khác hoặc duyệt qua danh mục sản phẩm.</p>
        <a href="index.php" class="btn btn-navy text-white mt-2"><i class="bi bi-grid-fill me-1"></i> Xem tất cả sản phẩm</a>
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
                    <div class="product-promo-box"><i class="bi bi-gift-fill"></i><span class="text-truncate">Trả góp 0% • Bảo hành 12 tháng</span></div>
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