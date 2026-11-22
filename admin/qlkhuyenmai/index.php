<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");

$dm = new DANHMUC();
$mh = new MATHANG();

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$thongbao = "";
$loi = "";

switch($action){
    case "macdinh":
        $danhmuc = $dm->laydanhmuc();
        $tatcamathang = $mh->laymathang();
        $dskhuyenmai = $mh->laymathangkhuyenmai();
        include("main.php");
        break;

    case "apdungtheohang":
        if(isset($_POST["danhmuc_id"]) && isset($_POST["phantramgiam"])){
            $danhmuc_id = (int)$_POST["danhmuc_id"];
            $phantramgiam = (float)$_POST["phantramgiam"];
            if($phantramgiam > 0 && $phantramgiam < 100){
                $kq = $mh->apdungkhuyenmaitheohang($danhmuc_id, $phantramgiam);
                if($kq !== false){
                    $tenhang = "toàn bộ cửa hàng";
                    if($danhmuc_id > 0){
                        $dm_info = $dm->laydanhmuctheoid($danhmuc_id);
                        $tenhang = "hãng " . ($dm_info["tendanhmuc"] ?? "");
                    }
                    $thongbao = "Đã áp dụng giảm giá " . $phantramgiam . "% cho " . $tenhang . " thành công!";
                } else {
                    $loi = "Không thể áp dụng khuyến mãi!";
                }
            } else {
                $loi = "Mức giảm phần trăm không hợp lệ (phải từ 1% đến 99%)!";
            }
        }
        $danhmuc = $dm->laydanhmuc();
        $tatcamathang = $mh->laymathang();
        $dskhuyenmai = $mh->laymathangkhuyenmai();
        include("main.php");
        break;

    case "apdungmay":
        if(isset($_POST["mathang_id"]) && isset($_POST["giabanmoi"])){
            $mathang_id = (int)$_POST["mathang_id"];
            $giabanmoi = (float)str_replace(['.', ',', ' '], '', $_POST["giabanmoi"]);
            if($mathang_id > 0 && $giabanmoi > 0){
                $mh_info = $mh->laymathangtheoid($mathang_id);
                if($mh_info){
                    $giagoc = (float)$mh_info["giagoc"];
                    if($giagoc <= 0 || $giagoc < (float)$mh_info["giaban"]){
                        $giagoc = (float)$mh_info["giaban"];
                    }
                    if($giabanmoi >= $giagoc){
                        $loi = "Giá khuyến mãi (" . number_format($giabanmoi, 0, ',', '.') . "đ) phải nhỏ hơn giá gốc niêm yết (" . number_format($giagoc, 0, ',', '.') . "đ)!";
                    } else {
                        $mh->apdungkhuyenmaimay($mathang_id, $giabanmoi);
                        $thongbao = "Đã cập nhật giá khuyến mãi cho \"" . htmlspecialchars($mh_info["tenmathang"]) . "\" thành công!";
                    }
                } else {
                    $loi = "Không tìm thấy sản phẩm được chọn!";
                }
            } else {
                $loi = "Vui lòng chọn sản phẩm và nhập giá khuyến mãi hợp lệ!";
            }
        }
        $danhmuc = $dm->laydanhmuc();
        $tatcamathang = $mh->laymathang();
        $dskhuyenmai = $mh->laymathangkhuyenmai();
        include("main.php");
        break;

    case "huykhuyenmai":
        if(isset($_GET["id"])){
            $id = (int)$_GET["id"];
            if($id == 0){
                $mh->huykhuyenmai(0);
                $thongbao = "Đã hủy toàn bộ khuyến mãi, tất cả sản phẩm đã được đưa về giá gốc!";
            } else {
                $mh_info = $mh->laymathangtheoid($id);
                $mh->huykhuyenmai($id);
                $thongbao = "Đã kết thúc khuyến mãi cho sản phẩm \"" . htmlspecialchars($mh_info["tenmathang"] ?? "") . "\"!";
            }
        }
        $danhmuc = $dm->laydanhmuc();
        $tatcamathang = $mh->laymathang();
        $dskhuyenmai = $mh->laymathangkhuyenmai();
        include("main.php");
        break;

    default:
        $danhmuc = $dm->laydanhmuc();
        $tatcamathang = $mh->laymathang();
        $dskhuyenmai = $mh->laymathangkhuyenmai();
        include("main.php");
        break;
}
?>