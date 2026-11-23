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
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">THÊM MẶT HÀNG MỚI</h3>
                            <p class="text-muted small mb-0 mt-1">Nhập thông tin sản phẩm, cấu hình bộ nhớ, màu sắc và hình ảnh vào hệ thống</p>
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

<!-- 2. Form thêm mặt hàng -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
        <div class="section-accent-bar"></div>
        <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
            Thông tin điện thoại
        </h5>
    </div>
    <div class="card-body px-4 pt-1 pb-4">
        <form method="post" enctype="multipart/form-data" action="index.php">
            <input type="hidden" name="action" value="xulythem">
            
            <div class="row g-3">
                <!-- Hãng sản xuất -->
                <div class="col-md-6">
                    <label for="optdanhmuc" class="form-label fw-semibold small text-muted mb-1">Hãng sản xuất <span class="text-danger">*</span></label>
                    <select class="form-select shadow-none" name="optdanhmuc" id="optdanhmuc" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        <?php foreach($danhmuc as $d): ?>
                            <option value="<?php echo $d["id"]; ?>"><?php echo htmlspecialchars($d["tendanhmuc"]); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tên mặt hàng -->
                <div class="col-md-6">
                    <label for="txttenmathang" class="form-label fw-semibold small text-muted mb-1">Tên mặt hàng <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="text" name="txttenmathang" id="txttenmathang" placeholder="VD: iPhone 16 Pro Max 256GB..." required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Giá nhập -->
                <div class="col-md-4">
                    <label for="txtgianhap" class="form-label fw-semibold small text-muted mb-1">Giá nhập (VNĐ)</label>
                    <input class="form-control shadow-none" type="number" name="txtgianhap" id="txtgianhap" value="0" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Giá bán -->
                <div class="col-md-4">
                    <label for="txtgiaban" class="form-label fw-semibold small text-muted mb-1">Giá bán niêm yết (VNĐ) <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="number" name="txtgiaban" id="txtgiaban" value="0" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Số lượng tồn -->
                <div class="col-md-4">
                    <label for="txtsoluong" class="form-label fw-semibold small text-muted mb-1">Số lượng tồn kho <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="number" name="txtsoluong" id="txtsoluong" value="0" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                </div>

                <!-- Phiên bản (Dung lượng) -->
                <div class="col-md-6">
                    <label for="txtphienban" class="form-label fw-semibold small text-muted mb-1">Phiên bản (Dung lượng)</label>
                    <input class="form-control shadow-none" type="text" id="txtphienban" name="txtphienban" placeholder="Ví dụ: 128GB, 256GB, 512GB..." style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                    <small class="text-muted" style="font-size: 12px;">Nhập các mức dung lượng cách nhau bằng dấu phẩy.</small>
                </div>

                <!-- Màu sắc sản phẩm -->
                <div class="col-md-6">
                    <label for="txtmausac" class="form-label fw-semibold small text-muted mb-1">Màu sắc sản phẩm</label>
                    <input class="form-control shadow-none" type="text" id="txtmausac" name="txtmausac" placeholder="Ví dụ: Đen, Trắng, Titan Tự Nhiên..." style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                    <small class="text-muted" style="font-size: 12px;">Nhập các tên màu tương ứng thứ tự ảnh màu tải lên.</small>
                </div>

                <!-- Ảnh đại diện chính -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Ảnh đại diện chính <span class="text-danger">*</span></label>
                    <input class="form-control shadow-none" type="file" name="filehinhanh" accept="image/*" required style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                    <small class="text-muted" style="font-size: 12px;">Ảnh hiển thị đại diện ngoài danh sách sản phẩm.</small>
                </div>

                <!-- Thư viện ảnh màu -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">Ảnh các màu sắc khác (Thư viện ảnh màu)</label>
                    <input class="form-control shadow-none" type="file" name="filethuvienanh[]" multiple accept="image/*" style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;">
                    <small class="text-muted" style="font-size: 12px;">Có thể chọn nhiều file ảnh tương ứng từng phiên bản màu.</small>
                </div>

                <!-- Mô tả chi tiết -->
                <div class="col-12">
                    <label for="txtmota" class="form-label fw-semibold small text-muted mb-1">Mô tả sản phẩm <span class="text-danger">*</span></label>
                    <textarea id="txtmota" class="form-control shadow-none" name="txtmota" rows="4" placeholder="Nhập mô tả tính năng nổi bật, thông số kỹ thuật..." required style="border-radius: 8px; border-color: #cbd5e1; font-size: 13.5px;"></textarea>
                </div>
            </div>

            <!-- Nút bấm -->
            <div class="mt-4 pt-2 d-flex gap-2.5">
                <button type="submit" class="btn btn-flagship-red px-4 py-2 d-inline-flex align-items-center">
                    <i class="align-middle me-2" data-feather="save" style="width: 16px; height: 16px;"></i>Lưu sản phẩm
                </button>
                <a href="index.php" class="btn btn-cancel px-4 py-2">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>