<?php include("../inc/top.php"); ?>

<style>
.column-sort-link {
    color: #475569;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    transition: color 0.15s ease;
}
.column-sort-link:hover {
    color: #d70018;
}
.btn-red-user {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    transition: all 0.2s ease;
}
.btn-red-user:hover {
    background-color: #b30012;
    border-color: #b30012;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
</style>

<!-- ================= HEADER TRANG & NÚT THAO TÁC ================= -->
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-md-7">
        <div class="d-flex align-items-center">
            <div style="width: 5px; height: 42px; background-color: #d70018; border-radius: 4px; margin-right: 14px; flex-shrink: 0;"></div>
            <div>
                <h2 class="h3 fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">QUẢN LÝ NGƯỜI DÙNG</h2>
                <p class="text-muted small mb-0">
                    Quản lý tài khoản quản trị viên, nhân viên và khách hàng của Thảo Mobile
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-2">
            <span class="badge bg-white text-secondary border px-3 py-2 shadow-sm" style="border-radius: 10px; font-weight: 500; font-size: 13px;">
                <i class="align-middle me-1 text-primary" data-feather="users" style="width: 14px; height: 14px;"></i>
                Tổng cộng: <strong class="text-dark"><?= !empty($nguoidung) ? count($nguoidung) : 0 ?></strong> tài khoản
            </span>
            <a href="index.php?action=them" class="btn btn-red-user d-inline-flex align-items-center shadow-sm px-3 py-2" style="border-radius: 10px; font-weight: 600; font-size: 13.5px;">
                <i class="align-middle me-1" data-feather="user-plus" style="width: 16px; height: 16px;"></i> + Thêm người dùng
            </a>
        </div>
    </div>
</div>

<!-- ================= THÔNG BÁO HỆ THỐNG NẾU CÓ ================= -->
<?php if(isset($tb)): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 12px; background-color: #fef2f2; border-left: 4px solid #ef4444 !important;" role="alert">
        <div class="d-flex align-items-center">
            <i class="align-middle me-2 text-danger" data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
            <div>
                <strong class="text-danger">Thông báo:</strong> <?= htmlspecialchars($tb) ?>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- ================= BẢNG DANH SÁCH NGƯỜI DÙNG TRONG THẺ TRẮNG ================= -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #ffffff;">
    <div class="card-body p-0">
        <?php if(empty($nguoidung)): ?>
            <div class="text-center py-5 text-muted">
                <i data-feather="users" style="width: 44px; height: 44px; stroke-width: 1.5; color: #adb5bd;" class="mb-2"></i>
                <p class="mb-0 fw-semibold">Không tìm thấy tài khoản người dùng nào.</p>
            </div>
        <?php else: ?>
            <?php $currentSort = $_GET["sort"] ?? ""; ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 220px;">
                                <a href="index.php?sort=hoten" class="text-decoration-none d-inline-flex align-items-center column-sort-link <?= ($currentSort == 'hoten') ? 'text-danger' : '' ?>">
                                    <span>HỌ TÊN</span>
                                    <i class="align-middle ms-1" data-feather="arrow-down" style="width: 12px; height: 12px; opacity: <?= ($currentSort == 'hoten') ? '1' : '0.4' ?>;"></i>
                                </a>
                            </th>
                            <th class="py-3" style="min-width: 220px;">
                                <a href="index.php?sort=email" class="text-decoration-none d-inline-flex align-items-center column-sort-link <?= ($currentSort == 'email') ? 'text-danger' : '' ?>">
                                    <span>EMAIL</span>
                                    <i class="align-middle ms-1" data-feather="arrow-down" style="width: 12px; height: 12px; opacity: <?= ($currentSort == 'email') ? '1' : '0.4' ?>;"></i>
                                </a>
                            </th>
                            <th class="py-3" style="min-width: 150px;">
                                <a href="index.php?sort=sodienthoai" class="text-decoration-none d-inline-flex align-items-center column-sort-link <?= ($currentSort == 'sodienthoai') ? 'text-danger' : '' ?>">
                                    <span>SỐ ĐIỆN THOẠI</span>
                                    <i class="align-middle ms-1" data-feather="arrow-down" style="width: 12px; height: 12px; opacity: <?= ($currentSort == 'sodienthoai') ? '1' : '0.4' ?>;"></i>
                                </a>
                            </th>
                            <th class="py-3 text-center" style="width: 140px;">
                                <a href="index.php?sort=loai" class="text-decoration-none d-inline-flex align-items-center column-sort-link <?= ($currentSort == 'loai') ? 'text-danger' : '' ?>">
                                    <span>LOẠI QUYỀN</span>
                                    <i class="align-middle ms-1" data-feather="arrow-down" style="width: 12px; height: 12px; opacity: <?= ($currentSort == 'loai') ? '1' : '0.4' ?>;"></i>
                                </a>
                            </th>
                            <th class="py-3 text-center" style="width: 130px;">
                                <span class="column-sort-link" style="cursor: default;">TRẠNG THÁI</span>
                            </th>
                            <th class="pe-4 py-3 text-center" style="width: 130px;">
                                <span class="column-sort-link" style="cursor: default;">THAO TÁC</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nguoidung as $nd): ?>
                            <?php 
                            $avatarPath = (!empty($nd["hinhanh"])) ? "../../images/users/" . $nd["hinhanh"] : "../../images/users/user.png";
                            $firstChar = mb_strtoupper(mb_substr(trim($nd["hoten"] ?? 'U'), 0, 1, "UTF-8"), "UTF-8");
                            $isCurrentAdmin = (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["id"] == $nd["id"]);
                            $isRootAdmin = ($nd["loai"] == 1);
                            ?>
                            <tr>
                                <!-- Cột 1: Họ tên & Avatar -->
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 position-relative" style="width: 36px; height: 36px; flex-shrink: 0;">
                                            <?php if (!empty($nd["hinhanh"])): ?>
                                                <img src="<?= $avatarPath ?>" alt="<?= htmlspecialchars($nd["hoten"]) ?>" 
                                                     class="rounded-circle border" width="36" height="36" 
                                                     style="object-fit: cover;" 
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="rounded-circle align-items-center justify-content-center text-white fw-bold shadow-sm" 
                                                     style="width: 36px; height: 36px; background: linear-gradient(135deg, #d70018 0%, #b91c1c 100%); display: none; font-size: 13.5px;">
                                                    <?= $firstChar ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                                     style="width: 36px; height: 36px; background: #fee2e2; color: #d70018; font-size: 13.5px; border: 1px solid #fecaca;">
                                                    <?= $firstChar ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px;">
                                                <?= htmlspecialchars($nd["hoten"]) ?>
                                                <?php if($isCurrentAdmin): ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-1" style="font-size: 10px; font-weight: 600;">Bạn</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-muted small" style="font-size: 11.5px;">ID: #<?= $nd["id"] ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Cột 2: Email -->
                                <td>
                                    <div class="d-flex align-items-center text-dark" style="font-size: 13px;">
                                        <i class="align-middle me-2 text-muted" data-feather="mail" style="width: 14px; height: 14px; flex-shrink: 0;"></i>
                                        <span><?= htmlspecialchars($nd["email"]) ?></span>
                                    </div>
                                </td>

                                <!-- Cột 3: Số điện thoại -->
                                <td>
                                    <?php if(!empty($nd["sodienthoai"])): ?>
                                        <div class="d-flex align-items-center text-dark" style="font-size: 13px;">
                                            <i class="align-middle me-2 text-muted" data-feather="phone" style="width: 14px; height: 14px; flex-shrink: 0;"></i>
                                            <span><?= htmlspecialchars($nd["sodienthoai"]) ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">—</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Cột 4: Loại quyền -->
                                <td class="text-center">
                                    <?php if($nd["loai"] == 1): ?>
                                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #fee2e2; color: #d70018; font-size: 11.5px; border: 1px solid #fecaca;">
                                            <i class="align-middle me-1" data-feather="shield" style="width: 11px; height: 11px;"></i>Quản trị
                                        </span>
                                    <?php elseif($nd["loai"] == 2): ?>
                                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #e0f2fe; color: #0369a1; font-size: 11.5px; border: 1px solid #bae6fd;">
                                            <i class="align-middle me-1" data-feather="user-check" style="width: 11px; height: 11px;"></i>Nhân viên
                                        </span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #f1f5f9; color: #475569; font-size: 11.5px; border: 1px solid #e2e8f0;">
                                            <i class="align-middle me-1" data-feather="user" style="width: 11px; height: 11px;"></i>Khách hàng
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Cột 5: Trạng thái -->
                                <td class="text-center">
                                    <?php if($nd["trangthai"] == 1): ?>
                                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #dcfce7; color: #15803d; font-size: 11.5px; border: 1px solid #bbf7d0;">
                                            ● Kích hoạt
                                        </span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill fw-bold px-2 py-1" style="background-color: #ffedd5; color: #c2410c; font-size: 11.5px; border: 1px solid #fed7aa;">
                                            ● Đã khóa
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Cột 6: Thao tác -->
                                <td class="pe-4 text-center">
                                    <?php if ($isRootAdmin || $isCurrentAdmin): ?>
                                        <span class="badge text-secondary border px-2 py-1" style="background-color: #f8fafc; font-size: 11px; font-weight: 500;">
                                            <i class="align-middle me-1" data-feather="shield" style="width: 11px; height: 11px;"></i>Mặc định
                                        </span>
                                    <?php else: ?>
                                        <?php if ($nd["trangthai"] == 1): ?>
                                            <a href="index.php?action=khoa&trangthai=0&mand=<?= $nd["id"] ?>" 
                                               class="btn btn-sm btn-outline-danger d-inline-flex align-items-center py-1 px-2" 
                                               style="border-radius: 8px; font-size: 12px; font-weight: 500;"
                                               onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản <?= htmlspecialchars($nd['hoten']) ?> không?');">
                                                <i class="align-middle me-1" data-feather="lock" style="width: 12px; height: 12px;"></i>Khóa
                                            </a>
                                        <?php else: ?>
                                            <a href="index.php?action=khoa&trangthai=1&mand=<?= $nd["id"] ?>" 
                                               class="btn btn-sm btn-outline-success d-inline-flex align-items-center py-1 px-2" 
                                               style="border-radius: 8px; font-size: 12px; font-weight: 500;"
                                               onclick="return confirm('Bạn có chắc chắn muốn mở khóa kích hoạt tài khoản <?= htmlspecialchars($nd['hoten']) ?> không?');">
                                                <i class="align-middle me-1" data-feather="unlock" style="width: 12px; height: 12px;"></i>Mở khóa
                                            </a>
                                        <?php endif; ?>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>

<?php include("../inc/bottom.php"); ?>
