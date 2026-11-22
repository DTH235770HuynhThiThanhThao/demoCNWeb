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
        $phieunhap = $nh->laydanhsachphieunhap();
        include("main.php");
        break;

    case "them":
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
            header("location:index.php?msg=them_ok&id=" . $id_moi);
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
            $phieunhap = $nh->laydanhsachphieunhap();
            include("main.php");
        }
        break;

    default:
        $phieunhap = $nh->laydanhsachphieunhap();
        include("main.php");
        break;
}
?>
