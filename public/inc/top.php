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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <title>Cửa hàng điện thoại</title>

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        
    </head>
    <body id="top">
        
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-info shadow">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php"><img src="../images/logo/logo.jpg" alt="Thanh Thảo Shop" class="rounded-2 me-2 shadow-sm" style="height: 48px; width: 48px; object-fit: cover;"> Thanh Thảo Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-2" style="white-space:nowrap; flex-wrap:nowrap;">
                        <li class="nav-item"><a class="nav-link active px-2" aria-current="page" href="index.php">Trang chính</a></li>
                        <li class="nav-item"><a class="nav-link px-2" href="#!">Giới thiệu</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục sản phẩm</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                                
                                <?php foreach ($danhmuc as $d): ?>
                                    <li><a class="dropdown-item" href="?action=group&id=<?php echo $d["id"]; ?>">
                                        <?php echo $d["tendanhmuc"]; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                    <!-- Ô tìm kiếm sản phẩm -->
                    <form class="d-flex mx-lg-3 my-2 my-lg-0 navbar-search-form" action="index.php" method="GET" role="search" autocomplete="off">
                        <input type="hidden" name="action" value="timkiem">
                        <div class="input-group navbar-search-group">
                            <input
                                class="form-control navbar-search-input"
                                type="search"
                                name="q"
                                placeholder="Tìm kiếm điện thoại..."
                                aria-label="Tìm kiếm"
                                value="<?php echo htmlspecialchars(trim($_REQUEST['q'] ?? '')); ?>"
                            >
                            <button class="btn navbar-search-btn" type="submit" title="Tìm kiếm">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <style>
                    .navbar-search-form { flex: 0 0 220px; }
                    .navbar-search-group { border-radius: 50px; overflow: hidden; box-shadow: 0 1px 6px rgba(0,0,0,0.12); }
                    .navbar-search-input {
                        border: none;
                        border-radius: 50px 0 0 50px !important;
                        padding: 7px 16px;
                        font-size: 0.88rem;
                        background: #fff;
                        color: #333;
                        outline: none;
                        box-shadow: none !important;
                        transition: background 0.2s;
                    }
                    .navbar-search-input::placeholder { color: #aaa; }
                    .navbar-search-input:focus { background: #f0faff; }
                    .navbar-search-btn {
                        background: #fff;
                        border: none;
                        border-radius: 0 50px 50px 0 !important;
                        color: #0dcaf0;
                        padding: 7px 14px;
                        font-size: 1rem;
                        transition: background 0.2s, color 0.2s;
                    }
                    .navbar-search-btn:hover { background: #0dcaf0; color: #fff; }
                    @media (max-width: 991px) {
                        .navbar-search-form { flex: 1 1 100%; margin: 6px 0 !important; }
                    }
                    </style>
                    <div class="d-flex align-items-center">
                        <a href="index.php?action=giohang" class="btn btn-outline-light me-2"><i class="bi bi-cart3"></i> Giỏ hàng <span class="badge bg-danger text-white ms-1 rounded-pill"><?php 
                            if(isset($_SESSION["khachhang"]["id"]) && !empty($_SESSION["khachhang"]["id"])){
                                $gh_top = new GIOHANG();
                                echo $gh_top->demmathang((int)$_SESSION["khachhang"]["id"]);
                            } else {
                                echo 0;
                            }
                        ?></span></a>

                        <?php if(isset($_SESSION["khachhang"]) && !empty($_SESSION["khachhang"]["id"])){ ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center py-1 px-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php if ($_SESSION["khachhang"]["hinhanh"]==NULL) echo "../images/users/user.png"; else echo "../images/users/" . $_SESSION["khachhang"]["hinhanh"]; ?>" class="rounded-circle border border-white me-2" width="34" height="34" style="object-fit: cover;">
                                <span>Chào <?php echo $_SESSION["khachhang"]["hoten"]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <?php if(isset($_SESSION["khachhang"]["loai"]) && in_array($_SESSION["khachhang"]["loai"], [1, 2])){ ?>
                                <li>
                                    <a class="dropdown-item fw-semibold text-primary" href="../admin/index.php">
                                        <i class="bi bi-gear-fill me-2"></i>Quản trị hệ thống
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <?php } ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=thongtin">
                                        <i class="bi bi-person me-2"></i>Hồ sơ cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=doimatkhau">
                                        <i class="bi bi-key me-2"></i>Đổi mật khẩu
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="index.php?action=dangxuat" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                                        <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php } else{ ?>
                            <a href="index.php?action=dangnhap" class="btn btn-outline-light"><i class="bi bi-person"></i> Đăng nhập</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Section-->        
        <section class="py-5">            
            <div class="container px-4 px-lg-5 mt-1">