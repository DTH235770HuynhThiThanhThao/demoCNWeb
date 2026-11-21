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
        <?php if(isset($tb_thanhcong) && !empty($tb_thanhcong)): ?>
          <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo $tb_thanhcong; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

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
                  <th class="text-center" style="width: 50px;">STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Ngày đặt</th>
                  <th class="text-end">Tổng tiền</th>
                  <th class="text-center" style="width: 140px;">Trạng thái</th>
                  <th class="text-center" style="width: 140px; white-space: nowrap;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $stt = 1;
                foreach($danhsach_donhang as $dh): 
                  $ma_donhang = sprintf("DH%06d", $dh["id"]);
                  $tt = (int)($dh["trangthai"] ?? 0);
                ?>
                <tr>
                  <td class="text-center fw-semibold text-secondary"><?= $stt++ ?></td>
                  <td>
                    <a class="text-navy fw-bold text-decoration-none" href="index.php?action=chitietdonhang&id=<?= $dh["id"] ?>">
                      <i class="bi bi-receipt me-1"></i><?= $ma_donhang ?>
                    </a>
                  </td>
                  <td>
                    <i class="bi bi-calendar3 me-1 text-muted"></i><?= date("d/m/Y H:i", strtotime($dh["ngay"])) ?>
                  </td>
                  <td class="text-end">
                    <span class="text-danger fw-bold fs-6"><?= number_format($dh["tongtien"]) ?>đ</span>
                  </td>
                  <td class="text-center">
                    <?php 
                    if($tt === 0){
                      echo '<span class="badge bg-warning text-dark px-2 py-1"><i class="bi bi-clock me-1"></i>Chờ xác nhận</span>';
                    } elseif($tt === 1){
                      echo '<span class="badge bg-primary px-2 py-1"><i class="bi bi-check-circle me-1"></i>Đã duyệt</span>';
                    } elseif($tt === 2){
                      echo '<span class="badge bg-info text-dark px-2 py-1"><i class="bi bi-truck me-1"></i>Đang giao</span>';
                    } elseif($tt === 3){
                      echo '<span class="badge bg-success px-2 py-1"><i class="bi bi-check2-all me-1"></i>Hoàn thành</span>';
                    } elseif($tt === 4){
                      echo '<span class="badge bg-danger px-2 py-1"><i class="bi bi-x-circle me-1"></i>Đã hủy</span>';
                    }
                    ?>
                  </td>
                  <td class="text-center" style="white-space: nowrap;">
                    <div class="d-flex justify-content-center align-items-center gap-2 flex-nowrap">
                      <a href="index.php?action=chitietdonhang&id=<?= $dh["id"] ?>" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                        <i class="bi bi-eye"></i>
                      </a>
                      <?php if($tt === 0): ?>
                      <a href="index.php?action=huydonhang&id=<?= $dh["id"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" title="Hủy đơn">
                        <i class="bi bi-x-circle me-1"></i>Hủy đơn
                      </a>
                      <?php endif; ?>
                    </div>
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
