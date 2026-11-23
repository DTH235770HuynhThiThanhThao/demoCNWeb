<?php 
include("inc/top.php"); 
$id = isset($id) ? $id : (isset($madm) ? $madm : ($_GET['id'] ?? 0));
$sort = isset($sort) ? $sort : ($_GET['sort'] ?? 'default');
?>

<!-- Breadcrumb navigation -->
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm" style="--bs-breadcrumb-divider: '›'; border-radius:10px;">
    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Trang chủ</a></li>
    <li class="breadcrumb-item active fw-semibold" style="color:#d70018;" aria-current="page">Điện thoại <?php echo htmlspecialchars($tendm); ?></li>
  </ol>
</nav>

<!-- Header Banner danh mục -->
<div class="card mb-4 border-0 shadow-sm" style="border-radius:14px; background:#fff;">
  <div class="card-body p-4">
    <div class="row align-items-center g-3">
      <!-- Cột trái: Tiêu đề danh mục + Badge số lượng mẫu -->
      <div class="col-lg-5 col-12">
        <div class="d-flex align-items-center">
          <div style="width: 4px; height: 32px; background-color: #d70018; border-radius: 4px; margin-right: 12px; flex-shrink: 0;"></div>
          <h2 class="text-dark fw-bold mb-0 fs-4">
            ĐIỆN THOẠI <span style="color: #d70018;"><?php echo strtoupper($tendm); ?></span>
            <span class="badge bg-secondary text-white ms-2 fs-6 fw-normal"><?php echo count($mathang); ?> mẫu</span>
          </h2>
        </div>
      </div>

      <!-- Cột phải: Dãy nút chọn nhanh hãng & Ô sắp xếp tách biệt thoáng mắt -->
      <div class="col-lg-7 col-12">
        <div class="d-flex flex-column align-items-lg-end align-items-start gap-3">
          <!-- Hàng 1: Dãy nút chọn nhanh hãng (giữ trên 1 hàng ngang flex-nowrap) -->
          <div class="d-flex flex-nowrap overflow-x-auto gap-2 pb-1 w-100 justify-content-lg-end align-items-center" style="scrollbar-width: thin;">
            <a href="index.php?action=group&id=0" 
               class="btn btn-sm rounded-pill px-3 py-1 fw-semibold text-nowrap" 
               style="<?php echo ($id == 0 ? 'background:#d70018; border-color:#d70018; color:#fff;' : 'background:#fff; border:1px solid #e5e7eb; color:#4b5563;'); ?>">
               Tất cả
            </a>
            <?php if(isset($danhmuc) && is_array($danhmuc)): ?>
              <?php foreach($danhmuc as $dmItem): ?>
                <a href="index.php?action=group&id=<?php echo $dmItem['id']; ?>" 
                   class="btn btn-sm rounded-pill px-3 py-1 fw-semibold text-nowrap" 
                   style="<?php echo ($id == $dmItem['id'] ? 'background:#d70018; border-color:#d70018; color:#fff;' : 'background:#fff; border:1px solid #e5e7eb; color:#4b5563;'); ?>">
                   <?php echo htmlspecialchars($dmItem['tendanhmuc']); ?>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Hàng 2: Bộ lọc sắp xếp giá & lượt xem (tách khoảng cách dọc rõ ràng với mt/gap) -->
          <div class="d-flex align-items-center">
            <label for="sortSelect" class="me-2 text-muted small fw-semibold text-nowrap">
              <i class="bi bi-sort-down me-1 text-danger"></i>Sắp xếp theo:
            </label>
            <select class="form-select form-select-sm w-auto rounded-3 shadow-none border-secondary-subtle" 
                    id="sortSelect" 
                    onchange="window.location.href='index.php?action=group&id=<?php echo $id; ?>&sort=' + this.value">
              <option value="default" <?php echo ($sort == 'default') ? 'selected' : ''; ?>>Mặc định</option>
              <option value="price_asc" <?php echo ($sort == 'price_asc') ? 'selected' : ''; ?>>Giá thấp → cao</option>
              <option value="price_desc" <?php echo ($sort == 'price_desc') ? 'selected' : ''; ?>>Giá cao → thấp</option>
              <option value="view_desc" <?php echo ($sort == 'view_desc' || $sort == 'most_viewed') ? 'selected' : ''; ?>>Xem nhiều nhất</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Lưới sản phẩm chuẩn 4 cột CellphoneS -->
<div class="row row-cols-2 row-cols-md-4 g-3">
<?php
if(!empty($mathang)){
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
                <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>" class="product-name text-decoration-none" title="<?php echo htmlspecialchars($m["tenmathang"]); ?>">
                    <?php echo htmlspecialchars($m["tenmathang"]); ?>
                </a>
                <div class="product-price-row">
                    <span class="product-price-current"><?php echo number_format($m["giaban"]); ?>đ</span>
                    <?php if($m["giaban"] != $m["giagoc"] && $m["giagoc"] > 0): ?>
                        <span class="product-price-original"><?php echo number_format($m["giagoc"]); ?>đ</span>
                    <?php endif; ?>
                </div>
                <div class="product-promo-box">
                    <i class="bi bi-gift-fill"></i>
                    <span class="text-truncate">Trả góp 0% • Bảo hành 12 tháng</span>
                </div>
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
<?php endforeach; ?>
<?php } else { ?>
    <div class="col-12 my-4">
        <div class="card border-0 shadow-sm text-center py-5 px-3" style="border-radius:14px; background:#fff;">
            <div class="mb-3">
                <i class="bi bi-phone text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Hiện chưa có mẫu điện thoại nào thuộc hãng này</h5>
            <p class="text-muted small mb-4">Vui lòng xem danh mục khác hoặc quay lại trang chủ để khám phá các sản phẩm hot.</p>
            <div>
                <a href="index.php" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold" style="background:#d70018; border-color:#d70018;">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
<?php } ?>
</div>

<?php include("inc/bottom.php"); ?>
