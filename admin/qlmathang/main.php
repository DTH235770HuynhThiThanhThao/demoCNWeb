<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<div>
		<h3 class="fw-bold mb-1">Quản lý mặt hàng</h3>
		<p class="text-muted small mb-0">Quản lý danh sách điện thoại, phiên bản dung lượng, màu sắc và thư viện ảnh</p>
	</div>
	<a href="index.php?action=them" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
		<i class="align-middle" data-feather="plus-circle"></i> 
		<span>Thêm mặt hàng mới</span>
	</a>
</div>

<?php if(isset($_GET["msg"])): ?>
	<?php if($_GET["msg"] == "bienthe_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
			<i class="align-middle me-2" data-feather="check-circle"></i>
			<div>Cập nhật <strong>Phiên bản & Màu sắc</strong> thành công!</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "anhmau_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
			<i class="align-middle me-2" data-feather="check-circle"></i>
			<div>Cập nhật <strong>Thư viện ảnh màu</strong> thành công!</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "xoa_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
			<i class="align-middle me-2" data-feather="check-circle"></i>
			<div>Đã xóa mặt hàng thành công!</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="card border-0 shadow-sm">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
		<div class="d-flex align-items-center gap-2">
			<span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
				Tổng: <?= count($mathang) ?> điện thoại
			</span>
		</div>
		<div class="d-flex align-items-center gap-2">
			<input type="text" id="inputTimKiemSP" class="form-control form-control-sm" placeholder="Tìm theo tên máy, hãng..." style="min-width: 240px;" onkeyup="locBangSanPham()">
		</div>
	</div>

	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0" id="bangSanPham">
				<thead class="table-light text-secondary text-uppercase small">
					<tr>
						<th style="min-width: 260px;" class="ps-3 py-3">Sản phẩm</th>
						<th style="min-width: 130px;" class="py-3">Giá bán</th>
						<th style="min-width: 140px;" class="py-3">Tồn kho / Biến thể</th>
						<th style="min-width: 320px;" class="text-end pe-3 py-3">Thao tác nhanh</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($mathang as $m): 
					// Tách phiên bản & màu sắc để đếm
					$ds_pb = !empty($m["phienban"]) ? array_filter(array_map('trim', explode(',', $m["phienban"]))) : [];
					$ds_mau = !empty($m["mausac"]) ? array_filter(array_map('trim', explode(',', $m["mausac"]))) : [];
					$so_bienthe = count($ds_pb) + count($ds_mau);

					// Tách thư viện ảnh để đếm
					$ds_anh_mau = !empty($m["thuvienanh"]) ? array_filter(array_map('trim', explode(',', $m["thuvienanh"]))) : [];
					$so_anh = count($ds_anh_mau);

					$ma_sp = sprintf("SP-%03d", $m['id']);
					$ten_hang = !empty($m['tendanhmuc']) ? $m['tendanhmuc'] : "Chưa rõ";
				?>
				<tr class="dong-san-pham">
					<!-- Cột 1: Sản phẩm (Ảnh + Tên + Mã SP + Hãng) -->
					<td class="ps-3 py-2">
						<div class="d-flex align-items-center gap-3">
							<a href="index.php?action=chitiet&id=<?= $m['id'] ?>" class="flex-shrink-0" title="Xem chi tiết nội bộ">
								<img src="../../<?= $m["hinhanh"] ?>" 
								     alt="<?= htmlspecialchars($m["tenmathang"]) ?>" 
								     class="rounded border bg-white p-1" 
								     style="width: 48px; height: 48px; object-fit: contain;"
								     onerror="this.src='../../images/products/a1.jpg';">
							</a>
							<div class="overflow-hidden">
								<a href="index.php?action=chitiet&id=<?= $m['id'] ?>" class="text-dark fw-bold text-decoration-none d-block text-truncate tieu-de-sp" style="max-width: 320px;" title="<?= htmlspecialchars($m["tenmathang"]) ?>">
									<?= htmlspecialchars($m["tenmathang"]) ?>
								</a>
								<div class="text-muted small mt-1 thong-tin-phu">
									<span class="badge bg-light text-dark border me-1">Mã: <?= $ma_sp ?></span>
									<span>&bull; Hãng: <strong class="text-primary"><?= htmlspecialchars($ten_hang) ?></strong></span>
								</div>
							</div>
						</div>
					</td>

					<!-- Cột 2: Giá bán -->
					<td class="py-2">
						<div class="fw-bold text-danger fs-6"><?= number_format($m["giaban"], 0, ',', '.') ?>đ</div>
						<?php if($m["giagoc"] > $m["giaban"]): ?>
							<del class="text-muted small d-block"><?= number_format($m["giagoc"], 0, ',', '.') ?>đ</del>
						<?php endif; ?>
					</td>

					<!-- Cột 3: Tồn kho / Biến thể -->
					<td class="py-2">
						<div class="d-flex flex-column gap-1">
							<?php if($so_bienthe > 0): ?>
								<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill align-self-start" title="<?= count($ds_pb) ?> bản dung lượng, <?= count($ds_mau) ?> màu">
									<i class="align-middle me-1" data-feather="layers" style="width: 11px; height: 11px;"></i><?= $so_bienthe ?> biến thể
								</span>
							<?php else: ?>
								<span class="badge bg-light text-muted border rounded-pill align-self-start">
									0 biến thể
								</span>
							<?php endif; ?>
							<div class="text-success fw-bold small">
								<i class="align-middle me-1" data-feather="check" style="width: 12px; height: 12px;"></i>Tồn: <?= $m["soluongton"] ?>
							</div>
						</div>
					</td>

					<!-- Cột 4: Thao tác nhanh trên 1 hàng ngang (Web | Biến thể | Ảnh màu | Sửa | Xóa) -->
					<td class="pe-3 py-2 text-end">
						<div class="d-inline-flex align-items-center gap-1 flex-nowrap">
							<!-- Nút Web: mở ngoài trang chi tiết khách hàng -->
							<a class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1" 
							   href="../../public/index.php?action=detail&id=<?= $m['id'] ?>" 
							   target="_blank" 
							   title="Mở xem trực tiếp ngoài web khách hàng">
								<i class="align-middle" data-feather="external-link" style="width: 14px; height: 14px;"></i>
								<span>Web</span>
							</a>

							<!-- Nút Biến thể: mở trang quản lý nhanh phiên bản & màu sắc -->
							<a class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1" 
							   href="index.php?action=bienthe&id=<?= $m['id'] ?>" 
							   title="Quản lý nhanh phiên bản dung lượng & màu sắc">
								<i class="align-middle" data-feather="sliders" style="width: 14px; height: 14px;"></i>
								<span>Biến thể (<?= $so_bienthe ?>)</span>
							</a>

							<!-- Nút Ảnh màu: mở trang quản lý thư viện ảnh màu -->
							<a class="btn btn-outline-success btn-sm d-inline-flex align-items-center gap-1" 
							   href="index.php?action=anhmau&id=<?= $m['id'] ?>" 
							   title="Quản lý thư viện ảnh theo màu">
								<i class="align-middle" data-feather="image" style="width: 14px; height: 14px;"></i>
								<span>Ảnh màu (<?= $so_anh ?>)</span>
							</a>

							<!-- Nút Sửa: mở form sửa toàn diện -->
							<a class="btn btn-outline-warning btn-sm d-inline-flex align-items-center gap-1" 
							   href="index.php?action=sua&id=<?= $m['id'] ?>" 
							   title="Sửa toàn bộ thông tin">
								<i class="align-middle" data-feather="edit-2" style="width: 14px; height: 14px;"></i>
								<span>Sửa</span>
							</a>

							<!-- Nút Xóa: xóa mặt hàng -->
							<a class="btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" 
							   href="index.php?action=xoa&id=<?= $m['id'] ?>" 
							   onclick="return confirm('Xác nhận xóa mặt hàng này?');" 
							   title="Xóa sản phẩm">
								<i class="align-middle" data-feather="trash-2" style="width: 14px; height: 14px;"></i>
								<span>Xóa</span>
							</a>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
function locBangSanPham() {
	var input = document.getElementById("inputTimKiemSP");
	var filter = input.value.toLowerCase().trim();
	var rows = document.querySelectorAll("#bangSanPham tbody tr.dong-san-pham");

	rows.forEach(function(row) {
		var textTitle = row.querySelector(".tieu-de-sp") ? row.querySelector(".tieu-de-sp").textContent.toLowerCase() : "";
		var textSub = row.querySelector(".thong-tin-phu") ? row.querySelector(".thong-tin-phu").textContent.toLowerCase() : "";
		if (textTitle.indexOf(filter) > -1 || textSub.indexOf(filter) > -1) {
			row.style.display = "";
		} else {
			row.style.display = "none";
		}
	});
}
</script>

<?php include("../inc/bottom.php"); ?>
