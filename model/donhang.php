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
	// Đọc tất cả đơn hàng (cho Admin)
	public function laydanhsachdonhang(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT d.*, n.hoten, n.email, n.sodienthoai, dc.diachi 
					FROM donhang d 
					LEFT JOIN nguoidung n ON d.nguoidung_id = n.id 
					LEFT JOIN diachi dc ON d.diachi_id = dc.id 
					ORDER BY d.id DESC";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			return $cmd->fetchAll();
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
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

	// Lấy danh sách tất cả đơn hàng của 1 khách hàng/người dùng (kèm địa chỉ giao)
	public function laydonhangtheonguoidung($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT d.*, dc.diachi 
					FROM donhang d 
					LEFT JOIN diachi dc ON d.diachi_id = dc.id 
					WHERE d.nguoidung_id = :id 
					ORDER BY d.id DESC";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", (int)$id, PDO::PARAM_INT);
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

	// Lấy thông tin 1 đơn hàng theo id (kèm thông tin khách hàng và địa chỉ giao hàng)
	public function laydonhangtheoid($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT d.*, n.hoten, n.email, n.sodienthoai, dc.diachi 
					FROM donhang d 
					LEFT JOIN nguoidung n ON d.nguoidung_id = n.id 
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

	// Cập nhật trạng thái đơn hàng (0: Chờ xác nhận, 1: Đã duyệt, 2: Đang giao, 3: Hoàn thành, 4: Đã hủy)
	public function capnhattrangthai($id, $trangthai){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE donhang SET trangthai = :trangthai WHERE id = :id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', (int)$id, PDO::PARAM_INT);
			$cmd->bindValue(':trangthai', (int)$trangthai, PDO::PARAM_INT);
			$result = $cmd->execute();
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

	// 1. Thống kê tổng hợp doanh thu theo khoảng ngày lọc
	public function thongkedoanhthu($tungay = '', $denngay = ''){
		$db = DATABASE::connect();
		try{
			$where = "";
			$params = array();
			if(!empty($tungay) && !empty($denngay)){
				$where = " WHERE DATE(ngay) BETWEEN :tungay AND :denngay";
				$params[':tungay'] = $tungay;
				$params[':denngay'] = $denngay;
			} elseif(!empty($tungay)){
				$where = " WHERE DATE(ngay) >= :tungay";
				$params[':tungay'] = $tungay;
			} elseif(!empty($denngay)){
				$where = " WHERE DATE(ngay) <= :denngay";
				$params[':denngay'] = $denngay;
			}

			$sql = "SELECT 
						COALESCE(SUM(CASE WHEN trangthai = 3 THEN tongtien ELSE 0 END), 0) AS doanhthuthucte,
						COALESCE(SUM(CASE WHEN trangthai IN (0, 1, 2) THEN tongtien ELSE 0 END), 0) AS doanhthuchoxuly,
						COALESCE(SUM(CASE WHEN trangthai = 4 THEN tongtien ELSE 0 END), 0) AS tongtienhuy,
						COALESCE(SUM(CASE WHEN trangthai = 3 THEN 1 ELSE 0 END), 0) AS sodonhoanthanh,
						COALESCE(COUNT(*), 0) AS tongsodon
					FROM donhang" . $where;
			$cmd = $db->prepare($sql);
			foreach($params as $k => $v){
				$cmd->bindValue($k, $v);
			}
			$cmd->execute();
			$result = $cmd->fetch(PDO::FETCH_ASSOC);
			if(!$result){
				return array(
					"doanhthuthucte" => 0,
					"doanhthuchoxuly" => 0,
					"tongtienhuy" => 0,
					"sodonhoanthanh" => 0,
					"tongsodon" => 0
				);
			}
			return $result;
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// 2. Thống kê doanh thu theo 12 tháng trong năm
	public function doanhthutheothang($nam = null){
		if(empty($nam)){
			$nam = (int)date("Y");
		}
		$db = DATABASE::connect();
		try{
			$sql = "SELECT MONTH(ngay) AS thang, COALESCE(SUM(tongtien), 0) AS doanhthu 
					FROM donhang 
					WHERE trangthai = 3 AND YEAR(ngay) = :nam 
					GROUP BY MONTH(ngay) 
					ORDER BY thang ASC";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':nam', (int)$nam, PDO::PARAM_INT);
			$cmd->execute();
			$rows = $cmd->fetchAll(PDO::FETCH_ASSOC);

			$data = array_fill(1, 12, 0);
			foreach($rows as $r){
				$thang = (int)$r["thang"];
				$data[$thang] = (float)$r["doanhthu"];
			}
			return $data;
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy năm gần nhất có phát sinh đơn hàng hoàn thành (trangthai = 3)
	public function laynamgannhatcohoanthanh(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT YEAR(ngay) AS nam FROM donhang WHERE trangthai = 3 ORDER BY ngay DESC LIMIT 1";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			$row = $cmd->fetch(PDO::FETCH_ASSOC);
			if($row && !empty($row["nam"])){
				return (int)$row["nam"];
			}
			return (int)date("Y");
		}
		catch(PDOException $e){
			return (int)date("Y");
		}
	}

	// Lấy danh sách các năm có phát sinh đơn hàng hoàn thành
	public function laydanhsachnamdoanhthu(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT DISTINCT YEAR(ngay) AS nam FROM donhang WHERE trangthai = 3 ORDER BY nam DESC";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			$years = $cmd->fetchAll(PDO::FETCH_COLUMN);
			$current_year = (int)date("Y");
			if(empty($years)){
				$years = [$current_year];
			}
			if(!in_array($current_year, $years)){
				array_unshift($years, $current_year);
			}
			for($y = $current_year; $y >= $current_year - 3; $y--){
				if(!in_array($y, $years)){
					$years[] = $y;
				}
			}
			rsort($years);
			return array_unique($years);
		}
		catch(PDOException $e){
			return [(int)date("Y")];
		}
	}

	// 3. Thống kê doanh thu và số máy bán ra theo từng hãng điện thoại
	public function doanhthutheohang($tungay = '', $denngay = ''){
		$db = DATABASE::connect();
		try{
			$date_condition = "";
			$params = array();
			if(!empty($tungay) && !empty($denngay)){
				$date_condition = " AND DATE(d.ngay) BETWEEN :tungay AND :denngay";
				$params[':tungay'] = $tungay;
				$params[':denngay'] = $denngay;
			} elseif(!empty($tungay)){
				$date_condition = " AND DATE(d.ngay) >= :tungay";
				$params[':tungay'] = $tungay;
			} elseif(!empty($denngay)){
				$date_condition = " AND DATE(d.ngay) <= :denngay";
				$params[':denngay'] = $denngay;
			}

			$sql = "SELECT dm.id, dm.tendanhmuc AS tenhang, 
						   COALESCE(SUM(CASE WHEN d.trangthai = 3 THEN ct.soluong ELSE 0 END), 0) AS somay, 
						   COALESCE(SUM(CASE WHEN d.trangthai = 3 THEN ct.thanhtien ELSE 0 END), 0) AS doanhthu 
					FROM danhmuc dm
					LEFT JOIN mathang m ON dm.id = m.danhmuc_id 
					LEFT JOIN donhangct ct ON m.id = ct.mathang_id 
					LEFT JOIN donhang d ON ct.donhang_id = d.id" . $date_condition . "
					GROUP BY dm.id, dm.tendanhmuc 
					ORDER BY doanhthu DESC";
			$cmd = $db->prepare($sql);
			foreach($params as $k => $v){
				$cmd->bindValue($k, $v);
			}
			$cmd->execute();
			return $cmd->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// 4. Lấy Top 5 sản phẩm bán chạy nhất mang lại doanh thu cao nhất
	public function topsanphambanchay($tungay = '', $denngay = ''){
		$db = DATABASE::connect();
		try{
			$where = " WHERE d.trangthai = 3";
			$params = array();
			if(!empty($tungay) && !empty($denngay)){
				$where .= " AND DATE(d.ngay) BETWEEN :tungay AND :denngay";
				$params[':tungay'] = $tungay;
				$params[':denngay'] = $denngay;
			} elseif(!empty($tungay)){
				$where .= " AND DATE(d.ngay) >= :tungay";
				$params[':tungay'] = $tungay;
			} elseif(!empty($denngay)){
				$where .= " AND DATE(d.ngay) <= :denngay";
				$params[':denngay'] = $denngay;
			}

			$sql = "SELECT m.id, m.tenmathang, m.hinhanh, dm.tendanhmuc AS tenhang, 
						   SUM(ct.soluong) AS tongsoluong, 
						   SUM(ct.thanhtien) AS tongdoanhthu 
					FROM donhangct ct 
					INNER JOIN donhang d ON ct.donhang_id = d.id 
					INNER JOIN mathang m ON ct.mathang_id = m.id 
					LEFT JOIN danhmuc dm ON m.danhmuc_id = dm.id 
					$where 
					GROUP BY m.id, m.tenmathang, m.hinhanh, dm.tendanhmuc 
					ORDER BY tongdoanhthu DESC 
					LIMIT 5";
			$cmd = $db->prepare($sql);
			foreach($params as $k => $v){
				$cmd->bindValue($k, $v);
			}
			$cmd->execute();
			return $cmd->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// 5. Lấy danh sách các mẫu điện thoại khách đã mua từ các đơn hàng Hoàn thành (trangthai = 3)
	public function laymathangdamuatheonguoidung($nguoidung_id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT d.id AS donhang_id, d.ngay AS ngaymua, m.id AS mathang_id, m.tenmathang, m.hinhanh, ct.dongia 
					FROM donhang d 
					INNER JOIN donhangct ct ON d.id = ct.donhang_id 
					INNER JOIN mathang m ON ct.mathang_id = m.id 
					WHERE d.nguoidung_id = :nguoidung_id AND d.trangthai = 3 
					ORDER BY d.id DESC, m.id ASC";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':nguoidung_id', (int)$nguoidung_id, PDO::PARAM_INT);
			$cmd->execute();
			return $cmd->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
?>
