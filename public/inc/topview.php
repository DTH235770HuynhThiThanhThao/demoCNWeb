<style>
  .topview-tabs .nav-link {
    font-weight: 700 !important;
    border-bottom: 2px solid transparent;
    transition: all 0.2s ease-in-out;
  }
  .topview-tabs .tab-noibat:not(.active) {
    color: #d97706 !important;
  }
  .topview-tabs .tab-xemnhieu:not(.active) {
    color: #0284c7 !important;
  }
  .topview-tabs .tab-banchay:not(.active) {
    color: #dc2626 !important;
  }
  .topview-tabs .tab-moi:not(.active) {
    color: #16a34a !important;
  }
  .topview-tabs .nav-link.active {
    color: #000000 !important;
    font-weight: 700 !important;
    border-color: #dee2e6 #dee2e6 #fff !important;
    border-top: 3px solid #000000 !important;
    background-color: #ffffff !important;
  }
  .topview-tabs .nav-link:hover:not(.active) {
    background-color: #f8f9fa;
  }
</style>

<!-- Nav tabs -->
<ul class="nav nav-tabs topview-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active fw-bold tab-noibat" data-bs-toggle="tab" href="#tab-noibat">Nổi bật</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bold tab-xemnhieu" data-bs-toggle="tab" href="#tab-xemnhieu">Xem nhiều</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bold tab-banchay" data-bs-toggle="tab" href="#tab-banchay">Bán chạy</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bold tab-moi" data-bs-toggle="tab" href="#tab-moi">Sản phẩm mới</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content pt-1">
  <!-- Tab 1: Nổi bật -->
  <div id="tab-noibat" class="tab-pane active fade show">
    <?php if(!empty($mathangnoibat)): foreach($mathangnoibat as $x): ?>
      <div class="py-2 border-bottom">
        <a class="text-decoration-none d-flex align-items-center text-dark" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
          <img class="img-thumbnail me-3 rounded flex-shrink-0" style="width: 55px; height: 55px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo $x["tenmathang"]; ?>">
          <div class="flex-grow-1 text-truncate">
            <h6 class="card-title text-navy mb-1 fw-bold text-truncate" title="<?php echo $x["tenmathang"]; ?>"><?php echo $x["tenmathang"]; ?></h6>
            <div class="d-flex align-items-center justify-content-between">
              <span class="card-text text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
              <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Nổi bật</span>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; endif; ?>
  </div>

  <!-- Tab 2: Xem nhiều -->
  <div id="tab-xemnhieu" class="tab-pane fade">
    <?php if(!empty($mathangxemnhieu)): foreach($mathangxemnhieu as $x): ?>
      <div class="py-2 border-bottom">
        <a class="text-decoration-none d-flex align-items-center text-dark" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
          <img class="img-thumbnail me-3 rounded flex-shrink-0" style="width: 55px; height: 55px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo $x["tenmathang"]; ?>">
          <div class="flex-grow-1 text-truncate">
            <h6 class="card-title text-navy mb-1 fw-bold text-truncate" title="<?php echo $x["tenmathang"]; ?>"><?php echo $x["tenmathang"]; ?></h6>
            <div class="d-flex align-items-center justify-content-between">
              <span class="card-text text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
              <small class="text-muted"><i class="bi bi-eye"></i> <?php echo $x["luotxem"]; ?> lượt xem</small>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; endif; ?>
  </div>

  <!-- Tab 3: Bán chạy -->
  <div id="tab-banchay" class="tab-pane fade">
    <?php if(!empty($mathangbanchay)): foreach($mathangbanchay as $x): ?>
      <div class="py-2 border-bottom">
        <a class="text-decoration-none d-flex align-items-center text-dark" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
          <img class="img-thumbnail me-3 rounded flex-shrink-0" style="width: 55px; height: 55px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo $x["tenmathang"]; ?>">
          <div class="flex-grow-1 text-truncate">
            <h6 class="card-title text-navy mb-1 fw-bold text-truncate" title="<?php echo $x["tenmathang"]; ?>"><?php echo $x["tenmathang"]; ?></h6>
            <div class="d-flex align-items-center justify-content-between">
              <span class="card-text text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
              <small class="text-success fw-semibold"><i class="bi bi-bag-check-fill"></i> Đã bán <?php echo $x["luotmua"]; ?></small>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; endif; ?>
  </div>

  <!-- Tab 4: Sản phẩm mới -->
  <div id="tab-moi" class="tab-pane fade">
    <?php if(!empty($mathangmoi)): foreach($mathangmoi as $x): ?>
      <div class="py-2 border-bottom">
        <a class="text-decoration-none d-flex align-items-center text-dark" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
          <img class="img-thumbnail me-3 rounded flex-shrink-0" style="width: 55px; height: 55px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo $x["tenmathang"]; ?>">
          <div class="flex-grow-1 text-truncate">
            <h6 class="card-title text-navy mb-1 fw-bold text-truncate" title="<?php echo $x["tenmathang"]; ?>"><?php echo $x["tenmathang"]; ?></h6>
            <div class="d-flex align-items-center justify-content-between">
              <span class="card-text text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
              <span class="badge bg-danger">Mới</span>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
