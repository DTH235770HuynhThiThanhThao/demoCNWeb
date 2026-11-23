<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, sạch sẽ */
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
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">LẬP PHIẾU TIẾP NHẬN BẢO HÀNH</h3>
                            <p class="text-muted small mb-0 mt-1">Ghi nhận thông tin thiết bị, tình trạng lỗi và thời hạn bảo hành của khách hàng</p>
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

<?php if(!empty($thongbao_loi)): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-3 d-flex align-items-center" role="alert">
    <i class="align-middle me-2" data-feather="alert-circle"></i>
    <div><?= htmlspecialchars($thongbao_loi) ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="row g-4 mb-4">
    <!-- Panel trái: Form nhập liệu -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                    Thông tin tiếp nhận bảo hành
                </h5>
            </div>
            <div class="card-body px-4 pt-1 pb-4">
                <form method="POST" action="index.php?action=xulythem" id="formBaoHanh">

                    <!-- Chọn nhanh từ đơn hàng đã mua -->
                    <div class="mb-4 p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <label class="form-label fw-bold text-dark small mb-1.5 d-flex align-items-center">
                            <i class="align-middle me-1.5 text-danger" data-feather="zap" style="width: 15px; height: 15px;"></i>
                            <span>Gợi ý: Chọn nhanh từ Đơn hàng đã mua (không bắt buộc)</span>
                        </label>
                        <select id="chonDonHang" name="donhang_id" class="form-select shadow-none" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
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
                        <small class="text-muted mt-1.5 d-block" style="font-size: 12px;">
                            <i class="align-middle me-1" data-feather="info" style="width: 12px; height: 12px;"></i>Khi chọn đơn hàng: Họ tên, Số điện thoại, Ngày mua và Hạn bảo hành (+12 tháng) sẽ tự động điền.
                        </small>
                    </div>

                    <div class="row g-3">
                        <!-- Họ tên khách -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted mb-1">Họ tên khách hàng <span class="text-danger">*</span></label>
                            <input type="text" name="tenkhachhang" id="tenkhachhang" class="form-control shadow-none"
                                   placeholder="VD: Nguyễn Văn A..."
                                   value="<?= htmlspecialchars($_POST['tenkhachhang'] ?? '') ?>" required
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        </div>

                        <!-- Số điện thoại -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted mb-1">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="sodienthoai" id="sodienthoai" class="form-control shadow-none"
                                   placeholder="VD: 0912345678"
                                   value="<?= htmlspecialchars($_POST['sodienthoai'] ?? '') ?>" required
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        </div>

                        <!-- Chọn thiết bị -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted mb-1">Thiết bị cần bảo hành <span class="text-danger">*</span></label>
                            <select name="mathang_id" id="mathang_id" class="form-select shadow-none" required style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
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
                            <label class="form-label fw-semibold small text-muted mb-1">Số IMEI / Serial máy</label>
                            <input type="text" name="soimei" id="soimei" class="form-control shadow-none font-monospace"
                                   placeholder="Nhập 15 số IMEI hoặc số serial..."
                                   value="<?= htmlspecialchars($_POST['soimei'] ?? '') ?>"
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                            <small class="text-muted" style="font-size: 12px;">Hỗ trợ khách tra cứu nhanh trên website bằng IMEI</small>
                        </div>

                        <!-- Ngày mua -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-muted mb-1">Ngày mua</label>
                            <input type="date" name="ngaymua" id="ngaymua" class="form-control shadow-none"
                                   value="<?= htmlspecialchars($_POST['ngaymua'] ?? '') ?>"
                                   max="<?= date('Y-m-d') ?>"
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        </div>

                        <!-- Hạn bảo hành -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-muted mb-1">Hạn bảo hành</label>
                            <input type="date" name="hanbaohanh" id="hanbaohanh" class="form-control shadow-none"
                                   value="<?= htmlspecialchars($_POST['hanbaohanh'] ?? '') ?>"
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                            <small class="text-danger fw-semibold" style="font-size: 11.5px;">+12 tháng mặc định</small>
                        </div>

                        <!-- Tình trạng lỗi -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-muted mb-1">Tình trạng lỗi máy <span class="text-danger">*</span></label>
                            <textarea name="tinhtrangloi" id="tinhtrangloi" class="form-control shadow-none" rows="3"
                                      placeholder="Mô tả cụ thể lỗi mang đến: Sọc màn hình, chai pin nhanh hết, hỏng mic đàm thoại, không nhận sạc..."
                                      required style="border-radius: 8px; border-color: #cbd5e1; font-size: 13.5px;"><?= htmlspecialchars($_POST['tinhtrangloi'] ?? '') ?></textarea>
                        </div>

                        <!-- Ghi chú / Chi phí -->
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-muted mb-1">Ghi chú linh kiện / Chi phí ước tính</label>
                            <input type="text" name="ghichu" class="form-control shadow-none"
                                   placeholder="Chi phí nếu ngoài phạm vi bảo hành hoặc linh kiện dự kiến thay thế..."
                                   value="<?= htmlspecialchars($_POST['ghichu'] ?? '') ?>"
                                   style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                        </div>
                    </div>

                    <div class="mt-4 pt-2 d-flex gap-2.5">
                        <button type="submit" class="btn btn-flagship-red px-4 py-2 d-inline-flex align-items-center">
                            <i class="align-middle me-2" data-feather="save" style="width: 16px; height: 16px;"></i>Lưu phiếu bảo hành
                        </button>
                        <a href="index.php" class="btn btn-cancel px-4 py-2">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Panel phải: Hướng dẫn & Quy trình -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 mb-3">
            <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                    Hướng dẫn lập phiếu
                </h5>
            </div>
            <div class="card-body px-4 pt-1 pb-3 small text-muted">
                <p class="mb-2"><i class="align-middle me-1.5 text-success" data-feather="check-circle" style="width: 14px; height: 14px;"></i><strong>Cách 1:</strong> Chọn đơn hàng từ ô gợi ý để tự điền Họ tên, SĐT và Ngày mua.</p>
                <p class="mb-3"><i class="align-middle me-1.5 text-success" data-feather="check-circle" style="width: 14px; height: 14px;"></i><strong>Cách 2:</strong> Điền trực tiếp thông tin khách mang máy đến sửa chữa tại quầy.</p>
                <hr class="my-2.5" style="border-color: #f1f5f9;">
                <p class="fw-semibold text-dark mb-1">Các thông tin bắt buộc:</p>
                <ul class="ps-3 mb-2.5" style="line-height: 1.6;">
                    <li>Họ tên khách hàng</li>
                    <li>Số điện thoại liên hệ</li>
                    <li>Dòng máy cần bảo hành</li>
                    <li>Mô tả chi tiết tình trạng lỗi</li>
                </ul>
                <div class="p-2.5 rounded-3 text-dark small" style="background-color: #fee2e2; border: 1px solid #fecaca; font-size: 12px;">
                    <i class="align-middle me-1 text-danger" data-feather="shield" style="width: 14px; height: 14px;"></i>Thời hạn bảo hành chuẩn tại <strong>Thảo Mobile</strong> là <strong>12 tháng</strong> kể từ ngày mua.
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 15px;">
                    5 Giai đoạn xử lý bảo hành
                </h5>
            </div>
            <div class="card-body px-4 pt-1 pb-3">
                <div class="d-flex flex-column gap-2 small">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; min-width: 85px; font-size: 11px;">Chờ tiếp nhận</span>
                        <span class="text-muted">Kiểm tra, chẩn đoán lỗi máy</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; min-width: 85px; font-size: 11px;">Đang sửa</span>
                        <span class="text-muted">Sửa chữa hoặc gửi hãng thẩm định</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; min-width: 85px; font-size: 11px;">Chờ trả khách</span>
                        <span class="text-muted">Đã test máy, chờ khách đến nhận</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; min-width: 85px; font-size: 11px;">Đã trả khách</span>
                        <span class="text-muted">Đã bàn giao máy tận tay khách</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; min-width: 85px; font-size: 11px;">Từ chối BH</span>
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