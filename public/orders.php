<?php include("inc/top.php"); ?>

<div class="row my-4">
  <div class="col-12 col-md-11 col-lg-10 m-auto">
    <div class="card shadow-sm">
      <div class="card-header bg-white py-3 border-bottom">          
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <h4 class="text-navy fw-bold mb-0">
            <i class="bi bi-clock-history me-2"></i>LỊCH SỬ MUA HÀNG
          </h4>
          <span class="badge bg-navy text-white px-3 py-2 rounded-pill">
            Tổng cộng: <?= !empty($danhsach_donhang) ? count($danhsach_donhang) : 0 ?> đơn hàng
          </span>
        </div>
      </div>
      <div class="card-body p-4">
        <?php if(isset($thongbao) && !empty($thongbao)): ?>
          <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $thongbao; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if(empty($danhsach_donhang)): ?>
          <div class="text-center py-5">
            <div class="mb-3 text-secondary" style="font-size: 4rem;">
              <i class="bi bi-bag-x"></i>
            </div>
            <h5 class="text-secondary fw-bold">Bạn chưa có đơn hàng nào!</h5>
            <p class="text-muted">Hãy dạo quanh cửa hàng và chọn những chiếc điện thoại ưng ý nhé.</p>
            <a href="index.php" class="btn btn-navy px-4 py-2 mt-2">
              <i class="bi bi-cart-plus me-1"></i> Mua sắm ngay
            </a>
          </div>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="text-center" style="width: 60px;">STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Ngày đặt</th>
                  <th class="text-end">Tổng tiền</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $stt = 1;
                foreach($danhsach_donhang as $dh): 
                  $ma_donhang = sprintf("DH%06d", $dh["id"]);
                ?>
                <tr>
                  <td class="text-center fw-semibold text-secondary"><?= $stt++ ?></td>
                  <td>
                    <a class="text-navy fw-bold text-decoration-none" href="index.php?action=chitietdonhang&id=<?= $dh["id"] ?>">
                      <i class="bi bi-receipt me-1"></i><?= $ma_donhang ?>
                    </a>
                  </td>
                  <td>
                    <i class="bi bi-calendar3 me-1 text-muted"></i><?= date("d/m/Y H:i:s", strtotime($dh["ngay"])) ?>
                  </td>
                  <td class="text-end">
                    <span class="text-danger fw-bold fs-6"><?= number_format($dh["tongtien"]) ?>đ</span>
                  </td>
                  <td class="text-center">
                    <a href="index.php?action=chitietdonhang&id=<?= $dh["id"] ?>" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye me-1"></i>Xem chi tiết
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php include("inc/bottom.php"); ?>
