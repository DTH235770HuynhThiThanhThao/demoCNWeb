<?php include("inc/top.php"); ?>

<!-- Hero tra cứu bảo hành -->
<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                 style="width:70px;height:70px;background:linear-gradient(135deg,#d70018,#ff4d4d);">
                <i class="bi bi-shield-check text-white" style="font-size:2rem;"></i>
            </div>
            <h2 class="fw-bold" style="color:#d70018;">Tra cứu bảo hành</h2>
            <p class="text-muted">Nhập <strong>Số điện thoại</strong> hoặc <strong>Số IMEI / Mã phiếu bảo hành</strong> để kiểm tra trạng thái và tiến độ sửa chữa thiết bị của bạn.</p>
        </div>

        <!-- Form tra cứu -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius:16px;overflow:hidden;">
            <div class="card-body p-4">
                <form method="POST" action="index.php?action=baohanh" class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0" style="border-radius:10px 0 0 10px;">
                                <i class="bi bi-search" style="color:#d70018;"></i>
                            </span>
                            <input type="text" name="tracuu" class="form-control border-start-0 ps-0"
                                   style="border-radius:0 10px 10px 0; font-size:1rem;"
                                   placeholder="SĐT: 09xxxxxxxx | IMEI: 352938... | Mã phiếu: BH00001"
                                   value="<?= htmlspecialchars($_POST['tracuu'] ?? '') ?>"
                                   autocomplete="off" required>
                        </div>
                    </div>
                    <button type="submit" class="btn fw-semibold text-white px-4"
                            style="background:#d70018;border-radius:10px;white-space:nowrap;">
                        <i class="bi bi-search me-2"></i>Tra cứu ngay
                    </button>
                </form>
            </div>
        </div>

        <?php
        $tracuu   = trim($_POST['tracuu'] ?? '');
        $ketqua   = array();
        if(!empty($tracuu)){
            if(!class_exists('BAOHANH')){
                require_once('../model/baohanh.php');
            }
            $bh_model = new BAOHANH();
            $ketqua = $bh_model->tracuubaohanh($tracuu);
        }
        ?>

        <?php if(!empty($tracuu)): ?>
            <?php if(empty($ketqua)): ?>
            <!-- Không tìm thấy -->
            <div class="text-center py-5">
                <i class="bi bi-emoji-frown" style="font-size:3rem;color:#d70018;opacity:0.5;"></i>
                <h5 class="mt-3 text-muted">Không tìm thấy phiếu bảo hành</h5>
                <p class="text-muted small">Không có kết quả nào khớp với "<strong><?= htmlspecialchars($tracuu) ?></strong>".<br>Vui lòng kiểm tra lại số điện thoại, số IMEI hoặc mã phiếu bảo hành.</p>
                <a href="index.php?action=baohanh" class="btn btn-sm btn-outline-danger mt-2">Tra cứu lại</a>
            </div>
            <?php else: ?>
            <!-- Danh sách kết quả -->
            <h6 class="fw-semibold mb-3 text-muted">Tìm thấy <?= count($ketqua) ?> phiếu bảo hành:</h6>
            <?php foreach($ketqua as $p): ?>
            <?php
                $tt = (int)($p['trangthai'] ?? 0);
                $hanbh = $p['hanbaohanh'] ?? null;
                $conhan = $hanbh && (strtotime($hanbh) >= strtotime(date('Y-m-d')));
                $badge_info = [
                    0 => ['Tiếp nhận kiểm tra',      'secondary', 'bi-clock'],
                    1 => ['Đang sửa chữa / Gửi hãng','warning',   'bi-tools'],
                    2 => ['Đã sửa xong - Chờ trả',   'info',      'bi-box-seam'],
                    3 => ['Đã bàn giao cho bạn',      'success',   'bi-check-circle-fill'],
                    4 => ['Từ chối / Hết hạn BH',     'danger',    'bi-x-circle-fill'],
                ];
                $bi = $badge_info[$tt] ?? $badge_info[0];
                // Tính % tiến trình
                $pct = [0=>10, 1=>40, 2=>75, 3=>100, 4=>100][$tt] ?? 10;
                $bar_color = ['0'=>'bg-secondary','1'=>'bg-warning','2'=>'bg-info','3'=>'bg-success','4'=>'bg-danger'][$tt] ?? 'bg-secondary';
            ?>
            <div class="card mb-3 border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
                <!-- Header card -->
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-3"
                     style="background:linear-gradient(90deg,#d70018,#ff6b6b);color:#fff;">
                    <span class="fw-bold fs-6">
                        <i class="bi bi-shield-check me-2"></i><?= sprintf("BH%05d", $p['id']) ?>
                        <?php if(!empty($p['donhang_id'])): ?>
                        <span class="badge bg-white bg-opacity-25 ms-2 fw-normal" style="font-size:0.75rem;"><?= sprintf("ĐH%06d", $p['donhang_id']) ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="badge bg-<?= $bi[1] ?> text-<?= $bi[1]==='warning'?'dark':'white' ?> px-3 py-2">
                        <i class="bi <?= $bi[2] ?> me-1"></i><?= $bi[0] ?>
                    </span>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <!-- Thông tin thiết bị -->
                        <div class="col-sm-5 d-flex align-items-center gap-3">
                            <img src="../images/products/<?= htmlspecialchars($p['hinhanh'] ?? 'x1.jpg') ?>"
                                 onerror="this.src='../images/products/x1.jpg'"
                                 alt="" style="width:64px;height:64px;object-fit:cover;border-radius:10px;border:1px solid #eee;">
                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($p['tenmathang'] ?? '--') ?></div>
                                <?php if(!empty($p['soimei'])): ?>
                                <small class="text-muted">IMEI: <?= htmlspecialchars($p['soimei']) ?></small><br>
                                <?php endif; ?>
                                <?php if($hanbh): ?>
                                <small class="<?= $conhan ? 'text-success' : 'text-danger' ?> fw-semibold">
                                    <i class="bi bi-<?= $conhan?'shield-check':'shield-x' ?> me-1"></i>
                                    <?= $conhan ? 'Còn hạn BH' : 'Hết hạn BH' ?> — <?= date("d/m/Y", strtotime($hanbh)) ?>
                                </small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Thông tin khách & ngày -->
                        <div class="col-sm-7">
                            <div class="row g-2 small">
                                <div class="col-6">
                                    <span class="text-muted">Khách hàng</span><br>
                                    <strong><?= htmlspecialchars($p['tenkhachhang']) ?></strong>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">Tiếp nhận</span><br>
                                    <strong><?= date("d/m/Y", strtotime($p['ngaytiepnhan'])) ?></strong>
                                </div>
                                <?php if(!empty($p['ngaymua'])): ?>
                                <div class="col-6">
                                    <span class="text-muted">Ngày mua</span><br>
                                    <strong><?= date("d/m/Y", strtotime($p['ngaymua'])) ?></strong>
                                </div>
                                <?php endif; ?>
                                <div class="col-6">
                                    <span class="text-muted">SĐT liên hệ</span><br>
                                    <strong><?= htmlspecialchars($p['sodienthoai']) ?></strong>
                                </div>
                            </div>
                        </div>

                        <!-- Tình trạng lỗi -->
                        <div class="col-12">
                            <div class="bg-light rounded p-2 small">
                                <span class="text-muted fw-semibold">Tình trạng tiếp nhận:</span>
                                <span class="ms-1"><?= htmlspecialchars($p['tinhtrangloi']) ?></span>
                            </div>
                        </div>

                        <?php if(!empty($p['ghichu']) && $tt > 0): ?>
                        <!-- Ghi chú sửa chữa -->
                        <div class="col-12">
                            <div class="rounded p-2 small" style="background:#e8f4ff;border-left:3px solid #0d6efd;">
                                <span class="text-primary fw-semibold"><i class="bi bi-wrench me-1"></i>Ghi chú kỹ thuật:</span>
                                <span class="ms-1"><?= htmlspecialchars($p['ghichu']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Thanh tiến trình -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Tiến độ xử lý</span>
                                <span class="fw-semibold"><?= $bi[0] ?></span>
                            </div>
                            <div class="progress" style="height:8px;border-radius:10px;">
                                <div class="progress-bar <?= $bar_color ?> <?= $tt===1?'progress-bar-striped progress-bar-animated':'' ?>"
                                     role="progressbar" style="width:<?= $pct ?>%"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-1" style="font-size:0.68rem;color:#999;">
                                <span>Tiếp nhận</span><span>Đang sửa</span><span>Đã sửa xong</span><span>Đã trả</span>
                            </div>
                        </div>

                        <?php if($tt === 2): ?>
                        <div class="col-12">
                            <div class="alert alert-info py-2 mb-0 small">
                                <i class="bi bi-bell-fill me-2"></i><strong>Thiết bị của bạn đã sửa xong!</strong> Vui lòng mang theo Mã phiếu <strong><?= sprintf("BH%05d", $p['id']) ?></strong> đến cửa hàng để nhận máy.
                            </div>
                        </div>
                        <?php elseif($tt === 3): ?>
                        <div class="col-12">
                            <div class="alert alert-success py-2 mb-0 small">
                                <i class="bi bi-check-circle-fill me-2"></i>Thiết bị đã được <strong>bàn giao</strong>. Cảm ơn bạn đã tin tưởng <strong><?= htmlspecialchars($ten_shop) ?></strong>!
                            </div>
                        </div>
                        <?php elseif($tt === 4): ?>
                        <div class="col-12">
                            <div class="alert alert-danger py-2 mb-0 small">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Phiếu bảo hành bị <strong>từ chối / hết hạn</strong>. Vui lòng liên hệ cửa hàng để được tư vấn chi phí sửa chữa.
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Hướng dẫn -->
        <?php if(empty($tracuu)): ?>
        <div class="card border-0 shadow-sm mt-2" style="border-radius:14px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle-fill me-2" style="color:#d70018;"></i>Hướng dẫn tra cứu</h6>
                <div class="row g-3">
                    <div class="col-sm-4 text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                             style="width:48px;height:48px;background:#fff0f0;">
                            <i class="bi bi-telephone-fill" style="font-size:1.3rem;color:#d70018;"></i>
                        </div>
                        <div class="small fw-semibold">Số điện thoại</div>
                        <div class="text-muted" style="font-size:0.78rem;">Nhập SĐT bạn đã để lại khi mang máy vào bảo hành.</div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                             style="width:48px;height:48px;background:#fff0f0;">
                            <i class="bi bi-upc-scan" style="font-size:1.3rem;color:#d70018;"></i>
                        </div>
                        <div class="small fw-semibold">Số IMEI / Serial</div>
                        <div class="text-muted" style="font-size:0.78rem;">Số IMEI gồm 15 chữ số, kiểm tra ở hộp máy hoặc gọi *#06#.</div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                             style="width:48px;height:48px;background:#fff0f0;">
                            <i class="bi bi-receipt" style="font-size:1.3rem;color:#d70018;"></i>
                        </div>
                        <div class="small fw-semibold">Mã phiếu BH</div>
                        <div class="text-muted" style="font-size:0.78rem;">Mã phiếu dạng BH00001, được in trên phiếu tiếp nhận bảo hành.</div>
                    </div>
                </div>
                <hr>
                <p class="text-center text-muted small mb-0">
                    <i class="bi bi-headset me-1" style="color:#d70018;"></i>
                    Cần hỗ trợ? Gọi ngay <strong><a href="tel:<?= preg_replace('/[^0-9]/', '', $hotline_shop) ?>" style="color:#d70018;"><?= htmlspecialchars($hotline_shop) ?></a></strong>
                    — Giờ làm việc: <?= htmlspecialchars($giomocua_shop) ?>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
