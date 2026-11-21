<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<h3 class="text-info fw-bold mb-0">Quản lý đơn hàng</h3>
	<span class="badge bg-secondary fs-6">Tổng cộng: <?= !empty($donhang) ? count($donhang) : 0 ?> đơn hàng</span>
</div>

<div class="card shadow-sm">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th class="text-center" style="width: 110px;">Mã ĐH</th>
						<th>Khách hàng</th>
						<th style="width: 145px;">Ngày đặt</th>
						<th class="text-end" style="width: 130px;">Tổng tiền</th>
						<th class="text-center" style="width: 140px;">Trạng thái</th>
						<th class="text-center" style="width: 220px; white-space: nowrap;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php if(empty($donhang)): ?>
					<tr>
						<td colspan="6" class="text-center text-muted py-4">Chưa có đơn hàng nào trong hệ thống.</td>
					</tr>
					<?php else: ?>
					<?php foreach ($donhang as $d): ?>
					<tr>
						<td class="text-center fw-bold text-primary"><?= sprintf("DH%06d", $d["id"]) ?></td>
						<td>
							<strong><?= htmlspecialchars($d["hoten"] ?? "Khách vãng lai") ?></strong>
							<?php if(!empty($d["sodienthoai"])): ?>
								<br><small class="text-muted"><i class="align-middle" data-feather="phone" style="width: 14px; height: 14px;"></i> <?= htmlspecialchars($d["sodienthoai"]) ?></small>
							<?php endif; ?>
						</td>
						<td><?= date("d/m/Y H:i", strtotime($d["ngay"])) ?></td>
						<td class="text-end">
							<span class="text-danger fw-bold fs-6"><?= number_format($d["tongtien"]) ?>đ</span>
						</td>
						<td class="text-center">
							<?php 
							$tt = (int)($d["trangthai"] ?? 0);
							if($tt === 0){
								echo '<span class="badge bg-warning text-dark px-2 py-1 text-nowrap"><i class="align-middle" data-feather="clock" style="width: 13px; height: 13px;"></i> Chờ xác nhận</span>';
							} elseif($tt === 1){
								echo '<span class="badge bg-primary px-2 py-1 text-nowrap"><i class="align-middle" data-feather="check-circle" style="width: 13px; height: 13px;"></i> Đã duyệt</span>';
							} elseif($tt === 2){
								echo '<span class="badge bg-info text-white px-2 py-1 text-nowrap"><i class="align-middle" data-feather="truck" style="width: 13px; height: 13px;"></i> Đang giao</span>';
							} elseif($tt === 3){
								echo '<span class="badge bg-success px-2 py-1 text-nowrap"><i class="align-middle" data-feather="check-square" style="width: 13px; height: 13px;"></i> Hoàn thành</span>';
							} elseif($tt === 4){
								echo '<span class="badge bg-danger px-2 py-1 text-nowrap"><i class="align-middle" data-feather="x-circle" style="width: 13px; height: 13px;"></i> Đã hủy</span>';
							}
							?>
						</td>
						<td class="text-center text-nowrap" style="width: 220px;">
							<div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
								<a href="index.php?action=chitiet&id=<?= $d["id"] ?>" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" title="Xem chi tiết" style="padding: 5px 8px;">
									<i class="align-middle" data-feather="eye"></i>
								</a>

								<?php if($tt === 0): ?>
									<a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=1" class="btn btn-sm btn-success d-inline-flex align-items-center text-nowrap" title="Duyệt đơn hàng" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="check" style="width: 14px; height: 14px;"></i>Duyệt
									</a>
									<a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=4" class="btn btn-sm btn-danger d-inline-flex align-items-center text-nowrap" onclick="return confirm('Xác nhận hủy đơn hàng này?');" title="Hủy đơn hàng" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="x" style="width: 14px; height: 14px;"></i>Hủy
									</a>
								<?php elseif($tt === 1): ?>
									<a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=2" class="btn btn-sm btn-info text-white d-inline-flex align-items-center text-nowrap" title="Bắt đầu giao hàng" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="truck" style="width: 14px; height: 14px;"></i>Giao
									</a>
									<a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=4" class="btn btn-sm btn-danger d-inline-flex align-items-center text-nowrap" onclick="return confirm('Xác nhận hủy đơn hàng này?');" title="Hủy đơn hàng" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="x" style="width: 14px; height: 14px;"></i>Hủy
									</a>
								<?php elseif($tt === 2): ?>
									<a href="index.php?action=capnhat&id=<?= $d["id"] ?>&trangthai=3" class="btn btn-sm btn-success d-inline-flex align-items-center text-nowrap" title="Xác nhận hoàn thành" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="check-circle" style="width: 14px; height: 14px;"></i>Hoàn thành
									</a>
								<?php endif; ?>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include("../inc/bottom.php"); ?>
