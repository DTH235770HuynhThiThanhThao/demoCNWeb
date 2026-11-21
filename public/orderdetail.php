<?php include("inc/top.php"); ?>

<div class="row my-4">
  <div class="col-12 col-md-11 col-lg-10 m-auto">
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h4 class="text-navy fw-bold mb-0">
          <i class="bi bi-receipt-cutoff me-2"></i>CHI TIẾT ĐƠN HÀNG #<?= sprintf("DH%06d", $donhang["id"]) ?>
        </h4>
        <div>
          <?php 
          $tt = (int)($donhang["trangthai"] ?? 0);
          if($tt === 0){
            echo '<span class="badge bg-warning text-dark fs-6 px-3 py-2"><i class="bi bi-clock me-1"></i>Chờ xác nhận</span>';
          } elseif($tt === 1){
            echo '<span class="badge bg-primary fs-6 px-3 py-2"><i class="bi bi-check-circle me-1"></i>Đã duyệt</span>';
          } elseif($tt === 2){
            echo '<span class="badge bg-info text-dark fs-6 px-3 py-2"><i class="bi bi-truck me-1"></i>Đang giao</span>';
          } elseif($tt === 3){
            echo '<span class="badge bg-success fs-6 px-3 py-2"><i class="bi bi-check2-all me-1"></i>Hoàn thành</span>';
          } elseif($tt === 4){
            echo '<span class="badge bg-danger fs-6 px-3 py-2"><i class="bi bi-x-circle me-1"></i>Đã hủy</span>';
          }
          ?>
        </div>
      </div>
      <div class="card-body p-4">

        <!-- Thông tin chung của đơn hàng -->
        <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
          <div class="col-12 col-md-6">
            <p class="mb-2"><strong>Mã đơn hàng:</strong> <span class="text-primary fw-bold"><?= sprintf("DH%06d", $donhang["id"]) ?></span></p>
            <p class="mb-2"><strong>Ngày đặt hàng:</strong> <?= date("d/m/Y H:i:s", strtotime($donhang["ngay"])) ?></p>
            <p class="mb-0"><strong>Người nhận:</strong> <?= htmlspecialchars($_SESSION["khachhang"]["hoten"]) ?> (<?= htmlspecialchars($_SESSION["khachhang"]["sodienthoai"]) ?>)</p>
          </div>
          <div class="col-12 col-md-6">
            <p class="mb-2"><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars(!empty($donhang["diachi"]) ? $donhang["diachi"] : "Địa chỉ mặc định của khách hàng") ?></p>
            <p class="mb-2"><strong>Trạng thái:</strong> 
              <?php 
              if($tt === 0) echo '<strong class="text-warning">Chờ xác nhận</strong>';
              elseif($tt === 1) echo '<strong class="text-primary">Đã duyệt</strong>';
              elseif($tt === 2) echo '<strong class="text-info">Đang giao</strong>';
              elseif($tt === 3) echo '<strong class="text-success">Hoàn thành</strong>';
              elseif($tt === 4) echo '<strong class="text-danger">Đã hủy</strong>';
              ?>
            </p>
            <p class="mb-0"><strong>Tổng tiền thanh toán:</strong> <span class="text-danger fw-bold fs-5"><?= number_format($donhang["tongtien"]) ?>đ</span></p>
          </div>
        </div>

        <h5 class="text-navy fw-bold mb-3">
          <i class="bi bi-box-seam me-2"></i>Danh sách sản phẩm
        </h5>

        <!-- Bảng chi tiết sản phẩm trong đơn hàng -->
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
              <tr class="text-center">
                <th style="width: 60px;">STT</th>
                <th style="width: 80px;">Hình ảnh</th>
                <th class="text-start">Tên sản phẩm</th>
                <th class="text-end" style="width: 140px;">Đơn giá</th>
                <th class="text-center" style="width: 100px;">Số lượng</th>
                <th class="text-end" style="width: 150px;">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $stt = 1;
              if(!empty($chitiet_donhang)):
                foreach($chitiet_donhang as $ct): 
              ?>
              <tr>
                <td class="text-center fw-semibold text-secondary"><?= $stt++ ?></td>
                <td class="text-center">
                  <img class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: contain;" src="../<?= $ct["hinhanh"] ?>" alt="<?= htmlspecialchars($ct["tenmathang"]) ?>">
                </td>
                <td>
                  <a class="text-dark fw-bold text-decoration-none" href="index.php?action=detail&id=<?= $ct["mhid"] ?>">
                    <?= htmlspecialchars($ct["tenmathang"]) ?>
                  </a>
                </td>
                <td class="text-end"><?= number_format($ct["dongia"]) ?>đ</td>
                <td class="text-center fw-semibold"><?= $ct["soluong"] ?></td>
                <td class="text-end fw-bold text-navy"><?= number_format($ct["thanhtien"]) ?>đ</td>
              </tr>
              <?php 
                endforeach; 
              else: 
              ?>
              <tr>
                <td colspan="6" class="text-center text-muted py-4">Không tìm thấy chi tiết sản phẩm cho đơn hàng này.</td>
              </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="table-light">
                <td colspan="5" class="text-end fw-bold fs-6">Tổng tiền:</td>
                <td class="text-end text-danger fw-bold fs-5"><?= number_format($donhang["tongtien"]) ?>đ</td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- Nút thao tác ở góc dưới -->
        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
          <a href="index.php?action=lichsumuahang" class="btn btn-navy px-4">
            <i class="bi bi-arrow-left me-1"></i> Quay lại lịch sử mua hàng
          </a>
          <?php if($tt === 0): ?>
          <a href="index.php?action=huydonhang&id=<?= $donhang["id"] ?>" class="btn btn-danger px-4" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
            <i class="bi bi-x-circle me-1"></i> Hủy đơn
          </a>
          <?php endif; ?>
        </div>

      </div>
    </div>

  </div>
</div>

<?php include("inc/bottom.php"); ?>
