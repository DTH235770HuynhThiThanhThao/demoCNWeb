<?php
if(isset($_SESSION["khachhang"])){
    if(empty($_SESSION["khachhang"]["id"])){
        unset($_SESSION["khachhang"]);
    }
    else if(class_exists("KHACHHANG")){
        $kh_top_check = new KHACHHANG();
        if(!$kh_top_check->laythongtinkhachhangtheoid($_SESSION["khachhang"]["id"])){
            unset($_SESSION["khachhang"]);
        }
    }
}

// Lấy thông tin cấu hình cửa hàng
if(!isset($thongtin_cuahang)){
    if(!class_exists("THONGTIN")){
        require_once("../model/thongtin.php");
    }
    $tt_top = new THONGTIN();
    $thongtin_cuahang = $tt_top->laythongtin();
}
$ten_shop = !empty($thongtin_cuahang["tencuahang"]) ? $thongtin_cuahang["tencuahang"] : "Thảo Mobile";
$hotline_shop = !empty($thongtin_cuahang["sodienthoai"]) ? $thongtin_cuahang["sodienthoai"] : "0357185269";
$slogan_shop = !empty($thongtin_cuahang["slogan"]) ? $thongtin_cuahang["slogan"] : "Thu cũ đổi mới trợ giá đến 2 triệu • Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng";
$email_shop = !empty($thongtin_cuahang["email"]) ? $thongtin_cuahang["email"] : "thaohuynh1092005@gmail.com";
$diachi_shop = !empty($thongtin_cuahang["diachi"]) ? $thongtin_cuahang["diachi"] : "570, ấp An Hòa, xã Lai Vung. tỉnh Đồng Tháp";
$giomocua_shop = !empty($thongtin_cuahang["giomocua"]) ? $thongtin_cuahang["giomocua"] : "08:00 - 21:30 (Tất cả các ngày trong tuần)";

