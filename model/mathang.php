<?php
class MATHANG{
    // khai báo các thuộc tính
    private $id;
    private $tenmathang;
    private $mota;
    private $giagoc;
    private $giaban;
    private $soluongton;
    private $hinhanh;
    private $phienban;
    private $mausac;
    private $thuvienanh;
    private $danhmucid;
    private $luotxem;
    private $luotmua;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function gettenmathang(){ return $this->tenmathang; }
    public function settenmathang($value){ $this->tenmathang = $value; }
    public function getmota(){ return $this->mota; }
    public function setmota($value){ $this->mota = $value; }
    public function getgiagoc(){ return $this->giagoc; }
    public function setgiagoc($value){ $this->giagoc = $value; }
    public function getgiaban(){ return $this->giaban; }
    public function setgiaban($value){ $this->giaban = $value; }
    public function getsoluongton(){ return $this->soluongton; }
    public function setsoluongton($value){ $this->soluongton = $value; }
    public function gethinhanh(){ return $this->hinhanh; }
    public function sethinhanh($value){ $this->hinhanh = $value; }
    public function getphienban(){ return $this->phienban; }
    public function setphienban($value){ $this->phienban = $value; }
    public function getmausac(){ return $this->mausac; }
    public function setmausac($value){ $this->mausac = $value; }
    public function getthuvienanh(){ return $this->thuvienanh; }
    public function setthuvienanh($value){ $this->thuvienanh = $value; }
    public function getdanhmuc_id(){ return $this->danhmuc_id; }
    public function setdanhmuc_id($value){ $this->danhmuc_id = $value; }
    public function getluotxem(){ return $this->luotxem; }
    public function setluotxem($value){ $this->luotxem = $value; }
    public function getluotmua(){ return $this->luotmua; }
    public function setluotmua($value){ $this->luotmua = $value; }


