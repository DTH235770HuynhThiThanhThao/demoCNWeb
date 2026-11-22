<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
	<div>
		<h3 class="fw-bold mb-1 text-info">Quản lý hình ảnh & Banner</h3>
		<p class="text-muted small mb-0">Cấu hình logo thương hiệu, slide Hero Banner đầu trang và banner khuyến mãi</p>
	</div>
	<div>
		<a href="../../public/index.php" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
			<i class="align-middle" data-feather="external-link"></i>
			<span>Xem trang chủ ngoài web</span>
		</a>
	</div>
</div>

<!-- Thông báo trạng thái -->
<?php if(isset($_GET["msg"])): ?>
	<?php if($_GET["msg"] == "them_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
			<i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
			<div><strong>Thành công!</strong> Đã thêm banner quảng cáo mới vào hệ thống.</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "logo_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
			<i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
			<div><strong>Thành công!</strong> Đã cập nhật Logo thương hiệu mới. Logo đã đồng bộ ra toàn bộ website.</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "trangthai_ok"): ?>
		<div class="alert alert-info alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
			<i class="align-middle me-2" data-feather="info" style="width: 20px; height: 20px;"></i>
			<div><strong>Đã cập nhật!</strong> Trạng thái hiển thị banner đã được thay đổi.</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "xoa_ok"): ?>
		<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
			<i class="align-middle me-2" data-feather="trash-2" style="width: 20px; height: 20px;"></i>
			<div><strong>Đã xóa!</strong> Banner quảng cáo đã được gỡ khỏi danh sách.</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php if(isset($_GET["err"])): ?>
	<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
		<i class="align-middle me-2" data-feather="alert-triangle" style="width: 20px; height: 20px;"></i>
		<div>
			<?php 
			if($_GET["err"] == "upload_fail") echo "<strong>Lỗi:</strong> Không thể tải file ảnh lên máy chủ. Vui lòng kiểm tra quyền thư mục.";
			elseif($_GET["err"] == "invalid_file") echo "<strong>Lỗi:</strong> Định dạng file không hợp lệ! Vui lòng chọn ảnh JPG, PNG, WEBP hoặc GIF.";
			elseif($_GET["err"] == "missing_data") echo "<strong>Lỗi:</strong> Vui lòng nhập đầy đủ tiêu đề và chọn file ảnh banner.";
			elseif($_GET["err"] == "no_file") echo "<strong>Lỗi:</strong> Chưa chọn file ảnh để tải lên.";
			else echo "<strong>Lỗi thao tác:</strong> Đã xảy ra lỗi không xác định.";
			?>
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<!-- HÀNG 1: 2 KHỐI THIẾT LẬP NHANH (col-lg-5 Logo & col-lg-7 Banner) -->
<div class="row g-3 mb-4">
	<!-- CỘT TRÁI: Quản lý Logo thương hiệu -->
	<div class="col-lg-5">
		<div class="card border-0 shadow-sm h-100">
			<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
				<i class="align-middle text-danger" data-feather="image"></i>
				<h5 class="fw-bold mb-0 text-dark">Logo thương hiệu</h5>
			</div>
			<div class="card-body p-3 p-md-4 d-flex flex-column justify-content-between">
				<div>
					<label class="form-label fw-semibold text-secondary small text-uppercase">Khung xem trước Logo hiện tại</label>
					<!-- Khung mô phỏng thanh Header Navbar màu đỏ (#d70018) -->
					<div class="rounded-3 p-3 mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2 shadow-sm" 
					     style="background-color: #d70018; border: 1px solid rgba(0,0,0,0.1);">
						<div class="d-flex align-items-center">
							<?php 
							$logo_file = !empty($logo_info["duongdan"]) ? $logo_info["duongdan"] : "logo1.jpg";
							?>
							<img src="../../images/logo/<?= htmlspecialchars($logo_file) ?>" 
							     id="previewLogoImg"
							     alt="Logo Thanh Thảo Shop" 
							     class="me-2 rounded shadow-sm bg-white p-1" 
							     style="height: 48px; max-width: 140px; object-fit: contain;">
							<div class="text-white">
								<div class="fw-bold fs-6 lh-1">THANH THẢO SHOP</div>
								<span class="small opacity-75" style="font-size: 11px;">Mô phỏng thanh Header</span>
							</div>
						</div>
						<span class="badge bg-light text-danger fw-bold px-2 py-1 small">Đang kích hoạt</span>
					</div>

					<div class="text-muted small mb-3">
						<i class="align-middle me-1" data-feather="info"></i>
						File hiện tại: <code class="text-danger fw-bold"><?= htmlspecialchars($logo_file) ?></code>
					</div>
				</div>

				<form action="index.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="doilogo">
					<div class="mb-3">
						<label for="filelogo" class="form-label fw-bold text-dark">Chọn ảnh Logo mới</label>
						<input class="form-control" type="file" id="filelogo" name="filelogo" accept="image/*" required onchange="xemTruocLogo(this)">
						<div class="form-text small text-muted">Hỗ trợ định dạng JPG, PNG, WEBP, SVG. Khuyên dùng kích thước tỉ lệ ngang hoặc vuông (cao 50-80px).</div>
					</div>
					<button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
						<i class="align-middle" data-feather="upload-cloud"></i>
						<span>Cập nhật Logo</span>
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- CỘT PHẢI: Thêm Banner quảng cáo mới -->
	<div class="col-lg-7">
		<div class="card border-0 shadow-sm h-100">
			<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
				<i class="align-middle text-success" data-feather="plus-circle"></i>
				<h5 class="fw-bold mb-0 text-dark">Thêm Banner quảng cáo mới</h5>
			</div>
			<div class="card-body p-3 p-md-4">
				<form action="index.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="thembanner">

					<div class="mb-3">
						<label class="form-label fw-bold text-dark">Tiêu đề / Thông điệp quảng cáo <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="txttieude" required placeholder="Ví dụ: Siêu hội Apple iPhone 16 Pro Max - Giảm ngay 2 triệu...">
					</div>

					<div class="row g-3 mb-3">
						<div class="col-md-7">
							<label class="form-label fw-bold text-dark">Vị trí hiển thị <span class="text-danger">*</span></label>
							<select class="form-select" name="cboloai" required>
								<option value="banner_chinh" selected>Hero Banner đầu trang (Slide chính lớn cạnh Menu)</option>
								<option value="banner_phu">Banner khuyến mãi phía dưới (Promo Carousel)</option>
							</select>
						</div>
						<div class="col-md-5">
							<label class="form-label fw-bold text-dark">Thứ tự hiển thị</label>
							<input type="number" class="form-control" name="numthutu" value="1" min="1" max="99">
						</div>
					</div>

					<div class="mb-3">
						<label class="form-label fw-bold text-dark">Chọn file ảnh banner <span class="text-danger">*</span></label>
						<input class="form-control" type="file" id="filehinhanh" name="filehinhanh" accept="image/*" required onchange="xemTruocBanner(this)">
						<div class="form-text small text-muted">Gợi ý kích thước chuẩn ngang: <strong>1200x450px</strong> (Hero Banner) hoặc <strong>600x600px</strong> (Banner khuyến mãi). Tối đa 5MB.</div>
					</div>

					<!-- Khung preview banner khi vừa chọn file -->
					<div id="boxPreviewBanner" class="mb-3 d-none">
						<label class="form-label small fw-semibold text-muted">Xem trước ảnh vừa chọn:</label>
						<div class="rounded border p-1 bg-light text-center" style="max-height: 140px; overflow: hidden;">
							<img id="imgPreviewBanner" src="#" alt="Preview" style="max-height: 130px; width: auto; max-width: 100%; object-fit: contain;">
						</div>
					</div>

					<button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
						<i class="align-middle" data-feather="plus"></i>
						<span>+ Tải lên Banner</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- HÀNG 2: DANH SÁCH BANNER ĐANG QUẢN LÝ -->
<div class="card border-0 shadow-sm">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
		<div class="d-flex align-items-center gap-2">
			<i class="align-middle text-primary" data-feather="layers"></i>
			<h5 class="fw-bold mb-0 text-dark">Danh sách Banner đang quản lý</h5>
		</div>

		<!-- 3 Tab lọc tiện lợi -->
		<div class="btn-group btn-group-sm" role="group" aria-label="Bộ lọc banner">
			<button type="button" class="btn btn-outline-primary active btn-filter" data-filter="all" onclick="locBanner('all', this)">
				Tất cả banner (<span id="countAll">0</span>)
			</button>
			<button type="button" class="btn btn-outline-primary btn-filter" data-filter="banner_chinh" onclick="locBanner('banner_chinh', this)">
				Hero Banner đầu trang (<span id="countChinh">0</span>)
			</button>
			<button type="button" class="btn btn-outline-primary btn-filter" data-filter="banner_phu" onclick="locBanner('banner_phu', this)">
				Banner khuyến mãi dưới (<span id="countPhu">0</span>)
			</button>
		</div>
	</div>

	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th style="width: 170px;">Hình ảnh xem trước</th>
						<th>Tiêu đề & Tên file</th>
						<th style="width: 200px;">Vị trí hiển thị</th>
						<th class="text-center" style="width: 90px;">Thứ tự</th>
						<th class="text-center" style="width: 140px;">Trạng thái</th>
						<th class="text-center" style="width: 140px;">Thao tác</th>
					</tr>
				</thead>
				<tbody id="tbodyBanner">
					<?php 
					$dem = 0;
					$ds_banner = array();
					foreach($tatca as $b){
						if($b["loai"] != "logo"){
							$ds_banner[] = $b;
						}
					}

					if(count($ds_banner) == 0):
					?>
						<tr>
							<td colspan="7" class="text-center py-4 text-muted">
								<i class="align-middle me-1" data-feather="inbox"></i> Chưa có banner nào được cấu hình.
							</td>
						</tr>
					<?php else: ?>
						<?php foreach($ds_banner as $item): 
							$dem++;
							$is_chinh = ($item["loai"] == "banner_chinh");
						?>
						<tr class="banner-row" data-loai="<?= htmlspecialchars($item["loai"]) ?>">
							<td class="text-center text-muted fw-bold"><?= $dem ?></td>
							<td>
								<a href="../../images/carousel/<?= htmlspecialchars($item["duongdan"]) ?>" target="_blank" title="Bấm xem ảnh kích thước đầy đủ">
									<img src="../../images/carousel/<?= htmlspecialchars($item["duongdan"]) ?>" 
									     alt="<?= htmlspecialchars($item["tieude"]) ?>" 
									     class="rounded shadow-sm border" 
									     style="width: 140px; height: 56px; object-fit: cover;"
									     onerror="this.src='../../images/carousel/h1.jpg'">
								</a>
							</td>
							<td>
								<div class="fw-bold text-dark mb-1"><?= htmlspecialchars($item["tieude"]) ?></div>
								<div class="text-muted small d-flex align-items-center gap-1">
									<i class="align-middle" data-feather="file" style="width: 13px; height: 13px;"></i>
									<code><?= htmlspecialchars($item["duongdan"]) ?></code>
								</div>
							</td>
							<td>
								<?php if($is_chinh): ?>
									<span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill">
										<i class="align-middle me-1" data-feather="layout" style="width: 12px; height: 12px;"></i>
										Hero Banner đầu trang
									</span>
								<?php else: ?>
									<span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill">
										<i class="align-middle me-1" data-feather="tag" style="width: 12px; height: 12px;"></i>
										Banner khuyến mãi dưới
									</span>
								<?php endif; ?>
							</td>
							<td class="text-center fw-bold text-secondary">
								<?= $item["thutu"] ?>
							</td>
							<td class="text-center">
								<?php if($item["trangthai"] == 1): ?>
									<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
										<i class="align-middle me-1" data-feather="check" style="width: 12px; height: 12px;"></i>
										Đang hiển thị
									</span>
								<?php else: ?>
									<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-pill">
										<i class="align-middle me-1" data-feather="eye-off" style="width: 12px; height: 12px;"></i>
										Tạm ẩn
									</span>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<div class="d-flex justify-content-center gap-1 flex-nowrap">
									<?php if($item["trangthai"] == 1): ?>
										<a href="index.php?action=doitrangthai&id=<?= $item["id"] ?>&trangthai=0" 
										   class="btn btn-outline-warning btn-sm" 
										   title="Bấm để ẩn banner này">
											<i class="align-middle" data-feather="eye-off"></i>
										</a>
									<?php else: ?>
										<a href="index.php?action=doitrangthai&id=<?= $item["id"] ?>&trangthai=1" 
										   class="btn btn-outline-success btn-sm" 
										   title="Bấm để kích hoạt hiển thị">
											<i class="align-middle" data-feather="eye"></i>
										</a>
									<?php endif; ?>

									<a href="index.php?action=xoa&id=<?= $item["id"] ?>" 
									   class="btn btn-outline-danger btn-sm" 
									   title="Xóa banner này"
									   onclick="return confirm('Xác nhận xóa banner này khỏi hệ thống?');">
										<i class="align-middle" data-feather="trash-2"></i>
									</a>
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

<script>
// Xem trước Logo khi chọn file
function xemTruocLogo(input) {
	if (input.files && input.files[0]) {
		const reader = new FileReader();
		reader.onload = function(e) {
			const preview = document.getElementById('previewLogoImg');
			if (preview) {
				preview.src = e.target.result;
			}
		}
		reader.readAsDataURL(input.files[0]);
	}
}

// Xem trước Banner khi chọn file
function xemTruocBanner(input) {
	if (input.files && input.files[0]) {
		const reader = new FileReader();
		reader.onload = function(e) {
			const box = document.getElementById('boxPreviewBanner');
			const img = document.getElementById('imgPreviewBanner');
			if (box && img) {
				img.src = e.target.result;
				box.classList.remove('d-none');
			}
		}
		reader.readAsDataURL(input.files[0]);
	}
}

// Lọc Banner theo tab
function locBanner(type, btn) {
	// Active button
	document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
	btn.classList.add('active');

	const rows = document.querySelectorAll('.banner-row');
	rows.forEach(row => {
		const loai = row.getAttribute('data-loai');
		if (type === 'all' || loai === type) {
			row.style.display = '';
		} else {
			row.style.display = 'none';
		}
	});
}

// Cập nhật số lượng trên các tab lọc khi tải trang
document.addEventListener('DOMContentLoaded', function() {
	const allRows = document.querySelectorAll('.banner-row');
	let countChinh = 0;
	let countPhu = 0;

	allRows.forEach(row => {
		const loai = row.getAttribute('data-loai');
		if (loai === 'banner_chinh') countChinh++;
		if (loai === 'banner_phu') countPhu++;
	});

	const elAll = document.getElementById('countAll');
	const elChinh = document.getElementById('countChinh');
	const elPhu = document.getElementById('countPhu');

	if (elAll) elAll.textContent = allRows.length;
	if (elChinh) elChinh.textContent = countChinh;
	if (elPhu) elPhu.textContent = countPhu;

	if (window.feather) {
		feather.replace();
	}
});
</script>

<?php include("../inc/bottom.php"); ?>