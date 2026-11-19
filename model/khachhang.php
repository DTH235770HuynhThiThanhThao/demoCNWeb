<?php
class KHACHHANG{
	
	// Thêm khách hàng mới khi mua hàng vãng lai (mật khẩu mặc định là số điện thoại)
	public function themkhachhang($email,$sodt,$hoten){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO nguoidung(email,matkhau,sodienthoai,hoten,loai,trangthai) VALUES(:email,:matkhau,:sodt,:hoten,3,1)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($sodt));
			$cmd->bindValue(':sodt',$sodt);
			$cmd->bindValue(':hoten',$hoten);			
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đăng ký tài khoản khách hàng mới với mật khẩu tự chọn
	public function dangkykhachhang($email,$sodt,$hoten,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO nguoidung(email,matkhau,sodienthoai,hoten,loai,trangthai) VALUES(:email,:matkhau,:sodt,:hoten,3,1)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($matkhau));
			$cmd->bindValue(':sodt',$sodt);
			$cmd->bindValue(':hoten',$hoten);			
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Kiểm tra đăng nhập hợp lệ (hỗ trợ email hoặc số điện thoại, tài khoản hoạt động trangthai=1)
	public function kiemtrakhachhanghople($email,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE (email=:email OR sodienthoai=:email OR email=CONCAT(:email_exact, '@shop.com')) AND matkhau=:matkhau AND trangthai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":email_exact", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount() >= 1);
			$cmd->closeCursor();
			return $valid;			
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	
	// Lấy thông tin người dùng theo email hoặc số điện thoại
	public function laythongtinkhachhang($email){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE (email=:email OR sodienthoai=:email OR email=CONCAT(:email_exact, '@shop.com'))";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":email_exact", $email);
			$cmd->execute();
			$ketqua = $cmd->fetch(PDO::FETCH_ASSOC);
			$cmd->closeCursor();
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy thông tin khách hàng theo id (chỉ lấy tài khoản đang kích hoạt trangthai=1)
	public function laythongtinkhachhangtheoid($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE id=:id AND trangthai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", (int)$id, PDO::PARAM_INT);
			$cmd->execute();
			$ketqua = $cmd->fetch(PDO::FETCH_ASSOC);
			$cmd->closeCursor();
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Kiểm tra email đã tồn tại hay chưa
	public function kiemtraemailtontai($email){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT id FROM nguoidung WHERE email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$tontai = ($cmd->rowCount() > 0);
			$cmd->closeCursor();
			return $tontai;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Kiểm tra số điện thoại đã tồn tại hay chưa
	public function kiemtrasdtontai($sodt){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT id FROM nguoidung WHERE sodienthoai=:sodt";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":sodt", $sodt);
			$cmd->execute();
			$tontai = ($cmd->rowCount() > 0);
			$cmd->closeCursor();
			return $tontai;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Kiểm tra email và số điện thoại có khớp với tài khoản hợp lệ không
	public function kiemtraemailvasdt($email, $sodt){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT id FROM nguoidung WHERE email=:email AND sodienthoai=:sodt AND trangthai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":sodt", $sodt);
			$cmd->execute();
			$valid = ($cmd->rowCount() > 0);
			$cmd->closeCursor();
			return $valid;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đặt lại mật khẩu mới cho tài khoản có email và số điện thoại khớp
	public function datlaimatkhau($email, $sodt, $matkhaumoi){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung SET matkhau=:matkhau WHERE email=:email AND sodienthoai=:sodt";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":matkhau", md5($matkhaumoi));
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":sodt", $sodt);
			$ketqua = $cmd->execute();
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
?>