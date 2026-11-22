<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/thongtin.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$tt = new THONGTIN();

switch($action){
    case "macdinh":
        $thongtin = $tt->laythongtin();
        include("main.php");
        break;

    case "capnhat":
        if(isset($_POST["txttencuahang"])){
            $tencuahang = trim($_POST["txttencuahang"]);
            $slogan = isset($_POST["txtslogan"]) ? trim($_POST["txtslogan"]) : "";
            $sodienthoai = isset($_POST["txtsodienthoai"]) ? trim($_POST["txtsodienthoai"]) : "";
            $email = isset($_POST["txtemail"]) ? trim($_POST["txtemail"]) : "";
            $diachi = isset($_POST["txtdiachi"]) ? trim($_POST["txtdiachi"]) : "";
            $giomocua = isset($_POST["txtgiomocua"]) ? trim($_POST["txtgiomocua"]) : "";
            $gioithieu = isset($_POST["txtgioithieu"]) ? trim($_POST["txtgioithieu"]) : "";

            $tt->capnhatthongtin($tencuahang, $slogan, $sodienthoai, $email, $diachi, $giomocua, $gioithieu);
            header("location:index.php?msg=capnhat_ok");
            exit();
        }
        $thongtin = $tt->laythongtin();
        include("main.php");
        break;

    default:
        $thongtin = $tt->laythongtin();
        include("main.php");
        break;
}
?>
