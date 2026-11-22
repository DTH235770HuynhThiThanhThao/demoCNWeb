<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/baohanh.php");
require("../../model/mathang.php");
require("../../model/donhang.php");

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$bh = new BAOHANH();
$mh = new MATHANG();
$dh = new DONHANG();

switch($action){
    case "macdinh":
    case "danhsach":
        $tukhoa   = trim($_REQUEST["tukhoa"] ?? "");
        $trangthai = isset($_REQUEST["trangthai"]) && $_REQUEST["trangthai"] !== "" ? $_REQUEST["trangthai"] : "";
        $baohanh  = $bh->laydanhsachbaohanh($tukhoa, $trangthai);
        $thongke  = $bh->thongkebaohanh();
        include("main.php");
        break;
    case "them":
        $danhsachmathang = $mh->laymathang();
        $danhsachdonhang = $dh->laydanhsachdonhang();
        include("thembaohanh.php");
        break;
    case "xulythem":
        $donhang_id   = trim($_POST["donhang_id"] ?? "");
        $mathang_id   = (int)($_POST["mathang_id"] ?? 0);
        $tenkhachhang = trim($_POST["tenkhachhang"] ?? "");
        $sodienthoai  = trim($_POST["sodienthoai"] ?? "");
        $soimei       = trim($_POST["soimei"] ?? "");
        $ngaymua      = trim($_POST["ngaymua"] ?? "");
        $hanbaohanh   = trim($_POST["hanbaohanh"] ?? "");
        $tinhtrangloi = trim($_POST["tinhtrangloi"] ?? "");
        $ghichu       = trim($_POST["ghichu"] ?? "");

        if(empty($tenkhachhang) || empty($sodienthoai) || $mathang_id <= 0 || empty($tinhtrangloi)){
            $thongbao_loi = "Vui lòng nhập đầy đủ: Họ tên khách hàng, Số điện thoại, Thiết bị và Tình trạng lỗi!";
            $danhsachmathang = $mh->laymathang();
            $danhsachdonhang = $dh->laydanhsachdonhang();
            include("thembaohanh.php");
            break;
        }

        $bh->themphieubaohanh($donhang_id, $mathang_id, $tenkhachhang, $sodienthoai, $soimei, $ngaymua, $hanbaohanh, $tinhtrangloi, $ghichu);
        $thongbao_ok = "Lập phiếu tiếp nhận bảo hành thành công!";
        $tukhoa   = "";
        $trangthai = "";
        $baohanh  = $bh->laydanhsachbaohanh();
        $thongke  = $bh->thongkebaohanh();
        include("main.php");
        break;
    case "capnhat":
        $id         = (int)($_REQUEST["id"] ?? 0);
        $trangthai  = (int)($_REQUEST["trangthai"] ?? 0);
        $ghichu     = trim($_REQUEST["ghichu"] ?? "");
        if($id > 0){
            $bh->capnhatbaohanh($id, $trangthai, $ghichu);
        }
        $tukhoa    = "";
        $trangthai = "";
        $baohanh   = $bh->laydanhsachbaohanh();
        $thongke   = $bh->thongkebaohanh();
        include("main.php");
        break;
    default:
        $tukhoa    = "";
        $trangthai = "";
        $baohanh   = $bh->laydanhsachbaohanh();
        $thongke   = $bh->thongkebaohanh();
        include("main.php");
        break;
}
?>
