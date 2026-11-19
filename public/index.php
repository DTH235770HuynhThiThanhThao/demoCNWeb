<?php 
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}
require("../model/database.php");
require("../model/danhmuc.php");
require("../model/mathang.php");
require("../model/giohang.php");
require("../model/khachhang.php");
require("../model/diachi.php");
require("../model/donhang.php");
require("../model/donhangct.php");
require("../model/nguoidung.php");

// Tự động đồng bộ session nếu đã đăng nhập bên admin
if(!isset($_SESSION["khachhang"]) && isset($_SESSION["nguoidung"])){
    $_SESSION["khachhang"] = $_SESSION["nguoidung"];
}


$dm = new DANHMUC();
$danhmuc = $dm->laydanhmuc();
$mh = new MATHANG();
$mathangxemnhieu = $mh->laymathangxemnhieu();
$mathangnoibat = $mh->laymathangnoibat();
$mathangbanchay = $mh->laymathangbanchay();
$mathangmoi = $mh->laymathangmoi();

// Kiểm tra khách hàng đã đăng nhập và tài khoản còn hợp lệ trong CSDL
function kiemtra_khachhang_hople(){
    if(!isset($_SESSION["khachhang"]) || empty($_SESSION["khachhang"]["id"])){
        unset($_SESSION["khachhang"]);
        return false;
    }
    $kh_check = new KHACHHANG();
    $kh_info = $kh_check->laythongtinkhachhangtheoid($_SESSION["khachhang"]["id"]);
    if(!$kh_info){
        unset($_SESSION["khachhang"]);
        return false;
    }
    return true;
}

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="null"; 
}


