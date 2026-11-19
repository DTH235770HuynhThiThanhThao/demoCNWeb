<?php
class DONHANG{
	
	// Thêm đơn hàng mới, trả về khóa của dòng mới thêm
	public function themdonhang($nguoidung_id,$diachi_id,$tongtien){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO donhang(nguoidung_id, diachi_id, tongtien) 
					VALUES(:nguoidung_id,:diachi_id,:tongtien)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':nguoidung_id',$nguoidung_id);			
			$cmd->bindValue(':diachi_id',$diachi_id);
			$cmd->bindValue(':tongtien',$tongtien);
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
	// Đọc ds đơn hàng của 1 khách
	public function laydanhsachdonhangtheokh($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM donhang WHERE nguoidung_id=:id ORDER BY ngay DESC";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

	// Lấy thông tin 1 đơn hàng theo id (kèm địa chỉ giao hàng)
	public function laydonhangtheoid($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT d.*, dc.diachi 
					FROM donhang d 
					LEFT JOIN diachi dc ON d.diachi_id = dc.id 
					WHERE d.id = :id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", (int)$id, PDO::PARAM_INT);
			$cmd->execute();
			$result = $cmd->fetch();
			return $result;
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Tính tổng doanh thu
	public function tinhdoanhthu(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT COALESCE(SUM(tongtien), 0) FROM donhang";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			return $cmd->fetchColumn();
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đếm tổng số đơn hàng
	public function demdonhang(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT COUNT(*) FROM donhang";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			return $cmd->fetchColumn();
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy danh sách đơn hàng mới nhất
	public function laydonhangmoinhat($soluong = 5){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT donhang.*, nguoidung.hoten, nguoidung.email, nguoidung.sodienthoai 
					FROM donhang 
					LEFT JOIN nguoidung ON donhang.nguoidung_id = nguoidung.id 
					ORDER BY donhang.id DESC 
					LIMIT :soluong";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':soluong', (int)$soluong, PDO::PARAM_INT);
			$cmd->execute();
			return $cmd->fetchAll();
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
?>
