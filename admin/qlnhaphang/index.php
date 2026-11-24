<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/nhaphang.php");
require("../../model/mathang.php");
require("../../model/danhmuc.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$nh = new NHAPHANG();
$mh = new MATHANG();

switch($action){
    case "macdinh":
    case "danhsach":
        $tab = isset($_REQUEST["tab"]) ? trim($_REQUEST["tab"]) : "tonkho";
        $tukhoa = isset($_REQUEST["tukhoa"]) ? trim($_REQUEST["tukhoa"]) : "";
        $muctonkho = isset($_REQUEST["muctonkho"]) ? trim($_REQUEST["muctonkho"]) : "tatca";

        $dastonkho = $nh->laydanhsachtonkho($tukhoa, $muctonkho);
        $phieunhap = $nh->laydanhsachphieunhap();
        $thongketon = $nh->thongketonkho();
        $tongtiennhap = $nh->tongtiennhaphang();

        include("main.php");
        break;

    case "them":
        $mathang_id_chon = isset($_GET["mathang_id"]) ? (int)$_GET["mathang_id"] : 0;
        $mathang = $mh->laymathang();
        include("themphieunhap.php");
        break;

    case "xulythem":
        if(isset($_POST["txtnhacungcap"]) && isset($_POST["optmathang"])){
            $nguoidung_id = (int)$_SESSION["nguoidung"]["id"];
            $nhacungcap = trim($_POST["txtnhacungcap"]);
            $ghichu_goc = isset($_POST["txtghichu"]) ? trim($_POST["txtghichu"]) : "";
            $ds_mathang = isset($_POST["optmathang"]) ? $_POST["optmathang"] : array();
            $ds_gianhap = isset($_POST["txtgianhap"]) ? $_POST["txtgianhap"] : array();
            $ds_soluong = isset($_POST["txtsoluong"]) ? $_POST["txtsoluong"] : array();
            $ds_phienban = isset($_POST["optphienban"]) ? $_POST["optphienban"] : array();
            $ds_mausac = isset($_POST["optmausac"]) ? $_POST["optmausac"] : array();

            // Lấy danh sách tên mặt hàng để tổng hợp chi tiết biến thể
            $all_mathang = $mh->laymathang();
            $mathang_map = array();
            foreach($all_mathang as $m_item){
                $mathang_map[$m_item["id"]] = $m_item["tenmathang"];
            }

            // Tự động tổng hợp chi tiết [Tên máy - Phiên bản - Màu sắc x SL]
            $chi_tiet_bienthe = array();
            if(is_array($ds_mathang)){
                for($i = 0; $i < count($ds_mathang); $i++){
                    $mh_id = (int)($ds_mathang[$i] ?? 0);
                    $sl = (int)($ds_soluong[$i] ?? 0);
                    if($mh_id > 0 && $sl > 0){
                        $ten_may = $mathang_map[$mh_id] ?? ("SP#" . $mh_id);
                        $pb = !empty($ds_phienban[$i]) ? trim($ds_phienban[$i]) : "Mặc định";
                        $ms = !empty($ds_mausac[$i]) ? trim($ds_mausac[$i]) : "Mặc định";
                        $chi_tiet_bienthe[] = "[{$ten_may} - {$pb} - {$ms} x {$sl}]";
                    }
                }
            }

            // Nối chi tiết biến thể vào cột ghichu của phieunhap
            $chuoi_bienthe = implode(", ", $chi_tiet_bienthe);
            if(!empty($ghichu_goc) && !empty($chuoi_bienthe)){
                $ghichu_tonghop = $ghichu_goc . " | Chi tiết: " . $chuoi_bienthe;
            } elseif(!empty($chuoi_bienthe)){
                $ghichu_tonghop = "Chi tiết: " . $chuoi_bienthe;
            } else {
                $ghichu_tonghop = $ghichu_goc;
            }

            $id_moi = $nh->themphieunhap($nguoidung_id, $nhacungcap, $ghichu_tonghop, $ds_mathang, $ds_gianhap, $ds_soluong);
            header("location:index.php?tab=phieunhap&msg=them_ok&id=" . $id_moi);
            exit();
        }
        header("location:index.php");
        exit();

    case "chitiet":
        if(isset($_GET["id"])){
            $id = (int)$_GET["id"];
            $pn = $nh->layphieunhaptheoid($id);
            $chitiet = $nh->laychitietphieunhap($id);
            include("chitiet.php");
        }
        else{
            $tab = "phieunhap";
            $dastonkho = $nh->laydanhsachtonkho();
            $phieunhap = $nh->laydanhsachphieunhap();
            $thongketon = $nh->thongketonkho();
            $tongtiennhap = $nh->tongtiennhaphang();
            include("main.php");
        }
        break;

    default:
        $tab = "tonkho";
        $dastonkho = $nh->laydanhsachtonkho();
        $phieunhap = $nh->laydanhsachphieunhap();
        $thongketon = $nh->thongketonkho();
        $tongtiennhap = $nh->tongtiennhaphang();
        include("main.php");
        break;
}
?>
