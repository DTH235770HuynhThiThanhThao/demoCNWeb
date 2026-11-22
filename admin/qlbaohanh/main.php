<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h3 class="text-info fw-bold mb-0"><i class="align-middle me-2" data-feather="shield"></i>Quản lý bảo hành</h3>
    <a href="index.php?action=them" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="align-middle" data-feather="plus-circle"></i> Tiếp nhận bảo hành mới
    </a>
</div>

<?php if(!empty($thongbao_ok)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="align-middle me-2" data-feather="check-circle"></i> <?= htmlspecialchars($thongbao_ok) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Hàng 1 — 4 Thẻ thống kê nhanh -->
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10" style="width:48px;height:48px;flex-shrink:0;">
                    <i class="align-middle text-primary" data-feather="clipboard" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?= (int)($thongke['tongsophieu'] ?? 0) ?></div>
                    <div class="text-muted small">Tổng phiếu bảo hành</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10" style="width:48px;height:48px;flex-shrink:0;">
                    <i class="align-middle text-warning" data-feather="tool" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?= (int)($thongke['dangsua'] ?? 0) ?></div>
                    <div class="text-muted small">Đang kiểm tra / Sửa chữa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-info bg-opacity-10" style="width:48px;height:48px;flex-shrink:0;">
                    <i class="align-middle text-info" data-feather="package" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?= (int)($thongke['chotrakach'] ?? 0) ?></div>
                    <div class="text-muted small">Chờ trả khách</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:48px;height:48px;flex-shrink:0;">
                    <i class="align-middle text-success" data-feather="check-square" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?= (int)($thongke['dahoanthanh'] ?? 0) ?></div>
                    <div class="text-muted small">Đã hoàn tất bàn giao</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hàng 2 — Thanh tìm kiếm & lọc trạng thái -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2 px-3">
        <form method="GET" action="index.php" class="row g-2 align-items-center">
            <input type="hidden" name="action" value="danhsach">
            <div class="col-12 col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light"><i class="align-middle" data-feather="search" style="width:14px;height:14px;"></i></span>
                    <input type="text" class="form-control" name="tukhoa" placeholder="Tìm theo tên khách, SĐT, IMEI máy..." value="<?= htmlspecialchars($tukhoa ?? '') ?>">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <select name="trangthai" class="form-select form-select-sm">
                    <option value="">-- Tất cả trạng thái bảo hành --</option>
                    <option value="0" <?= (isset($trangthai) && $trangthai === '0') ? 'selected' : '' ?>>0: Tiếp nhận kiểm tra</option>
                    <option value="1" <?= (isset($trangthai) && $trangthai === '1') ? 'selected' : '' ?>>1: Đang sửa chữa / Gửi hãng</option>
                    <option value="2" <?= (isset($trangthai) && $trangthai === '2') ? 'selected' : '' ?>>2: Đã sửa xong - Chờ trả khách</option>
                    <option value="3" <?= (isset($trangthai) && $trangthai === '3') ? 'selected' : '' ?>>3: Đã bàn giao khách</option>
                    <option value="4" <?= (isset($trangthai) && $trangthai === '4') ? 'selected' : '' ?>>4: Từ chối bảo hành / Hết hạn</option>
                </select>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-outline-primary flex-fill d-inline-flex align-items-center justify-content-center">
                    <i class="align-middle me-1" data-feather="filter" style="width:13px;height:13px;"></i>Lọc
                </button>
                <a href="index.php" class="btn btn-sm btn-outline-secondary flex-fill text-center">Xóa lọc</a>
            </div>
        </form>
    </div>
</div>

<!-- Bảng danh sách bảo hành -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:115px;" class="text-center">Mã BH</th>
                        <th style="width:200px;">Khách hàng & IMEI</th>
                        <th style="width:220px;">Thiết bị & Hạn BH</th>
                        <th>Tình trạng lỗi</th>
                        <th class="text-center" style="width:145px;">Trạng thái</th>
                        <th class="text-center" style="width:230px; white-space:nowrap;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($baohanh)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="align-middle" data-feather="inbox" style="width:40px;height:40px;opacity:0.3;"></i>
                            <div class="mt-2">Chưa có phiếu bảo hành nào phù hợp.</div>
                        </td>
                    </tr>
                <?php else: ?>
                <?php foreach($baohanh as $bh_item): ?>
                <?php
                    $tt = (int)($bh_item['trangthai'] ?? 0);
                    $hanbh = $bh_item['hanbaohanh'] ?? null;
                    $conhanBH = $hanbh && (strtotime($hanbh) >= strtotime(date('Y-m-d')));
                ?>
                <tr>
                    <!-- Cột 1: Mã BH / Mã ĐH -->
                    <td class="text-center">
                        <div class="fw-bold text-primary fs-6"><?= sprintf("BH%05d", $bh_item['id']) ?></div>
                        <?php if(!empty($bh_item['donhang_id'])): ?>
                        <span class="badge bg-light text-secondary border" style="font-size:0.7rem;"><?= sprintf("DH%06d", $bh_item['donhang_id']) ?></span>
                        <?php endif; ?>
                        <div class="text-muted mt-1" style="font-size:0.72rem;"><?= date("d/m/Y", strtotime($bh_item['ngaytiepnhan'])) ?></div>
                    </td>

                    <!-- Cột 2: Khách hàng & IMEI -->
                    <td>
                        <strong class="text-dark"><?= htmlspecialchars($bh_item['tenkhachhang']) ?></strong>
                        <br><small class="text-muted"><i class="align-middle" data-feather="phone" style="width:12px;height:12px;"></i> <?= htmlspecialchars($bh_item['sodienthoai']) ?></small>
                        <?php if(!empty($bh_item['soimei'])): ?>
                        <br><small class="text-secondary" style="font-size:0.75rem;">IMEI: <span class="font-monospace"><?= htmlspecialchars($bh_item['soimei']) ?></span></small>
                        <?php endif; ?>
                    </td>

                    <!-- Cột 3: Thiết bị & Hạn BH -->
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="../../images/products/<?= htmlspecialchars($bh_item['hinhanh'] ?? 'default.jpg') ?>"
                                 onerror="this.src='../../images/products/x1.jpg'"
                                 alt="" style="width:40px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6;flex-shrink:0;">
                            <div>
                                <div class="fw-semibold text-truncate" style="font-size:0.83rem;max-width:160px;"><?= htmlspecialchars($bh_item['tenmathang'] ?? '--') ?></div>
                                <?php if($hanbh): ?>
                                <small>
                                    <?php if($conhanBH): ?>
                                    <span class="badge bg-success" style="font-size:0.65rem;">Còn hạn BH</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger" style="font-size:0.65rem;">Hết hạn BH</span>
                                    <?php endif; ?>
                                    <span class="text-muted ms-1" style="font-size:0.72rem;"><?= date("d/m/Y", strtotime($hanbh)) ?></span>
                                </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>

                    <!-- Cột 4: Tình trạng lỗi -->
                    <td>
                        <div class="text-dark" style="font-size:0.83rem;"><?= htmlspecialchars(mb_substr($bh_item['tinhtrangloi'], 0, 80)) ?><?= mb_strlen($bh_item['tinhtrangloi']) > 80 ? '...' : '' ?></div>
                        <?php if(!empty($bh_item['ghichu'])): ?>
                        <small class="text-info d-block mt-1"><i class="align-middle" data-feather="edit-3" style="width:11px;height:11px;"></i> <?= htmlspecialchars(mb_substr($bh_item['ghichu'], 0, 70)) ?></small>
                        <?php endif; ?>
                    </td>

                    <!-- Cột 5: Trạng thái -->
                    <td class="text-center">
                        <?php
                        if($tt === 0){
                            echo '<span class="badge bg-secondary px-2 py-1 text-nowrap"><i class="align-middle" data-feather="clock" style="width:12px;height:12px;"></i> Tiếp nhận</span>';
                        } elseif($tt === 1){
                            echo '<span class="badge bg-warning text-dark px-2 py-1 text-nowrap"><i class="align-middle" data-feather="tool" style="width:12px;height:12px;"></i> Đang sửa chữa</span>';
                        } elseif($tt === 2){
                            echo '<span class="badge bg-info text-white px-2 py-1 text-nowrap"><i class="align-middle" data-feather="package" style="width:12px;height:12px;"></i> Đã sửa xong</span>';
                        } elseif($tt === 3){
                            echo '<span class="badge bg-success px-2 py-1 text-nowrap"><i class="align-middle" data-feather="check-circle" style="width:12px;height:12px;"></i> Đã trả khách</span>';
                        } elseif($tt === 4){
                            echo '<span class="badge bg-danger px-2 py-1 text-nowrap"><i class="align-middle" data-feather="x-circle" style="width:12px;height:12px;"></i> Từ chối BH</span>';
                        }
                        ?>
                    </td>

                    <!-- Cột 6: Thao tác (nằm chung 1 hàng ngang) -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
                            <?php if($tt === 0): ?>
                                <a href="index.php?action=capnhat&id=<?= $bh_item['id'] ?>&trangthai=1"
                                   class="btn btn-sm btn-warning text-dark d-inline-flex align-items-center text-nowrap" style="padding:4px 8px;" title="Chuyển sang Đang sửa chữa">
                                    <i class="align-middle me-1" data-feather="tool" style="width:13px;height:13px;"></i>Sửa chữa
                                </a>
                                <a href="index.php?action=capnhat&id=<?= $bh_item['id'] ?>&trangthai=4"
                                   class="btn btn-sm btn-danger d-inline-flex align-items-center text-nowrap" style="padding:4px 8px;" title="Từ chối bảo hành"
                                   onclick="return confirm('Xác nhận từ chối bảo hành phiếu BH<?= sprintf('%05d', $bh_item['id']) ?>?');">
                                    <i class="align-middle me-1" data-feather="x" style="width:13px;height:13px;"></i>Từ chối
                                </a>
                            <?php elseif($tt === 1): ?>
                                <a href="index.php?action=capnhat&id=<?= $bh_item['id'] ?>&trangthai=2"
                                   class="btn btn-sm btn-info text-white d-inline-flex align-items-center text-nowrap" style="padding:4px 8px;" title="Báo đã sửa xong, chờ trả khách">
                                    <i class="align-middle me-1" data-feather="check" style="width:13px;height:13px;"></i>Báo xong
                                </a>
                            <?php elseif($tt === 2): ?>
                                <a href="index.php?action=capnhat&id=<?= $bh_item['id'] ?>&trangthai=3"
                                   class="btn btn-sm btn-success d-inline-flex align-items-center text-nowrap" style="padding:4px 8px;" title="Xác nhận đã bàn giao máy cho khách">
                                    <i class="align-middle me-1" data-feather="user-check" style="width:13px;height:13px;"></i>Trả khách
                                </a>
                            <?php endif; ?>

                            <!-- Nút cập nhật ghi chú / trạng thái bằng Modal -->
                            <button type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center" style="padding:4px 8px;"
                                    title="Cập nhật ghi chú và tiến độ"
                                    data-bs-toggle="modal" data-bs-target="#modalGhiChu<?= $bh_item['id'] ?>">
                                <i class="align-middle" data-feather="edit-2" style="width:13px;height:13px;"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal cập nhật nằm ngoài bảng -->
<?php if(!empty($baohanh)): ?>
<?php foreach($baohanh as $bh_item): ?>
<?php $tt = (int)($bh_item['trangthai'] ?? 0); ?>
<div class="modal fade" id="modalGhiChu<?= $bh_item['id'] ?>" tabindex="-1" aria-labelledby="lblModal<?= $bh_item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="capnhat">
                <input type="hidden" name="id" value="<?= $bh_item['id'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="lblModal<?= $bh_item['id'] ?>">
                        <i class="align-middle me-2" data-feather="edit-2"></i>Cập nhật phiếu <?= sprintf("BH%05d", $bh_item['id']) ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Khách hàng / Máy</label>
                        <div class="form-control-plaintext text-muted">
                            <strong><?= htmlspecialchars($bh_item['tenkhachhang']) ?></strong> (<?= htmlspecialchars($bh_item['sodienthoai']) ?>) — <?= htmlspecialchars($bh_item['tenmathang'] ?? '') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trạng thái xử lý</label>
                        <select name="trangthai" class="form-select">
                            <option value="0" <?= $tt===0?'selected':'' ?>>0: Tiếp nhận kiểm tra</option>
                            <option value="1" <?= $tt===1?'selected':'' ?>>1: Đang sửa chữa / Gửi hãng</option>
                            <option value="2" <?= $tt===2?'selected':'' ?>>2: Đã sửa xong - Chờ trả khách</option>
                            <option value="3" <?= $tt===3?'selected':'' ?>>3: Đã bàn giao khách</option>
                            <option value="4" <?= $tt===4?'selected':'' ?>>4: Từ chối bảo hành / Hết hạn</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ghi chú sửa chữa / Chi phí phát sinh</label>
                        <input type="text" name="ghichu" class="form-control"
                               placeholder="VD: Đã thay màn hình linh kiện chính hãng, chi phí..."
                               value="<?= htmlspecialchars($bh_item['ghichu'] ?? '') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                        <i class="align-middle me-1" data-feather="save"></i>Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php include("../inc/bottom.php"); ?>
