<?php 
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}
require("../../model/database.php");
require("../../model/nguoidung.php");
require("../../model/mathang.php");
require("../../model/donhang.php");

// Đồng bộ session nếu đã đăng nhập ngoài public với quyền Quản trị (1) hoặc Nhân viên (2)
if (!isset($_SESSION["nguoidung"]) && isset($_SESSION["khachhang"]) && in_array($_SESSION["khachhang"]["loai"] ?? null, [1, 2])) {
    $_SESSION["nguoidung"] = $_SESSION["khachhang"];
}

// Biến $isLogin cho biết người dùng đăng nhập chưa
$isLogin = isset($_SESSION["nguoidung"]) && in_array($_SESSION["nguoidung"]["loai"] ?? null, [1, 2]);


// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
elseif($isLogin == FALSE){  // chưa đăng nhập
    $action="dangnhap";
}
else{   // mặc định
    $action="macdinh";
}

$nd = new NGUOIDUNG();


switch($action){
    case "macdinh":               
        $dh = new DONHANG();
        $mh = new MATHANG();
        $tongdoanhthu = $dh->tinhdoanhthu();
        $tongdonhang = $dh->demdonhang();
        $donhangmoinhat = $dh->laydonhangmoinhat(5);
        $tongmathang = $mh->demmathang();
        $mathangsaphet = $mh->laymathangsaphethang(5);
        $tongkhachhang = $nd->demkhachhang();
        include("main.php");
        break;
    case "dangnhap":
        include("login.php");
        break;
    case "xldangnhap":
        $email = $_REQUEST["txtemail"];
        $matkhau = $_REQUEST["txtmatkhau"];
        if($nd->kiemtranguoidunghople($email,$matkhau)==TRUE){
            $user_info = $nd->laythongtinnguoidung($email);
            if(in_array($user_info["loai"] ?? null, [1, 2])){
                $_SESSION["nguoidung"] = $user_info; // đặt biến session
                $_SESSION["khachhang"] = $user_info; // đồng bộ sang public
                header("location:index.php");
                exit();
            }
            else{
                $tb = "Tài khoản không có quyền quản trị hệ thống!";
                include("login.php");
            }
        }
        else{
            $tb = "Email hoặc mật khẩu không chính xác!";
            include("login.php");
        }
        break;
    case "dangxuat":
        unset($_SESSION["nguoidung"]);  // hủy biến session
        unset($_SESSION["khachhang"]);  // hủy biến session khách hàng
        //include("login.php");         // hiển thị trang login
        header("location:../../index.php");     // hoặc chuyển hướng ra bên ngoài (trang dành cho khách)
        break;  
    case "hoso":               
        include("profile.php");
        break; 
    case "xlhoso":
        $ndcapnhat = new NGUOIDUNG();
        $ndcapnhat->setid($_POST["txtid"]);
        $ndcapnhat->setemail($_POST["txtemail"]);        
        $ndcapnhat->setsodienthoai($_POST["txtdienthoai"]);
        $ndcapnhat->sethoten($_POST["txthoten"]);
        $ndcapnhat->sethinhanh($_POST["txthinhanh"]);

        if($_FILES["fhinh"]["name"] != null){
            $hinhanh = basename($_FILES["fhinh"]["name"]);
            $duongdan = "../../images/users/" . $hinhanh;
            move_uploaded_file($_FILES["fhinh"]["tmp_name"], $duongdan);
            $ndcapnhat->sethinhanh($hinhanh);
        }
        
        $nd->capnhatnguoidung($ndcapnhat);

        $_SESSION["nguoidung"] = $nd->laythongtinnguoidung($ndcapnhat->getemail());
        header("location:index.php");
        exit();        
        break;

       
    case "matkhau":               
        include("changepass.php");
        break; 
    case "doimatkhau":
        if(!$isLogin){
            include("login.php");
            break;
        }
        $email          = $_SESSION["nguoidung"]["email"];
        $matkhaucu      = trim($_POST["matkhaucu"] ?? "");
        $matkhaumoi     = trim($_POST["matkhaumoi"] ?? "");
        $nhaplaimatkhau = trim($_POST["nhaplaimatkhau"] ?? "");

        if(empty($matkhaucu) || empty($matkhaumoi) || empty($nhaplaimatkhau)){
            $tb = "Vui lòng nhập đầy đủ tất cả các trường mật khẩu!";
            include("changepass.php");
        }
        elseif(!$nd->kiemtramatkhau($email, $matkhaucu)){
            $tb = "Mật khẩu hiện tại không chính xác!";
            include("changepass.php");
        }
        elseif($matkhaumoi !== $nhaplaimatkhau){
            $tb = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
            include("changepass.php");
        }
        elseif($matkhaumoi === $matkhaucu){
            $tb = "Mật khẩu mới phải khác mật khẩu hiện tại!";
            include("changepass.php");
        }
        else{
            $ndcapnhat = new NGUOIDUNG();
            $ndcapnhat->setemail($email);
            $ndcapnhat->setmatkhau($matkhaumoi);
            $nd->doimatkhau($ndcapnhat);
            $tb_thanhcong = "Đổi mật khẩu thành công!";
            include("changepass.php");
        }
        break;
    default:
        $dh = new DONHANG();
        $mh = new MATHANG();
        $tongdoanhthu = $dh->tinhdoanhthu();
        $tongdonhang = $dh->demdonhang();
        $donhangmoinhat = $dh->laydonhangmoinhat(5);
        $tongmathang = $mh->demmathang();
        $mathangsaphet = $mh->laymathangsaphethang(5);
        $tongkhachhang = $nd->demkhachhang();
        include("main.php");
        break;
}
?>
