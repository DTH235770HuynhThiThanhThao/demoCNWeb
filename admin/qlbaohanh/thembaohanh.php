<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-info fw-bold mb-0"><i class="align-middle me-2" data-feather="plus-circle"></i>Lập phiếu tiếp nhận bảo hành</h3>
    <a href="index.php" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="align-middle" data-feather="arrow-left" style="width:15px;height:15px;"></i> Quay lại danh sách
    </a>
</div>

<?php if(!empty($thongbao_loi)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="align-middle me-2" data-feather="alert-circle"></i> <?= htmlspecialchars($thongbao_loi) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row g-4">
    <!-- Panel trái: Form nhập liệu -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light fw-semibold py-2">
                <i class="align-middle me-2" data-feather="file-text" style="width:16px;height:16px;"></i>Thông tin tiếp nhận bảo hành
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?action=xulythem" id="formBaoHanh">

                    <!-- Chọn nhanh từ đơn hàng đã mua -->
                    <div class="mb-4 p-3 bg-light rounded border border-primary border-opacity-25">
                        <label class="form-label fw-bold text-primary mb-1">
                            <i class="align-middle me-1" data-feather="zap" style="width:15px;height:15px;"></i>Gợi ý: Chọn nhanh từ Đơn hàng đã mua (không bắt buộc)
                        </label>
                        <select id="chonDonHang" name="donhang_id" class="form-select">
                            <option value="">-- Nhập thông tin thủ công hoặc chọn đơn hàng để tự điền --</option>
                            <?php if(!empty($danhsachdonhang)): ?>
                            <?php foreach($danhsachdonhang as $don): ?>
                            <option value="<?= $don['id'] ?>"
                                    data-hoten="<?= htmlspecialchars($don['hoten'] ?? '') ?>"
                                    data-sdt="<?= htmlspecialchars($don['sodienthoai'] ?? '') ?>"
                                    data-ngaymua="<?= date('Y-m-d', strtotime($don['ngay'])) ?>">
                                <?= sprintf("DH%06d", $don['id']) ?> — <?= htmlspecialchars($don['hoten'] ?? 'Khách lẻ') ?> (<?= htmlspecialchars($don['sodienthoai'] ?? '') ?>) — Ngày: <?= date("d/m/Y", strtotime($don['ngay'])) ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <small class="text-muted mt-1 d-block"><i class="align-middle me-1" data-feather="info" style="width:12px;height:12px;"></i>Khi chọn đơn hàng: Họ tên, Số điện thoại, Ngày mua và Hạn bảo hành (+12 tháng) sẽ tự động điền.</small>
                    </div>

                    <div class="row g-3">
                        <!-- Họ tên khách -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Họ tên khách hàng <span class="text-danger">*</span></label>
                            <input type="text" name="tenkhachhang" id="tenkhachhang" class="form-control"
                                   placeholder="VD: Nguyễn Văn A..."
                                   value="<?= htmlspecialchars($_POST['tenkhachhang'] ?? '') ?>" required>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="sodienthoai" id="sodienthoai" class="form-control"
                                   placeholder="VD: 0912345678"
                                   value="<?= htmlspecialchars($_POST['sodienthoai'] ?? '') ?>" required>
                        </div>

                        <!-- Chọn thiết bị -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Thiết bị cần bảo hành <span class="text-danger">*</span></label>
                            <select name="mathang_id" id="mathang_id" class="form-select" required>
                                <option value="">-- Chọn dòng điện thoại cần bảo hành --</option>
                                <?php if(!empty($danhsachmathang)): ?>
                                <?php foreach($danhsachmathang as $may): ?>
                                <option value="<?= $may['id'] ?>" <?= (isset($_POST['mathang_id']) && $_POST['mathang_id'] == $may['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($may['tenmathang']) ?> (Giá: <?= number_format($may['giaban']) ?>đ)
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Số IMEI -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số IMEI / Serial máy</label>
                            <input type="text" name="soimei" id="soimei" class="form-control"
                                   placeholder="Nhập 15 số IMEI hoặc số serial..."
                                   value="<?= htmlspecialchars($_POST['soimei'] ?? '') ?>">
                            <small class="text-muted">Hỗ trợ khách tra cứu nhanh trên website bằng IMEI</small>
                        </div>

                        <!-- Ngày mua -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Ngày mua</label>
                            <input type="date" name="ngaymua" id="ngaymua" class="form-control"
                                   value="<?= htmlspecialchars($_POST['ngaymua'] ?? '') ?>"
                                   max="<?= date('Y-m-d') ?>">
                        </div>

                        <!-- Hạn bảo hành -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Hạn bảo hành</label>
                            <input type="date" name="hanbaohanh" id="hanbaohanh" class="form-control"
                                   value="<?= htmlspecialchars($_POST['hanbaohanh'] ?? '') ?>">
                            <small class="text-primary fw-semibold">+12 tháng mặc định</small>
                        </div>

                        <!-- Tình trạng lỗi -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Tình trạng lỗi máy <span class="text-danger">*</span></label>
                            <textarea name="tinhtrangloi" id="tinhtrangloi" class="form-control" rows="3"
                                      placeholder="Mô tả cụ thể lỗi mang đến: Sọc màn hình, chai pin nhanh hết, hỏng mic đàm thoại, không nhận sạc..."
                                      required><?= htmlspecialchars($_POST['tinhtrangloi'] ?? '') ?></textarea>
                        </div>

                        <!-- Ghi chú / Chi phí -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Ghi chú linh kiện / Chi phí ước tính</label>
                            <input type="text" name="ghichu" class="form-control"
                                   placeholder="Chi phí nếu ngoài phạm vi bảo hành hoặc linh kiện dự kiến thay thế..."
                                   value="<?= htmlspecialchars($_POST['ghichu'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center">
                            <i class="align-middle me-2" data-feather="save"></i>Lưu phiếu bảo hành
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Panel phải: Hướng dẫn & Quy trình -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-primary bg-opacity-10 fw-semibold py-2 text-primary">
                <i class="align-middle me-2" data-feather="info" style="width:15px;height:15px;"></i>Hướng dẫn lập phiếu
            </div>
            <div class="card-body small text-muted">
                <p class="mb-2"><i class="align-middle me-1 text-success" data-feather="check-circle" style="width:14px;height:14px;"></i><strong>Cách 1:</strong> Chọn đơn hàng từ ô chọn nhanh để tự điền Họ tên, SĐT và Ngày mua.</p>
                <p class="mb-3"><i class="align-middle me-1 text-success" data-feather="check-circle" style="width:14px;height:14px;"></i><strong>Cách 2:</strong> Điền trực tiếp thông tin khách mang máy đến sửa chữa tại quầy.</p>
                <hr>
                <p class="fw-semibold text-dark mb-1">Các thông tin bắt buộc:</p>
                <ul class="ps-3 mb-2">
                    <li>Họ tên khách hàng</li>
                    <li>Số điện thoại liên hệ</li>
                    <li>Dòng máy cần bảo hành</li>
                    <li>Mô tả chi tiết tình trạng lỗi</li>
                </ul>
                <div class="p-2 bg-light rounded text-info small">
                    <i class="align-middle me-1" data-feather="shield" style="width:13px;height:13px;"></i>Thời hạn bảo hành chuẩn tại <strong>Thảo Mobile</strong> là <strong>12 tháng</strong> kể từ ngày mua.
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-light fw-semibold py-2 small">
                <i class="align-middle me-2" data-feather="activity" style="width:15px;height:15px;"></i>5 Giai đoạn xử lý bảo hành
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-column gap-2 small">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-secondary" style="min-width:75px;">Tiếp nhận</span>
                        <span class="text-muted">Kiểm tra, chẩn đoán lỗi máy</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-warning text-dark" style="min-width:75px;">Đang sửa</span>
                        <span class="text-muted">Sửa chữa hoặc gửi hãng thẩm định</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-info text-white" style="min-width:75px;">Đã sửa xong</span>
                        <span class="text-muted">Đã test máy, chờ khách đến nhận</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success" style="min-width:75px;">Đã trả</span>
                        <span class="text-muted">Đã bàn giao máy tận tay khách</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-danger" style="min-width:75px;">Từ chối</span>
                        <span class="text-muted">Máy rơi vỡ / ngấm nước / hết hạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tự điền thông tin khi chọn đơn hàng
document.getElementById('chonDonHang').addEventListener('change', function(){
    var opt = this.options[this.selectedIndex];
    if(!opt.value) return;

    var hoten = opt.getAttribute('data-hoten') || '';
    var sdt   = opt.getAttribute('data-sdt') || '';
    var ngaymua = opt.getAttribute('data-ngaymua') || '';

    if(hoten) document.getElementById('tenkhachhang').value = hoten;
    if(sdt)   document.getElementById('sodienthoai').value  = sdt;

    if(ngaymua){
        document.getElementById('ngaymua').value = ngaymua;
        var d = new Date(ngaymua);
        d.setFullYear(d.getFullYear() + 1);
        var yyyy = d.getFullYear();
        var mm   = String(d.getMonth() + 1).padStart(2, '0');
        var dd   = String(d.getDate()).padStart(2, '0');
        document.getElementById('hanbaohanh').value = yyyy + '-' + mm + '-' + dd;
    }
});

// Tự tính hạn bảo hành khi nhập ngày mua
document.getElementById('ngaymua').addEventListener('change', function(){
    if(!this.value) return;
    var d = new Date(this.value);
    d.setFullYear(d.getFullYear() + 1);
    var yyyy = d.getFullYear();
    var mm   = String(d.getMonth() + 1).padStart(2, '0');
    var dd   = String(d.getDate()).padStart(2, '0');
    document.getElementById('hanbaohanh').value = yyyy + '-' + mm + '-' + dd;
});
</script>

<?php include("../inc/bottom.php"); ?>
