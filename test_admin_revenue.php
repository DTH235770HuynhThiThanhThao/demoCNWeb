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
    include 'admin/qldoanhthu/index.php';
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
}
