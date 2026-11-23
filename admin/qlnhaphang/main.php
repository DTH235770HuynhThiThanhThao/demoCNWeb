<?php include("../inc/top.php"); ?>

<?php
$tab_hien_tai = isset($tab) ? $tab : "tonkho";
?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
	<div>
		<h3 class="fw-bold mb-1 text-info"><i class="align-middle me-2" data-feather="download-cloud"></i>Quản lý tồn kho & nhập hàng</h3>
		<p class="text-muted small mb-0">Theo dõi chi tiết số lượng tồn kho thực tế, đối soát nhập - bán và lịch sử nhập hàng của Thảo Mobile</p>
	</div>
	<a href="index.php?action=them" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
		<i class="align-middle" data-feather="plus-circle"></i> 
		<span>Lập phiếu nhập mới</span>
	</a>
</div>

<?php if(isset($_GET["msg"]) && $_GET["msg"] == "them_ok"): ?>
	<div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
		<i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
		<div>
			<strong>Nhập kho thành công!</strong> Phiếu nhập <strong><?= sprintf("PN%05d", (int)($_GET["id"] ?? 0)) ?></strong> đã được lưu và hệ thống đã <strong>tự động cộng dồn số lượng tồn kho</strong> cho các mẫu điện thoại.
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<!-- HÀNG 1 — 4 THẺ THỐNG KÊ TỔNG QUAN -->
<div class="row g-3 mb-4">
	<!-- Thẻ 1: Tổng máy tồn kho -->
	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm h-100 mb-0">
			<div class="card-body p-3 d-flex align-items-center">
				<div class="flex-shrink-0 bg-primary-subtle text-primary p-3 rounded-3 me-3">
					<i class="align-middle" data-feather="package" style="width: 26px; height: 26px;"></i>
				</div>
				<div>
					<div class="text-muted small">Tổng máy tồn kho</div>
					<h3 class="fw-bold mb-0 text-dark"><?= number_format($thongketon["tongmayton"] ?? 0) ?> <span class="fs-6 fw-normal text-muted">máy</span></h3>
				</div>
			</div>
		</div>
	</div>

	<!-- Thẻ 2: Cảnh báo sắp hết / Hết hàng -->
	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm h-100 mb-0">
			<div class="card-body p-3 d-flex align-items-center">
				<div class="flex-shrink-0 bg-warning-subtle text-warning p-3 rounded-3 me-3">
					<i class="align-middle" data-feather="alert-triangle" style="width: 26px; height: 26px;"></i>
				</div>
				<div>
					<div class="text-muted small">Cảnh báo sắp hết (≤15)</div>
					<h3 class="fw-bold mb-0 text-warning">
						<?= number_format($thongketon["maysaphet"] ?? 0) ?> <span class="fs-6 fw-normal text-muted">mẫu máy</span>
					</h3>
					<?php if(!empty($thongketon["mayhethang"])): ?>
						<small class="text-danger fw-bold"><i class="align-middle" data-feather="x-circle" style="width:12px;height:12px;"></i> <?= $thongketon["mayhethang"] ?> mẫu đã hết hàng</small>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Thẻ 3: Tổng phiếu nhập -->
	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm h-100 mb-0">
			<div class="card-body p-3 d-flex align-items-center">
				<div class="flex-shrink-0 bg-info-subtle text-info p-3 rounded-3 me-3">
					<i class="align-middle" data-feather="file-text" style="width: 26px; height: 26px;"></i>
				</div>
				<div>
					<div class="text-muted small">Tổng phiếu nhập kho</div>
					<h3 class="fw-bold mb-0 text-info"><?= count($phieunhap) ?> <span class="fs-6 fw-normal text-muted">phiếu</span></h3>
				</div>
			</div>
		</div>
	</div>

	<!-- Thẻ 4: Tổng giá trị nhập kho -->
	<div class="col-sm-6 col-xl-3">
		<div class="card border-0 shadow-sm h-100 mb-0">
			<div class="card-body p-3 d-flex align-items-center">
				<div class="flex-shrink-0 bg-danger-subtle text-danger p-3 rounded-3 me-3">
					<i class="align-middle" data-feather="dollar-sign" style="width: 26px; height: 26px;"></i>
				</div>
				<div>
					<div class="text-muted small">Tổng giá trị nhập kho</div>
					<h4 class="fw-bold mb-0 text-danger text-truncate" title="<?= number_format($tongtiennhap ?? 0, 0, ',', '.') ?>đ">
						<?= number_format($tongtiennhap ?? 0, 0, ',', '.') ?>đ
					</h4>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- HÀNG 2 — THANH CHUYỂN TAB -->
