<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
	<div>
		<h3 class="fw-bold mb-1 text-info">Quản lý nhập hàng</h3>
		<p class="text-muted small mb-0">Theo dõi lịch sử nhập kho điện thoại từ các hãng và nhà phân phối chính thức</p>
	</div>
	<a href="index.php?action=them" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
		<i class="align-middle" data-feather="plus-circle"></i> 
		<span>+ Lập phiếu nhập mới</span>
	</a>
</div>

<?php if(isset($_GET["msg"]) && $_GET["msg"] == "them_ok"): ?>
	<div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
		<i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
		<div>
			<strong>Nhập kho thành công!</strong> Phiếu nhập <strong><?= sprintf("PN%05d", (int)($_GET["id"] ?? 0)) ?></strong> đã được lưu và hệ thống đã <strong>tự động cộng dồn số lượng tồn kho</strong> vào danh mục hàng hóa.
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<!-- Thẻ thống kê nhanh -->
<div class="row g-3 mb-4">
	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm mb-0">
			<div class="card-body p-3">
				<div class="d-flex align-items-center">
					<div class="flex-shrink-0 bg-primary-subtle text-primary p-3 rounded-3 me-3">
						<i class="align-middle" data-feather="file-text" style="width: 24px; height: 24px;"></i>
					</div>
					<div>
						<div class="text-muted small">Tổng số phiếu nhập</div>
						<h4 class="fw-bold mb-0 text-dark"><?= count($phieunhap) ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	$tong_tien_toan_bo = 0;
	$tong_may_toan_bo = 0;
	foreach($phieunhap as $p){
		$tong_tien_toan_bo += (float)$p["tongtien"];
		$tong_may_toan_bo += (int)($p["tongsoluong"] ?? 0);
	}
	?>

	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm mb-0">
			<div class="card-body p-3">
				<div class="d-flex align-items-center">
					<div class="flex-shrink-0 bg-success-subtle text-success p-3 rounded-3 me-3">
						<i class="align-middle" data-feather="package" style="width: 24px; height: 24px;"></i>
					</div>
					<div>
						<div class="text-muted small">Tổng máy đã nhập</div>
						<h4 class="fw-bold mb-0 text-success"><?= number_format($tong_may_toan_bo) ?> máy</h4>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-xl-6">
		<div class="card border-0 shadow-sm mb-0">
			<div class="card-body p-3">
				<div class="d-flex align-items-center">
					<div class="flex-shrink-0 bg-danger-subtle text-danger p-3 rounded-3 me-3">
						<i class="align-middle" data-feather="dollar-sign" style="width: 24px; height: 24px;"></i>
					</div>
					<div>
						<div class="text-muted small">Tổng giá trị nhập kho</div>
						<h4 class="fw-bold mb-0 text-danger"><?= number_format($tong_tien_toan_bo, 0, ',', '.') ?>đ</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Bảng danh sách phiếu nhập -->
<div class="card border-0 shadow-sm">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
		<div class="d-flex align-items-center gap-2">
			<span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
				Lịch sử: <?= count($phieunhap) ?> phiếu nhập
			</span>
		</div>
		<div class="d-flex align-items-center gap-2">
			<input type="text" id="inputTimKiemPN" class="form-control form-control-sm" placeholder="Tìm kiếm theo mã, nhà cung cấp, người lập..." style="min-width: 280px;" onkeyup="locBangPhieuNhap()">
		</div>
	</div>

	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0" id="bangPhieuNhap">
				<thead class="table-light text-secondary text-uppercase small">
					<tr>
						<th class="ps-3 py-3" style="width: 120px;">Mã phiếu</th>
						<th class="py-3">Nhà cung cấp</th>
						<th class="py-3" style="width: 180px;">Người lập phiếu</th>
						<th class="py-3" style="width: 150px;">Ngày nhập</th>
						<th class="py-3 text-center" style="width: 130px;">Số lượng nhập</th>
						<th class="py-3 text-end" style="width: 150px;">Tổng tiền nhập</th>
						<th class="pe-3 py-3 text-center" style="width: 110px;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
				<?php if(empty($phieunhap)): ?>
					<tr>
						<td colspan="7" class="text-center py-5 text-muted">
							<i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 48px; height: 48px;"></i>
							<div class="fw-semibold">Chưa có phiếu nhập hàng nào.</div>
							<div class="small">Bấm vào nút "+ Lập phiếu nhập mới" để tiến hành nhập hàng vào kho.</div>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach($phieunhap as $pn): 
						$ma_pn = sprintf("PN%05d", $pn["id"]);
						$so_luong_may = (int)($pn["tongsoluong"] ?? 0);
					?>
					<tr class="dong-phieu-nhap">
						<!-- Mã phiếu -->
						<td class="ps-3 py-3">
							<a href="index.php?action=chitiet&id=<?= $pn["id"] ?>" class="fw-bold text-primary text-decoration-none">
								<?= $ma_pn ?>
							</a>
						</td>

						<!-- Nhà cung cấp + Ghi chú -->
						<td class="py-3">
							<div class="fw-bold text-dark cot-ncc"><?= htmlspecialchars($pn["nhacungcap"]) ?></div>
							<?php if(!empty($pn["ghichu"])): ?>
								<div class="text-muted small mt-1">
									<i class="align-middle me-1" data-feather="message-square" style="width: 12px; height: 12px;"></i><?= htmlspecialchars($pn["ghichu"]) ?>
								</div>
							<?php endif; ?>
						</td>

						<!-- Người lập phiếu -->
						<td class="py-3">
							<div class="fw-semibold text-dark cot-nguoi"><?= htmlspecialchars($pn["hoten"] ?? "Quản trị viên") ?></div>
							<?php if(!empty($pn["email"])): ?>
								<div class="text-muted small"><?= htmlspecialchars($pn["email"]) ?></div>
							<?php endif; ?>
						</td>

						<!-- Ngày nhập -->
						<td class="py-3 text-muted small">
							<i class="align-middle me-1" data-feather="calendar" style="width: 13px; height: 13px;"></i><?= date("d/m/Y H:i", strtotime($pn["ngaynhap"])) ?>
						</td>

						<!-- Số lượng máy -->
						<td class="py-3 text-center">
							<span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill fw-bold">
								<?= number_format($so_luong_may) ?> máy
							</span>
						</td>

						<!-- Tổng tiền -->
						<td class="py-3 text-end">
							<div class="fw-bold text-danger fs-6"><?= number_format($pn["tongtien"], 0, ',', '.') ?>đ</div>
						</td>

						<!-- Thao tác -->
						<td class="pe-3 py-3 text-center">
							<a href="index.php?action=chitiet&id=<?= $pn["id"] ?>" 
							   class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center p-2" 
							   title="Xem chi tiết phiếu nhập">
								<i class="align-middle" data-feather="eye" style="width: 15px; height: 15px;"></i>
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

<script>
function locBangPhieuNhap() {
	var input = document.getElementById("inputTimKiemPN");
	var filter = input.value.toLowerCase().trim();
	var rows = document.querySelectorAll("#bangPhieuNhap tbody tr.dong-phieu-nhap");

	rows.forEach(function(row) {
		var text = row.textContent.toLowerCase();
		if (text.indexOf(filter) > -1) {
			row.style.display = "";
		} else {
			row.style.display = "none";
		}
	});
}
</script>

<?php include("../inc/bottom.php"); ?>
