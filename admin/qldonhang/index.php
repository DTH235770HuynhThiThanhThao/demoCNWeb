<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/donhang.php");
require("../../model/donhangct.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$dh = new DONHANG();
$dhct = new DONHANGCT();

switch($action){
    case "macdinh":
    case "danhsach":
        $donhang = $dh->laydanhsachdonhang();
        include("main.php");
        break;
    case "chitiet":
        if(isset($_GET["id"])){
            $id = (int)$_GET["id"];
            $donhang = $dh->laydonhangtheoid($id);
            $chitiet = $dhct->laychitietdonhang($id);
            include("chitiet.php");
        }
        else{
            $donhang = $dh->laydanhsachdonhang();
            include("main.php");
        }
        break;
    case "capnhat":
        if(isset($_REQUEST["id"]) && isset($_REQUEST["trangthai"])){
            $id = (int)$_REQUEST["id"];
            $trangthai = (int)$_REQUEST["trangthai"];
            $dh->capnhattrangthai($id, $trangthai);
        }
        $donhang = $dh->laydanhsachdonhang();
        include("main.php");
        break;
    default:
        $donhang = $dh->laydanhsachdonhang();
        include("main.php");
        break;
}
?>
