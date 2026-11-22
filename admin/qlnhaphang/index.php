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
            $ghichu = isset($_POST["txtghichu"]) ? trim($_POST["txtghichu"]) : "";
            $ds_mathang = isset($_POST["optmathang"]) ? $_POST["optmathang"] : array();
            $ds_gianhap = isset($_POST["txtgianhap"]) ? $_POST["txtgianhap"] : array();
            $ds_soluong = isset($_POST["txtsoluong"]) ? $_POST["txtsoluong"] : array();

            $id_moi = $nh->themphieunhap($nguoidung_id, $nhacungcap, $ghichu, $ds_mathang, $ds_gianhap, $ds_soluong);
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