<div class="card border-0 shadow-sm mb-3">
	<div class="card-body p-2">
		<!-- Hai nút Tab nổi bật -->
		<ul class="nav nav-pills" id="tabKhoNhap" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link fw-semibold px-3 py-2 d-flex align-items-center gap-2 <?= $tab_hien_tai === 'tonkho' ? 'active' : '' ?>" 
				        id="tab-tonkho-btn" 
				        data-bs-toggle="pill" 
				        data-bs-target="#tab-tonkho" 
				        type="button" 
				        role="tab">
					<i class="align-middle" data-feather="layers" style="width:16px;height:16px;"></i>
					<span>Tồn kho hiện tại</span>
					<span class="badge bg-secondary-subtle text-dark border ms-1"><?= count($dastonkho) ?></span>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link fw-semibold px-3 py-2 d-flex align-items-center gap-2 <?= $tab_hien_tai === 'phieunhap' ? 'active' : '' ?>" 
				        id="tab-phieunhap-btn" 
				        data-bs-toggle="pill" 
				        data-bs-target="#tab-phieunhap" 
				        type="button" 
				        role="tab">
					<i class="align-middle" data-feather="clock" style="width:16px;height:16px;"></i>
					<span>Lịch sử phiếu nhập</span>
					<span class="badge bg-secondary-subtle text-dark border ms-1"><?= count($phieunhap) ?></span>
				</button>
			</li>
		</ul>
	</div>
</div>

