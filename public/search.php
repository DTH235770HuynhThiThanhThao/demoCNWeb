<?php include("inc/top.php"); ?>

<style>
.search-result-title {
    font-size: 1.1rem;
    color: #0dcaf0;
    border-left: 4px solid #0dcaf0;
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
                &nbsp;<span class="badge bg-info text-dark"><?php echo count($mathang); ?> sản phẩm</span>
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
        <a href="index.php" class="btn btn-info text-white mt-2"><i class="bi bi-house-fill me-1"></i> Về trang chủ</a>
    </div>
<?php elseif(empty($mathang)): ?>
    <div class="search-no-result">
        <i class="bi bi-emoji-frown"></i>
        <h5>Không tìm thấy sản phẩm nào</h5>
        <p>Không có sản phẩm nào khớp với từ khóa <strong>"<?php echo $tukhoa_hien; ?>"</strong>.</p>
        <p class="text-muted small">Thử tìm với từ khóa khác hoặc duyệt qua danh mục sản phẩm.</p>
        <a href="index.php" class="btn btn-info text-white mt-2"><i class="bi bi-grid-fill me-1"></i> Xem tất cả sản phẩm</a>
    </div>
<?php else: ?>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach($mathang as $m): ?>
        <div class="col mb-5">
            <div class="card h-100 shadow">
                <?php if ($m["giaban"] != $m["giagoc"]): ?>
                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                <?php endif; ?>
                <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>">
                    <img class="card-img-top" src="../<?php echo $m["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($m["tenmathang"]); ?>" />
                </a>
                <div class="card-body p-4">
                    <div class="text-center">
                        <a class="text-decoration-none" href="index.php?action=detail&id=<?php echo $m["id"]; ?>">
                            <h5 class="fw-bolder text-info"><?php echo htmlspecialchars($m["tenmathang"]); ?></h5>
                        </a>
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <?php if ($m["giaban"] != $m["giagoc"]): ?>
                        <span class="text-muted text-decoration-line-through"><?php echo number_format($m["giagoc"]); ?>đ</span>
                        <?php endif; ?>
                        <span class="text-danger fw-bolder"><?php echo number_format($m["giaban"]); ?>đ</span>
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a class="btn btn-outline-info mt-auto" href="index.php?action=chovaogio&id=<?php echo $m["id"]; ?>">Chọn mua</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include("inc/bottom.php"); ?>
