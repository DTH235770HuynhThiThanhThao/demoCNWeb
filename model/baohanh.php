<?php
class BAOHANH{

    // 1. Lấy danh sách phiếu bảo hành (có lọc theo từ khóa và trạng thái)
    public function laydanhsachbaohanh($tukhoa = '', $trangthai = ''){
        $db = DATABASE::connect();
        try{
            $where = " WHERE 1=1";
            $params = array();
            if(!empty($tukhoa)){
                $where .= " AND (bh.tenkhachhang LIKE :tukhoa OR bh.sodienthoai LIKE :tukhoa2 OR bh.soimei LIKE :tukhoa3)";
                $params[':tukhoa']  = "%" . $tukhoa . "%";
                $params[':tukhoa2'] = "%" . $tukhoa . "%";
                $params[':tukhoa3'] = "%" . $tukhoa . "%";
            }
            if($trangthai !== ''){
                $where .= " AND bh.trangthai = :trangthai";
                $params[':trangthai'] = (int)$trangthai;
            }
            $sql = "SELECT bh.*, m.tenmathang, m.hinhanh
                    FROM baohanh bh
                    LEFT JOIN mathang m ON bh.mathang_id = m.id"
                    . $where .
                    " ORDER BY bh.id DESC";
            $cmd = $db->prepare($sql);
            foreach($params as $k => $v){
                $cmd->bindValue($k, $v);
            }
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 2. Lấy chi tiết 1 phiếu bảo hành theo id
    public function laybaohanhtheoid($id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT bh.*, m.tenmathang, m.hinhanh, m.giaban
                    FROM baohanh bh
                    LEFT JOIN mathang m ON bh.mathang_id = m.id
                    WHERE bh.id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $cmd->execute();
            return $cmd->fetch();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 3. Thêm phiếu tiếp nhận bảo hành mới
    public function themphieubaohanh($donhang_id, $mathang_id, $tenkhachhang, $sodienthoai, $soimei, $ngaymua, $hanbaohanh, $tinhtrangloi, $ghichu){
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO baohanh(donhang_id, mathang_id, tenkhachhang, sodienthoai, soimei, ngaymua, hanbaohanh, tinhtrangloi, ghichu)
                    VALUES(:donhang_id, :mathang_id, :tenkhachhang, :sodienthoai, :soimei, :ngaymua, :hanbaohanh, :tinhtrangloi, :ghichu)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':donhang_id',    !empty($donhang_id) ? (int)$donhang_id : null, PDO::PARAM_INT);
            $cmd->bindValue(':mathang_id',    (int)$mathang_id, PDO::PARAM_INT);
            $cmd->bindValue(':tenkhachhang',  $tenkhachhang);
            $cmd->bindValue(':sodienthoai',   $sodienthoai);
            $cmd->bindValue(':soimei',        !empty($soimei) ? $soimei : null);
            $cmd->bindValue(':ngaymua',       !empty($ngaymua) ? $ngaymua : null);
            $cmd->bindValue(':hanbaohanh',    !empty($hanbaohanh) ? $hanbaohanh : null);
            $cmd->bindValue(':tinhtrangloi',  $tinhtrangloi);
            $cmd->bindValue(':ghichu',        !empty($ghichu) ? $ghichu : null);
            $cmd->execute();
            return $db->lastInsertId();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 4. Cập nhật tiến độ xử lý bảo hành và ghi chú sửa chữa
    public function capnhatbaohanh($id, $trangthai, $ghichu){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE baohanh SET trangthai = :trangthai, ghichu = :ghichu WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id',        (int)$id, PDO::PARAM_INT);
            $cmd->bindValue(':trangthai', (int)$trangthai, PDO::PARAM_INT);
            $cmd->bindValue(':ghichu',    !empty($ghichu) ? $ghichu : null);
            return $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 5. Tra cứu phiếu bảo hành (cho khách ngoài website)
    public function tracuubaohanh($tukhoa){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT bh.*, m.tenmathang, m.hinhanh
                    FROM baohanh bh
                    LEFT JOIN mathang m ON bh.mathang_id = m.id
                    WHERE bh.sodienthoai = :tukhoa
                       OR bh.soimei = :tukhoa2
                       OR bh.id = :tukhoa3
                    ORDER BY bh.id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tukhoa',  $tukhoa);
            $cmd->bindValue(':tukhoa2', $tukhoa);
            // Thử parse mã phiếu dạng BH00001 -> lấy số
            $id_tim = 0;
            if(preg_match('/^BH(\d+)$/i', trim($tukhoa), $m)){
                $id_tim = (int)$m[1];
            } elseif(is_numeric($tukhoa) && strlen($tukhoa) <= 7){
                $id_tim = (int)$tukhoa;
            }
            $cmd->bindValue(':tukhoa3', $id_tim, PDO::PARAM_INT);
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Hàm hỗ trợ: Thống kê số lượng theo trạng thái
    public function thongkebaohanh(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT
                        COUNT(*) AS tongsophieu,
                        COALESCE(SUM(CASE WHEN trangthai IN (0,1) THEN 1 ELSE 0 END), 0) AS dangsua,
                        COALESCE(SUM(CASE WHEN trangthai = 2 THEN 1 ELSE 0 END), 0) AS chotrakach,
                        COALESCE(SUM(CASE WHEN trangthai = 3 THEN 1 ELSE 0 END), 0) AS dahoanthanh
                    FROM baohanh";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetch(PDO::FETCH_ASSOC);
            if(!$result){
                return array('tongsophieu'=>0,'dangsua'=>0,'chotrakach'=>0,'dahoanthanh'=>0);
            }
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
