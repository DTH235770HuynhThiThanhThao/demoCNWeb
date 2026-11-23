<?php include("inc/top.php"); ?>

<!-- Trang Bảo Hành Thảo Mobile -->
<div class="container py-4">

    <!-- Thông báo kết quả thao tác -->
    <?php if(!empty($thongbao_thanhcong)): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3 d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill fs-4 text-success me-3 flex-shrink-0"></i>
        <div class="flex-grow-1">
            <?= $thongbao_thanhcong ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if(!empty($thongbao_loi)): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3 d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-4 text-danger me-3 flex-shrink-0"></i>
        <div class="flex-grow-1">
            <?= htmlspecialchars($thongbao_loi) ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- KHỐI 1 — KHUNG TRA CỨU BẢO HÀNH ĐIỆN TỬ -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden; background: #ffffff;">
        <!-- Thanh nhấn đỏ Flagship -->
        <div style="height: 5px; background: linear-gradient(90deg, #d70018 0%, #ff3b30 100%);"></div>
        
        <div class="card-body p-4 p-md-5">
            <!-- Tiêu đề lớn & mô tả -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm"
                     style="width: 64px; height: 64px; background: #fff1f2; border: 2px solid #fecdd3;">
                    <i class="bi bi-shield-check" style="font-size: 2rem; color: #d70018;"></i>
                </div>
                <h2 class="fw-bold text-uppercase mb-2" style="color: #d70018; letter-spacing: 0.5px;">
                    TRUNG TÂM TRA CỨU & BẢO HÀNH THẢO MOBILE
                </h2>
                <p class="text-secondary mb-0 fw-medium">
                    1 đổi 1 trong 30 ngày đầu • Bảo hành chính hãng 12 tháng • Theo dõi tiến độ sửa chữa trực tuyến
                </p>
            </div>

            <!-- Thanh tìm kiếm tra cứu lớn -->
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <form method="GET" action="index.php" class="mb-2">
                        <input type="hidden" name="action" value="baohanh">
                        <div class="input-group input-group-lg shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1.5px solid #e5e7eb;">
                            <span class="input-group-text bg-white border-0 text-muted ps-3">
                                <i class="bi bi-search" style="color: #d70018; font-size: 1.25rem;"></i>
                            </span>
                            <input type="text"
                                   name="tukhoa"
                                   class="form-control border-0 ps-2"
                                   placeholder="Nhập Số điện thoại, Số IMEI hoặc Mã phiếu (VD: BH00001, 0934567890)..."
                                   value="<?= htmlspecialchars($tukhoa ?? '') ?>"
                                   required
                                   autocomplete="off">
                            <button type="submit" class="btn fw-bold px-4 text-white" style="background-color: #d70018; border: none;">
                                <i class="bi bi-arrow-right-circle me-1"></i> Tra cứu ngay
                            </button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between flex-wrap gap-2 text-muted small px-2">
                        <span><i class="bi bi-info-circle me-1"></i>Hỗ trợ tìm theo: <b>SĐT khách hàng</b>, <b>Số IMEI 15 số</b> hoặc <b>Mã BH</b> (VD: BH00001).</span>
                        <?php if(!empty($tukhoa)): ?>
                        <a href="index.php?action=baohanh" class="text-decoration-none text-danger fw-semibold">
                            <i class="bi bi-x-circle me-1"></i>Xóa tìm kiếm
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- HIỂN THỊ KẾT QUẢ TRA CỨU -->
            <?php if($ketqua_tracuu !== null): ?>
            <div class="mt-4 pt-3 border-top">
                <?php if(empty($ketqua_tracuu)): ?>
                <!-- Không tìm thấy phiếu -->
                <div class="text-center py-5 px-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 bg-light"
                         style="width: 70px; height: 70px;">
                        <i class="bi bi-search text-muted" style="font-size: 2.2rem; opacity: 0.6;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Không tìm thấy thông tin bảo hành phù hợp</h5>
                    <p class="text-muted mb-3" style="max-width: 540px; margin: 0 auto;">
                        Không có kết quả nào khớp với từ khóa "<strong><?= htmlspecialchars($tukhoa) ?></strong>". Quý khách vui lòng kiểm tra lại SĐT/IMEI hoặc gửi yêu cầu bảo hành bên dưới.
                    </p>
                    <a href="#formGuiYeuCau" class="btn btn-outline-danger fw-semibold px-4" style="border-radius: 8px;">
                        <i class="bi bi-pencil-square me-1"></i> Gửi yêu cầu bảo hành mới
                    </a>
                </div>
                <?php else: ?>
                <!-- Có kết quả -->
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>Tìm thấy <?= count($ketqua_tracuu) ?> phiếu bảo hành phù hợp:
                    </h5>
                    <span class="badge bg-light text-secondary border px-3 py-2">Từ khóa: <?= htmlspecialchars($tukhoa) ?></span>
                </div>

                <div class="d-flex flex-column gap-3">
                    <?php foreach($ketqua_tracuu as $bh_item): ?>
                    <?php
                        $tt = (int)($bh_item['trangthai'] ?? 0);
                        $hanbh = $bh_item['hanbaohanh'] ?? null;
                        $conhan = $hanbh && (strtotime($hanbh) >= strtotime(date('Y-m-d')));

                        // Định nghĩa nhãn trạng thái & màu sắc
                        $trangthai_map = [
                            0 => ['ten' => 'Tiếp nhận kiểm tra',       'color' => 'secondary', 'icon' => 'bi-clock-history'],
                            1 => ['ten' => 'Đang sửa chữa / Gửi hãng', 'color' => 'warning',   'icon' => 'bi-tools'],
                            2 => ['ten' => 'Đã sửa xong - Chờ trả khách', 'color' => 'info',   'icon' => 'bi-box-seam'],
                            3 => ['ten' => 'Đã bàn giao khách hàng',   'color' => 'success',   'icon' => 'bi-check2-circle'],
                            4 => ['ten' => 'Từ chối bảo hành / Hết hạn', 'color' => 'danger',  'icon' => 'bi-x-circle-fill']
                        ];
                        $st = $trangthai_map[$tt] ?? $trangthai_map[0];
                    ?>
                    <!-- Khung thẻ kết quả chi tiết từng phiếu -->
                    <div class="card border border-light-subtle shadow-sm p-0" style="border-radius: 12px; overflow: hidden; background: #ffffff;">
                        <!-- Header thẻ phiếu -->
                        <div class="px-3 py-2 d-flex align-items-center justify-content-between flex-wrap gap-2"
                             style="background-color: #fafbfc; border-bottom: 1px solid #f0f2f5;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-danger px-3 py-2 fw-bold fs-6" style="letter-spacing: 0.5px;">
                                    <?= sprintf("BH%05d", $bh_item['id']) ?>
                                </span>
                                <?php if(!empty($bh_item['donhang_id'])): ?>
                                <span class="badge bg-light text-secondary border px-2 py-1">
                                    Đơn hàng: <?= sprintf("DH%06d", $bh_item['donhang_id']) ?>
                                </span>
                                <?php endif; ?>
                                <span class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i>Tiếp nhận: <?= date("d/m/Y H:i", strtotime($bh_item['ngaytiepnhan'])) ?>
                                </span>
                            </div>
                            <div>
                                <span class="badge bg-<?= $st['color'] ?> text-<?= ($st['color'] == 'warning') ? 'dark' : 'white' ?> px-3 py-2 fw-semibold">
                                    <i class="bi <?= $st['icon'] ?> me-1"></i><?= $st['ten'] ?>
                                </span>
                            </div>
                        </div>

                        <!-- Nội dung phiếu -->
                        <div class="card-body p-3 p-md-4">
                            <div class="row g-3 align-items-start">
                                <!-- Cột ảnh & Tên thiết bị -->
                                <div class="col-md-5 d-flex gap-3 align-items-center">
                                    <div class="position-relative flex-shrink-0" style="width: 80px; height: 80px;">
                                        <img src="../images/products/<?= htmlspecialchars(!empty($bh_item['hinhanh']) ? $bh_item['hinhanh'] : 'x1.jpg') ?>"
                                             onerror="this.src='../images/products/x1.jpg'"
                                             alt="<?= htmlspecialchars($bh_item['tenmathang'] ?? 'Điện thoại') ?>"
                                             class="img-fluid rounded-3 border w-100 h-100"
                                             style="object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold text-dark mb-1 fs-6">
                                            <?= htmlspecialchars($bh_item['tenmathang'] ?? 'Điện thoại chính hãng') ?>
                                        </h6>
                                        <?php if(!empty($bh_item['soimei'])): ?>
                                        <div class="text-muted small">
                                            IMEI: <span class="fw-semibold font-monospace text-dark"><?= htmlspecialchars($bh_item['soimei']) ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <div class="mt-1">
                                            <?php if($hanbh): ?>
                                                <?php if($conhan): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle fw-medium">
                                                    <i class="bi bi-shield-check me-1"></i>Còn hạn bảo hành (đến <?= date("d/m/Y", strtotime($hanbh)) ?>)
                                                </span>
                                                <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle fw-medium">
                                                    <i class="bi bi-shield-x me-1"></i>Hết hạn bảo hành (hết ngày <?= date("d/m/Y", strtotime($hanbh)) ?>)
                                                </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary border fw-medium">
                                                    <i class="bi bi-shield me-1"></i>Bảo hành tiêu chuẩn
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cột thông tin khách hàng & ngày mua -->
                                <div class="col-md-7">
                                    <div class="row g-2 small">
                                        <div class="col-sm-6">
                                            <div class="p-2 rounded bg-light">
                                                <span class="text-muted d-block">Khách hàng:</span>
                                                <strong class="text-dark"><i class="bi bi-person me-1 text-danger"></i><?= htmlspecialchars($bh_item['tenkhachhang']) ?></strong>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="p-2 rounded bg-light">
                                                <span class="text-muted d-block">Số điện thoại:</span>
                                                <strong class="text-dark"><i class="bi bi-telephone me-1 text-danger"></i><?= htmlspecialchars($bh_item['sodienthoai']) ?></strong>
                                            </div>
                                        </div>
                                        <?php if(!empty($bh_item['ngaymua'])): ?>
                                        <div class="col-sm-6">
                                            <div class="p-2 rounded bg-light">
                                                <span class="text-muted d-block">Ngày mua máy:</span>
                                                <span class="text-dark fw-semibold"><i class="bi bi-bag-check me-1 text-secondary"></i><?= date("d/m/Y", strtotime($bh_item['ngaymua'])) ?></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-sm-<?= !empty($bh_item['ngaymua']) ? '6' : '12' ?>">
                                            <div class="p-2 rounded bg-light">
                                                <span class="text-muted d-block">Hạn bảo hành:</span>
                                                <span class="text-dark fw-semibold"><i class="bi bi-calendar-event me-1 text-secondary"></i><?= !empty($hanbh) ? date("d/m/Y", strtotime($hanbh)) : '12 tháng chính hãng' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mô tả tình trạng lỗi -->
                                <div class="col-12">
                                    <div class="p-3 rounded-2" style="background-color: #fff8f8; border-left: 4px solid #d70018;">
                                        <div class="fw-semibold text-danger small mb-1">
                                            <i class="bi bi-exclamation-octagon-fill me-1"></i>Tình trạng lỗi tiếp nhận:
                                        </div>
                                        <div class="text-dark small">
                                            <?= nl2br(htmlspecialchars($bh_item['tinhtrangloi'])) ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ghi chú phản hồi từ Kỹ thuật viên (nếu có) -->
                                <?php if(!empty($bh_item['ghichu'])): ?>
                                <div class="col-12">
                                    <div class="p-3 rounded-2" style="background-color: #f0f7ff; border-left: 4px solid #0d6efd;">
                                        <div class="fw-semibold text-primary small mb-1">
                                            <i class="bi bi-wrench-adjustable me-1"></i>Phản hồi & ghi chú kỹ thuật viên Thảo Mobile:
                                        </div>
                                        <div class="text-dark small">
                                            <?= nl2br(htmlspecialchars($bh_item['ghichu'])) ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Thanh tiến trình 4 bước trực quan -->
                                <div class="col-12 pt-2">
                                    <div class="fw-semibold text-dark small mb-3 d-flex align-items-center justify-content-between">
                                        <span><i class="bi bi-activity text-danger me-1"></i>Tiến độ xử lý bảo hành:</span>
                                        <?php if($tt == 4): ?>
                                        <span class="badge bg-danger text-white"><i class="bi bi-x-circle me-1"></i>Phiếu từ chối / Hết hạn</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($tt == 4): ?>
                                    <div class="alert alert-danger py-2 mb-0 small rounded-2">
                                        <i class="bi bi-x-octagon-fill me-2"></i><strong>Từ chối bảo hành:</strong> Thiết bị không đáp ứng điều kiện bảo hành miễn phí (do rơi vỡ, vào nước, can thiệp phần cứng hoặc đã hết hạn BH). Kỹ thuật viên sẽ liên hệ để tư vấn sửa chữa dịch vụ ưu đãi.
                                    </div>
                                    <?php else: ?>
                                    <!-- Stepper 4 bước chuẩn -->
                                    <div class="position-relative py-2 px-2">
                                        <!-- Đường kẻ nền mờ -->
                                        <div class="position-absolute top-50 start-0 translate-middle-y w-100 bg-secondary bg-opacity-25" style="height: 4px; z-index: 1;"></div>
                                        <!-- Đường kẻ tiến độ đã hoàn thành -->
                                        <?php
                                            $prog_pct = 0;
                                            if($tt == 0) $prog_pct = 15;
                                            elseif($tt == 1) $prog_pct = 48;
                                            elseif($tt == 2) $prog_pct = 80;
                                            elseif($tt == 3) $prog_pct = 100;
                                        ?>
                                        <div class="position-absolute top-50 start-0 translate-middle-y bg-danger" style="height: 4px; width: <?= $prog_pct ?>%; z-index: 2; transition: width 0.4s ease;"></div>

                                        <div class="d-flex justify-content-between position-relative" style="z-index: 3;">
                                            <!-- Bước 1 -->
                                            <div class="text-center" style="width: 25%;">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm <?= ($tt >= 0) ? 'bg-danger text-white' : 'bg-white text-muted border' ?>"
                                                     style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem;">
                                                    <?= ($tt > 0) ? '<i class="bi bi-check-lg fs-5"></i>' : '1' ?>
                                                </div>
                                                <div class="small fw-semibold mt-1 <?= ($tt >= 0) ? 'text-dark' : 'text-muted' ?>" style="font-size: 0.8rem;">Tiếp nhận</div>
                                                <div class="text-muted d-none d-sm-block" style="font-size: 0.7rem;">Kiểm tra sơ bộ</div>
                                            </div>

                                            <!-- Bước 2 -->
                                            <div class="text-center" style="width: 25%;">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm <?= ($tt >= 1) ? 'bg-danger text-white' : 'bg-white text-muted border' ?>"
                                                     style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem;">
                                                    <?= ($tt > 1) ? '<i class="bi bi-check-lg fs-5"></i>' : '2' ?>
                                                </div>
                                                <div class="small fw-semibold mt-1 <?= ($tt >= 1) ? 'text-dark' : 'text-muted' ?>" style="font-size: 0.8rem;">Đang sửa chữa</div>
                                                <div class="text-muted d-none d-sm-block" style="font-size: 0.7rem;">Thay thế / Gửi hãng</div>
                                            </div>

                                            <!-- Bước 3 -->
                                            <div class="text-center" style="width: 25%;">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm <?= ($tt >= 2) ? 'bg-danger text-white' : 'bg-white text-muted border' ?>"
                                                     style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem;">
                                                    <?= ($tt > 2) ? '<i class="bi bi-check-lg fs-5"></i>' : '3' ?>
                                                </div>
                                                <div class="small fw-semibold mt-1 <?= ($tt >= 2) ? 'text-dark' : 'text-muted' ?>" style="font-size: 0.8rem;">Đã sửa xong</div>
                                                <div class="text-muted d-none d-sm-block" style="font-size: 0.7rem;">Chờ trả khách</div>
                                            </div>

                                            <!-- Bước 4 -->
                                            <div class="text-center" style="width: 25%;">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm <?= ($tt >= 3) ? 'bg-success text-white' : 'bg-white text-muted border' ?>"
                                                     style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem;">
                                                    <?= ($tt >= 3) ? '<i class="bi bi-check-lg fs-5"></i>' : '4' ?>
                                                </div>
                                                <div class="small fw-semibold mt-1 <?= ($tt >= 3) ? 'text-success' : 'text-muted' ?>" style="font-size: 0.8rem;">Đã trả khách</div>
                                                <div class="text-muted d-none d-sm-block" style="font-size: 0.7rem;">Bàn giao máy</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Thông điệp hướng dẫn tương ứng trạng thái -->
                                    <div class="mt-3">
                                        <?php if($tt == 0): ?>
                                        <div class="alert alert-secondary py-2 mb-0 small rounded-2">
                                            <i class="bi bi-clock-history me-1 text-primary"></i>Phiếu đang ở trạng thái <b>Tiếp nhận</b>. Kỹ thuật viên đang kiểm tra lỗi thiết bị và liên hệ cập nhật trong 24 giờ.
                                        </div>
                                        <?php elseif($tt == 1): ?>
                                        <div class="alert alert-warning py-2 mb-0 small rounded-2">
                                            <i class="bi bi-tools me-1 text-dark"></i>Thiết bị đang được sửa chữa hoặc chờ linh kiện chính hãng. Thảo Mobile sẽ nhắn tin thông báo ngay khi hoàn tất.
                                        </div>
                                        <?php elseif($tt == 2): ?>
                                        <div class="alert alert-info py-2 mb-0 small rounded-2">
                                            <i class="bi bi-bell-fill me-1 text-primary"></i><strong>Tuyệt vời! Thiết bị của bạn đã sửa xong.</strong> Quý khách vui lòng mang Mã phiếu <b><?= sprintf("BH%05d", $bh_item['id']) ?></b> hoặc tin nhắn SMS đến cửa hàng để nhận máy.
                                        </div>
                                        <?php elseif($tt == 3): ?>
                                        <div class="alert alert-success py-2 mb-0 small rounded-2">
                                            <i class="bi bi-check-circle-fill me-1 text-success"></i>Thiết bị đã được bàn giao thành công. Cảm ơn quý khách đã tin dùng sản phẩm và dịch vụ tại <strong>Thảo Mobile</strong>!
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Lịch sử bảo hành của khách hàng đăng nhập (nếu có và chưa gõ từ khóa) -->
            <?php if($ketqua_tracuu === null && !empty($baohanh_cuatoi)): ?>
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="bi bi-clock-history text-danger me-2"></i>Phiếu bảo hành gần đây của bạn (<?= count($baohanh_cuatoi) ?>):
                    </h5>
                    <small class="text-muted">Đồng bộ theo số điện thoại tài khoản</small>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 bg-white border rounded">
                        <thead class="table-light small">
                            <tr>
                                <th class="text-center" style="width: 110px;">Mã phiếu</th>
                                <th>Thiết bị</th>
                                <th>Tiếp nhận</th>
                                <th>Lỗi báo</th>
                                <th class="text-center" style="width: 150px;">Trạng thái</th>
                                <th class="text-center" style="width: 100px;">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($baohanh_cuatoi as $my_bh): ?>
                            <?php
                                $my_tt = (int)($my_bh['trangthai'] ?? 0);
                                $my_badge = [
                                    0 => ['Tiếp nhận', 'secondary'],
                                    1 => ['Đang sửa',  'warning'],
                                    2 => ['Chờ nhận máy', 'info'],
                                    3 => ['Đã trả',    'success'],
                                    4 => ['Từ chối',   'danger'],
                                ][$my_tt] ?? ['Chờ xử lý', 'secondary'];
                            ?>
                            <tr>
                                <td class="text-center fw-bold text-danger"><?= sprintf("BH%05d", $my_bh['id']) ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($my_bh['tenmathang'] ?? '--') ?></strong>
                                    <?php if(!empty($my_bh['soimei'])): ?>
                                    <div class="text-muted small">IMEI: <?= htmlspecialchars($my_bh['soimei']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?= date("d/m/Y", strtotime($my_bh['ngaytiepnhan'])) ?></td>
                                <td class="small text-truncate" style="max-width: 200px;"><?= htmlspecialchars($my_bh['tinhtrangloi']) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= $my_badge[1] ?> text-<?= $my_badge[1] == 'warning' ? 'dark' : 'white' ?> px-2 py-1">
                                        <?= $my_badge[0] ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="index.php?action=baohanh&tukhoa=<?= sprintf("BH%05d", $my_bh['id']) ?>"
                                       class="btn btn-sm btn-outline-danger py-0 px-2" title="Xem tiến trình">
                                        Xem
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>


    <!-- KHỐI 2 — GỬI YÊU CẦU BẢO HÀNH / SỬA CHỮA ONLINE (row g-4) -->
    <div class="row g-4" id="formGuiYeuCau">

        <!-- CỘT TRÁI (col-lg-7) — FORM ĐĂNG KÝ BẢO HÀNH TRỰC TUYẾN -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-body p-4 p-md-4">
                    <!-- Tiêu đề cột trái -->
                    <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                             style="width: 40px; height: 40px; background: #fff1f2; color: #d70018;">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0" style="color: #d70018;">GỬI YÊU CẦU BẢO HÀNH / SỬA CHỮA</h4>
                            <small class="text-muted">Điền thông tin trực tuyến để được nhân viên kỹ thuật tiếp nhận nhanh nhất</small>
                        </div>
                    </div>

                    <form method="POST" action="index.php?action=baohanh#formGuiYeuCau" id="formDangKyBaoHanh">
                        <input type="hidden" name="donhang_id" id="hidden_donhang_id" value="">
                        <input type="hidden" name="ngaymua" id="hidden_ngaymua" value="">
                        <input type="hidden" name="hanbaohanh" id="hidden_hanbaohanh" value="">

                        <!-- Chọn máy nhanh từ đơn hàng đã mua (Nếu đã đăng nhập) -->
                        <?php if(isset($_SESSION['khachhang'])): ?>
                            <?php if(!empty($mathang_damua)): ?>
                            <div class="p-3 mb-3 rounded-3" style="background-color: #fdf2f2; border: 1.5px dashed #f87171;">
                                <label class="form-label fw-bold text-danger mb-1 d-flex align-items-center">
                                    <i class="bi bi-lightning-charge-fill me-1 text-warning"></i>Chọn máy từ đơn hàng đã mua:
                                </label>
                                <select id="select_may_damua" class="form-select form-select-sm">
                                    <option value="">-- Bấm vào đây để chọn máy bạn đã mua tại Thảo Mobile --</option>
                                    <?php foreach($mathang_damua as $dm_item): ?>
                                    <?php
                                        $ngaymua_str = date('Y-m-d', strtotime($dm_item['ngaymua']));
                                        $hanbh_str = date('Y-m-d', strtotime('+1 year', strtotime($dm_item['ngaymua'])));
                                    ?>
                                    <option value="<?= $dm_item['mathang_id'] ?>"
                                            data-donhangid="<?= $dm_item['donhang_id'] ?>"
                                            data-ngaymua="<?= $ngaymua_str ?>"
                                            data-hanbaohanh="<?= $hanbh_str ?>">
                                        <?= sprintf("DH%06d", $dm_item['donhang_id']) ?> — <?= htmlspecialchars($dm_item['tenmathang']) ?> (Mua: <?= date("d/m/Y", strtotime($dm_item['ngaymua'])) ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                    <i class="bi bi-magic me-1 text-danger"></i>Khi chọn máy, hệ thống tự động điền mẫu máy, mã đơn và tính hạn bảo hành 12 tháng.
                                </small>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Row 1: Họ tên + SĐT -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">
                                    Họ và tên khách hàng <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="tenkhachhang"
                                       id="input_tenkhachhang"
                                       class="form-control"
                                       placeholder="VD: Nguyễn Văn A..."
                                       value="<?= htmlspecialchars($_POST['tenkhachhang'] ?? ($_SESSION['khachhang']['hoten'] ?? '')) ?>"
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">
                                    Số điện thoại liên hệ <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="sodienthoai"
                                       id="input_sodienthoai"
                                       class="form-control"
                                       placeholder="VD: 0934567890..."
                                       value="<?= htmlspecialchars($_POST['sodienthoai'] ?? ($_SESSION['khachhang']['sodienthoai'] ?? '')) ?>"
                                       required>
                            </div>
                        </div>

                        <!-- Row 2: Chọn mẫu điện thoại + IMEI -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-semibold small text-dark">
                                    Chọn mẫu điện thoại cần bảo hành <span class="text-danger">*</span>
                                </label>
                                <select name="mathang_id" id="select_mathang_id" class="form-select" required>
                                    <option value="">-- Vui lòng chọn mẫu máy --</option>
                                    <?php if(!empty($danhsachmathang)): ?>
                                        <?php foreach($danhsachmathang as $m): ?>
                                        <option value="<?= $m['id'] ?>" <?= (isset($_POST['mathang_id']) && (int)$_POST['mathang_id'] == $m['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($m['tenmathang']) ?> (<?= !empty($m['tendanhmuc']) ? $m['tendanhmuc'] : 'Chính hãng' ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold small text-dark">
                                    Số IMEI máy <small class="text-muted fw-normal">(nếu có)</small>
                                </label>
                                <input type="text"
                                       name="soimei"
                                       id="input_soimei"
                                       class="form-control font-monospace"
                                       placeholder="15 số IMEI (*#06#)"
                                       value="<?= htmlspecialchars($_POST['soimei'] ?? '') ?>"
                                       maxlength="30">
                            </div>
                        </div>

                        <!-- Row 3: Mô tả chi tiết tình trạng lỗi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-dark">
                                Mô tả chi tiết tình trạng lỗi <span class="text-danger">*</span>
                            </label>
                            <textarea name="tinhtrangloi"
                                      id="textarea_tinhtrangloi"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Mô tả cụ thể hiện tượng: màn hình sọc, pin tụt nhanh, không nhận sạc, mất sóng, camera mờ, rơi nước..."
                                      required><?= htmlspecialchars($_POST['tinhtrangloi'] ?? '') ?></textarea>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                Mô tả càng chi tiết giúp kỹ thuật viên chuẩn bị linh kiện thay thế nhanh chóng hơn.
                            </small>
                        </div>

                        <!-- Nút gửi form -->
                        <div class="d-grid">
                            <button type="submit" name="btn_guibaohanh" class="btn text-white fw-bold py-2 fs-6 shadow-sm"
                                    style="background-color: #d70018; border: none; border-radius: 8px;">
                                <i class="bi bi-send-check me-2"></i>GỬI YÊU CẦU BẢO HÀNH
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- CỘT PHẢI (col-lg-5) — CAM KẾT & QUY TRÌNH BẢO HÀNH 4 BƯỚC -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-body p-4 p-md-4">
                    <!-- Tiêu đề quyền lợi -->
                    <h5 class="fw-bold mb-3 d-flex align-items-center" style="color: #d70018;">
                        <i class="bi bi-patch-check-fill me-2 fs-4"></i>QUYỀN LỢI BẢO HÀNH VÀNG
                    </h5>

                    <!-- 4 Quyền lợi nổi bật tại Thảo Mobile -->
                    <div class="d-flex flex-column gap-3 mb-4">
                        <!-- Quyền lợi 1 -->
                        <div class="d-flex gap-3 align-items-start p-2 rounded-2" style="background: #fafafa;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 36px; height: 36px; background: #fee2e2; color: #dc2626;">
                                <i class="bi bi-arrow-repeat fs-5"></i>
                            </div>
                            <div>
                                <strong class="text-dark small d-block">1 Đổi 1 trong 30 ngày đầu</strong>
                                <span class="text-muted" style="font-size: 0.82rem;">Đổi ngay máy mới cùng model nếu phát sinh lỗi phần cứng từ nhà sản xuất.</span>
                            </div>
                        </div>

                        <!-- Quyền lợi 2 -->
                        <div class="d-flex gap-3 align-items-start p-2 rounded-2" style="background: #fafafa;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 36px; height: 36px; background: #e0f2fe; color: #0284c7;">
                                <i class="bi bi-shield-check fs-5"></i>
                            </div>
                            <div>
                                <strong class="text-dark small d-block">Bảo hành chính hãng 12 tháng</strong>
                                <span class="text-muted" style="font-size: 0.82rem;">Hỗ trợ tiếp nhận gửi hãng trên toàn quốc, linh kiện chính hãng 100%.</span>
                            </div>
                        </div>

                        <!-- Quyền lợi 3 -->
                        <div class="d-flex gap-3 align-items-start p-2 rounded-2" style="background: #fafafa;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 36px; height: 36px; background: #fef3c7; color: #d97706;">
                                <i class="bi bi-phone fs-5"></i>
                            </div>
                            <div>
                                <strong class="text-dark small d-block">Mượn máy dùng tạm miễn phí</strong>
                                <span class="text-muted" style="font-size: 0.82rem;">Hỗ trợ máy sơ cua hoàn toàn miễn phí trong thời gian chờ hãng sửa chữa.</span>
                            </div>
                        </div>

                        <!-- Quyền lợi 4 -->
                        <div class="d-flex gap-3 align-items-start p-2 rounded-2" style="background: #fafafa;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 36px; height: 36px; background: #dcfce7; color: #16a34a;">
                                <i class="bi bi-headset fs-5"></i>
                            </div>
                            <div>
                                <strong class="text-dark small d-block">Tổng đài hỗ trợ kỹ thuật: <?= htmlspecialchars($hotline_shop ?? "0357185269") ?></strong>
                                <span class="text-muted" style="font-size: 0.82rem;">Giải đáp mọi thắc mắc kỹ thuật từ <?= htmlspecialchars($giomocua_shop ?? "8:00 - 21:30") ?> mỗi ngày.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quy trình 4 bước chuẩn -->
                    <div class="pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3">Quy trình xử lý bảo hành 4 bước:</h6>
                        <ol class="ps-3 mb-0 small text-secondary d-flex flex-column gap-2">
                            <li><strong>Bước 1 - Tiếp nhận:</strong> Khách gửi yêu cầu hoặc mang máy đến cửa hàng để lập phiếu.</li>
                            <li><strong>Bước 2 - Kiểm tra & Sửa chữa:</strong> Kỹ thuật kiểm tra chuyên sâu, báo hướng xử lý hoặc gửi hãng.</li>
                            <li><strong>Bước 3 - QC & Kiểm định:</strong> Máy sửa xong được chạy test kiểm tra chất lượng toàn diện.</li>
                            <li><strong>Bước 4 - Trả máy:</strong> Bàn giao tận tay khách kèm phiếu bảo hành dịch vụ linh kiện.</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- JavaScript xử lý chọn nhanh máy từ đơn hàng đã mua -->
<script>
document.addEventListener("DOMContentLoaded", function(){
    const selectMay = document.getElementById("select_may_damua");
    const selectMathang = document.getElementById("select_mathang_id");
    const hiddenDonhang = document.getElementById("hidden_donhang_id");
    const hiddenNgaymua = document.getElementById("hidden_ngaymua");
    const hiddenHanbh   = document.getElementById("hidden_hanbaohanh");

    if(selectMay){
        selectMay.addEventListener("change", function(){
            const selectedOpt = this.options[this.selectedIndex];
            const mathangId = this.value;
            if(mathangId){
                if(selectMathang){
                    selectMathang.value = mathangId;
                }
                const donhangId = selectedOpt.getAttribute("data-donhangid") || "";
                const ngaymua   = selectedOpt.getAttribute("data-ngaymua") || "";
                const hanbh     = selectedOpt.getAttribute("data-hanbaohanh") || "";

                if(hiddenDonhang) hiddenDonhang.value = donhangId;
                if(hiddenNgaymua) hiddenNgaymua.value = ngaymua;
                if(hiddenHanbh)   hiddenHanbh.value   = hanbh;
            } else {
                if(hiddenDonhang) hiddenDonhang.value = "";
                if(hiddenNgaymua) hiddenNgaymua.value = "";
                if(hiddenHanbh)   hiddenHanbh.value   = "";
            }
        });
    }
});
</script>

<?php include("inc/bottom.php"); ?>
