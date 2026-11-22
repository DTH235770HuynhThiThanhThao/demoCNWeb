<?php include("../inc/top.php"); ?>

<h3>Thêm mặt hàng</h3> 
<br>
<form method="post" enctype="multipart/form-data" action="index.php">
<input type="hidden" name="action" value="xulythem">
<div class="mb-3 mt-3">
	<label for="optdanhmuc" class="form-label">Hãng sản xuất</label>
	<select class="form-select" name="optdanhmuc">
	<?php
	foreach($danhmuc as $d):
	?>
		<option value="<?php echo $d["id"]; ?>"><?php echo $d["tendanhmuc"]; ?></option>
	<?php
	endforeach;
	?>
	</select>
</div>
<div class="mb-3 mt-3">
	<label for="txttenmathang" class="form-label">Tên mặt hàng</label>
	<input class="form-control" type="text" name="txttenmathang" placeholder="Nhập tên" required>
</div>
<div class="mb-3 mt-3">
	<label for="txtgianhap" class="form-label">Giá nhập</label>
	<input class="form-control" type="number" name="txtgianhap" value="0">
</div>
<div class="mb-3 mt-3">
	<label for="txtgiaban" class="form-label">Giá bán</label>
	<input class="form-control" type="number" name="txtgiaban" value="0">
</div>
<div class="mb-3 mt-3">
	<label for="txtsoluong" class="form-label">Số lượng</label>
	<input class="form-control" type="number" name="txtsoluong" value="0">
</div>
<div class="mb-3 mt-3">
	<label for="txtmota" class="form-label">Mô tả</label>
	<textarea id="txtmota" class="form-control" name="txtmota" placeholder="Nhập mô tả" required></textarea>
</div>
<div class="mb-3 mt-3">
	<label for="txtphienban" class="form-label fw-bold">Phiên bản (Dung lượng)</label>
	<input class="form-control" type="text" id="txtphienban" name="txtphienban" placeholder="Ví dụ: 128GB, 256GB, 512GB — nhập cách nhau bằng dấu phẩy">
	<div class="form-text text-muted">Nhập các mức dung lượng của máy (ví dụ: 128GB, 256GB, 512GB).</div>
</div>
<div class="mb-3 mt-3">
	<label for="txtmausac" class="form-label fw-bold">Màu sắc sản phẩm</label>
	<input class="form-control" type="text" id="txtmausac" name="txtmausac" placeholder="Ví dụ: Đen, Trắng, Xanh Dương — nhập cách nhau bằng dấu phẩy tương ứng thứ tự ảnh màu bên dưới">
	<div class="form-text text-muted">Nhập danh sách tên màu sắc thực tế của sản phẩm tương ứng với từng hình ảnh màu bên dưới.</div>
</div>
<div class="mb-3 mt-3">
	<label class="form-label">Ảnh đại diện chính</label>
	<input class="form-control" type="file" name="filehinhanh">
	<div class="form-text text-muted">Ảnh hiển thị ngoài danh sách sản phẩm và là màu sắc đầu tiên.</div>
</div>
<div class="mb-3 mt-3">
	<label class="form-label">Ảnh các màu sắc khác (Thư viện ảnh màu)</label>
	<input class="form-control" type="file" name="filethuvienanh[]" multiple accept="image/*">
	<div class="form-text text-muted">Có thể chọn nhiều file ảnh tương ứng với từng phiên bản màu của máy.</div>
</div>
<div class="mb-3 mt-3">
	<input type="submit" value="Lưu" class="btn btn-success">
	<input type="reset" value="Hủy" class="btn btn-warning">
</div>
</form>

<?php include("../inc/bottom.php"); ?>