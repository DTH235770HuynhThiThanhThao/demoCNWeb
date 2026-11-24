<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["nguoidung"] = array(
    "id" => 1,
    "hoten" => "Quản trị viên",
    "email" => "admin@gmail.com",
    "hinhanh" => "user.png",
    "loai" => 1
);
$_SERVER['REQUEST_URI'] = '/demoCNWeb/admin/qldoanhthu/index.php';

try {
    require_once "model/database.php";
    require_once "model/donhang.php";
    require_once "model/donhangct.php";
    require_once "model/danhmuc.php";
    require_once "model/mathang.php";

    $dh = new DONHANG();
    $tungay = "";
    $denngay = "";
    $danhsachnam = $dh->laydanhsachnamdoanhthu();
    $nam_gannhat = $dh->laynamgannhatcohoanthanh();
    $nam = $nam_gannhat > 0 ? $nam_gannhat : (int)date("Y");

    $thongke = $dh->thongkedoanhthu($tungay, $denngay);
    $doanhthuthucte  = (float)($thongke["doanhthuthucte"] ?? 0);
    $doanhthuchoxuly = (float)($thongke["doanhthuchoxuly"] ?? 0);
    $tongtienhuy     = (float)($thongke["tongtienhuy"] ?? 0);
    $sodonhoanthanh  = (int)($thongke["sodonhoanthanh"] ?? 0);
    $giatritrungbinh = ($sodonhoanthanh > 0) ? round($doanhthuthucte / $sodonhoanthanh) : 0;

    $doanhthuthang = $dh->doanhthutheothang($nam);
    $doanhthuhang = $dh->doanhthutheohang($tungay, $denngay);
    $topsanpham = $dh->topsanphambanchay($tungay, $denngay);

    echo "Nam: $nam\n";
    echo "Doanh thu thuc te: $doanhthuthucte\n";
    echo "Doanh thu theo hang count: " . count($doanhthuhang) . "\n";
    echo "Top san pham count: " . count($topsanpham) . "\n";
    echo "Doanh thu thang count: " . count($doanhthuthang) . "\n";
    print_r($doanhthuthang);
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
}

