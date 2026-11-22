<?php include("../inc/top.php"); ?>
<div>
<h3>Cập nhật mặt hàng</h3>
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="xulysua">
<input type="hidden" name="txtid" value="<?php echo $m["id"]; ?>">
<div class="my-3">    
	<label>Hãng sản xuất</label>    
	<select class="form-control" name="optdanhmuc">
		<?php foreach ($danhmuc as $dm ) { ?>
			<option value="<?php echo $dm["id"]; ?>" <?php if($dm["id"] == $m["danhmuc_id"]) echo "selected"; ?>><?php echo $dm["tendanhmuc"]; ?></option>
		<?php } ?>
	</select>
</div>
<div class="my-3">    
	<label>Tên hàng</label>    
	<input class="form-control" type="text" name="txttenhang" required value="<?php echo $m["tenmathang"]; ?>">
</div> 
<div class="my-3">    
	<label>Mô tả</label>    
	<textarea class="form-control" name="txtmota" id="txtmota" required><?php echo $m["mota"]; ?></textarea>
</div> 
<div class="my-3">    
	<label>Giá gốc</label>    
	<input class="form-control" type="number" name="txtgiagoc" value="<?php echo $m["giagoc"]; ?>" required>
</div> 
<div class="my-3">    
	<label>Giá bán</label>    
	<input class="form-control" type="number" name="txtgiaban" value="<?php echo $m["giaban"]; ?>" required>
</div> 
<div class="my-3">    
	<label>Số lượng tồn</label>    
	<input class="form-control" type="number" name="txtsoluongton" value="<?php echo $m["soluongton"]; ?>" required>
	</div> 
<div class="my-3">    
	<label>Lượt xem</label>    
	<input class="form-control" type="number" name="txtluotxem" value="<?php echo $m["luotxem"]; ?>" required>
</div> 
<div class="my-3">    
	<label>Lượt mua</label>    
	<input class="form-control" type="number" name="txtluotmua" value="<?php echo $m["luotmua"]; ?>" required>
</div> 
<div class="my-3">    
	<label class="form-label fw-bold">Phiên bản (Dung lượng)</label>    
	<input class="form-control" type="text" name="txtphienban" value="<?php echo htmlspecialchars($m["phienban"] ?? ""); ?>" placeholder="Ví dụ: 128GB, 256GB, 512GB — nhập cách nhau bằng dấu phẩy">
	<div class="form-text text-muted">Nhập các mức dung lượng của máy (ví dụ: 128GB, 256GB, 512GB).</div>
</div>
<div class="my-3">    
	<label class="form-label fw-bold">Màu sắc sản phẩm</label>    
	<input class="form-control" type="text" name="txtmausac" value="<?php echo htmlspecialchars($m["mausac"] ?? ""); ?>" placeholder="Ví dụ: Đen, Trắng, Xanh Dương — nhập các màu cách nhau bằng dấu phẩy">
	<div class="form-text text-muted">Nhập danh sách tên màu sắc thực tế của sản phẩm tương ứng với ảnh chính và ảnh thư viện bên dưới.</div>
</div>
<div class="my-3">
	<label class="form-label fw-bold">Ảnh đại diện chính</label><br>
	<input type="hidden" name="txthinhcu" value="<?php echo $m["hinhanh"]; ?>">
	<div class="d-flex align-items-center gap-3 mb-2">
		<img src="../../<?php echo $m["hinhanh"]; ?>" width="65" height="65" style="object-fit: contain;" class="img-thumbnail rounded" alt="Ảnh chính">	
		<a class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#demo">
			<i class="align-middle me-1" data-feather="edit-2"></i>Đổi ảnh chính
		</a>
	</div>
	<div id="demo" class="collapse mt-2">
	  <input type="file" class="form-control" name="filehinhanh" accept="image/*">
	</div>
</div>

