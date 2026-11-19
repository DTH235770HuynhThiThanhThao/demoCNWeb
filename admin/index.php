<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nếu đã đăng nhập ở ngoài trang public với quyền Quản trị (loai = 1) hoặc Nhân viên (loai = 2) thì tự động đồng bộ sang admin
if (!isset($_SESSION["nguoidung"]) && isset($_SESSION["khachhang"]) && in_array($_SESSION["khachhang"]["loai"] ?? null, [1, 2])) {
    $_SESSION["nguoidung"] = $_SESSION["khachhang"];
}

header("location:ktnguoidung");
exit();
?>