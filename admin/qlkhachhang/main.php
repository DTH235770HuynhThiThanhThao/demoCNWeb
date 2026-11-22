<?php include("../inc/top.php"); ?>

<div class="row align-items-center mb-3">
	<div class="col-md-6 col-12 mb-2 mb-md-0 d-flex align-items-center gap-2 flex-wrap">
		<h3 class="text-info fw-bold mb-0">Quản lý khách hàng</h3>
		<span class="badge bg-secondary fs-6">Tổng cộng: <?= !empty($khachhang) ? count($khachhang) : 0 ?> khách hàng</span>
	</div>
	<div class="col-md-6 col-12">
		<form class="d-flex justify-content-md-end align-items-center gap-2" method="get" action="index.php">
			<div class="input-group input-group-sm" style="max-width: 320px;">
				<input type="text" name="tukhoa" class="form-control" placeholder="Tìm theo tên, SĐT, email..." value="<?= htmlspecialchars($tukhoa ?? '') ?>">
				<button class="btn btn-info text-white" type="submit" title="Tìm kiếm">
					<i class="align-middle" data-feather="search" style="width: 14px; height: 14px;"></i>
				</button>
				<?php if(!empty($tukhoa)): ?>
					<a href="index.php" class="btn btn-outline-secondary d-flex align-items-center" title="Xóa tìm kiếm">
						<i class="align-middle" data-feather="x" style="width: 14px; height: 14px;"></i>
					</a>
				<?php endif; ?>
			</div>
		</form>
	</div>
</div>

<div class="card shadow-sm">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th class="text-center" style="width: 100px;">Mã KH</th>
						<th>Khách hàng</th>
						<th style="width: 140px;">Số điện thoại</th>
						<th class="text-center" style="width: 110px;">Đơn hàng</th>
						<th class="text-end" style="width: 160px;">Tổng chi tiêu</th>
						<th class="text-center" style="width: 130px;">Trạng thái</th>
						<th class="text-center" style="width: 180px; white-space: nowrap;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php if(empty($khachhang)): ?>
					<tr>
						<td colspan="7" class="text-center text-muted py-4">
							<?php if(!empty($tukhoa)): ?>
								Không tìm thấy khách hàng nào phù hợp với từ khóa "<strong><?= htmlspecialchars($tukhoa) ?></strong>".
								<br><a href="index.php" class="btn btn-sm btn-link mt-2">Xem tất cả khách hàng</a>
							<?php else: ?>
								Chưa có dữ liệu khách hàng nào trong hệ thống.
							<?php endif; ?>
						</td>
					</tr>
					<?php else: ?>
					<?php foreach ($khachhang as $k): 
						$avatar = !empty($k["hinhanh"]) ? "../../" . $k["hinhanh"] : "../../images/users/user.png";
						$sodon = (int)($k["sodonhang"] ?? 0);
						$tongtien = (float)($k["tongchitieu"] ?? 0);
						$trangthai = (int)($k["trangthai"] ?? 1);
					?>
					<tr>
						<td class="text-center fw-bold text-primary"><?= sprintf("KH%04d", $k["id"]) ?></td>
						<td>
							<div class="d-flex align-items-center">
								<img src="<?= $avatar ?>" class="rounded-circle me-2 border" style="width: 36px; height: 36px; object-fit: cover;" alt="<?= htmlspecialchars($k["hoten"]) ?>" onerror="this.src='../../images/users/user.png';">
								<div>
									<strong class="text-dark"><?= htmlspecialchars($k["hoten"]) ?></strong>
									<br><small class="text-muted"><?= htmlspecialchars($k["email"]) ?></small>
								</div>
							</div>
						</td>
						<td>
							<span class="text-nowrap text-dark">
								<i class="align-middle text-muted me-1" data-feather="phone" style="width: 14px; height: 14px;"></i>
								<?= htmlspecialchars($k["sodienthoai"]) ?>
							</span>
						</td>
						<td class="text-center">
							<span class="badge bg-light text-dark border px-2 py-1 fs-6"><?= $sodon ?> đơn</span>
						</td>
						<td class="text-end">
							<span class="text-danger fw-bold fs-6"><?= number_format($tongtien, 0, ',', '.') ?>đ</span>
							<?php if($tongtien >= 30000000): ?>
								<br><span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px;"><i class="align-middle me-1" data-feather="star" style="width: 11px; height: 11px;"></i>VIP</span>
							<?php endif; ?>
						</td>
						<td class="text-center">
							<?php if($trangthai === 1): ?>
								<span class="badge bg-success px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="check-circle" style="width: 13px; height: 13px;"></i>Hoạt động</span>
							<?php else: ?>
								<span class="badge bg-danger px-2 py-1 text-nowrap"><i class="align-middle me-1" data-feather="lock" style="width: 13px; height: 13px;"></i>Đã khóa</span>
							<?php endif; ?>
						</td>
						<td class="text-center text-nowrap">
							<div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
								<a href="index.php?action=chitiet&id=<?= $k["id"] ?>" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" title="Xem chi tiết & lịch sử mua" style="padding: 5px 8px;">
									<i class="align-middle" data-feather="eye" style="width: 15px; height: 15px;"></i>
								</a>

								<?php if($trangthai === 1): ?>
									<a href="index.php?action=doitrangthai&id=<?= $k["id"] ?>&trangthai=0<?= !empty($tukhoa) ? '&tukhoa=' . urlencode($tukhoa) : '' ?>" class="btn btn-sm btn-warning d-inline-flex align-items-center text-dark text-nowrap" onclick="return confirm('Xác nhận khóa tài khoản khách hàng này?');" title="Khóa tài khoản" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="lock" style="width: 14px; height: 14px;"></i>Khóa
									</a>
								<?php else: ?>
									<a href="index.php?action=doitrangthai&id=<?= $k["id"] ?>&trangthai=1<?= !empty($tukhoa) ? '&tukhoa=' . urlencode($tukhoa) : '' ?>" class="btn btn-sm btn-success d-inline-flex align-items-center text-nowrap" onclick="return confirm('Xác nhận mở khóa tài khoản khách hàng này?');" title="Mở khóa tài khoản" style="padding: 5px 9px;">
										<i class="align-middle me-1" data-feather="unlock" style="width: 14px; height: 14px;"></i>Mở khóa
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