<div class="my-3">
	<label class="form-label fw-bold">Ảnh các màu sắc khác (Thư viện ảnh màu)</label>
	<input type="hidden" name="txtthuvienanhcu" id="txtthuvienanhcu" value="<?php echo htmlspecialchars($m["thuvienanh"] ?? ""); ?>">
	
	<?php 
	$ds_anh_cu = array();
	if(!empty($m["thuvienanh"])){
		$raw_list = explode(",", $m["thuvienanh"]);
		foreach($raw_list as $img_item){
			$img_item = trim($img_item);
			if(!empty($img_item)){
				$ds_anh_cu[] = $img_item;
			}
		}
	}
	?>

	<div id="gallery-container" class="d-flex flex-wrap gap-2 mb-2">
		<?php if(!empty($ds_anh_cu)): ?>
			<?php foreach($ds_anh_cu as $img_file): 
				$src_file = (strpos($img_file, "images/") === 0) ? "../../" . $img_file : "../../images/products/" . $img_file;
			?>
				<div class="gallery-item-card position-relative border rounded p-1 bg-white shadow-sm text-center" style="width: 85px;" data-file="<?php echo htmlspecialchars($img_file); ?>">
					<img src="<?php echo $src_file; ?>" style="width: 70px; height: 70px; object-fit: contain;" class="rounded" alt="Ảnh màu">
					<button type="button" class="btn btn-danger btn-sm py-0 px-1 position-absolute top-0 end-0 rounded-circle" style="line-height: 1; transform: translate(30%, -30%); font-size: 11px;" onclick="xoaAnhThuvien(this, '<?php echo htmlspecialchars(addslashes($img_file)); ?>')" title="Xóa ảnh này">×</button>
					<div class="small text-muted text-truncate" style="font-size: 10px;" title="<?php echo htmlspecialchars($img_file); ?>"><?php echo htmlspecialchars($img_file); ?></div>
					<label class="small text-danger d-block mt-1 mb-0" style="font-size: 11px; cursor: pointer;">
						<input type="checkbox" name="chk_xoa_anh[]" value="<?php echo htmlspecialchars($img_file); ?>" onchange="xoaQuaCheckbox(this, '<?php echo htmlspecialchars(addslashes($img_file)); ?>')"> Xóa
					</label>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="text-muted small fst-italic" id="no-gallery-msg">Chưa có ảnh màu phụ nào được lưu.</div>
		<?php endif; ?>
	</div>

	<div class="mt-2">
		<label class="form-label small text-muted">Chọn thêm ảnh màu mới (nếu có):</label>
		<input type="file" class="form-control" name="filethuvienanh[]" multiple accept="image/*">
		<div class="form-text text-muted">Có thể chọn tải lên nhiều ảnh màu cùng lúc.</div>
	</div>
</div>

<div class="my-3">
<input class="btn btn-primary"  type="submit" value="Lưu">
<input class="btn btn-warning"  type="reset" value="Hủy">
</div>
</form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#txtmota' ) )
        .catch( error => {
            console.error( error );
        } );

    function xoaQuaCheckbox(chk, fileName) {
        if(chk.checked) {
            xoaAnhThuvien(chk, fileName);
        }
    }

    function xoaAnhThuvien(btn, fileName) {
        var card = btn.closest('.gallery-item-card');
        if (card) {
            card.remove();
        }
        var hiddenInput = document.getElementById('txtthuvienanhcu');
        if (hiddenInput) {
            var currentFiles = hiddenInput.value.split(',').map(function(s){ return s.trim(); }).filter(function(s){ return s.length > 0; });
            var newFiles = currentFiles.filter(function(item) {
                return item !== fileName;
            });
            hiddenInput.value = newFiles.join(', ');
            var container = document.getElementById('gallery-container');
            if (container && container.querySelectorAll('.gallery-item-card').length === 0) {
                container.innerHTML = '<div class="text-muted small fst-italic" id="no-gallery-msg">Đã xóa hết ảnh màu phụ.</div>';
            }
        }
    }
</script>

<?php include("../inc/bottom.php"); ?>