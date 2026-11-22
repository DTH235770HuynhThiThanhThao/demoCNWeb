<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require_once("../../model/database.php");
require_once("../../model/hinhanh.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action = "macdinh";
}

$ha = new HINHANH();

switch($action){
    case "macdinh":
        $tatca = $ha->laydanhsachhinhanh();
        $banner_chinh = $ha->laydanhsachhinhanh('banner_chinh');
        $banner_phu = $ha->laydanhsachhinhanh('banner_phu');
        $logo_info = $ha->laylogo();
        include("main.php");
        break;

    case "thembanner":
        if(isset($_POST["txttieude"]) && !empty($_FILES["filehinhanh"]["name"])){
            $tieude = trim($_POST["txttieude"]);
            $loai = isset($_POST["cboloai"]) ? trim($_POST["cboloai"]) : "banner_chinh";
            $thutu = isset($_POST["numthutu"]) ? intval($_POST["numthutu"]) : 1;

            // Xử lý upload file ảnh banner vào images/carousel/
            $target_dir = "../../images/carousel/";
            if(!is_dir($target_dir)){
                mkdir($target_dir, 0777, true);
            }

            $file_info = pathinfo($_FILES["filehinhanh"]["name"]);
            $file_ext = strtolower($file_info["extension"] ?? "jpg");
            $allowed_exts = array("jpg", "jpeg", "png", "webp", "gif", "jfif");

            if(in_array($file_ext, $allowed_exts)){
                $clean_filename = preg_replace("/[^a-zA-Z0-9_\-\.]/", "", basename($_FILES["filehinhanh"]["name"]));
                $final_filename = time() . "_" . $clean_filename;
                $target_file = $target_dir . $final_filename;

                if(move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $target_file)){
                    $ha->themhinhanh($tieude, $final_filename, $loai, $thutu);
                    header("location:index.php?msg=them_ok");
                    exit();
                } else {
                    header("location:index.php?err=upload_fail");
                    exit();
                }
            } else {
                header("location:index.php?err=invalid_file");
                exit();
            }
        }
        header("location:index.php?err=missing_data");
        exit();

    case "doilogo":
        if(!empty($_FILES["filelogo"]["name"])){
            $target_dir = "../../images/logo/";
            if(!is_dir($target_dir)){
                mkdir($target_dir, 0777, true);
            }

            $file_info = pathinfo($_FILES["filelogo"]["name"]);
            $file_ext = strtolower($file_info["extension"] ?? "jpg");
            $allowed_exts = array("jpg", "jpeg", "png", "webp", "gif", "svg", "jfif");

            if(in_array($file_ext, $allowed_exts)){
                $clean_filename = preg_replace("/[^a-zA-Z0-9_\-\.]/", "", basename($_FILES["filelogo"]["name"]));
                $final_filename = "logo_" . time() . "." . $file_ext;
                $target_file = $target_dir . $final_filename;

                if(move_uploaded_file($_FILES["filelogo"]["tmp_name"], $target_file)){
                    $ha->capnhatlogo($final_filename);
                    header("location:index.php?msg=logo_ok");
                    exit();
                } else {
                    header("location:index.php?err=upload_fail");
                    exit();
                }
            } else {
                header("location:index.php?err=invalid_file");
                exit();
            }
        }
        header("location:index.php?err=no_file");
        exit();

    case "doitrangthai":
        if(isset($_GET["id"]) && isset($_GET["trangthai"])){
            $id = intval($_GET["id"]);
            $trangthai = intval($_GET["trangthai"]);
            $ha->doitrangthai($id, $trangthai);
            header("location:index.php?msg=trangthai_ok");
            exit();
        }
        header("location:index.php");
        exit();

    case "xoa":
        if(isset($_GET["id"])){
            $id = intval($_GET["id"]);
            $ha->xoahinhanh($id);
            header("location:index.php?msg=xoa_ok");
            exit();
        }
        header("location:index.php");
        exit();

    default:
        $tatca = $ha->laydanhsachhinhanh();
        $banner_chinh = $ha->laydanhsachhinhanh('banner_chinh');
        $banner_phu = $ha->laydanhsachhinhanh('banner_phu');
        $logo_info = $ha->laylogo();
        include("main.php");
        break;
}
?>