    // Lấy danh sách
    public function laymathang(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang ORDER BY id DESC";
            $cmd = $dbcon->prepare($sql);
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
    // Tìm kiếm mặt hàng theo từ khóa (tên, mô tả)
    public function timkiemmathang($tukhoa){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE tenmathang LIKE :tukhoa OR mota LIKE :tukhoa2 ORDER BY luotxem DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tukhoa", "%" . $tukhoa . "%");
            $cmd->bindValue(":tukhoa2", "%" . $tukhoa . "%");
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

	// Lấy danh sách mặt hàng thuộc 1 danh mục
    public function laymathangtheodanhmuc($danhmuc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE danhmuc_id=:madm" ;
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":madm",$danhmuc_id);
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

    // Lấy mặt hàng theo id
    public function laymathangtheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
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
    // Cập nhật lượt xem
    public function tangluotxem($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE mathang SET luotxem=luotxem+1 WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Lấy mặt hàng xem nhiều
    public function laymathangxemnhieu(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang ORDER BY luotxem DESC LIMIT 4";
            $cmd = $dbcon->prepare($sql);
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

    // Lấy mặt hàng nổi bật
    public function laymathangnoibat(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang ORDER BY luotxem DESC, luotmua DESC LIMIT 4";
            $cmd = $dbcon->prepare($sql);
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

    // Lấy mặt hàng bán chạy nhất (theo lượt mua)
    public function laymathangbanchay(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang ORDER BY luotmua DESC LIMIT 4";
            $cmd = $dbcon->prepare($sql);
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

    // Lấy mặt hàng mới nhất (1 flagship đại diện từng hãng)
    public function laymathangmoi(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE id IN (1, 11, 21, 31) ORDER BY giaban DESC";
            $cmd = $dbcon->prepare($sql);
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

    // Lấy mặt hàng mua nhiều
    public function laymathangmuanhieu(){
        return $this->laymathangbanchay();
    }

    // Thêm mới
    public function themmathang($mathang){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO mathang(tenmathang,mota,giagoc,giaban,soluongton,danhmuc_id,hinhanh,phienban,mausac,thuvienanh,luotxem,luotmua) 
                VALUES(:tenmathang,:mota,:giagoc,:giaban,:soluongton,:danhmuc_id,:hinhanh,:phienban,:mausac,:thuvienanh,0,0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->tenmathang);
            $cmd->bindValue(":mota", $mathang->mota);
            $cmd->bindValue(":giagoc", $mathang->giagoc);
            $cmd->bindValue(":giaban", $mathang->giaban);
            $cmd->bindValue(":soluongton", $mathang->soluongton);
            $cmd->bindValue(":danhmuc_id", $mathang->danhmuc_id);
            $cmd->bindValue(":hinhanh", $mathang->hinhanh);
            $cmd->bindValue(":phienban", $mathang->phienban);
            $cmd->bindValue(":mausac", $mathang->mausac);
            $cmd->bindValue(":thuvienanh", $mathang->thuvienanh);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoamathang($mathang){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $mathang->id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suamathang($mathang){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE mathang SET tenmathang=:tenmathang,
                                        mota=:mota,
                                        giagoc=:giagoc,
                                        giaban=:giaban,
                                        soluongton=:soluongton,
                                        danhmuc_id=:danhmuc_id,
                                        hinhanh=:hinhanh,
                                        phienban=:phienban,
                                        mausac=:mausac,
                                        thuvienanh=:thuvienanh,
                                        luotxem=:luotxem,
                                        luotmua=:luotmua
                                        WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->tenmathang);
            $cmd->bindValue(":mota", $mathang->mota);
            $cmd->bindValue(":giagoc", $mathang->giagoc);
            $cmd->bindValue(":giaban", $mathang->giaban);
            $cmd->bindValue(":soluongton", $mathang->soluongton);
            $cmd->bindValue(":danhmuc_id", $mathang->danhmuc_id);
            $cmd->bindValue(":hinhanh", $mathang->hinhanh);
            $cmd->bindValue(":phienban", $mathang->phienban);
            $cmd->bindValue(":mausac", $mathang->mausac);
            $cmd->bindValue(":thuvienanh", $mathang->thuvienanh);
            $cmd->bindValue(":luotxem", $mathang->luotxem);
            $cmd->bindValue(":luotmua", $mathang->luotmua);
            $cmd->bindValue(":id", $mathang->id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật số lượng tồn
    public function capnhatsoluong($id, $soluong){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE mathang SET soluongton=soluongton - :soluong WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":soluong", $soluong);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đếm tổng số mặt hàng
    public function demmathang(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT COUNT(*) FROM mathang";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            return $cmd->fetchColumn();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy các mặt hàng sắp hết hàng (tồn kho thấp nhất)
    public function laymathangsaphethang($soluong = 5){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang ORDER BY soluongton ASC LIMIT :soluong";
            $cmd = $dbcon->prepare($sql);
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

    // Lấy danh sách điện thoại đang có chương trình khuyến mãi (giagoc > giaban)
    public function laymathangkhuyenmai(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT m.*, d.tendanhmuc 
                    FROM mathang m 
                    LEFT JOIN danhmuc d ON m.danhmuc_id = d.id 
                    WHERE m.giagoc > m.giaban 
                    ORDER BY (m.giagoc - m.giaban) DESC";
            $cmd = $dbcon->prepare($sql);
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

    // Áp dụng giảm giá theo % cho một hãng (danhmuc_id) hoặc toàn bộ cửa hàng (danhmuc_id = 0)
    public function apdungkhuyenmaitheohang($danhmuc_id, $phantramgiam){
        $dbcon = DATABASE::connect();
        try{
            $danhmuc_id = (int)$danhmuc_id;
            $phantramgiam = (float)$phantramgiam;
            if ($phantramgiam <= 0 || $phantramgiam >= 100) {
                return false;
            }

            // Đảm bảo giagoc hợp lệ: nếu giagoc <= 0 hoặc giagoc < giaban thì gán giagoc = giaban
            if ($danhmuc_id == 0) {
                $sql1 = "UPDATE mathang SET giagoc = giaban WHERE giagoc <= 0 OR giagoc < giaban";
                $cmd1 = $dbcon->prepare($sql1);
                $cmd1->execute();

                // Tính giaban mới = ROUND(giagoc * (100 - %)/100, -4)
                $sql2 = "UPDATE mathang SET giaban = ROUND(giagoc * (100 - :phantram) / 100, -4)";
                $cmd2 = $dbcon->prepare($sql2);
                $cmd2->bindValue(":phantram", $phantramgiam);
                $result = $cmd2->execute();
            } else {
                $sql1 = "UPDATE mathang SET giagoc = giaban WHERE (giagoc <= 0 OR giagoc < giaban) AND danhmuc_id = :danhmuc_id";
                $cmd1 = $dbcon->prepare($sql1);
                $cmd1->bindValue(":danhmuc_id", $danhmuc_id, PDO::PARAM_INT);
                $cmd1->execute();

                $sql2 = "UPDATE mathang SET giaban = ROUND(giagoc * (100 - :phantram) / 100, -4) WHERE danhmuc_id = :danhmuc_id";
                $cmd2 = $dbcon->prepare($sql2);
                $cmd2->bindValue(":phantram", $phantramgiam);
                $cmd2->bindValue(":danhmuc_id", $danhmuc_id, PDO::PARAM_INT);
                $result = $cmd2->execute();
            }
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Áp dụng giá khuyến mãi trực tiếp cho 1 mẫu máy
    public function apdungkhuyenmaimay($id, $giabanmoi){
        $dbcon = DATABASE::connect();
        try{
            $id = (int)$id;
            $giabanmoi = (float)$giabanmoi;
            if ($id <= 0 || $giabanmoi <= 0) {
                return false;
            }

            // Đảm bảo giagoc được giữ nguyên nếu đã lớn hơn giaban, ngược lại gán giagoc = giaban hiện tại
            $sql = "UPDATE mathang 
                    SET giagoc = CASE WHEN giagoc <= 0 OR giagoc < giaban THEN giaban ELSE giagoc END, 
                        giaban = :giabanmoi 
                    WHERE id = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":giabanmoi", $giabanmoi);
            $cmd->bindValue(":id", $id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Hủy khuyến mãi: đưa giá bán trở về bằng giá gốc
    public function huykhuyenmai($id){
        $dbcon = DATABASE::connect();
        try{
            $id = (int)$id;
            if ($id == 0) {
                // Đưa tất cả điện thoại đang khuyến mãi về giá gốc
                $sql = "UPDATE mathang SET giaban = giagoc WHERE giagoc > giaban";
                $cmd = $dbcon->prepare($sql);
                $result = $cmd->execute();
            } else {
                $sql = "UPDATE mathang SET giaban = giagoc WHERE id = :id";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":id", $id, PDO::PARAM_INT);
                $result = $cmd->execute();
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
