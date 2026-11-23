<?php
class DANHGIA{

    // 1. Lấy danh sách đánh giá của một mặt hàng (kèm họ tên, ảnh của người đánh giá)
    public function laydanhgiatheomathang($mathang_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT dg.*, nd.hoten, nd.hinhanh, nd.email 
                    FROM danhgia dg 
                    LEFT JOIN nguoidung nd ON dg.nguoidung_id = nd.id 
                    WHERE dg.mathang_id = :mathang_id AND dg.trangthai = 1 
                    ORDER BY dg.id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mathang_id', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->execute();
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 2. Tính điểm trung bình, tổng số đánh giá và thống kê số lượng từng mức 1 - 5 sao
    public function tinhdiemdanhgia($mathang_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT 
                        COUNT(*) AS tongso,
                        ROUND(COALESCE(AVG(sosao), 5.0), 1) AS diemtrungbinh,
                        COALESCE(SUM(CASE WHEN sosao = 5 THEN 1 ELSE 0 END), 0) AS sao5,
                        COALESCE(SUM(CASE WHEN sosao = 4 THEN 1 ELSE 0 END), 0) AS sao4,
                        COALESCE(SUM(CASE WHEN sosao = 3 THEN 1 ELSE 0 END), 0) AS sao3,
                        COALESCE(SUM(CASE WHEN sosao = 2 THEN 1 ELSE 0 END), 0) AS sao2,
                        COALESCE(SUM(CASE WHEN sosao = 1 THEN 1 ELSE 0 END), 0) AS sao1
                    FROM danhgia 
                    WHERE mathang_id = :mathang_id AND trangthai = 1";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mathang_id', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->execute();
            $kq = $cmd->fetch(PDO::FETCH_ASSOC);

            if(!$kq || (int)$kq['tongso'] === 0){
                return array(
                    'tongso' => 0,
                    'diemtrungbinh' => 5.0,
                    'sao5' => 0,
                    'sao4' => 0,
                    'sao3' => 0,
                    'sao2' => 0,
                    'sao1' => 0
                );
            }

            return array(
                'tongso' => (int)$kq['tongso'],
                'diemtrungbinh' => (float)$kq['diemtrungbinh'],
                'sao5' => (int)$kq['sao5'],
                'sao4' => (int)$kq['sao4'],
                'sao3' => (int)$kq['sao3'],
                'sao2' => (int)$kq['sao2'],
                'sao1' => (int)$kq['sao1']
            );
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 3. Kiểm tra khách có đơn hàng Hoàn thành (trangthai = 3) chứa mathang_id và chưa đánh giá không
    public function kiemtraduocphepdanhgia($nguoidung_id, $mathang_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT d.id AS donhang_id 
                    FROM donhang d 
                    INNER JOIN donhangct ct ON d.id = ct.donhang_id 
                    WHERE d.nguoidung_id = :nguoidung_id 
                      AND ct.mathang_id = :mathang_id 
                      AND d.trangthai = 3 
                      AND d.id NOT IN (
                          SELECT dg.donhang_id 
                          FROM danhgia dg 
                          WHERE dg.nguoidung_id = :nguoidung_id2 
                            AND dg.mathang_id = :mathang_id2
                      ) 
                    ORDER BY d.id DESC 
                    LIMIT 1";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':nguoidung_id', (int)$nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(':mathang_id', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->bindValue(':nguoidung_id2', (int)$nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(':mathang_id2', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->execute();
            $dong = $cmd->fetch(PDO::FETCH_ASSOC);

            if($dong && isset($dong["donhang_id"])){
                return (int)$dong["donhang_id"];
            }
            return false;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 4. Kiểm tra sản phẩm trong 1 đơn hàng cụ thể đã được khách đánh giá chưa
    public function kiemtradadanhgiadon($nguoidung_id, $donhang_id, $mathang_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT COUNT(*) 
                    FROM danhgia 
                    WHERE nguoidung_id = :nguoidung_id 
                      AND donhang_id = :donhang_id 
                      AND mathang_id = :mathang_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':nguoidung_id', (int)$nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(':donhang_id', (int)$donhang_id, PDO::PARAM_INT);
            $cmd->bindValue(':mathang_id', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->execute();
            return ((int)$cmd->fetchColumn() > 0);
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 5. Thêm đánh giá mới vào bảng danhgia
    public function themdanhgia($mathang_id, $nguoidung_id, $donhang_id, $sosao, $noidung){
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO danhgia(mathang_id, nguoidung_id, donhang_id, sosao, noidung) 
                    VALUES(:mathang_id, :nguoidung_id, :donhang_id, :sosao, :noidung)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mathang_id', (int)$mathang_id, PDO::PARAM_INT);
            $cmd->bindValue(':nguoidung_id', (int)$nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(':donhang_id', (int)$donhang_id, PDO::PARAM_INT);
            $cmd->bindValue(':sosao', (int)$sosao, PDO::PARAM_INT);
            $cmd->bindValue(':noidung', $noidung);
            $cmd->execute();
            return $db->lastInsertId();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>