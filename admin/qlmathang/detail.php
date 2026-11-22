<?php include("../inc/top.php"); ?>

<div class="mb-3">
	<a href="index.php" class="btn btn-secondary btn-sm">
		<i class="align-middle me-1" data-feather="arrow-left"></i>Trở về danh sách
	</a>
</div>

<div class="card shadow-sm border-0 mb-4">
	<div class="card-header bg-white py-3 border-bottom">
		<h3 class="fw-bold text-info mb-1"><?php echo htmlspecialchars($m["tenmathang"]); ?></h3>
		<div class="d-flex flex-wrap gap-2 mt-2">
			<?php if(!empty($m["phienban"])): ?>
				<span class="badge bg-light text-primary border px-2 py-1 fs-6">
					<i class="align-middle me-1" data-feather="hard-drive" style="width: 14px; height: 14px;"></i>Phiên bản: <?php echo htmlspecialchars($m["phienban"]); ?>
				</span>
			<?php endif; ?>
			<?php if(!empty($m["mausac"])): ?>
				<span class="badge bg-light text-secondary border px-2 py-1 fs-6">
					<i class="align-middle me-1" data-feather="disc" style="width: 14px; height: 14px;"></i>Màu sắc: <?php echo htmlspecialchars($m["mausac"]); ?>
				</span>
			<?php endif; ?>
		</div>
	</div>
	<div class="card-body">
		<div class="row g-4">
			<div class="col-md-5 text-center">
				<div class="p-2 border rounded bg-white mb-3">
					<img src="../../<?php echo $m["hinhanh"]; ?>" style="max-width: 100%; max-height: 380px; object-fit: contain;" class="rounded" alt="Ảnh chính">
				</div>

				<?php 
				$ds_tv = array();
				if(!empty($m["thuvienanh"])){
					$arr_raw = explode(",", $m["thuvienanh"]);
					foreach($arr_raw as $it){
						$it = trim($it);
						if(!empty($it)) $ds_tv[] = $it;
					}
				}
				?>
				<?php if(!empty($ds_tv)): ?>
					<div class="text-start">
						<label class="form-label fw-bold text-muted small">Ảnh các phiên bản màu khác:</label>
						<div class="d-flex flex-wrap gap-2">
							<?php foreach($ds_tv as $tv_img): 
								$src_tv = (strpos($tv_img, "images/") === 0) ? "../../" . $tv_img : "../../images/products/" . $tv_img;
							?>
								<img src="<?php echo $src_tv; ?>" style="width: 60px; height: 60px; object-fit: contain;" class="border rounded p-1" title="<?php echo htmlspecialchars($tv_img); ?>">
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-md-7">
				<table class="table table-bordered">
					<tr>
						<th style="width: 180px;" class="table-light">Giá gốc niêm yết:</th>
						<td><span class="text-muted text-decoration-line-through"><?php echo number_format($m["giagoc"]); ?>đ</span></td>
					</tr>
					<tr>
						<th class="table-light">Giá bán hiện tại:</th>
						<td><span class="text-danger fw-bold fs-5"><?php echo number_format($m["giaban"]); ?>đ</span></td>
					</tr>
					<tr>
						<th class="table-light">Phiên bản (Dung lượng):</th>
						<td><strong><?php echo !empty($m["phienban"]) ? htmlspecialchars($m["phienban"]) : "Chưa nhập"; ?></strong></td>
					</tr>
					<tr>
						<th class="table-light">Màu sắc thực tế:</th>
						<td><strong><?php echo !empty($m["mausac"]) ? htmlspecialchars($m["mausac"]) : "Chưa nhập"; ?></strong></td>
					</tr>
					<tr>
						<th class="table-light">Số lượng tồn kho:</th>
						<td><span class="badge bg-secondary"><?php echo $m["soluongton"]; ?></span></td>
					</tr>
					<tr>
						<th class="table-light">Lượt xem / Lượt mua:</th>
						<td><?php echo number_format($m["luotxem"]); ?> lượt xem / <?php echo number_format($m["luotmua"]); ?> lượt mua</td>
					</tr>
				</table>

				<div class="mt-3">
					<h5 class="fw-bold text-muted">Mô tả sản phẩm:</h5>
					<div class="p-3 bg-light rounded border">
						<?php echo $m["mota"]; ?>
					</div>
				</div>

				<div class="mt-4 d-flex gap-2">
					<a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $m["id"]; ?>">
						<i class="align-middle me-1" data-feather="edit"></i>Sửa thông tin
					</a> 
					<a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $m["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa mặt hàng này?');">
						<i class="align-middle me-1" data-feather="trash-2"></i>Xóa
					</a>
					<a class="btn btn-outline-secondary" href="index.php">
						Trở về danh sách
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("../inc/bottom.php"); ?>
