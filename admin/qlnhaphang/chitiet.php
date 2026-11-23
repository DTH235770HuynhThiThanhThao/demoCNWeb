<?php include("../inc/top.php"); ?>

<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
	<div>
		<a href="index.php" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="arrow-left"></i>
			<span>&larr; Quay lại danh sách nhập hàng</span>
		</a>
	</div>
	<div class="d-flex align-items-center gap-2">
		<button type="button" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1" onclick="window.print()">
			<i class="align-middle" data-feather="printer"></i>
			<span>In phiếu nhập</span>
		</button>
		<a href="index.php?action=them" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="plus-circle"></i>
			<span>Lập phiếu mới</span>
		</a>
	</div>
</div>

<?php 
$ma_pn = sprintf("PN%05d", $pn["id"]);
$tong_sl_may = 0;
foreach($chitiet as $c){
	$tong_sl_may += (int)$c["soluong"];
}
?>

<!-- THÔNG TIN CHUNG PHIẾU NHẬP -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
		<div class="d-flex align-items-center gap-2">
			<i class="align-middle text-primary" data-feather="file-text"></i>
			<h4 class="fw-bold mb-0 text-dark">Chi tiết phiếu nhập: <span class="text-primary"><?= $ma_pn ?></span></h4>
		</div>
		<span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6 rounded-pill">
			<i class="align-middle me-1" data-feather="check-circle" style="width: 14px; height: 14px;"></i>Đã nhập kho thành công
		</span>
	</div>

	<div class="card-body p-4">
		<div class="row g-4">
			<div class="col-md-6">
				<table class="table table-sm table-borderless mb-0">
					<tr>
						<th class="text-muted fw-normal" style="width: 150px;">Nhà cung cấp:</th>
						<td><strong class="text-dark fs-6"><?= htmlspecialchars($pn["nhacungcap"]) ?></strong></td>
					</tr>
					<tr>
						<th class="text-muted fw-normal">Thời gian nhập:</th>
						<td>
							<i class="align-middle me-1 text-muted" data-feather="calendar" style="width: 13px; height: 13px;"></i>
							<strong><?= date("d/m/Y H:i:s", strtotime($pn["ngaynhap"])) ?></strong>
						</td>
					</tr>
					<tr>
						<th class="text-muted fw-normal">Ghi chú kho:</th>
						<td><?= !empty($pn["ghichu"]) ? htmlspecialchars($pn["ghichu"]) : "<span class='text-muted fst-italic'>Không có ghi chú</span>" ?></td>
					</tr>
				</table>
			</div>

			<div class="col-md-6">
				<table class="table table-sm table-borderless mb-0">
					<tr>
						<th class="text-muted fw-normal" style="width: 150px;">Người lập phiếu:</th>
						<td><strong class="text-dark"><?= htmlspecialchars($pn["hoten"] ?? "Quản trị viên") ?></strong></td>
					</tr>
					<tr>
						<th class="text-muted fw-normal">Email liên hệ:</th>
						<td><?= htmlspecialchars($pn["email"] ?? "admin@shop.com") ?></td>
					</tr>
					<tr>
						<th class="text-muted fw-normal">Số điện thoại:</th>
						<td><?= htmlspecialchars($pn["sodienthoai"] ?? "Chưa cập nhật") ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- BẢNG CHI TIẾT CÁC MẶT HÀNG NHẬP -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center gap-2">
			<i class="align-middle text-success" data-feather="box"></i>
			<h5 class="fw-bold mb-0 text-dark">Danh sách điện thoại trong phiếu nhập</h5>
		</div>
		<span class="badge bg-primary fs-6 px-3 py-1 rounded-pill">
			<?= count($chitiet) ?> dòng sản phẩm &bull; <?= number_format($tong_sl_may) ?> máy
		</span>
	</div>

	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light text-secondary text-uppercase small text-center">
					<tr>
						<th style="width: 50px;">STT</th>
						<th style="width: 70px;">Hình ảnh</th>
						<th class="text-start">Mặt hàng điện thoại</th>
						<th class="text-end" style="width: 170px;">Giá nhập</th>
						<th class="text-center" style="width: 130px;">Số lượng nhập</th>
						<th class="text-end" style="width: 180px;">Thành tiền</th>
						<th class="text-center" style="width: 130px;">Tồn kho hiện tại</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$stt = 0;
				foreach($chitiet as $c): 
					$stt++;
					$img_src = !empty($c["hinhanh"]) ? "../../" . $c["hinhanh"] : "../../images/products/a1.jpg";
				?>
				<tr>
					<td class="text-center fw-bold text-muted"><?= $stt ?></td>
					<td class="text-center">
						<img src="<?= $img_src ?>" 
						     alt="<?= htmlspecialchars($c["tenmathang"]) ?>" 
						     class="rounded border bg-white p-1" 
						     style="width: 48px; height: 48px; object-fit: contain;"
						     onerror="this.src='../../images/products/a1.jpg';">
					</td>
					<td>
						<div class="fw-bold text-dark fs-6"><?= htmlspecialchars($c["tenmathang"]) ?></div>
						<div class="small text-muted mt-1">
							<span class="badge bg-light text-dark border">Mã: <?= sprintf("SP-%03d", $c["mathang_id"]) ?></span>
							<span class="ms-2">Giá niêm yết bán lẻ: <strong class="text-primary"><?= number_format($c["giaban"]) ?>đ</strong></span>
						</div>
					</td>
					<td class="text-end fw-semibold text-dark">
						<?= number_format($c["gianhap"], 0, ',', '.') ?>đ
					</td>
					<td class="text-center">
						<span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-1 rounded-pill fw-bold fs-6">
							<?= number_format($c["soluong"]) ?> máy
						</span>
					</td>
					<td class="text-end fw-bold text-danger fs-6">
						<?= number_format($c["thanhtien"], 0, ',', '.') ?>đ
					</td>
					<td class="text-center">
						<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
							<?= (int)$c["soluongton"] ?> máy
						</span>
					</td>
				</tr>
				<?php endforeach; ?>
				</tbody>
				<tfoot class="table-light">
					<tr>
						<td colspan="4" class="text-end fw-bold py-3 fs-6">Tổng cộng:</td>
						<td class="text-center py-3">
							<span class="badge bg-primary fs-6 px-3 py-2 rounded-pill"><?= number_format($tong_sl_may) ?> máy</span>
						</td>
						<td class="text-end py-3">
							<span class="text-danger fw-bold fs-4"><?= number_format($pn["tongtien"], 0, ',', '.') ?>đ</span>
						</td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center">
		<a href="index.php" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="arrow-left"></i>
			<span>&larr; Quay lại danh sách nhập hàng</span>
		</a>
		<a href="index.php?action=them" class="btn btn-primary d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="plus"></i>
			<span>Lập phiếu nhập mới</span>
		</a>
	</div>
</div>

<?php include("../inc/bottom.php"); ?>
