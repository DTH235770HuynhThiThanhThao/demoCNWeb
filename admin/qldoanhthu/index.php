<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra quyền đăng nhập quản trị
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/donhang.php");
require("../../model/donhangct.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");

$dh = new DONHANG();

// Tiếp nhận các tham số lọc từ form GET
$tungay = isset($_GET["tungay"]) ? trim($_GET["tungay"]) : "";
$denngay = isset($_GET["denngay"]) ? trim($_GET["denngay"]) : "";
$nam = isset($_GET["nam"]) && (int)$_GET["nam"] > 0 ? (int)$_GET["nam"] : (int)date("Y");

// 1. Thống kê 4 chỉ số tài chính tổng hợp
$thongke = $dh->thongkedoanhthu($tungay, $denngay);
$doanhthuthucte  = (float)($thongke["doanhthuthucte"] ?? 0);
$doanhthuchoxuly = (float)($thongke["doanhthuchoxuly"] ?? 0);
$tongtienhuy     = (float)($thongke["tongtienhuy"] ?? 0);
$sodonhoanthanh  = (int)($thongke["sodonhoanthanh"] ?? 0);
$giatritrungbinh = ($sodonhoanthanh > 0) ? round($doanhthuthucte / $sodonhoanthanh) : 0;

// 2. Thống kê doanh thu theo 12 tháng trong năm được chọn
$doanhthuthang = $dh->doanhthutheothang($nam);

// 3. Thống kê doanh thu và sản lượng theo từng hãng điện thoại
$doanhthuhang = $dh->doanhthutheohang($tungay, $denngay);

// 4. Lấy Top 5 sản phẩm bán chạy nhất mang lại doanh thu cao nhất
$topsanpham = $dh->topsanphambanchay($tungay, $denngay);

include("main.php");
?>