<!-- NỘI DUNG 2 TAB -->
<div class="tab-content" id="tabKhoNhapContent">

	<!-- ========================================== -->
	<!-- TAB 1: TỒN KHO HIỆN TẠI                    -->
	<!-- ========================================== -->
	<div class="tab-pane fade <?= $tab_hien_tai === 'tonkho' ? 'show active' : '' ?>" id="tab-tonkho" role="tabpanel">
		<!-- Bộ lọc tìm kiếm & mức tồn kho -->
		<div class="card border-0 shadow-sm mb-3">
			<div class="card-body py-2 px-3">
				<form method="GET" action="index.php" class="row g-2 align-items-center">
					<input type="hidden" name="action" value="danhsach">
					<input type="hidden" name="tab" value="tonkho">

					<!-- Ô tìm kiếm tên máy / mã SP -->
					<div class="col-12 col-md-5">
						<div class="input-group input-group-sm">
							<span class="input-group-text bg-light"><i class="align-middle" data-feather="search" style="width:14px;height:14px;"></i></span>
							<input type="text" class="form-control" name="tukhoa" placeholder="Tìm theo tên điện thoại, mã SP, hãng..." value="<?= htmlspecialchars($tukhoa ?? '') ?>">
						</div>
					</div>

					<!-- Dropdown lọc mức tồn kho -->
					<div class="col-12 col-md-4">
						<select name="muctonkho" class="form-select form-select-sm">
							<option value="tatca" <?= (!isset($muctonkho) || $muctonkho === 'tatca') ? 'selected' : '' ?>>-- Tất cả mức tồn kho --</option>
							<option value="hethang" <?= (isset($muctonkho) && $muctonkho === 'hethang') ? 'selected' : '' ?>>Hết hàng (Tồn = 0)</option>
							<option value="saphet" <?= (isset($muctonkho) && $muctonkho === 'saphet') ? 'selected' : '' ?>>Sắp hết hàng (Tồn ≤ 15)</option>
							<option value="conhang" <?= (isset($muctonkho) && $muctonkho === 'conhang') ? 'selected' : '' ?>>Còn nhiều hàng (Tồn > 15)</option>
						</select>
					</div>

					<!-- Nút Lọc và Xóa lọc -->
					<div class="col-12 col-md-3 d-flex gap-2">
						<button type="submit" class="btn btn-sm btn-outline-primary flex-fill d-inline-flex align-items-center justify-content-center">
							<i class="align-middle me-1" data-feather="filter" style="width:13px;height:13px;"></i>Lọc
						</button>
						<a href="index.php?tab=tonkho" class="btn btn-sm btn-outline-secondary flex-fill text-center">Xóa lọc</a>
					</div>
				</form>
			</div>
		</div>

		<!-- Bảng Tồn kho thực tế -->
		<div class="card border-0 shadow-sm">
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover align-middle mb-0" id="bangTonKho">
						<thead class="table-light text-secondary text-uppercase small">
							<tr>
								<th class="ps-3 py-3 text-center" style="width: 90px;">Mã SP</th>
								<th class="py-3" style="min-width: 250px;">Tên điện thoại</th>
								<th class="py-3 text-end" style="width: 140px;">Giá bán</th>
								<th class="py-3 text-center" style="width: 120px;">Tổng nhập</th>
								<th class="py-3 text-center" style="width: 120px;">Đã bán</th>
								<th class="py-3 text-center" style="width: 150px;">Tồn kho thực tế</th>
								<th class="pe-3 py-3 text-center" style="width: 130px;">Thao tác</th>
							</tr>
						</thead>
						<tbody>
						<?php if(empty($dastonkho)): ?>
							<tr>
								<td colspan="7" class="text-center py-5 text-muted">
									<i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 42px; height: 42px; opacity: 0.4;"></i>
									<div class="fw-semibold">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</div>
									<div class="small"><a href="index.php?tab=tonkho">Bấm vào đây để xem tất cả</a></div>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach($dastonkho as $sp): 
								$ton = (int)$sp["soluongton"];
								$tong_nhap = (int)$sp["tongnhap"];
								$da_ban = (int)$sp["daban"];
								$ma_sp = sprintf("SP-%03d", $sp["id"]);
							?>
							<tr>
								<!-- 1. Mã SP -->
								<td class="ps-3 py-3 text-center fw-bold text-secondary font-monospace">
									<?= $ma_sp ?>
								</td>

								<!-- 2. Tên điện thoại + Ảnh + Hãng -->
								<td class="py-3">
									<?php
									$hinh_anh = $sp['hinhanh'] ?? 'images/products/a1.jpg';
									if(strpos($hinh_anh, 'images/') === false){
										$hinh_anh = 'images/products/' . $hinh_anh;
									}
									?>
									<div class="d-flex align-items-center gap-2">
										<img src="../../<?= htmlspecialchars($hinh_anh) ?>"
										     onerror="this.src='../../images/products/a1.jpg'"
										     alt="" style="width: 40px; height: 40px; object-fit: contain; border-radius: 6px; border: 1px solid #dee2e6; background: #fff; padding: 2px; flex-shrink: 0;">
										<div>
											<div class="fw-bold text-dark" style="font-size: 0.9rem; line-height: 1.3;">
												<?= htmlspecialchars($sp["tenmathang"]) ?>
											</div>
											<?php if(!empty($sp["tenhang"])): ?>
												<span class="badge bg-secondary-subtle text-secondary border px-2 py-0" style="font-size: 0.7rem;">
													<?= htmlspecialchars($sp["tenhang"]) ?>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</td>

								<!-- 3. Giá bán -->
								<td class="py-3 text-end fw-semibold text-dark">
									<?= number_format($sp["giaban"], 0, ',', '.') ?>đ
								</td>

								<!-- 4. Tổng nhập -->
								<td class="py-3 text-center">
									<span class="fw-semibold text-secondary">
										<?= number_format($tong_nhap) ?>
									</span>
								</td>

								<!-- 5. Đã bán -->
								<td class="py-3 text-center">
									<span class="fw-bold text-primary">
										<?= number_format($da_ban) ?>
									</span>
								</td>

								<!-- 6. Tồn kho thực tế -->
								<td class="py-3 text-center">
									<?php if($ton == 0): ?>
										<div class="text-danger fw-bold fs-5 mb-0">0</div>
										<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0" style="font-size: 0.72rem;">
											Hết hàng
										</span>
									<?php elseif($ton <= 15): ?>
										<div class="text-warning fw-bold fs-5 mb-0" style="color: #d39e00 !important;"><?= $ton ?></div>
										<span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-0" style="font-size: 0.72rem; color: #856404 !important;">
											Sắp hết
										</span>
									<?php else: ?>
										<div class="text-success fw-bold fs-5 mb-0"><?= $ton ?></div>
										<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0" style="font-size: 0.72rem;">
											Còn hàng
										</span>
									<?php endif; ?>
								</td>

								<!-- 7. Thao tác -->
								<td class="pe-3 py-3 text-center">
									<a href="index.php?action=them&mathang_id=<?= $sp['id'] ?>" 
									   class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 text-nowrap shadow-sm"
									   title="Lập phiếu nhập thêm hàng cho mẫu máy này">
										<i class="align-middle" data-feather="plus" style="width: 14px; height: 14px;"></i>
										<span>Nhập thêm</span>
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

	<!-- ========================================== -->
	<!-- TAB 2: LỊCH SỬ PHIẾU NHẬP                 -->
	<!-- ========================================== -->
	<div class="tab-pane fade <?= $tab_hien_tai === 'phieunhap' ? 'show active' : '' ?>" id="tab-phieunhap" role="tabpanel">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-end align-items-center">
				<div class="d-flex align-items-center gap-2" style="max-width: 380px; width: 100%;">
					<div class="input-group input-group-sm">
						<span class="input-group-text bg-light"><i class="align-middle" data-feather="search" style="width: 14px; height: 14px;"></i></span>
						<input type="text" id="inputTimKiemPN" class="form-control" placeholder="Tìm kiếm nhanh mã phiếu, nhà cung cấp, người lập..." onkeyup="locBangPhieuNhap()">
					</div>
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
									<i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.4;"></i>
									<div class="fw-semibold">Chưa có phiếu nhập hàng nào.</div>
									<div class="small">Bấm vào nút "Lập phiếu nhập mới" để tiến hành nhập hàng vào kho.</div>
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
									   class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center p-2 shadow-sm" 
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
