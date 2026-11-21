<?php include("../inc/top.php"); ?>

<div class="row mb-3">
    <div class="col-12">
        <h3 class="text-info fw-bold mb-1">Bảng điều khiển hệ thống</h3>
        <p class="text-muted small mb-0">Tổng quan tình hình kinh doanh và hoạt động của cửa hàng điện thoại</p>
    </div>
</div>

<!-- Hàng 1 — 4 thẻ thống kê tổng quan -->
<div class="row">
    <!-- Thẻ 1: Doanh thu -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted">Doanh thu</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <h2 class="mt-1 mb-2 text-primary fw-bold"><?php echo number_format($tongdoanhthu ?? 0, 0, ',', '.'); ?>đ</h2>
                <div class="mb-0 text-muted small">
                    <span class="text-success me-1"><i class="align-middle" data-feather="trending-up"></i> Tích lũy</span>
                    <span>Tổng doanh thu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 2: Đơn hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted">Đơn hàng</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-success">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <h2 class="mt-1 mb-2 fw-bold text-dark"><?php echo number_format($tongdonhang ?? 0, 0, ',', '.'); ?></h2>
                <div class="mb-0">
                    <a href="#donhangmoinhat" class="text-primary small text-decoration-none fw-semibold">
                        Xem chi tiết &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 3: Sản phẩm -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted">Sản phẩm</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-warning">
                            <i class="align-middle" data-feather="package"></i>
                        </div>
                    </div>
                </div>
                <h2 class="mt-1 mb-2 fw-bold text-dark"><?php echo number_format($tongmathang ?? 0, 0, ',', '.'); ?></h2>
                <div class="mb-0">
                    <a href="../qlmathang/index.php" class="text-warning small text-decoration-none fw-semibold">
                        Quản lý kho &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thẻ 4: Khách hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title text-muted">Khách hàng</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-info">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <h2 class="mt-1 mb-2 fw-bold text-dark"><?php echo number_format($tongkhachhang ?? 0, 0, ',', '.'); ?></h2>
                <div class="mb-0">
                    <a href="../qlnguoidung/index.php" class="text-info small text-decoration-none fw-semibold">
                        Danh sách &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hàng 2 — 2 bảng dữ liệu song song -->
<div class="row">
    <!-- Cột trái (col-lg-7) — Đơn hàng mới nhất -->
    <div class="col-lg-7 mb-4">
        <div class="card h-100 shadow-sm border-0" id="donhangmoinhat">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-primary" data-feather="clock"></i>
                    Đơn hàng mới nhất
                </h5>
            </div>
            <div class="card-body p-0">
                <?php if (empty($donhangmoinhat)): ?>
                    <p class="text-muted text-center py-4 my-0">Chưa có đơn hàng nào</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle my-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Mã ĐH</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th class="text-end pe-3">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donhangmoinhat as $dh): ?>
                                    <tr>
                                        <td class="ps-3">
                                            <span class="badge bg-light text-primary border fw-bold"><?php echo sprintf("DH%06d", $dh["id"]); ?></span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-dark"><?php echo htmlspecialchars($dh["hoten"] ?? 'Khách vãng lai'); ?></span>
                                            <?php if (!empty($dh["sodienthoai"])): ?>
                                                <div class="text-muted small"><?php echo htmlspecialchars($dh["sodienthoai"]); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-muted small">
                                            <?php echo !empty($dh["ngay"]) ? date("d/m/Y H:i", strtotime($dh["ngay"])) : "—"; ?>
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="text-danger fw-bold"><?php echo number_format($dh["tongtien"] ?? 0, 0, ',', '.'); ?>đ</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Cột phải (col-lg-5) — Cảnh báo tồn kho / Sản phẩm sắp hết hàng -->
    <div class="col-lg-5 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-warning" data-feather="alert-triangle"></i>
                    Cảnh báo tồn kho (Thấp nhất)
                </h5>
            </div>
            <div class="card-body p-0">
                <?php if (empty($mathangsaphet)): ?>
                    <p class="text-muted text-center py-4 my-0">Không có dữ liệu mặt hàng</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle my-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3" style="width: 50px;">Ảnh</th>
                                    <th>Tên điện thoại</th>
                                    <th class="text-end pe-3">Tồn kho</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mathangsaphet as $sp): ?>
                                    <tr>
                                        <td class="ps-3">
                                            <img src="../../<?php echo htmlspecialchars($sp["hinhanh"] ?? ''); ?>" 
                                                 alt="<?php echo htmlspecialchars($sp["tenmathang"] ?? ''); ?>" 
                                                 width="40" height="40" 
                                                 class="rounded border" 
                                                 style="object-fit: cover;" 
                                                 onerror="this.src='../../images/products/no-image.png'">
                                        </td>
                                        <td>
                                            <a href="../qlmathang/index.php?action=chitiet&id=<?php echo $sp["id"]; ?>" class="text-dark text-decoration-none fw-semibold">
                                                <?php echo htmlspecialchars($sp["tenmathang"]); ?>
                                            </a>
                                            <div class="text-muted small"><?php echo number_format($sp["giaban"] ?? 0, 0, ',', '.'); ?>đ</div>
                                        </td>
                                        <td class="text-end pe-3">
                                            <?php if ($sp["soluongton"] < 5): ?>
                                                <span class="badge bg-danger">Còn <?php echo $sp["soluongton"]; ?></span>
                                            <?php elseif ($sp["soluongton"] < 15): ?>
                                                <span class="badge bg-warning text-dark">Còn <?php echo $sp["soluongton"]; ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Còn <?php echo $sp["soluongton"]; ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Hàng 3 — Lối tắt thao tác nhanh -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="align-middle me-2 text-primary" data-feather="zap"></i>
                    Lối tắt thao tác nhanh
                </h5>
            </div>
            <div class="card-body">
                <a href="../qlmathang/index.php?action=them" class="btn btn-primary me-2 mb-2">
                    <i class="align-middle me-1" data-feather="plus-circle"></i> + Thêm điện thoại mới
                </a>
                <a href="../qldanhmuc/index.php" class="btn btn-outline-primary me-2 mb-2">
                    <i class="align-middle me-1" data-feather="grid"></i> Quản lý danh mục
                </a>
                <a href="../qlnguoidung/index.php" class="btn btn-outline-info me-2 mb-2">
                    <i class="align-middle me-1" data-feather="users"></i> Quản lý người dùng
                </a>
                <a href="../qlmathang/index.php" class="btn btn-outline-secondary me-2 mb-2">
                    <i class="align-middle me-1" data-feather="package"></i> Quản lý kho hàng
                </a>
                <a href="../../public/index.php" target="_blank" class="btn btn-outline-success me-2 mb-2">
                    <i class="align-middle me-1" data-feather="external-link"></i> Xem website bán hàng
                </a>
            </div>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>