<?php include("../inc/top.php"); ?>

<h3 class="text-info">Danh sách danh mục</h3> 
<br>

<a class="btn btn-info mb-3" data-bs-toggle="collapse" data-bs-target="#demo">
	<i class="align-middle" data-feather="plus-circle"></i> Thêm danh mục
</a>

<div id="demo" class="collapse mb-4">
	<div class="card card-body bg-light">
		<form method="post"> 
			<input type="hidden" name="action" value="them">
			<div class="row g-2 align-items-center">	
				<div class="col-auto">
					<label class="col-form-label fw-semibold">Tên danh mục mới:</label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" name="ten" placeholder="Nhập tên danh mục..." required>
				</div>
				<div class="col-auto">
					<input type="submit" class="btn btn-info" value="Lưu danh mục">
				</div>
			</div>
		</form>
	</div>
</div>

<table class="table table-hover">
	<tr>
		<th style="width: 15%;">ID</th>
		<th style="width: 60%;">Tên danh mục</th>
		<th style="width: 25%;">Thao tác</th>
	</tr>
	<?php 
	foreach ($danhmuc as $d) : 
		if($d["id"] == $idsua){ // hiển thị form
	?>
		<tr>
		<form method="post">
			<input type="hidden" name="action" value="capnhat">
			<input type="hidden" name="id" value="<?php echo $d["id"]; ?>">
			<td><?php echo $d["id"]; ?></td>
			<td><input class="form-control" name="ten" type="text" value="<?php echo $d["tendanhmuc"]; ?>" required></td>
			<td>
				<input class="btn btn-success btn-sm me-1" type="submit" value="Lưu">
				<a href="index.php" class="btn btn-secondary btn-sm">Hủy</a>
			</td>
		</form>
		</tr>

	<?php 
		} // end if 
		else {
	?>
		<tr>
			<td><?php echo $d["id"]; ?></td>
			<td><?php echo $d["tendanhmuc"]; ?></td>
			<td>
				<a class="btn btn-warning btn-sm me-1" href="index.php?action=sua&id=<?php echo $d["id"]; ?>" title="Sửa">
					<i class="align-middle" data-feather="edit"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="index.php?action=xoa&id=<?php echo $d["id"]; ?>" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
					<i class="align-middle" data-feather="trash-2"></i>
				</a>
			</td>
		</tr>
	<?php 
		} // end else
	endforeach; 
	?>
</table>

<?php include("../inc/bottom.php"); ?>
