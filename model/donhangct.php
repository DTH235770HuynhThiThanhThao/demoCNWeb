<?php
class DONHANGCT{
	
	// Thêm chi tiết đơn hàng mới kèm biến thể, trả về khóa của dòng mới thêm
	public function themchitietdonhang($donhang_id, $mathang_id, $dongia, $soluong, $thanhtien, $phienban = "", $mausac = "", $hinhanh = ""){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO donhangct(donhang_id, mathang_id, dongia, soluong, thanhtien, phienban, mausac, hinhanh) 
					VALUES(:donhang_id, :mathang_id, :dongia, :soluong, :thanhtien, :phienban, :mausac, :hinhanh)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':donhang_id', $donhang_id, PDO::PARAM_INT);			
			$cmd->bindValue(':mathang_id', $mathang_id, PDO::PARAM_INT);
			$cmd->bindValue(':dongia', $dongia);
			$cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
			$cmd->bindValue(':thanhtien', $thanhtien);
			$cmd->bindValue(':phienban', $phienban);
			$cmd->bindValue(':mausac', $mausac);
			$cmd->bindValue(':hinhanh', $hinhanh);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đọc chi tiết 1 đơn hàng (ưu tiên lấy ảnh và thông tin biến thể đã lưu)
	public function laychitietdonhang($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT c.*, m.id as mhid, m.tenmathang, 
                           COALESCE(NULLIF(c.hinhanh, ''), m.hinhanh) as hinhanh 
                    FROM donhangct c 
                    INNER JOIN mathang m ON c.mathang_id = m.id 
                    WHERE c.donhang_id = :id 
                    ORDER BY c.id DESC";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id", $id, PDO::PARAM_INT);
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

}
?>
