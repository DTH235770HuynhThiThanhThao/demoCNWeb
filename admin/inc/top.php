<?php
// Khởi tạo các biến thông báo mặc định
$so_don_moi = 0;
$so_bh_moi = 0;
$so_sap_het = 0;
$ds_don_moi = array();
$ds_bh_moi = array();
$ds_sap_het = array();
$tong_thongbao = 0;

try {
    if (!class_exists("DATABASE")) {
        require_once(__DIR__ . "/../../model/database.php");
    }
    $db = DATABASE::connect();

    // 1. Đơn hàng mới chờ xác nhận (trangthai = 0)
    $cmd_dem_don = $db->query("SELECT COUNT(*) FROM donhang WHERE trangthai = 0");
    $so_don_moi = (int)$cmd_dem_don->fetchColumn();

    if ($so_don_moi > 0) {
        $cmd_ds_don = $db->query("SELECT d.id, d.ngay AS ngaydat, d.tongtien, n.hoten 
                                  FROM donhang d 
                                  LEFT JOIN nguoidung n ON d.nguoidung_id = n.id 
                                  WHERE d.trangthai = 0 
                                  ORDER BY d.id DESC 
                                  LIMIT 5");
        $ds_don_moi = $cmd_ds_don->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Yêu cầu bảo hành mới tiếp nhận (trangthai = 0)
    $cmd_dem_bh = $db->query("SELECT COUNT(*) FROM baohanh WHERE trangthai = 0");
    $so_bh_moi = (int)$cmd_dem_bh->fetchColumn();

    if ($so_bh_moi > 0) {
        $cmd_ds_bh = $db->query("SELECT b.id, b.tenkhachhang, b.ngaytiepnhan, m.tenmathang AS tenhang 
                                 FROM baohanh b 
                                 LEFT JOIN mathang m ON b.mathang_id = m.id 
                                 WHERE b.trangthai = 0 
                                 ORDER BY b.id DESC 
                                 LIMIT 3");
        $ds_bh_moi = $cmd_ds_bh->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Cảnh báo điện thoại sắp hết hàng (soluongton <= 5)
    $cmd_dem_het = $db->query("SELECT COUNT(*) FROM mathang WHERE soluongton <= 5");
    $so_sap_het = (int)$cmd_dem_het->fetchColumn();

    if ($so_sap_het > 0) {
        $cmd_ds_het = $db->query("SELECT id, tenmathang AS tenhang, soluongton 
                                  FROM mathang 
                                  WHERE soluongton <= 5 
                                  ORDER BY soluongton ASC, id ASC 
                                  LIMIT 2");
        $ds_sap_het = $cmd_ds_het->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tổng số thông báo cần xử lý
    $tong_thongbao = $so_don_moi + $so_bh_moi + $so_sap_het;

    // Tạo chữ ký nhận diện tập hợp thông báo hiện tại
    $alert_keys = array();
    foreach ($ds_don_moi as $dh) {
        $alert_keys[] = "dh_" . $dh['id'];
    }
    foreach ($ds_bh_moi as $bh) {
        $alert_keys[] = "bh_" . $bh['id'];
    }
    foreach ($ds_sap_het as $sp) {
        $alert_keys[] = "sp_" . $sp['id'];
    }
    $current_alert_signature = "c:" . $so_don_moi . "_" . $so_bh_moi . "_" . $so_sap_het . "|ids:" . implode(",", $alert_keys);
} catch (Exception $e) {
    // Bọc trong try...catch an toàn để không bao giờ gây lỗi giao diện
    $so_don_moi = 0;
    $so_bh_moi = 0;
    $so_sap_het = 0;
    $ds_don_moi = array();
    $ds_bh_moi = array();
    $ds_sap_het = array();
    $tong_thongbao = 0;
    $current_alert_signature = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<title>Trang quản trị - Thảo Mobile</title>

	<link href="../inc/css/app.css" rel="stylesheet">
	<script src="../inc/js/app.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

	<!-- Phong cách Tech Flagship hiện đại Thảo Mobile -->
	<style>
		/* Nền Sidebar tối sang trọng */
		.sidebar, 
		.sidebar-content, 
		.sidebar-nav {
			background: #181c24 !important;
			background: linear-gradient(180deg, #181c24 0%, #11141a 100%) !important;
		}

		/* Khối thương hiệu Brand */
		.sidebar-brand {
			padding: 1.15rem 1.25rem !important;
			background: transparent !important;
		}
		.sidebar-brand:hover {
			opacity: 0.95;
		}

		/* Tiêu đề nhóm xám bạc tinh tế */
		.sidebar-header {
			color: #64748b !important;
			font-size: 0.7rem !important;
			font-weight: 700 !important;
			letter-spacing: 0.08em !important;
			padding: 1.25rem 1.4rem 0.45rem !important;
			text-transform: uppercase !important;
			background: transparent !important;
		}

		/* Tinh chỉnh mục Sidebar */
		.sidebar-item {
			margin-bottom: 2px !important;
		}
		.sidebar-link {
			color: #cbd5e1 !important;
			border-radius: 10px !important;
			margin: 2px 12px !important;
			padding: 0.62rem 0.95rem !important;
			white-space: nowrap !important;
			font-size: 0.88rem !important;
			font-weight: 500 !important;
			display: flex !important;
			align-items: center !important;
			transition: all 0.2s ease !important;
			background: transparent !important;
			border-left: none !important;
		}
		.sidebar-link i, 
		.sidebar-link svg {
			color: #94a3b8 !important;
			margin-right: 0.75rem !important;
			width: 18px !important;
			height: 18px !important;
			flex-shrink: 0 !important;
			transition: color 0.2s ease, transform 0.2s ease !important;
		}

		/* Hiệu ứng Hover mục thường */
		.sidebar-link:hover {
			background: rgba(255, 255, 255, 0.07) !important;
			color: #ffffff !important;
		}
		.sidebar-link:hover i, 
		.sidebar-link:hover svg {
			color: #ff4d6d !important;
			transform: scale(1.08);
		}

		/* Hiệu ứng Active tông đỏ thương hiệu #d70018 */
		.sidebar-item.active > .sidebar-link {
			background: linear-gradient(90deg, #d70018 0%, #b91c1c 100%) !important;
			color: #ffffff !important;
			font-weight: 600 !important;
			border-radius: 10px !important;
			margin: 2px 12px !important;
			box-shadow: 0 4px 14px rgba(215, 0, 24, 0.35) !important;
			border-left: none !important;
		}
		.sidebar-item.active > .sidebar-link i, 
		.sidebar-item.active > .sidebar-link svg {
			color: #ffffff !important;
			transform: none !important;
		}
		.sidebar-item.active > .sidebar-link:hover {
			background: linear-gradient(90deg, #d70018 0%, #b91c1c 100%) !important;
			color: #ffffff !important;
		}

		/* Xóa vạch xanh mặc định của template AdminKit nếu có */
		.sidebar-item.active:before,
		.sidebar-item.active:after,
		.sidebar-link:before,
		.sidebar-link:after {
			display: none !important;
			content: none !important;
		}

		/* Đánh dấu thông báo đã đọc / chưa đọc */
		.alert-item {
			transition: background-color 0.2s ease, opacity 0.2s ease;
		}
		.alert-item:hover {
			background-color: #f8f9fa !important;
		}
		.alert-item.alert-item-read {
			opacity: 0.65;
			background-color: #fbfbfb;
		}
		.alert-item.alert-item-read .alert-title {
			color: #64748b !important;
			font-weight: 500 !important;
		}
		.alert-item.alert-item-read .unread-dot {
			display: none !important;
		}
		.unread-dot {
			width: 7px;
			height: 7px;
			background-color: #d70018;
			border-radius: 50%;
			display: inline-block;
			flex-shrink: 0;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand d-flex align-items-center py-3 px-3 text-decoration-none" href="../../public/index.php" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
					<div class="brand-logo-container me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); overflow: hidden; flex-shrink: 0;">
						<img src="../../images/logo/logo2.jpg" alt="Thảo Mobile" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='../../images/logo/logo.jpg'">
					</div>
					<div class="brand-info text-start lh-sm">
						<div class="fw-bold text-white text-uppercase" style="letter-spacing: 0.6px; font-size: 0.95rem;">THẢO MOBILE</div>
						<div style="color: #94a3b8; font-size: 0.72rem; font-weight: 500;">Hệ thống quản trị</div>
					</div>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						HỆ THỐNG
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"ktnguoidung") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../ktnguoidung/index.php">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Bảng điều khiển</span>
						</a>
					</li>

				<?php if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1){ ?>
					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlnguoidung") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlnguoidung/index.php">
						<i class="align-middle" data-feather="users"></i> <span class="align-middle">Quản lý người dùng</span>
						</a>
					</li>
				<?php } ?>

					<li class="sidebar-header">
						DANH MỤC
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qldanhmuc") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldanhmuc/index.php">
						<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Quản lý danh mục</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlmathang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlmathang/index.php">
						<i class="align-middle" data-feather="package"></i> <span class="align-middle">Quản lý hàng hóa</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlnhaphang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlnhaphang/index.php">
						<i class="align-middle" data-feather="download-cloud"></i> <span class="align-middle">Quản lý kho & nhập hàng</span>
						</a>
					</li>

					<li class="sidebar-header">
						KINH DOANH
					</li>
					
					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlkhachhang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlkhachhang/index.php">
						<i class="align-middle" data-feather="users"></i> <span class="align-middle">Quản lý khách hàng</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qldonhang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldonhang/index.php">
						<i class="align-middle" data-feather="truck"></i> <span class="align-middle">Quản lý đơn hàng</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlbaohanh") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlbaohanh/index.php">
						<i class="align-middle" data-feather="shield"></i> <span class="align-middle">Quản lý bảo hành</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qldoanhthu") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldoanhthu/index.php">
						<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Quản lý doanh thu</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlkhuyenmai") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlkhuyenmai/index.php">
						<i class="align-middle" data-feather="tag"></i> <span class="align-middle">Chương trình khuyến mãi</span>
						</a>
					</li>

					
					
					<li class="sidebar-header">
						CẤU HÌNH WEBSITE
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlthongtin") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlthongtin/index.php">
						<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Thông tin</span>
						</a>
					</li>

					<li class="sidebar-item <?php if(strpos($_SERVER['REQUEST_URI'],"qlhinhanh") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlhinhanh/index.php">
						<i class="align-middle" data-feather="image"></i> <span class="align-middle">Hình ảnh</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Thông báo hệ thống">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<?php if ($tong_thongbao > 0): ?>
										<span class="indicator" id="alertIndicatorBadge" style="background-color: #dc3545; color: #fff; font-weight: 700;"><?= $tong_thongbao ?></span>
										<script>
											// Ẩn ngay lập tức nếu Admin đã xem qua tập hợp thông báo này để chống chớp nháy số đỏ
											(function() {
												try {
													var currentSig = <?= json_encode($current_alert_signature) ?>;
													var seenSig = localStorage.getItem('thao_mobile_admin_seen_alerts');
													if (seenSig && seenSig === currentSig) {
														var badge = document.getElementById('alertIndicatorBadge');
														if (badge) badge.style.display = 'none';
													}
												} catch(e) {}
											})();
										</script>
									<?php endif; ?>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0 shadow border-0" aria-labelledby="alertsDropdown" style="min-width: 330px;">
								<div class="dropdown-menu-header py-2 px-3 fw-bold text-center" style="background-color: #f8f9fa; color: #212529; border-bottom: 1px solid #e9ecef;">
									<?php if ($tong_thongbao > 0): ?>
										<span class="text-danger fw-bold"><i class="align-middle me-1" data-feather="alert-circle" style="width: 15px; height: 15px;"></i><?= $tong_thongbao ?> thông báo cần xử lý</span>
									<?php else: ?>
										<span class="text-secondary fw-semibold">Thông báo hệ thống</span>
									<?php endif; ?>
								</div>
								<div class="list-group list-group-flush" style="max-height: 380px; overflow-y: auto;">
									<?php if ($tong_thongbao == 0): ?>
										<div class="list-group-item text-center py-4 text-muted border-0">
											<i class="align-middle mb-2 text-success" data-feather="check-circle" style="width: 32px; height: 32px;"></i>
											<div class="small fw-semibold text-secondary">Hiện không có thông báo mới nào cần xử lý.</div>
										</div>
									<?php else: ?>
										<!-- 1. Đơn hàng mới chờ xác nhận -->
										<?php foreach ($ds_don_moi as $dh): ?>
											<a href="../qldonhang/index.php?action=chitiet&id=<?= $dh['id'] ?>" class="list-group-item list-group-item-action py-2 alert-item" data-alert-id="dh_<?= $dh['id'] ?>">
												<div class="row g-0 align-items-center">
													<div class="col-2 text-center">
														<div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background-color: rgba(215, 0, 24, 0.1);">
															<i class="align-middle" data-feather="shopping-cart" style="color: #d70018; width: 17px; height: 17px;"></i>
														</div>
													</div>
													<div class="col-10 ps-2">
														<div class="text-dark fw-bold small alert-title d-flex align-items-center justify-content-between">
															<span>Đơn hàng mới <?= sprintf("#DH%06d", $dh['id']) ?></span>
															<span class="unread-dot"></span>
														</div>
														<div class="text-muted small mt-1 alert-desc" style="font-size: 12px;">Khách: <strong><?= htmlspecialchars($dh['hoten'] ?? 'Khách vãng lai') ?></strong> • <span class="text-danger fw-semibold"><?= number_format($dh['tongtien'], 0, ',', '.') ?>đ</span></div>
														<div class="text-muted small mt-1" style="font-size: 11px;"><i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i><?= date("d/m/Y H:i", strtotime($dh['ngaydat'])) ?></div>
													</div>
												</div>
											</a>
										<?php endforeach; ?>

										<!-- 2. Yêu cầu bảo hành mới tiếp nhận -->
										<?php foreach ($ds_bh_moi as $bh): ?>
											<a href="../qlbaohanh/index.php" class="list-group-item list-group-item-action py-2 alert-item" data-alert-id="bh_<?= $bh['id'] ?>">
												<div class="row g-0 align-items-center">
													<div class="col-2 text-center">
														<div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background-color: rgba(245, 158, 11, 0.15);">
															<i class="align-middle" data-feather="shield" style="color: #f59e0b; width: 17px; height: 17px;"></i>
														</div>
													</div>
													<div class="col-10 ps-2">
														<div class="text-dark fw-bold small alert-title d-flex align-items-center justify-content-between">
															<span>Yêu cầu bảo hành <?= sprintf("#BH%05d", $bh['id']) ?></span>
															<span class="unread-dot"></span>
														</div>
														<div class="text-muted small mt-1 alert-desc" style="font-size: 12px;"><strong><?= htmlspecialchars($bh['tenkhachhang']) ?></strong> • Máy: <?= htmlspecialchars($bh['tenhang'] ?? 'Điện thoại') ?></div>
														<div class="text-muted small mt-1" style="font-size: 11px;"><i class="align-middle me-1" data-feather="clock" style="width: 11px; height: 11px;"></i><?= date("d/m/Y H:i", strtotime($bh['ngaytiepnhan'])) ?></div>
													</div>
												</div>
											</a>
										<?php endforeach; ?>

										<!-- 3. Cảnh báo tồn kho thấp -->
										<?php foreach ($ds_sap_het as $sp): ?>
											<a href="../qlnhaphang/index.php" class="list-group-item list-group-item-action py-2 alert-item" data-alert-id="sp_<?= $sp['id'] ?>">
												<div class="row g-0 align-items-center">
													<div class="col-2 text-center">
														<div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background-color: rgba(252, 185, 44, 0.18);">
															<i class="align-middle" data-feather="alert-triangle" style="color: #d97706; width: 17px; height: 17px;"></i>
														</div>
													</div>
													<div class="col-10 ps-2">
														<div class="text-dark fw-bold small alert-title d-flex align-items-center justify-content-between">
															<span>Sắp hết hàng: <?= htmlspecialchars($sp['tenhang']) ?></span>
															<span class="unread-dot"></span>
														</div>
														<div class="text-danger small mt-1 fw-semibold alert-desc" style="font-size: 12px;">Chỉ còn <?= (int)$sp['soluongton'] ?> chiếc trong kho</div>
													</div>
												</div>
											</a>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<div class="dropdown-menu-footer text-center py-2 bg-light border-top">
									<a href="../qldonhang/index.php" class="text-primary fw-semibold small text-decoration-none">
										Quản lý tất cả đơn hàng <i class="align-middle ms-1" data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
									</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="<?php if (empty($_SESSION["nguoidung"]["hinhanh"])) echo "../../images/users/user.png"; else echo "../../images/users/" . $_SESSION["nguoidung"]["hinhanh"]; ?>" class="avatar img-fluid rounded-circle me-1" width="36" height="36" style="object-fit: cover;" /> 
								<span class="text-dark">Chào <?php if(isset($_SESSION["nguoidung"])) echo $_SESSION["nguoidung"]["hoten"]; else echo "bạn"; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
							
								<a class="dropdown-item fw-semibold text-primary" href="../../public/index.php">
									<i class="align-middle me-1" data-feather="external-link"></i> Xem cửa hàng
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../ktnguoidung/index.php?action=hoso">
									<i class="align-middle me-1" data-feather="user"></i> Hồ sơ cá nhân
								</a>								
								<a class="dropdown-item" href="../ktnguoidung/index.php?action=matkhau">
									<i class="align-middle me-1" data-feather="key"></i> Đổi mật khẩu
								</a>
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="../ktnguoidung/index.php?action=dangxuat" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');"><i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<!-- Controller quản lý trạng thái thông báo và huy hiệu số đỏ Admin Thảo Mobile -->
			<script>
			(function() {
				var currentSig = <?= json_encode($current_alert_signature ?? '') ?>;

				function getReadAlertItems() {
					try {
						var raw = localStorage.getItem('thao_mobile_admin_read_alert_items');
						return raw ? JSON.parse(raw) : [];
					} catch(e) {
						return [];
					}
				}

				function markAlertItemAsRead(id) {
					try {
						var items = getReadAlertItems();
						if (items.indexOf(id) === -1) {
							items.push(id);
							if (items.length > 100) items.shift(); // giới hạn tối đa 100 ID
							localStorage.setItem('thao_mobile_admin_read_alert_items', JSON.stringify(items));
						}
					} catch(e) {}
				}

				function markAllAlertsAsSeen() {
					try {
						if (currentSig) {
							localStorage.setItem('thao_mobile_admin_seen_alerts', currentSig);
						}
						var badge = document.getElementById('alertIndicatorBadge');
						if (badge) {
							badge.style.display = 'none';
						}
					} catch(e) {}
				}

				// Đảm bảo ẩn huy hiệu ngay lập tức nếu Admin đã xem qua tập hợp thông báo này
				try {
					var seenSig = localStorage.getItem('thao_mobile_admin_seen_alerts');
					if (seenSig && seenSig === currentSig) {
						var badge = document.getElementById('alertIndicatorBadge');
						if (badge) badge.style.display = 'none';
					}
				} catch(e) {}

				document.addEventListener('DOMContentLoaded', function() {
					var alertsBtn = document.getElementById('alertsDropdown');
					var badge = document.getElementById('alertIndicatorBadge');

					// Kiểm tra lại trạng thái sau khi nạp DOM
					try {
						var seenSig = localStorage.getItem('thao_mobile_admin_seen_alerts');
						if (seenSig && seenSig === currentSig) {
							if (badge) badge.style.display = 'none';
						} else if (currentSig && badge) {
							badge.style.display = '';
						}
					} catch(e) {}

					// Lắng nghe click hoặc sự kiện mở dropdown của Bootstrap
					if (alertsBtn) {
						alertsBtn.addEventListener('click', markAllAlertsAsSeen);
						alertsBtn.addEventListener('show.bs.dropdown', markAllAlertsAsSeen);
					}

					// Áp dụng kiểu dáng "đã đọc" cho các mục thông báo
					var readItems = getReadAlertItems();
					var alertLinks = document.querySelectorAll('.alert-item');
					alertLinks.forEach(function(item) {
						var id = item.getAttribute('data-alert-id');
						if (id && readItems.indexOf(id) !== -1) {
							item.classList.add('alert-item-read');
						}

						item.addEventListener('click', function() {
							if (id) {
								markAlertItemAsRead(id);
								item.classList.add('alert-item-read');
							}
							markAllAlertsAsSeen();
						});
					});
				});
			})();
			</script>

			<main class="content">
				<div class="container-fluid p-0">