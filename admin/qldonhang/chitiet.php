<?php include("../inc/top.php"); ?>

<div class="mb-3">
	<a href="index.php" class="btn btn-secondary btn-sm">
		<i class="align-middle" data-feather="arrow-left"></i> Quay lại danh sách đơn hàng
	</a>
</div>

<div class="card shadow-sm mb-4">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
		<h4 class="text-info fw-bold mb-0">
			<i class="align-middle" data-feather="file-text"></i> Chi tiết đơn hàng #<?= sprintf("DH%06d", $donhang["id"] ?? 0) ?>
		</h4>
		<div>
			<?php 
			$tt = (int)($donhang["trangthai"] ?? 0);
			if($tt === 0){
				echo '<span class="badge bg-warning text-dark fs-6 px-3 py-2"><i class="align-middle" data-feather="clock"></i> Chờ xác nhận</span>';
			} elseif($tt === 1){
				echo '<span class="badge bg-primary fs-6 px-3 py-2"><i class="align-middle" data-feather="check-circle"></i> Đã duyệt</span>';
			} elseif($tt === 2){
				echo '<span class="badge bg-info text-white fs-6 px-3 py-2"><i class="align-middle" data-feather="truck"></i> Đang giao</span>';
			} elseif($tt === 3){
				echo '<span class="badge bg-success fs-6 px-3 py-2"><i class="align-middle" data-feather="check-square"></i> Hoàn thành</span>';
			} elseif($tt === 4){
				echo '<span class="badge bg-danger fs-6 px-3 py-2"><i class="align-middle" data-feather="x-circle"></i> Đã hủy</span>';
			}
			?>
		</div>
	</div>
	<div class="card-body">
		<!-- Thông tin đơn hàng và khách hàng -->
		<div class="row g-3 mb-4 p-3 bg-light rounded border">
			<div class="col-md-6">
				<p class="mb-2"><strong>Mã đơn hàng:</strong> <span class="text-primary fw-bold"><?= sprintf("DH%06d", $donhang["id"] ?? 0) ?></span></p>
				<p class="mb-2"><strong>Ngày đặt:</strong> <?= isset($donhang["ngay"]) ? date("d/m/Y H:i:s", strtotime($donhang["ngay"])) : "" ?></p>
				<p class="mb-0"><strong>Khách hàng:</strong> <?= htmlspecialchars($donhang["hoten"] ?? "Chưa rõ") ?></p>
			</div>
			<div class="col-md-6">
				<p class="mb-2"><strong>Số điện thoại:</strong> <?= htmlspecialchars($donhang["sodienthoai"] ?? "Chưa rõ") ?></p>
				<p class="mb-2"><strong>Địa chỉ giao:</strong> <?= htmlspecialchars(!empty($donhang["diachi"]) ? $donhang["diachi"] : "Địa chỉ mặc định") ?></p>
				<p class="mb-0"><strong>Tổng tiền:</strong> <span class="text-danger fw-bold fs-5"><?= number_format($donhang["tongtien"] ?? 0) ?>đ</span></p>
			</div>
		</div>

		<h5 class="fw-bold mb-3 text-secondary">
			<i class="align-middle" data-feather="package"></i> Danh sách mặt hàng
		</h5>

		<div class="table-responsive">
			<table class="table table-bordered table-hover align-middle mb-0">
				<thead class="table-light">
					<tr class="text-center">
						<th style="width: 50px;">STT</th>
						<th style="width: 80px;">Hình ảnh</th>
						<th class="text-start">Tên sản phẩm</th>
						<th class="text-end" style="width: 150px;">Đơn giá</th>
						<th class="text-center" style="width: 90px;">Số lượng</th>
						<th class="text-end" style="width: 150px;">Thành tiền</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$stt = 1;
					if(!empty($chitiet)):
						foreach($chitiet as $ct):
					?>
					<tr>
						<td class="text-center text-secondary"><?= $stt++ ?></td>
						<td class="text-center">
							<img class="img-thumbnail rounded" style="width: 55px; height: 55px; object-fit: contain;" src="../../<?= $ct["hinhanh"] ?>" alt="<?= htmlspecialchars($ct["tenmathang"]) ?>">
						</td>
						<td><strong><?= htmlspecialchars($ct["tenmathang"]) ?></strong></td>
						<td class="text-end"><?= number_format($ct["dongia"]) ?>đ</td>
						<td class="text-center fw-semibold"><?= $ct["soluong"] ?></td>
						<td class="text-end fw-bold text-primary"><?= number_format($ct["thanhtien"]) ?>đ</td>
					</tr>
					<?php 
						endforeach;
					else:
					?>
					<tr>
						<td colspan="6" class="text-center text-muted py-3">Không có thông tin chi tiết sản phẩm.</td>
					</tr>
					<?php endif; ?>
				</tbody>
				<tfoot>
					<tr class="table-light">
						<td colspan="5" class="text-end fw-bold fs-6">Tổng cộng:</td>
						<td class="text-end text-danger fw-bold fs-5"><?= number_format($donhang["tongtien"] ?? 0) ?>đ</td>
					</tr>
				</tfoot>
			</table>
		</div>

		<!-- Nút xử lý trạng thái nhanh ngay trong trang chi tiết nếu cần -->
		<div class="mt-4 d-flex justify-content-between align-items-center">
			<a href="index.php" class="btn btn-secondary">
				<i class="align-middle" data-feather="arrow-left"></i> Quay lại danh sách đơn hàng
			</a>
			<div>
				<?php if($tt === 0): ?>
					<a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=1" class="btn btn-success me-2">
						<i class="align-middle" data-feather="check"></i> Duyệt đơn hàng
					</a>
					<a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=4" class="btn btn-danger" onclick="return confirm('Xác nhận hủy đơn hàng này?');">
						<i class="align-middle" data-feather="x"></i> Hủy đơn hàng
					</a>
				<?php elseif($tt === 1): ?>
					<a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=2" class="btn btn-info text-white me-2">
						<i class="align-middle" data-feather="truck"></i> Giao hàng
					</a>
					<a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=4" class="btn btn-danger" onclick="return confirm('Xác nhận hủy đơn hàng này?');">
						<i class="align-middle" data-feather="x"></i> Hủy đơn hàng
					</a>
				<?php elseif($tt === 2): ?>
					<a href="index.php?action=capnhat&id=<?= $donhang["id"] ?>&trangthai=3" class="btn btn-success">
						<i class="align-middle" data-feather="check-circle"></i> Xác nhận hoàn thành
					</a>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>

<?php include("../inc/bottom.php"); ?>
