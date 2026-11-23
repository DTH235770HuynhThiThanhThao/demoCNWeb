<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, thanh thoát */
.brand-title-bar {
    width: 5px;
    height: 38px;
    background-color: #d70018;
    border-radius: 4px;
    margin-right: 14px;
    flex-shrink: 0;
}
.section-accent-bar {
    width: 4px;
    height: 20px;
    background-color: #d70018;
    border-radius: 3px;
    margin-right: 10px;
    flex-shrink: 0;
}
.btn-flagship-red {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship-red:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-cancel {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-cancel:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
</style>

<!-- 1. Thanh tiêu đề & Nút quay lại -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">CẬP NHẬT MẶT HÀNG</h3>
                            <p class="text-muted small mb-0 mt-1">Chỉnh sửa thông tin, giá bán, phiên bản dung lượng và hình ảnh của sản phẩm</p>
                        </div>
                    </div>
                    <div>
                        <a href="index.php" class="btn btn-sm btn-cancel d-inline-flex align-items-center px-3 py-2">
                            <i class="align-middle me-1.5" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
                            <span>Quay lại danh sách</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Form cập nhật mặt hàng -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
        <div class="section-accent-bar"></div>
        <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
            Thông tin: <?= htmlspecialchars($m["tenmathang"]) ?> (#SP-<?= sprintf('%03d', $m["id"]) ?>)
        </h5>
    </div>
    <div class="card-body px-4 pt-1 pb-4">
        <form method="post" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="xulysua">
            <input type="hidden" name="txtid" value="<?php echo $m["id"]; ?>">

            <div class="row g-3">
                <!-- Hãng sản xuất -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Hãng sản xuất <span class="text-danger">*</span></label>
                    <select class="form-select shadow-none" name="optdanhmuc" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        <?php foreach ($danhmuc as $dm) { ?>
                            <option value="<?php echo $dm["id"]; ?>" <?php if($dm["id"] == $m["danhmuc_id"]) echo "selected"; ?>><?php echo htmlspecialchars($dm["tendanhmuc"]); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Tên mặt hàng -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Tên mặt hàng <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="text" name="txttenhang" required value="<?php echo htmlspecialchars($m["tenmathang"]); ?>" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Giá gốc -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold small text-muted mb-1">Giá gốc (niêm yết) <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="number" name="txtgiagoc" value="<?php echo $m["giagoc"]; ?>" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Giá bán -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold small text-muted mb-1">Giá bán hiện tại <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="number" name="txtgiaban" value="<?php echo $m["giaban"]; ?>" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Số lượng tồn -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold small text-muted mb-1">Số lượng tồn kho <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="number" name="txtsoluongton" value="<?php echo $m["soluongton"]; ?>" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Lượt xem -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Lượt xem</label>
                    <input class="form-control shadow-none" type="number" name="txtluotxem" value="<?php echo $m["luotxem"]; ?>" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Lượt mua -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Lượt mua</label>
                    <input class="form-control shadow-none" type="number" name="txtluotmua" value="<?php echo $m["luotmua"]; ?>" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Phiên bản (Dung lượng) -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Phiên bản (Dung lượng)</label>
                    <input class="form-control shadow-none" type="text" name="txtphienban" value="<?php echo htmlspecialchars($m["phienban"] ?? ""); ?>" placeholder="Ví dụ: 128GB, 256GB, 512GB..." style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                    <small class="text-muted" style="font-size: 12px;">Nhập các mức dung lượng của máy cách nhau bằng dấu phẩy.</small>
                </div>

                <!-- Màu sắc sản phẩm -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Màu sắc sản phẩm</label>
                    <input class="form-control shadow-none" type="text" name="txtmausac" value="<?php echo htmlspecialchars($m["mausac"] ?? ""); ?>" placeholder="Ví dụ: Đen, Trắng, Xanh Dương..." style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                    <small class="text-muted" style="font-size: 12px;">Nhập danh sách tên màu sắc thực tế tương ứng với ảnh bên dưới.</small>
                </div>

                <!-- Ảnh đại diện chính -->
                <div class="col-12">
                    <label class="form-label fw-semibold small text-muted mb-1">Ảnh đại diện chính</label>
                    <input type="hidden" name="txthinhcu" value="<?php echo $m["hinhanh"]; ?>">
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <img src="../../<?php echo $m["hinhanh"]; ?>" width="64" height="64" style="object-fit: contain;" class="rounded-3 border bg-white p-1 shadow-sm" alt="Ảnh chính" onerror="this.src='../../images/products/a1.jpg'">
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#boxDoiAnhChinh" style="border-radius: 8px; font-size: 12.5px;">
                                <i class="align-middle me-1" data-feather="edit-2" style="width: 13px; height: 13px;"></i>Đổi ảnh chính
                            </button>
                            <div class="text-muted small mt-1" style="font-size: 12px;">Ảnh hiển thị đại diện ngoài danh sách sản phẩm.</div>
                        </div>
                    </div>
                    <div id="boxDoiAnhChinh" class="collapse mt-2">
                        <input type="file" class="form-control shadow-none" name="filehinhanh" accept="image/*" style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                    </div>
                </div>

                <!-- Thư viện ảnh màu -->
                <div class="col-12">
                    <label class="form-label fw-semibold small text-muted mb-1">Ảnh các màu sắc khác (Thư viện ảnh màu)</label>
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

                    <div id="gallery-container" class="d-flex flex-wrap gap-2.5 p-3 rounded-3 mb-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <?php if(!empty($ds_anh_cu)): ?>
                            <?php foreach($ds_anh_cu as $img_file): 
                                $src_file = (strpos($img_file, "images/") === 0) ? "../../" . $img_file : "../../images/products/" . $img_file;
                            ?>
                                <div class="gallery-item-card position-relative border rounded-3 p-1 bg-white shadow-sm text-center" style="width: 86px;" data-file="<?php echo htmlspecialchars($img_file); ?>">
                                    <img src="<?php echo $src_file; ?>" style="width: 72px; height: 72px; object-fit: contain;" class="rounded" alt="Ảnh màu" onerror="this.src='../../images/products/a1.jpg'">
                                    <button type="button" class="btn btn-danger btn-sm py-0 px-1 position-absolute top-0 end-0 rounded-circle" style="line-height: 1; transform: translate(30%, -30%); font-size: 11px; width: 20px; height: 20px;" onclick="xoaAnhThuvien(this, '<?php echo htmlspecialchars(addslashes($img_file)); ?>')" title="Xóa ảnh này">×</button>
                                    <div class="small text-muted text-truncate mt-1" style="font-size: 10px;" title="<?php echo htmlspecialchars($img_file); ?>"><?php echo htmlspecialchars($img_file); ?></div>
                                    <label class="small text-danger d-block mt-0.5 mb-0" style="font-size: 11px; cursor: pointer;">
                                        <input type="checkbox" name="chk_xoa_anh[]" value="<?php echo htmlspecialchars($img_file); ?>" onchange="xoaQuaCheckbox(this, '<?php echo htmlspecialchars(addslashes($img_file)); ?>')"> Xóa
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted small fst-italic" id="no-gallery-msg">Chưa có ảnh màu phụ nào được lưu.</div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-2">
                        <label class="form-label small text-muted mb-1">Chọn thêm ảnh màu mới (nếu có):</label>
                        <input type="file" class="form-control shadow-none" name="filethuvienanh[]" multiple accept="image/*" style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                        <small class="text-muted" style="font-size: 12px;">Có thể chọn tải lên nhiều ảnh màu cùng lúc.</small>
                    </div>
                </div>

                <!-- Mô tả chi tiết -->
                <div class="col-12">
                    <label class="form-label fw-semibold small text-muted mb-1">Mô tả sản phẩm <span class="text-danger">*</span></label>
                    <textarea class="form-control shadow-none" name="txtmota" id="txtmota" rows="5" required style="border-radius: 8px; border-color: #cbd5e1; font-size: 13.5px;"><?php echo htmlspecialchars($m["mota"]); ?></textarea>
                </div>
            </div>

            <!-- Nút bấm -->
            <div class="mt-4 pt-2 d-flex gap-2.5">
                <button type="submit" class="btn btn-flagship-red px-4 py-2 d-inline-flex align-items-center">
                    <i class="align-middle me-2" data-feather="save" style="width: 16px; height: 16px;"></i>Lưu thay đổi
                </button>
                <a href="index.php" class="btn btn-cancel px-4 py-2">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<script>
    if(typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create( document.querySelector( '#txtmota' ) )
            .catch( error => {
                console.error( error );
            } );
    }

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