<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/khachhang.php");
require("../../model/donhang.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$kh = new KHACHHANG();
$dh = new DONHANG();

switch($action){
    case "macdinh":
    case "danhsach":
        $tukhoa = isset($_REQUEST["tukhoa"]) ? trim($_REQUEST["tukhoa"]) : "";
        $khachhang = $kh->laydanhsachkhachhang($tukhoa);
        include("main.php");
        break;

    case "chitiet":
        if(isset($_GET["id"])){
            $id = (int)$_GET["id"];
            $khachhang = $kh->laykhachhangtheoid($id);
            if(!$khachhang){
                $tukhoa = "";
                $khachhang = $kh->laydanhsachkhachhang();
                include("main.php");
                break;
            }
            $donhang = $dh->laydonhangtheonguoidung($id);
            include("chitiet.php");
        }
        else{
            $tukhoa = "";
            $khachhang = $kh->laydanhsachkhachhang();
            include("main.php");
        }
        break;

    case "doitrangthai":
        if(isset($_REQUEST["id"]) && isset($_REQUEST["trangthai"])){
            $id = (int)$_REQUEST["id"];
            $trangthai = (int)$_REQUEST["trangthai"];
            $kh->doitrangthaikhachhang($id, $trangthai);
        }
        if(isset($_REQUEST["from"]) && $_REQUEST["from"] === "chitiet"){
            header("location:index.php?action=chitiet&id=" . (int)$_REQUEST["id"]);
            exit();
        }
        $tukhoa = isset($_REQUEST["tukhoa"]) ? trim($_REQUEST["tukhoa"]) : "";
        $khachhang = $kh->laydanhsachkhachhang($tukhoa);
        include("main.php");
        break;

    default:
        $tukhoa = "";
        $khachhang = $kh->laydanhsachkhachhang();
        include("main.php");
        break;
}
?>