// Lấy thông tin Logo cửa hàng từ bảng hinhanh
if(!isset($logo_shop)){
    if(!class_exists("HINHANH")){
        require_once("../model/hinhanh.php");
    }
    $ha_top = new HINHANH();
    $logo_data = $ha_top->laylogo();
    $logo_shop = !empty($logo_data["duongdan"]) ? $logo_data["duongdan"] : "logo1.jpg";
}
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo htmlspecialchars($ten_shop); ?> - Điện Thoại Chính Hãng Giá Tốt Nhất</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap 5 CSS & Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
        
        <!-- Custom Retail Tech Stylesheet -->
        <link href="inc/style.css" rel="stylesheet">
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body id="top">
        
        <!-- Top Announcement Bar -->
        <div class="top-notice-bar py-1 d-none d-md-block">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3 text-truncate me-3">
                    <span class="notice-item text-truncate"><i class="bi bi-megaphone-fill text-warning me-1"></i><?php echo htmlspecialchars($slogan_shop); ?></span>
                </div>
                <div class="d-flex align-items-center gap-3 flex-shrink-0">
                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $hotline_shop); ?>" class="text-white text-decoration-none fw-semibold">
                        <i class="bi bi-telephone-fill me-1 text-warning"></i>Hotline: <?php echo htmlspecialchars($hotline_shop); ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sticky Header / Navbar (CellphoneS Red Tech) -->
        <nav class="navbar navbar-expand-lg shop-navbar sticky-top">
            <div class="container">
                <!-- Logo & Brand Name -->
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img src="../images/logo/<?php echo htmlspecialchars($logo_shop); ?>" alt="<?php echo htmlspecialchars($ten_shop); ?>" class="me-2" onerror="this.src='../images/logo/logo1.jpg'">
                    <span><?php echo mb_strtoupper($ten_shop, 'UTF-8'); ?></span>
                </a>

                <!-- Mobile Toggler -->
                <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-2 text-white"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navigation Menu -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-2">
                        <li class="nav-item">
                            <a class="nav-link px-2<?php if(!isset($action) || $action=='null') echo ' active'; ?>" href="index.php">
                                <i class="bi bi-house-door me-1"></i>Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2<?php if(isset($action) && $action=='gioithieu') echo ' active'; ?>" href="index.php?action=gioithieu">
                                <i class="bi bi-info-circle me-1"></i>Giới thiệu
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-grid me-1"></i>Danh mục hãng
                            </a>
                            <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">                                
                                <?php foreach ($danhmuc as $d): ?>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="?action=group&id=<?php echo $d["id"]; ?>">
                                            <i class="bi bi-phone me-2 text-danger"></i><?php echo $d["tendanhmuc"]; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>

                    <!-- Search Form -->
                    <form class="d-flex mx-lg-3 my-2 my-lg-0 navbar-search-form" action="index.php" method="GET" role="search" autocomplete="off">
                        <input type="hidden" name="action" value="timkiem">
                        <div class="input-group navbar-search-group w-100">
                            <input
                                class="form-control navbar-search-input"
                                type="search"
                                name="q"
                                placeholder="Bạn cần tìm điện thoại gì hôm nay? (iPhone 18, Galaxy S26...)"
                                aria-label="Tìm kiếm"
                                value="<?php echo htmlspecialchars(trim($_REQUEST['q'] ?? '')); ?>"
                            >
                            <button class="btn navbar-search-btn" type="submit" title="Tìm kiếm">
                                <i class="bi bi-search me-1"></i><span class="d-none d-sm-inline">Tìm</span>
                            </button>
                        </div>
                    </form>

                    <!-- Right Controls (Cart & User) -->
                    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                        <!-- Nút Giỏ hàng -->
                        <a href="index.php?action=giohang" class="btn btn-cart-pill d-inline-flex align-items-center">
                            <i class="bi bi-cart3 fs-6"></i>
                            <span class="ms-1 d-none d-sm-inline">Giỏ hàng</span>
                            <span class="badge cart-badge"><?php 
                                if(isset($_SESSION["khachhang"]["id"]) && !empty($_SESSION["khachhang"]["id"])){
                                    $gh_top = new GIOHANG();
                                    echo $gh_top->demmathang((int)$_SESSION["khachhang"]["id"]);
                                } else {
                                    echo 0;
                                }
                            ?></span>
                        </a>

                        <!-- Cụm Tài khoản / Đăng nhập -->
                        <?php if(isset($_SESSION["khachhang"]) && !empty($_SESSION["khachhang"]["id"])){ ?>
                        <div class="dropdown">
                            <a class="user-dropdown-toggle dropdown-toggle text-decoration-none d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php if (empty($_SESSION["khachhang"]["hinhanh"])) echo "../images/users/user.png"; else echo "../images/users/" . $_SESSION["khachhang"]["hinhanh"]; ?>" alt="Avatar">
                                <span class="ms-1 text-truncate" style="max-width: 120px;">Chào <?php echo $_SESSION["khachhang"]["hoten"]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <?php if(isset($_SESSION["khachhang"]["loai"]) && in_array($_SESSION["khachhang"]["loai"], [1, 2])){ ?>
                                <li>
                                    <a class="dropdown-item fw-semibold text-primary" href="../admin/index.php">
                                        <i class="bi bi-gear-fill me-2 text-danger"></i>Quản trị hệ thống
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <?php } ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=thongtin">
                                        <i class="bi bi-person me-2 text-secondary"></i>Hồ sơ cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=lichsumuahang">
                                        <i class="bi bi-clock-history me-2 text-secondary"></i>Lịch sử mua hàng
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=doimatkhau">
                                        <i class="bi bi-key me-2 text-secondary"></i>Đổi mật khẩu
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item text-danger fw-semibold" href="index.php?action=dangxuat" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                                        <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php } else { ?>
                            <a href="index.php?action=dangnhap" class="btn btn-cart-pill d-inline-flex align-items-center">
                                <i class="bi bi-person fs-6 me-1"></i>Đăng nhập
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Section-->        
        <section class="py-4">            
            <div class="container">