switch($action){
    case "null": 	
    	$mathang = $mh->laymathang();	
        include("main.php");
        break;
    case "group": 
        if(isset($_REQUEST["id"])){
            $madm = $_REQUEST["id"];
            $dmuc = $dm->laydanhmuctheoid($madm);
            $tendm =  $dmuc["tendanhmuc"];   
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("group.php");
        }
        else{
            include("main.php");
        }
        break;
    case "detail": 
        if(isset($_GET["id"])){
            $mahang = $_GET["id"];
            // tăng lượt xem lên 1
            $mh->tangluotxem($mahang);
            // lấy thông tin chi tiết mặt hàng
            $mhct = $mh->laymathangtheoid($mahang);
            // lấy các mặt hàng cùng danh mục
            $madm = $mhct["danhmuc_id"];
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("detail.php");
        }
        break;
    case "chovaogio":    
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để thêm sản phẩm vào giỏ hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();

        if(isset($_REQUEST["id"]))
            $id = intval($_REQUEST["id"]);
        else
            $id = 0;

        if(isset($_REQUEST["soluong"]))
            $soluong = intval($_REQUEST["soluong"]);
        else
            $soluong = 1;

        if($soluong <= 0){
            $soluong = 1;
        }

        if($id > 0){
            $gh->themvaogio($khachhang_id, $id, $soluong);
        }
        
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);   
        include("cart.php");
        break;
    case "giohang":  
    case "xemgiohang":  
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để xem giỏ hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);   
        include("cart.php");
        break;
    case "capnhatgio":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để cập nhật giỏ hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();
        if(isset($_REQUEST["mh"])){
            $ds_mh = $_REQUEST["mh"];
            foreach ($ds_mh as $id => $soluong) {
                $soluong = intval($soluong);
                if($soluong > 0)
                    $gh->capnhatsoluong($khachhang_id, intval($id), $soluong);
                else 
                    $gh->xoamotmathang($khachhang_id, intval($id));                
            }
        }  
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);   
        include("cart.php");
        break;
    case "xoamotmathang":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để thao tác giỏ hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();
        if(isset($_REQUEST["id"])){
            $gh->xoamotmathang($khachhang_id, intval($_REQUEST["id"]));
        }
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);
        include("cart.php");
        break;
    case "xoagiohang":  
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để thao tác giỏ hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();
        $gh->xoatoanbogiohang($khachhang_id);
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);   
        include("cart.php");
        break;
    case "thanhtoan":        
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để thanh toán đơn hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        $gh = new GIOHANG();
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);
        $dc = new DIACHI();
        $diachi = $dc->laydiachikhachhang($khachhang_id);
        include("checkout.php");
        break;
    case "luudonhang": 
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập hoặc đăng ký tài khoản để hoàn tất đơn hàng!";
            include("loginform.php");
            break;
        }

        $khachhang_id = (int)$_SESSION["khachhang"]["id"];           
        $hoten = $_SESSION["khachhang"]["hoten"];
        $diachi = isset($_POST["txtdiachi"]) ? trim($_POST["txtdiachi"]) : "";

        $dc = new DIACHI();
        $diachi_kh = $dc->laydiachikhachhang($khachhang_id);            
        if($diachi_kh != null){
            $diachi_id = $diachi_kh["id"];
        }
        else{
            $diachi_id = $dc->themdiachi($khachhang_id, $diachi);
        }
        
        // lưu đơn hàng
        $dh = new DONHANG();
        $gh = new GIOHANG();
        $tongtien = $gh->tinhtiengiohang($khachhang_id);
        $donhang_id = $dh->themdonhang($khachhang_id, $diachi_id, $tongtien);
        
        // lưu chi tiết đơn hàng
        $ct = new DONHANGCT();      
        $giohang = $gh->laygiohangtheonguoidung($khachhang_id);
        $mh_model = new MATHANG();
        foreach($giohang as $id => $mh_item){
            $dongia = $mh_item["giaban"];
            $soluong = $mh_item["soluong"];
            $thanhtien = $mh_item["thanhtien"];
            $ct->themchitietdonhang($donhang_id, (int)$id, $dongia, $soluong, $thanhtien);
            $mh_model->capnhatsoluong((int)$id, $soluong);
        }
        
        // xóa giỏ hàng
        $gh->xoatoanbogiohang($khachhang_id);
        
        // chuyển đến trang cảm ơn
        include("message.php");
        break;
    case "dangnhap":
        include("loginform.php");
        break;
    case "xldangnhap":
        $email = trim($_POST["txtemail"] ?? "");
        $matkhau = trim($_POST["txtmatkhau"] ?? "");
        $kh = new KHACHHANG();
        if(!empty($email) && !empty($matkhau) && $kh->kiemtrakhachhanghople($email,$matkhau)==TRUE){
            $khachhang = $kh->laythongtinkhachhang($email);
            if($khachhang && isset($khachhang["id"]) && (int)$khachhang["id"] > 0){
                $_SESSION["khachhang"] = $khachhang;
                // Nếu là Quản trị (1) hoặc Nhân viên (2), đồng bộ sang admin
                if(in_array($khachhang["loai"] ?? null, [1, 2])){
                    $_SESSION["nguoidung"] = $khachhang;
                }
                header("Location: index.php");
                exit();
            }
            else{
                $tb = "Không tìm thấy thông tin tài khoản hợp lệ!";
                include("loginform.php");
            }
        }
        else{
            $tb = "Email (hoặc số điện thoại) hoặc mật khẩu không chính xác, hoặc tài khoản đã bị khóa!";
            include("loginform.php");
        }
        break;
    case "dangky":
        include("registerform.php");
        break;
    case "xldangky":
        $hoten = trim($_POST["txthoten"] ?? "");
        $email = trim($_POST["txtemail"] ?? "");
        $sodienthoai = trim($_POST["txtsodienthoai"] ?? "");
        $matkhau = trim($_POST["txtmatkhau"] ?? "");
        $matkhauxacnhan = trim($_POST["txtmatkhauxacnhan"] ?? "");

        $kh = new KHACHHANG();
        if(empty($hoten) || empty($email) || empty($sodienthoai) || empty($matkhau)){
            $tb = "Vui lòng nhập đầy đủ các trường thông tin!";
            include("registerform.php");
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $tb = "Địa chỉ email không hợp lệ!";
            include("registerform.php");
        }
        elseif(!preg_match('/^[0-9]{10}$/', $sodienthoai)){
            $tb = "Số điện thoại phải gồm đúng 10 chữ số!";
            include("registerform.php");
        }
        elseif(strlen($matkhau) < 6){
            $tb = "Mật khẩu phải có độ dài từ 6 ký tự trở lên!";
            include("registerform.php");
        }
        elseif($matkhau !== $matkhauxacnhan){
            $tb = "Mật khẩu xác nhận không trùng khớp!";
            include("registerform.php");
        }
        elseif($kh->kiemtraemailtontai($email)){
            $tb = "Email này đã được sử dụng. Vui lòng dùng email khác!";
            include("registerform.php");
        }
        elseif($kh->kiemtrasdtontai($sodienthoai)){
            $tb = "Số điện thoại này đã được sử dụng. Vui lòng dùng số khác!";
            include("registerform.php");
        }
        else{
            $kh->dangkykhachhang($email, $sodienthoai, $hoten, $matkhau);
            $tb_thanhcong = "Đăng ký tài khoản thành công! Vui lòng đăng nhập.";
            include("loginform.php");
        }
        break;
    case "quenmatkhau":
        include("forgotpass.php");
        break;
    case "xlquenmatkhau":
        $email = trim($_POST["txtemail"] ?? "");
        $sodienthoai = trim($_POST["txtsodienthoai"] ?? "");
        $matkhaumoi = trim($_POST["txtmatkhaumoi"] ?? "");
        $xacnhanmatkhau = trim($_POST["txtxacnhanmatkhau"] ?? "");

        $kh = new KHACHHANG();
        if(empty($email) || empty($sodienthoai) || empty($matkhaumoi)){
            $tb = "Vui lòng nhập đầy đủ thông tin!";
            include("forgotpass.php");
        }
        elseif(strlen($matkhaumoi) < 6){
            $tb = "Mật khẩu mới phải có ít nhất 6 ký tự!";
            include("forgotpass.php");
        }
        elseif($matkhaumoi !== $xacnhanmatkhau){
            $tb = "Mật khẩu xác nhận không khớp!";
            include("forgotpass.php");
        }
        elseif(!$kh->kiemtraemailvasdt($email, $sodienthoai)){
            $tb = "Email và số điện thoại không khớp với bất kỳ tài khoản nào hoặc tài khoản bị khóa!";
            include("forgotpass.php");
        }
        else{
            $kh->datlaimatkhau($email, $sodienthoai, $matkhaumoi);
            $tb_thanhcong = "Đặt lại mật khẩu thành công! Vui lòng đăng nhập với mật khẩu mới.";
            include("loginform.php");
        }
        break;
    case "thongtin":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập để xem thông tin tài khoản!";
            include("loginform.php");
            break;
        }
        $khachhang_id = (int)$_SESSION["khachhang"]["id"];
        // đọc thông tin các đơn của khách
        $dh = new DONHANG();
        $donhang = $dh->laydanhsachdonhangtheokh($khachhang_id);
        
        if(isset($_REQUEST["dhid"])){
            $dhct = new DONHANGCT();
            $donhangct = $dhct->laychitietdonhang((int)$_REQUEST["dhid"]);
        }
        include("info.php"); // trang info.php hiển thị thông tin hồ sơ và các đơn đã đặt
        break;
    case "xlhoso":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập để cập nhật hồ sơ!";
            include("loginform.php");
            break;
        }
        $nd = new NGUOIDUNG();
        $ndcapnhat = new NGUOIDUNG();
        $ndcapnhat->setid($_POST["txtid"]);
        $ndcapnhat->setemail($_POST["txtemail"]);        
        $ndcapnhat->setsodienthoai($_POST["txtdienthoai"]);
        $ndcapnhat->sethoten($_POST["txthoten"]);
        $ndcapnhat->sethinhanh($_POST["txthinhanh"]);

        if(isset($_FILES["fhinh"]) && $_FILES["fhinh"]["name"] != null){
            $hinhanh = basename($_FILES["fhinh"]["name"]);
            $duongdan = "../images/users/" . $hinhanh;
            move_uploaded_file($_FILES["fhinh"]["tmp_name"], $duongdan);
            $ndcapnhat->sethinhanh($hinhanh);
        }
        
        $nd->capnhatnguoidung($ndcapnhat);

        $_SESSION["khachhang"] = $nd->laythongtinnguoidung($ndcapnhat->getemail());
        if(isset($_SESSION["nguoidung"])){
            $_SESSION["nguoidung"] = $_SESSION["khachhang"];
        }

        $tb_thanhcong = "Cập nhật thông tin hồ sơ thành công!";
        $dh = new DONHANG();
        $donhang = $dh->laydanhsachdonhangtheokh((int)$_SESSION["khachhang"]["id"]);
        include("info.php");
        break;
    case "doimatkhau":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập để đổi mật khẩu!";
            include("loginform.php");
            break;
        }
        include("changepass.php");
        break;
    case "xldoimatkhau":
        if(!kiemtra_khachhang_hople()){
            $thongbao = "Vui lòng đăng nhập để đổi mật khẩu!";
            include("loginform.php");
            break;
        }
        $nd = new NGUOIDUNG();
        $ndcapnhat = new NGUOIDUNG();
        $ndcapnhat->setemail($_POST["txtemail"]);
        $ndcapnhat->setmatkhau($_POST["txtmatkhaumoi"]);
        $nd->doimatkhau($ndcapnhat);
        $tb_thanhcong = "Đổi mật khẩu thành công!";
        include("changepass.php");
        break;
    case "gioithieu":
        include("about.php");
        break;
    case "timkiem":
        $tukhoa = trim($_REQUEST["q"] ?? "");
        if($tukhoa !== ""){
            $mathang = $mh->timkiemmathang($tukhoa);
        } else {
            $mathang = [];
        }
        include("search.php");
        break;
    case "dangxuat":
        unset($_SESSION["khachhang"]);
        unset($_SESSION["nguoidung"]);
        // chuyển về trang chủ
/*        // xử lý phân trang
        $tongmh = $mh->demtongsomathang();   // tổng số mặt hàng
        $soluong = 4;                           // số lượng mh hiển thị trên trang 
        $tongsotrang = ceil($tongmh/$soluong);  // tổng số trang
        if(!isset($_REQUEST["trang"]))          // trang hiện hành: mặc định là trang đầu
            $tranghh = 1;   
        else                                    // hoặc hiển thị trang do người dùng chọn
            $tranghh = $_REQUEST["trang"];
        if($tranghh > $tongsotrang)
            $tranghh = $tongsotrang;
        else if($tranghh < 1)
            $tranghh = 1;
        $batdau = ($tranghh-1)*$soluong;          // mặt hàng bắt đầu sẽ lấy
        $mathang = $mh->laymathangphantrang($batdau, $soluong);
*/
        $mathang = $mh->laymathang();   
        include("main.php");
        break;    
    default:
        break;
}
?>
