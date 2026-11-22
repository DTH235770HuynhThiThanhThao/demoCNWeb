<?php 
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}

require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}

$dm = new DANHMUC();
$mh = new MATHANG();

switch($action){
    case "xem":
        $mathang = $mh->laymathang();
		include("main.php");
        break;

	case "them":
		$danhmuc = $dm->laydanhmuc();
		include("addform.php");
        break;

	case "xulythem":	
		// xử lý file upload ảnh chính
		$hinhanh = "";
		if(!empty($_FILES["filehinhanh"]["name"])){
			$hinhanh = "images/products/" . basename($_FILES["filehinhanh"]["name"]); // đường dẫn ảnh lưu trong db
			$duongdan = "../../" . $hinhanh; // nơi lưu file upload
			move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
		}

		// xử lý upload ảnh các màu sắc khác (thư viện ảnh)
		$ds_thuvien = array();
		if(isset($_FILES["filethuvienanh"]) && !empty($_FILES["filethuvienanh"]["name"][0])){
			$total_files = count($_FILES["filethuvienanh"]["name"]);
			for($i = 0; $i < $total_files; $i++){
				if(!empty($_FILES["filethuvienanh"]["name"][$i])){
					$ten_file = basename($_FILES["filethuvienanh"]["name"][$i]);
					$duongdan_tv = "../../images/products/" . $ten_file;
					if(move_uploaded_file($_FILES["filethuvienanh"]["tmp_name"][$i], $duongdan_tv)){
						$ds_thuvien[] = $ten_file;
					}
				}
			}
		}
		$thuvienanh = !empty($ds_thuvien) ? implode(", ", $ds_thuvien) : null;
		$phienban = isset($_POST["txtphienban"]) ? trim($_POST["txtphienban"]) : null;
		$mausac = isset($_POST["txtmausac"]) ? trim($_POST["txtmausac"]) : null;

		// xử lý thêm		
        $mathanghh = new MATHANG();
		$mathanghh->settenmathang($_POST["txttenmathang"]);
		$mathanghh->setmota($_POST["txtmota"]);
		$mathanghh->setgiagoc($_POST["txtgianhap"]);
		$mathanghh->setgiaban($_POST["txtgiaban"]);
		$mathanghh->setsoluongton($_POST["txtsoluong"]);
		$mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->sethinhanh($hinhanh);
        $mathanghh->setphienban($phienban);
        $mathanghh->setmausac($mausac);
        $mathanghh->setthuvienanh($thuvienanh);
		$mh->themmathang($mathanghh);
		
		header("location:index.php");
		exit();

	case "xoa":
		if(isset($_GET["id"])){
            $mathanghh = new MATHANG();        
            $mathanghh->setid($_GET["id"]);
			$mh->xoamathang($mathanghh);
        }
		header("location:index.php?msg=xoa_ok");
		exit();

    case "chitiet":
        if(isset($_GET["id"])){ 
            $m = $mh->laymathangtheoid($_GET["id"]);            
            include("detail.php");
        }
        else{
            $mathang = $mh->laymathang();        
            include("main.php");            
        }
        break;

    case "sua":
        if(isset($_GET["id"])){ 
            $m = $mh->laymathangtheoid($_GET["id"]);
            $danhmuc = $dm->laydanhmuc(); 
            include("updateform.php");
        }
        else{
            $mathang = $mh->laymathang();        
            include("main.php");            
        }
        break;

    case "xulysua":
        $mathanghh = new MATHANG();
        $mathanghh->setid($_POST["txtid"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->settenmathang($_POST["txttenhang"]);
        $mathanghh->setmota($_POST["txtmota"]);
        $mathanghh->setgiagoc($_POST["txtgiagoc"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setsoluongton($_POST["txtsoluongton"]);
        $mathanghh->setluotxem($_POST["txtluotxem"]);
        $mathanghh->setluotmua($_POST["txtluotmua"]);
        $mathanghh->sethinhanh($_POST["txthinhcu"]);

        // upload file ảnh chính mới (nếu có)
        if(!empty($_FILES["filehinhanh"]["name"])){
            $hinhanh = "images/products/" . basename($_FILES["filehinhanh"]["name"]);
            $mathanghh->sethinhanh($hinhanh);
            $duongdan = "../../" . $hinhanh;
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
        }

        // xử lý danh sách ảnh thư viện cũ còn lại sau khi xóa
        $thuvienanh_cu_str = isset($_POST["txtthuvienanhcu"]) ? trim($_POST["txtthuvienanhcu"]) : "";
        $ds_tong_thuvien = array();
        if(!empty($thuvienanh_cu_str)){
            $arr_cu = explode(",", $thuvienanh_cu_str);
            foreach($arr_cu as $item_cu){
                $item_cu = trim($item_cu);
                if(!empty($item_cu)){
                    $ds_tong_thuvien[] = $item_cu;
                }
            }
        }

        // loại bỏ các ảnh được tick chọn xóa qua checkbox (nếu có)
        if(isset($_POST["chk_xoa_anh"]) && is_array($_POST["chk_xoa_anh"])){
            $ds_tong_thuvien = array_values(array_diff($ds_tong_thuvien, $_POST["chk_xoa_anh"]));
        }

        // xử lý upload thêm ảnh màu mới (nếu có)
        if(isset($_FILES["filethuvienanh"]) && !empty($_FILES["filethuvienanh"]["name"][0])){
            $total_files = count($_FILES["filethuvienanh"]["name"]);
            for($i = 0; $i < $total_files; $i++){
                if(!empty($_FILES["filethuvienanh"]["name"][$i])){
                    $ten_file = basename($_FILES["filethuvienanh"]["name"][$i]);
                    $duongdan_tv = "../../images/products/" . $ten_file;
                    if(move_uploaded_file($_FILES["filethuvienanh"]["tmp_name"][$i], $duongdan_tv)){
                        if(!in_array($ten_file, $ds_tong_thuvien)){
                            $ds_tong_thuvien[] = $ten_file;
                        }
                    }
                }
            }
        }
        $thuvienanh_moi = !empty($ds_tong_thuvien) ? implode(", ", $ds_tong_thuvien) : null;
        $phienban_moi = isset($_POST["txtphienban"]) ? trim($_POST["txtphienban"]) : null;
        $mausac_moi = isset($_POST["txtmausac"]) ? trim($_POST["txtmausac"]) : null;

        $mathanghh->setthuvienanh($thuvienanh_moi);
        $mathanghh->setphienban($phienban_moi);
        $mathanghh->setmausac($mausac_moi);
        
        // sửa mặt hàng
        $mh->suamathang($mathanghh);         
    
        header("location:index.php");
        exit();

	// Quản lý nhanh Phiên bản (Dung lượng) & Màu sắc
	case "bienthe":
		if(isset($_GET["id"])){ 
			$m = $mh->laymathangtheoid($_GET["id"]);
			include("bienthe.php");
		}
		else{
			$mathang = $mh->laymathang();        
			include("main.php");            
		}
		break;

	case "luubienthe":
		if(isset($_POST["txtid"])){
			$id = (int)$_POST["txtid"];
			$phienban = isset($_POST["txtphienban"]) ? trim($_POST["txtphienban"]) : null;
			$mausac = isset($_POST["txtmausac"]) ? trim($_POST["txtmausac"]) : null;
			$mh->capnhatbienthe($id, $phienban, $mausac);
		}
		header("location:index.php?msg=bienthe_ok");
		exit();

	// Quản lý nhanh Thư viện ảnh màu
	case "anhmau":
		if(isset($_GET["id"])){ 
			$m = $mh->laymathangtheoid($_GET["id"]);
			include("anhmau.php");
		}
		else{
			$mathang = $mh->laymathang();        
			include("main.php");            
		}
		break;

	case "themanhmau":
		if(isset($_POST["txtid"])){
			$id = (int)$_POST["txtid"];
			$m = $mh->laymathangtheoid($id);
			$ds_thuvien = array();
			if(!empty($m["thuvienanh"])){
				$arr_cu = explode(",", $m["thuvienanh"]);
				foreach($arr_cu as $it){
					$it = trim($it);
					if(!empty($it)) $ds_thuvien[] = $it;
				}
			}

			// Xử lý upload thêm ảnh
			if(isset($_FILES["fileanhmau"]) && !empty($_FILES["fileanhmau"]["name"][0])){
				$total_files = count($_FILES["fileanhmau"]["name"]);
				for($i = 0; $i < $total_files; $i++){
					if(!empty($_FILES["fileanhmau"]["name"][$i])){
						$ten_file = basename($_FILES["fileanhmau"]["name"][$i]);
						$duongdan_tv = "../../images/products/" . $ten_file;
						if(move_uploaded_file($_FILES["fileanhmau"]["tmp_name"][$i], $duongdan_tv)){
							if(!in_array($ten_file, $ds_thuvien)){
								$ds_thuvien[] = $ten_file;
							}
						}
					}
				}
			}

			$thuvienanh_moi = !empty($ds_thuvien) ? implode(", ", $ds_thuvien) : null;
			$mh->capnhatthuvienanh($id, $thuvienanh_moi);
			header("location:index.php?action=anhmau&id=" . $id . "&msg=them_ok");
			exit();
		}
		header("location:index.php");
		exit();

	case "xoaanhmau":
		if(isset($_GET["id"]) && isset($_GET["file"])){
			$id = (int)$_GET["id"];
			$file_xoa = trim($_GET["file"]);
			$m = $mh->laymathangtheoid($id);
			$ds_thuvien = array();
			if(!empty($m["thuvienanh"])){
				$arr_cu = explode(",", $m["thuvienanh"]);
				foreach($arr_cu as $it){
					$it = trim($it);
					if(!empty($it) && $it !== $file_xoa){
						$ds_thuvien[] = $it;
					}
				}
			}
			$thuvienanh_moi = !empty($ds_thuvien) ? implode(", ", $ds_thuvien) : null;
			$mh->capnhatthuvienanh($id, $thuvienanh_moi);
			header("location:index.php?action=anhmau&id=" . $id . "&msg=xoa_ok");
			exit();
		}
		header("location:index.php");
		exit();

    default:
        break;
}
?>