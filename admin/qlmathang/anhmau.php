<?php include("../inc/top.php"); ?>
<?php 
$from_bienthe = (isset($_GET["from"]) && $_GET["from"] === "bienthe"); 
$url_from_param = $from_bienthe ? "&from=bienthe" : "";
?>

<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
	<div>
		<?php if($from_bienthe): ?>
			<a href="index.php?action=bienthe&id=<?= $m['id'] ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
				<i class="align-middle" data-feather="arrow-left"></i>
				<span>← Trở về cấu hình biến thể</span>
			</a>
		<?php else: ?>
			<a href="index.php" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
				<i class="align-middle" data-feather="arrow-left"></i>
				<span>Trở về danh sách mặt hàng</span>
			</a>
		<?php endif; ?>
	</div>
	<div class="d-flex align-items-center gap-2">
		<a href="index.php?action=bienthe&id=<?= $m['id'] ?>" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="sliders"></i>
			<span>Quản lý biến thể</span>
		</a>
		<a href="../../public/index.php?action=detail&id=<?= $m['id'] ?>" target="_blank" class="btn btn-outline-success btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="external-link"></i>
			<span>Xem trên Web</span>
		</a>
	</div>
</div>

<?php if(isset($_GET["msg"])): ?>
	<?php if($_GET["msg"] == "them_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
			<i class="align-middle me-2" data-feather="check-circle"></i>
			<div>Đã tải thêm ảnh vào thư viện thành công!</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif($_GET["msg"] == "xoa_ok"): ?>
		<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
			<i class="align-middle me-2" data-feather="check-circle"></i>
			<div>Đã xóa ảnh khỏi thư viện thành công!</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
<?php endif; ?>

<!-- Thẻ thông tin mặt hàng -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-body p-3">
		<div class="d-flex align-items-center gap-3">
			<img src="../../<?= $m["hinhanh"] ?>" 
			     alt="<?= htmlspecialchars($m["tenmathang"]) ?>" 
			     class="rounded border bg-white p-1" 
			     style="width: 72px; height: 72px; object-fit: contain;"
			     onerror="this.src='../../images/products/a1.jpg';">
			<div>
				<div class="d-flex align-items-center gap-2 flex-wrap">
					<span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold"><?= sprintf("SP-%03d", $m["id"]) ?></span>
					<span class="badge bg-light text-secondary border"><?= htmlspecialchars($m["tendanhmuc"] ?? "Điện thoại") ?></span>
				</div>
				<h4 class="fw-bold mb-1 mt-1 text-dark"><?= htmlspecialchars($m["tenmathang"]) ?></h4>
				<div class="small text-muted">
					<?php 
					$ds_mau = !empty($m["mausac"]) ? array_filter(array_map('trim', explode(',', $m["mausac"]))) : [];
					?>
					<span>Màu sắc đã cấu hình: </span>
					<?php if(!empty($ds_mau)): ?>
						<?php foreach($ds_mau as $idx_ms => $ten_ms): ?>
							<span class="badge bg-light text-dark border me-1"><?= ($idx_ms + 1) ?>. <?= htmlspecialchars($ten_ms) ?></span>
						<?php endforeach; ?>
					<?php else: ?>
						<span class="text-danger fst-italic">Chưa có danh sách màu sắc. <a href="index.php?action=bienthe&id=<?= $m['id'] ?>">Thêm màu sắc ngay</a></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
// Xử lý danh sách ảnh phụ
$ds_anh_phu = array();
if(!empty($m["thuvienanh"])){
	$raw_tv = explode(",", $m["thuvienanh"]);
	foreach($raw_tv as $it){
		$it = trim($it);
		if(!empty($it)) $ds_anh_phu[] = $it;
	}
}
?>

<div class="row g-4">
	<!-- 1. CỘT TRÁI: DANH SÁCH ẢNH HIỆN CÓ CỦA MÁY -->
	<div class="col-lg-8">
		<div class="card border-0 shadow-sm mb-4">
			<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center gap-2">
					<i class="align-middle text-success" data-feather="image"></i>
					<h5 class="fw-bold mb-0 text-dark">Thư viện ảnh màu hiện có</h5>
				</div>
				<span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill">
					<?= count($ds_anh_phu) ?> ảnh màu phụ
				</span>
			</div>
			<div class="card-body p-4">
				<!-- Khung ảnh đại diện chính -->
				<div class="mb-4 p-3 bg-light rounded border">
					<div class="d-flex align-items-center justify-content-between mb-2">
						<span class="badge bg-primary px-2 py-1"><i class="align-middle me-1" data-feather="star" style="width: 12px; height: 12px;"></i>Ảnh đại diện chính (Mặc định)</span>
						<span class="small text-muted"><?= htmlspecialchars($m["hinhanh"]) ?></span>
					</div>
					<div class="d-flex align-items-center gap-3">
						<img src="../../<?= $m["hinhanh"] ?>" class="rounded border bg-white p-2" style="width: 90px; height: 90px; object-fit: contain;" alt="Ảnh chính" onerror="this.src='../../images/products/a1.jpg';">
						<div>
							<div class="fw-bold text-dark">Ảnh hiển thị chính thức trên toàn hệ thống</div>
							<div class="small text-muted mt-1">Ảnh này sẽ đại diện cho sản phẩm ngoài trang chủ, trang danh mục và là màu sắc đầu tiên khi khách vào xem chi tiết.</div>
						</div>
					</div>
				</div>

				<!-- Lưới các ảnh phụ (Thư viện ảnh theo màu) -->
				<h6 class="fw-bold text-dark mb-3">Các ảnh màu phụ (Hiển thị khi khách bấm chọn màu tương ứng):</h6>
				<?php if(!empty($ds_anh_phu)): ?>
					<div class="row row-cols-2 row-cols-md-3 g-3">
						<?php foreach($ds_anh_phu as $idx_anh => $file_anh): 
							$src_anh = (strpos($file_anh, "images/") === 0) ? "../../" . $file_anh : "../../images/products/" . $file_anh;
							$ten_mau_tuongung = isset($ds_mau[$idx_anh]) ? $ds_mau[$idx_anh] : ("Màu " . ($idx_anh + 1));
						?>
							<div class="col">
								<div class="card h-100 border text-center p-2 shadow-sm position-relative">
									<!-- Nút Xóa ảnh phụ -->
									<a href="index.php?action=xoaanhmau&id=<?= $m['id'] ?>&file=<?= urlencode($file_anh) ?><?= $url_from_param ?>" 
									   class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" 
									   style="width: 26px; height: 26px; line-height: 1;" 
									   onclick="return confirm('Bạn có chắc muốn xóa ảnh <?= htmlspecialchars($file_anh) ?> khỏi thư viện?');" 
									   title="Xóa ảnh này">
										&times;
									</a>

									<div class="p-2 bg-white rounded d-flex align-items-center justify-content-center" style="height: 130px;">
										<img src="<?= $src_anh ?>" 
										     alt="Ảnh màu <?= ($idx_anh + 1) ?>" 
										     style="max-width: 100%; max-height: 120px; object-fit: contain;" 
										     onerror="this.src='../../images/products/a1.jpg';">
									</div>

									<div class="card-body p-2 border-top mt-2">
										<span class="badge bg-light text-primary border mb-1">
											#<?= ($idx_anh + 1) ?>: <?= htmlspecialchars($ten_mau_tuongung) ?>
										</span>
										<div class="small text-muted text-truncate" title="<?= htmlspecialchars($file_anh) ?>" style="font-size: 11px;">
											<?= htmlspecialchars($file_anh) ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else: ?>
					<div class="text-center py-5 bg-light rounded border">
						<i class="align-middle text-muted mb-2" data-feather="image" style="width: 48px; height: 48px;"></i>
						<p class="text-muted mb-1">Chưa có ảnh màu phụ nào cho điện thoại này.</p>
						<p class="small text-muted mb-0">Hãy chọn tải ảnh từ máy tính ở khung bên phải để thêm thư viện ảnh màu.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- 2. CỘT PHẢI: TẢI THÊM ẢNH MÀU MỚI TỪ MÁY TÍNH -->
	<div class="col-lg-4">
		<div class="card border-0 shadow-sm mb-4">
			<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
				<i class="align-middle text-primary" data-feather="upload-cloud"></i>
				<h5 class="fw-bold mb-0 text-dark">Tải thêm ảnh màu mới</h5>
			</div>
			<div class="card-body p-4">
				<form method="post" action="index.php" enctype="multipart/form-data">
					<input type="hidden" name="action" value="themanhmau">
					<input type="hidden" name="txtid" value="<?= $m["id"] ?>">
					<?php if($from_bienthe): ?>
						<input type="hidden" name="from" value="bienthe">
					<?php endif; ?>

					<div class="mb-3">
						<label class="form-label fw-bold text-dark">Chọn file ảnh từ máy tính:</label>
						<input type="file" class="form-control" name="fileanhmau[]" multiple accept="image/*" required>
						<div class="form-text small text-muted">
							Bạn có thể nhấn giữ phím <kbd>Ctrl</kbd> hoặc <kbd>Shift</kbd> để chọn nhiều ảnh màu cùng một lúc.
						</div>
					</div>

					<div class="alert alert-info py-2 px-3 small mb-3">
						<i class="align-middle me-1" data-feather="info"></i>
						Thứ tự các ảnh được tải lên sẽ lần lượt tương ứng với các màu sắc đã nhập bên phần <strong>Biến thể</strong>.
					</div>

					<button type="submit" class="btn btn-success w-100 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
						<i class="align-middle" data-feather="upload"></i>
						<span>Tải ảnh lên thư viện</span>
					</button>
				</form>
			</div>
		</div>

		<!-- Hướng dẫn đồng bộ -->
		<div class="card border-0 shadow-sm bg-light">
			<div class="card-body p-3 small text-muted">
				<h6 class="fw-bold text-dark mb-2"><i class="align-middle me-1 text-primary" data-feather="help-circle"></i>Lưu ý khi quản lý ảnh màu:</h6>
				<ul class="ps-3 mb-0">
					<li class="mb-1">Ảnh tải lên sẽ được tự động lưu vào thư mục <code>images/products/</code>.</li>
					<li class="mb-1">Khi khách hàng bấm vào từng ô màu sắc ngoài Web, hệ thống sẽ tự động phóng to đúng ảnh của màu đó.</li>
					<li>Bạn có thể xóa ảnh phụ bất kỳ lúc nào bằng nút <strong>&times;</strong> trên góc mỗi ảnh.</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php include("../inc/bottom.php"); ?>
