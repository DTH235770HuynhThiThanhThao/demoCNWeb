<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, sạch sẽ, dịu mắt */
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
.btn-flagship-dark {
    background-color: #1e293b;
    border-color: #1e293b;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship-dark:hover {
    background-color: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
}
.btn-filter-reset {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-filter-reset:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.kpi-card-bh {
    border-radius: 14px !important;
    background-color: #ffffff;
    border: 1px solid #f1f5f9 !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kpi-card-bh:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05) !important;
}
.kpi-card-bh .card-body {
    padding: 14px 16px !important;
}
.icon-pastel-bh {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.table-flagship-head th {
    background-color: #f8fafc !important;
    color: #475569 !important;
    font-weight: 700 !important;
    font-size: 0.78rem !important;
    border-bottom: 1px solid #e2e8f0 !important;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}
</style>

<!-- 1. Thanh tiêu đề & Nút thêm bảo hành -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-0">
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="brand-title-bar"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ BẢO HÀNH</h3>
                            <p class="text-muted small mb-0 mt-1">Tiếp nhận, kiểm tra tình trạng thiết bị và theo dõi tiến độ bảo hành cho khách hàng</p>
                        </div>
                    </div>
                    <div>
                        <a href="index.php?action=them" class="btn btn-flagship-red d-inline-flex align-items-center px-3 py-2 shadow-sm">
                            <i class="align-middle me-1.5" data-feather="plus-circle" style="width: 17px; height: 17px;"></i>
                            <span>Tiếp nhận bảo hành mới</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($thongbao_ok)): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-3 d-flex align-items-center" role="alert">
    <i class="align-middle me-2" data-feather="check-circle"></i>
    <div><?= htmlspecialchars($thongbao_ok) ?></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- 2. Hàng 1 — 4 Thẻ thống kê nhỏ gọn (padding: 14px 16px, dịu mắt) -->
<div class="row g-3 mb-4">
    <!-- Thẻ 1: Tổng phiếu bảo hành -->
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100 kpi-card-bh">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-pastel-bh" style="background-color: #f1f5f9; color: #475569;">
                    <i class="align-middle" data-feather="clipboard" style="width: 18px; height: 18px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark" style="letter-spacing: -0.4px;"><?= (int)($thongke['tongsophieu'] ?? 0) ?></div>
                    <div class="text-muted small" style="font-size: 12px;">Tổng phiếu bảo hành</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Đang kiểm tra / Sửa chữa -->
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100 kpi-card-bh">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-pastel-bh" style="background-color: #fef3c7; color: #b45309;">
                    <i class="align-middle" data-feather="tool" style="width: 18px; height: 18px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark" style="letter-spacing: -0.4px;"><?= (int)($thongke['dangsua'] ?? 0) ?></div>
                    <div class="text-muted small" style="font-size: 12px;">Đang kiểm tra / Sửa chữa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Chờ trả khách -->
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100 kpi-card-bh">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-pastel-bh" style="background-color: #e0f2fe; color: #0369a1;">
                    <i class="align-middle" data-feather="package" style="width: 18px; height: 18px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark" style="letter-spacing: -0.4px;"><?= (int)($thongke['chotrakach'] ?? 0) ?></div>
                    <div class="text-muted small" style="font-size: 12px;">Chờ trả khách</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Đã hoàn tất bàn giao -->
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100 kpi-card-bh">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-pastel-bh" style="background-color: #dcfce7; color: #15803d;">
                    <i class="align-middle" data-feather="check-square" style="width: 18px; height: 18px;"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark" style="letter-spacing: -0.4px;"><?= (int)($thongke['dahoanthanh'] ?? 0) ?></div>
                    <div class="text-muted small" style="font-size: 12px;">Đã hoàn tất bàn giao</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. Hàng 2 — Thanh tìm kiếm & Lọc trạng thái gọn gàng -->
<div class="card shadow-sm border-0 rounded-4 p-3 mb-3">
    <form method="GET" action="index.php" class="row g-2 align-items-center">
        <input type="hidden" name="action" value="danhsach">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;">
                    <i class="align-middle" data-feather="search" style="width: 15px; height: 15px;"></i>
                </span>
                <input type="text" class="form-control shadow-none border-start-0" name="tukhoa" placeholder="Tìm theo tên khách, SĐT, IMEI máy..." value="<?= htmlspecialchars($tukhoa ?? '') ?>" style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; height: 38px; font-size: 13.5px;">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <select name="trangthai" class="form-select shadow-none" style="border-radius: 8px; border-color: #cbd5e1; height: 38px; font-size: 13.5px;">
                <option value="">-- Tất cả trạng thái bảo hành --</option>
                <option value="0" <?= (isset($trangthai) && $trangthai === '0') ? 'selected' : '' ?>>0: Tiếp nhận kiểm tra</option>
                <option value="1" <?= (isset($trangthai) && $trangthai === '1') ? 'selected' : '' ?>>1: Đang sửa chữa / Gửi hãng</option>
                <option value="2" <?= (isset($trangthai) && $trangthai === '2') ? 'selected' : '' ?>>2: Đã sửa xong - Chờ trả khách</option>
                <option value="3" <?= (isset($trangthai) && $trangthai === '3') ? 'selected' : '' ?>>3: Đã bàn giao khách</option>
                <option value="4" <?= (isset($trangthai) && $trangthai === '4') ? 'selected' : '' ?>>4: Từ chối bảo hành / Hết hạn</option>
            </select>
        </div>
        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-flagship-dark flex-fill d-inline-flex align-items-center justify-content-center" style="height: 38px; font-size: 13.5px;">
                <i class="align-middle me-1.5" data-feather="filter" style="width: 14px; height: 14px;"></i>Lọc
            </button>
            <a href="index.php" class="btn btn-filter-reset flex-fill d-inline-flex align-items-center justify-content-center text-center" style="height: 38px; font-size: 13.5px;">
                Xóa lọc
            </a>
        </div>
    </form>
</div>

<!-- 4. Hàng 3 — Bảng danh sách phiếu bảo hành (Soft Pastel Badges) -->
<div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head">
                    <tr>
                        <th style="width: 120px;" class="text-center ps-3">Mã BH</th>
                        <th style="width: 210px;">Khách hàng & IMEI</th>
                        <th style="width: 230px;">Thiết bị & Hạn BH</th>
                        <th>Tình trạng lỗi</th>
                        <th class="text-center" style="width: 155px;">Trạng thái</th>
                        <th class="text-center pe-3" style="width: 120px; white-space: nowrap;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($baohanh)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="align-middle text-muted mb-2" data-feather="inbox" style="width: 36px; height: 36px; opacity: 0.4;"></i>
                            <div class="fw-semibold">Chưa có phiếu bảo hành nào phù hợp.</div>
                            <div class="small text-muted mt-1">Bấm "+ Tiếp nhận bảo hành mới" để lập phiếu tiếp nhận thiết bị.</div>
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
                    <td class="text-center ps-3">
                        <div class="fw-bold fs-6" style="color: #d70018; letter-spacing: -0.3px;">
                            <?= sprintf("#BH%05d", $bh_item['id']) ?>
                        </div>
                        <?php if(!empty($bh_item['donhang_id'])): ?>
                        <span class="badge bg-light text-secondary border mt-1" style="font-size: 0.7rem; border-radius: 4px;">
                            <?= sprintf("DH%06d", $bh_item['donhang_id']) ?>
                        </span>
                        <?php endif; ?>
                        <div class="text-muted mt-1" style="font-size: 0.72rem;">
                            <?= date("d/m/Y", strtotime($bh_item['ngaytiepnhan'])) ?>
                        </div>
                    </td>

                    <!-- Cột 2: Khách hàng & IMEI -->
                    <td>
                        <strong class="text-dark d-block" style="font-size: 13.5px;"><?= htmlspecialchars($bh_item['tenkhachhang']) ?></strong>
                        <small class="text-muted"><i class="align-middle me-1" data-feather="phone" style="width: 12px; height: 12px;"></i><?= htmlspecialchars($bh_item['sodienthoai']) ?></small>
                        <?php if(!empty($bh_item['soimei'])): ?>
                        <br><small class="text-secondary" style="font-size: 0.75rem;">IMEI: <span class="font-monospace text-dark fw-semibold"><?= htmlspecialchars($bh_item['soimei']) ?></span></small>
                        <?php endif; ?>
                    </td>

                    <!-- Cột 3: Thiết bị & Hạn BH -->
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="../../images/products/<?= htmlspecialchars($bh_item['hinhanh'] ?? 'default.jpg') ?>"
                                 onerror="this.src='../../images/products/x1.jpg'"
                                 alt="" class="rounded-3 border bg-white p-1 shadow-sm" style="width: 42px; height: 42px; object-fit: contain; flex-shrink: 0;">
                            <div>
                                <div class="fw-semibold text-truncate text-dark" style="font-size: 13.5px; max-width: 165px;"><?= htmlspecialchars($bh_item['tenmathang'] ?? '--') ?></div>
                                <?php if($hanbh): ?>
                                <div class="d-flex align-items-center gap-1 mt-0.5">
                                    <?php if($conhanBH): ?>
                                    <span class="badge rounded-pill fw-semibold px-2 py-0.5" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 0.68rem;">Còn hạn BH</span>
                                    <?php else: ?>
                                    <span class="badge rounded-pill fw-semibold px-2 py-0.5" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 0.68rem;">Hết hạn BH</span>
                                    <?php endif; ?>
                                    <span class="text-muted" style="font-size: 0.72rem;"><?= date("d/m/Y", strtotime($hanbh)) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>

                    <!-- Cột 4: Tình trạng lỗi -->
                    <td>
                        <div class="text-dark" style="font-size: 13px; line-height: 1.4;">
                            <?= htmlspecialchars(mb_substr($bh_item['tinhtrangloi'], 0, 85)) ?><?= mb_strlen($bh_item['tinhtrangloi']) > 85 ? '...' : '' ?>
                        </div>
                        <?php if(!empty($bh_item['ghichu'])): ?>
                        <small class="text-muted fst-italic d-block mt-1" style="font-size: 12px;">
                            <i class="align-middle me-1 text-danger" data-feather="edit-3" style="width: 11px; height: 11px;"></i><?= htmlspecialchars(mb_substr($bh_item['ghichu'], 0, 75)) ?>
                        </small>
                        <?php endif; ?>
                    </td>

                    <!-- Cột 5: Trạng thái (Soft Pastel Badges) -->
                    <td class="text-center">
                        <?php
                        if($tt === 0){
                            echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 12px;"><i class="align-middle me-1" data-feather="clock" style="width: 12px; height: 12px;"></i>Chờ tiếp nhận</span>';
                        } elseif($tt === 1){
                            echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 12px;"><i class="align-middle me-1" data-feather="tool" style="width: 12px; height: 12px;"></i>Đang sửa chữa</span>';
                        } elseif($tt === 2){
                            echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px;"><i class="align-middle me-1" data-feather="package" style="width: 12px; height: 12px;"></i>Chờ trả khách</span>';
                        } elseif($tt === 3){
                            echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px;"><i class="align-middle me-1" data-feather="check-circle" style="width: 12px; height: 12px;"></i>Đã trả khách</span>';
                        } elseif($tt === 4){
                            echo '<span class="badge rounded-pill fw-semibold px-2.5 py-1 text-nowrap" style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; font-size: 12px;"><i class="align-middle me-1" data-feather="x-circle" style="width: 12px; height: 12px;"></i>Từ chối BH</span>';
                        }
                        ?>
                    </td>

                    <!-- Cột 6: Thao tác duy nhất (Xử lý - icon cây bút) -->
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center gap-1.5"
                                style="border-radius: 8px; padding: 5px 12px; font-weight: 600; font-size: 12.5px; border: 1px solid #fecaca; color: #d70018; background-color: #fff5f5; transition: all 0.2s ease;"
                                title="Cập nhật tiến độ & ghi chú"
                                data-bs-toggle="modal" data-bs-target="#modalGhiChu<?= $bh_item['id'] ?>">
                            <i class="align-middle" data-feather="edit-2" style="width: 13px; height: 13px;"></i>
                            <span>Xử lý</span>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal cập nhật tiến độ & ghi chú bảo hành (Bo góc 14px, đồng bộ Flagship) -->
<?php if(!empty($baohanh)): ?>
<?php foreach($baohanh as $bh_item): ?>
<?php $tt = (int)($bh_item['trangthai'] ?? 0); ?>
<div class="modal fade" id="modalGhiChu<?= $bh_item['id'] ?>" tabindex="-1" aria-labelledby="lblModal<?= $bh_item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="capnhat">
                <input type="hidden" name="id" value="<?= $bh_item['id'] ?>">
                
                <div class="modal-header bg-white py-3 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="section-accent-bar"></div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="lblModal<?= $bh_item['id'] ?>" style="font-size: 15px;">
                            Cập nhật tiến độ #BH<?= sprintf('%05d', $bh_item['id']) ?>
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="mb-3 p-2.5 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <label class="form-label fw-semibold small text-muted mb-1">Khách hàng & Thiết bị:</label>
                        <div class="text-dark small">
                            <strong><?= htmlspecialchars($bh_item['tenkhachhang']) ?></strong> (<?= htmlspecialchars($bh_item['sodienthoai']) ?>)
                            <br><span class="text-secondary"><?= htmlspecialchars($bh_item['tenmathang'] ?? '') ?></span>
                            <?php if(!empty($bh_item['soimei'])): ?>
                            <span class="text-muted ms-1">| IMEI: <?= htmlspecialchars($bh_item['soimei']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted mb-1">Trạng thái xử lý:</label>
                        <select name="trangthai" class="form-select shadow-none" style="border-radius: 8px; border-color: #cbd5e1; height: 40px; font-size: 13.5px;">
                            <option value="0" <?= $tt===0?'selected':'' ?>>0: Tiếp nhận kiểm tra</option>
                            <option value="1" <?= $tt===1?'selected':'' ?>>1: Đang sửa chữa / Gửi hãng</option>
                            <option value="2" <?= $tt===2?'selected':'' ?>>2: Đã sửa xong - Chờ trả khách</option>
                            <option value="3" <?= $tt===3?'selected':'' ?>>3: Đã bàn giao khách</option>
                            <option value="4" <?= $tt===4?'selected':'' ?>>4: Từ chối bảo hành / Hết hạn</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-semibold small text-muted mb-1">Ghi chú sửa chữa / Chi phí phát sinh:</label>
                        <textarea name="ghichu" class="form-control shadow-none" rows="3"
                                  placeholder="VD: Đã thay màn hình linh kiện chính hãng, chi phí phát sinh..."
                                  style="border-radius: 8px; border-color: #cbd5e1; font-size: 13.5px;"><?= htmlspecialchars($bh_item['ghichu'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light py-2.5 px-4 border-top">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="border-radius: 8px; height: 36px;">Đóng</button>
                    <button type="submit" class="btn btn-sm btn-flagship-red px-3 d-inline-flex align-items-center" style="height: 36px;">
                        <i class="align-middle me-1.5" data-feather="save" style="width: 15px; height: 15px;"></i>Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<?php include("../inc/bottom.php"); ?>