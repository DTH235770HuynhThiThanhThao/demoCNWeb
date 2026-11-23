<?php
class BAOHANH{

    // 1. Lấy danh sách phiếu bảo hành (có lọc theo từ khóa và trạng thái - cho Admin)
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

    // 3. Thêm phiếu tiếp nhận bảo hành mới (trangthai = 0: Tiếp nhận kiểm tra)
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

    // 4. Cập nhật tiến độ xử lý bảo hành và ghi chú sửa chữa (Admin)
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

    // 5. Tra cứu phiếu bảo hành theo SĐT, IMEI hoặc Mã phiếu (VD: BH00001 -> id 1)
    public function tracuubaohanh($tukhoa){
        $db = DATABASE::connect();
        try{
            $tukhoa_clean = trim($tukhoa);
            $id_tim = 0;
            // Tách mã phiếu: BH00001, BH1, hoặc số thuần túy <= 6 chữ số
            if(preg_match('/^BH(\d+)$/i', $tukhoa_clean, $m)){
                $id_tim = (int)$m[1];
            } elseif(is_numeric($tukhoa_clean) && strlen($tukhoa_clean) <= 6){
                $id_tim = (int)$tukhoa_clean;
            }

            $sql = "SELECT bh.*, m.tenmathang, m.hinhanh, m.giaban
                    FROM baohanh bh
                    LEFT JOIN mathang m ON bh.mathang_id = m.id
                    WHERE bh.sodienthoai LIKE :sdt
                       OR bh.soimei LIKE :imei
                       OR bh.id = :id
                    ORDER BY bh.id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':sdt',  '%' . $tukhoa_clean . '%');
            $cmd->bindValue(':imei', '%' . $tukhoa_clean . '%');
            $cmd->bindValue(':id',   $id_tim, PDO::PARAM_INT);
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 6. Lấy danh sách phiếu bảo hành của khách hàng theo số điện thoại
    public function laybaohanhtheonguoidung($sodienthoai){
        $db = DATABASE::connect();
        try{
            $sdt_clean = trim($sodienthoai);
            $sql = "SELECT bh.*, m.tenmathang, m.hinhanh, m.giaban
                    FROM baohanh bh
                    LEFT JOIN mathang m ON bh.mathang_id = m.id
                    WHERE bh.sodienthoai = :sodienthoai
                    ORDER BY bh.id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':sodienthoai', $sdt_clean);
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Hàm hỗ trợ: Thống kê số lượng theo trạng thái (cho Admin)
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