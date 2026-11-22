<?php include("../inc/top.php"); ?>

<div class="mb-3">
	<a href="index.php" class="btn btn-secondary btn-sm">
		<i class="align-middle" data-feather="arrow-left"></i> Quay lại danh sách khách hàng
	</a>
</div>

<?php 
$avatar = !empty($khachhang["hinhanh"]) ? "../../" . $khachhang["hinhanh"] : "../../images/users/user.png";
$tongtien = (float)($khachhang["tongchitieu"] ?? 0);
$sodon = !empty($donhang) ? count($donhang) : (int)($khachhang["sodonhang"] ?? 0);
$trangthai = (int)($khachhang["trangthai"] ?? 1);
?>

<div class="row g-3">
	<!-- Cột trái: Hồ sơ khách hàng -->
	<div class="col-lg-4 col-12">
		<div class="card shadow-sm mb-3">
			<div class="card-header bg-white py-3 border-bottom">
				<h5 class="card-title mb-0 fw-bold text-info">
					<i class="align-middle me-1" data-feather="user"></i> Hồ sơ khách hàng
				</h5>
			</div>
			<div class="card-body text-center pb-3">
				<div class="position-relative d-inline-block mb-3">
					<img src="<?= $avatar ?>" class="rounded-circle border p-1 shadow-sm" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= htmlspecialchars($khachhang["hoten"]) ?>" onerror="this.src='../../images/users/user.png';">
				</div>
				<h4 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($khachhang["hoten"]) ?></h4>
				<p class="text-primary fw-bold mb-2"><?= sprintf("KH%04d", $khachhang["id"]) ?></p>
				
				<div class="d-flex justify-content-center align-items-center gap-2 mb-3">
					<?php if($trangthai === 1): ?>
						<span class="badge bg-success px-2 py-1"><i class="align-middle me-1" data-feather="check-circle" style="width: 13px; height: 13px;"></i>Tài khoản hoạt động</span>
					<?php else: ?>
						<span class="badge bg-danger px-2 py-1"><i class="align-middle me-1" data-feather="lock" style="width: 13px; height: 13px;"></i>Tài khoản đã khóa</span>
					<?php endif; ?>

					<?php if($tongtien >= 30000000): ?>
						<span class="badge bg-warning text-dark px-2 py-1"><i class="align-middle me-1" data-feather="star" style="width: 12px; height: 12px;"></i>Khách VIP</span>
					<?php endif; ?>
				</div>

				<div class="row g-2 text-center my-3 py-2 bg-light rounded border">
					<div class="col-6 border-end">
						<div class="text-muted small">Tổng đơn hàng</div>
						<div class="fw-bold fs-5 text-dark"><?= $sodon ?></div>
					</div>
					<div class="col-6">
						<div class="text-muted small">Chi tiêu tích lũy</div>
						<div class="fw-bold fs-5 text-danger"><?= number_format($tongtien, 0, ',', '.') ?>đ</div>
					</div>
				</div>

				<ul class="list-group list-group-flush text-start small">
					<li class="list-group-item px-0 py-2 d-flex justify-content-between">
						<span class="text-muted"><i class="align-middle me-1" data-feather="mail" style="width: 14px; height: 14px;"></i>Email:</span>
						<span class="fw-semibold text-break"><?= htmlspecialchars($khachhang["email"]) ?></span>
					</li>
					<li class="list-group-item px-0 py-2 d-flex justify-content-between">
						<span class="text-muted"><i class="align-middle me-1" data-feather="phone" style="width: 14px; height: 14px;"></i>Điện thoại:</span>
						<span class="fw-semibold"><?= htmlspecialchars($khachhang["sodienthoai"]) ?></span>
					</li>
					<li class="list-group-item px-0 py-2">
						<div class="text-muted mb-1"><i class="align-middle me-1" data-feather="map-pin" style="width: 14px; height: 14px;"></i>Địa chỉ nhận hàng:</div>
						<?php if(!empty($khachhang["diachi"])): ?>
							<?php foreach($khachhang["diachi"] as $dc): ?>
								<div class="p-2 mb-1 bg-light rounded border">
									<?= htmlspecialchars($dc["diachi"]) ?>
									<?php if(!empty($dc["macdinh"])): ?>
										<span class="badge bg-info text-white ms-1" style="font-size: 10px;">Mặc định</span>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<span class="text-muted fst-italic">Chưa có địa chỉ lưu trong hệ thống.</span>
						<?php endif; ?>
					</li>
				</ul>

				<div class="mt-3">
					<?php if($trangthai === 1): ?>
						<a href="index.php?action=doitrangthai&id=<?= $khachhang["id"] ?>&trangthai=0&from=chitiet" class="btn btn-warning btn-sm w-100 text-dark" onclick="return confirm('Xác nhận khóa tài khoản khách hàng này?');">
							<i class="align-middle me-1" data-feather="lock"></i> Khóa tài khoản này
						</a>
					<?php else: ?>
						<a href="index.php?action=doitrangthai&id=<?= $khachhang["id"] ?>&trangthai=1&from=chitiet" class="btn btn-success btn-sm w-100" onclick="return confirm('Xác nhận mở khóa tài khoản khách hàng này?');">
							<i class="align-middle me-1" data-feather="unlock"></i> Mở khóa tài khoản này
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Cột phải: Lịch sử đơn hàng -->
	<div class="col-lg-8 col-12">
		<div class="card shadow-sm mb-3">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<h5 class="card-title mb-0 fw-bold text-info">
					<i class="align-middle me-1" data-feather="shopping-bag"></i> Lịch sử đơn hàng
				</h5>
				<span class="badge bg-secondary"><?= count($donhang) ?> đơn hàng</span>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover align-middle mb-0">
						<thead class="table-light">
							<tr>
								<th class="text-center" style="width: 110px;">Mã ĐH</th>
								<th style="width: 145px;">Ngày đặt</th>
								<th class="text-end" style="width: 130px;">Tổng tiền</th>
								<th class="text-center" style="width: 140px;">Trạng thái</th>
								<th class="text-center" style="width: 90px;">Chi tiết</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($donhang)): ?>
							<tr>
								<td colspan="5" class="text-center text-muted py-4">
									<i class="align-middle me-1" data-feather="inbox"></i> Khách hàng này chưa có đơn hàng nào.
								</td>
							</tr>
							<?php else: ?>
							<?php foreach($donhang as $d): ?>
							<tr>
								<td class="text-center fw-bold text-primary">
									<?= sprintf("DH%06d", $d["id"]) ?>
								</td>
								<td><?= date("d/m/Y H:i", strtotime($d["ngay"])) ?></td>
								<td class="text-end">
									<span class="text-danger fw-bold"><?= number_format($d["tongtien"], 0, ',', '.') ?>đ</span>
								</td>
								<td class="text-center">
									<?php 
									$tt = (int)($d["trangthai"] ?? 0);
									if($tt === 0){
										echo '<span class="badge bg-warning text-dark px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="clock" style="width: 12px; height: 12px;"></i>Chờ xác nhận</span>';
									} elseif($tt === 1){
										echo '<span class="badge bg-primary px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="check-circle" style="width: 12px; height: 12px;"></i>Đã duyệt</span>';
									} elseif($tt === 2){
										echo '<span class="badge bg-info text-white px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="truck" style="width: 12px; height: 12px;"></i>Đang giao</span>';
									} elseif($tt === 3){
										echo '<span class="badge bg-success px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="check-square" style="width: 12px; height: 12px;"></i>Hoàn thành</span>';
									} elseif($tt === 4){
										echo '<span class="badge bg-danger px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="x-circle" style="width: 12px; height: 12px;"></i>Đã hủy</span>';
									}
									?>
								</td>
								<td class="text-center">
									<a href="../qldonhang/index.php?action=chitiet&id=<?= $d["id"] ?>" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" title="Xem chi tiết đơn hàng" style="padding: 5px 8px;">
										<i class="align-middle" data-feather="eye" style="width: 14px; height: 14px;"></i>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("../inc/bottom.php"); ?>