<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

chdir(__DIR__);

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

ob_start();
include 'index.php';
$out = ob_get_clean();
echo "SUCCESS RENDER REVENUE: " . strlen($out) . " bytes\n";
