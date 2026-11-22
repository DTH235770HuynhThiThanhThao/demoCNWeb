<?php include("../inc/top.php"); ?>

<h3>Quản lý mặt hàng</h3> 
<br>
<a href="index.php?action=them" class="btn btn-info">
	<i class="align-middle" data-feather="plus-circle"></i> 
	Thêm mặt hàng
</a>
<br> <br> 
<table class="table table-hover">
	<tr>
		<th>Tên mặt hàng</th>
		<th>Giá bán</th>
		<th>Số lượng</th>
		<th>Hình ảnh</th>
		<th>Thao tác</th>
	</tr>
	<?php foreach($mathang as $m): ?>
	<tr>
		<td>
			<a href="index.php?action=chitiet&id=<?php echo $m["id"]; ?>" class="fw-bold text-dark text-decoration-none">
				<?php echo $m["tenmathang"]; ?>
			</a>
			<div class="mt-1 d-flex flex-wrap gap-1">
				<?php if(!empty($m["phienban"])): ?>
					<span class="badge bg-light text-primary border" title="Phiên bản dung lượng">
						<i class="align-middle me-1" data-feather="hard-drive" style="width: 12px; height: 12px;"></i><?php echo htmlspecialchars($m["phienban"]); ?>
					</span>
				<?php endif; ?>
				<?php if(!empty($m["mausac"])): ?>
					<span class="badge bg-light text-secondary border" title="Màu sắc">
						<i class="align-middle me-1" data-feather="disc" style="width: 12px; height: 12px;"></i><?php echo htmlspecialchars($m["mausac"]); ?>
					</span>
				<?php endif; ?>
			</div>
		</td>
		<td><span class="text-danger fw-bold"><?php echo number_format($m["giaban"]); ?>đ</span></td>
		<td><?php echo $m["soluongton"]; ?></td>
		<td>
			<a href="index.php?action=chitiet&id=<?php echo $m["id"]; ?>">
				<img src="../../<?php echo $m["hinhanh"]; ?>" width="80" class="img-thumbnail">
			</a>
		</td>
		<td>
			<a class="btn btn-info btn-sm me-1" href="index.php?action=chitiet&id=<?php echo $m["id"]; ?>" title="Xem chi tiết">
				<i class="align-middle" data-feather="eye"></i>
			</a>
			<a class="btn btn-warning btn-sm me-1" href="index.php?action=sua&id=<?php echo $m["id"]; ?>" title="Sửa">
				<i class="align-middle" data-feather="edit"></i>
			</a>
			<a class="btn btn-danger btn-sm" href="index.php?action=xoa&id=<?php echo $m["id"]; ?>" title="Xóa">
				<i class="align-middle" data-feather="trash-2"></i>
			</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php include("../inc/bottom.php"); ?>
