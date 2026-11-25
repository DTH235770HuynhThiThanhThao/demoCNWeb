<?php
class GIOHANG{
    private $id;
    private $nguoidung_id;
    private $mathang_id;
    private $phienban;
    private $mausac;
    private $hinhanh;
    private $giaban;
    private $soluong;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function getnguoidung_id(){ return $this->nguoidung_id; }
    public function setnguoidung_id($value){ $this->nguoidung_id = $value; }
    public function getmathang_id(){ return $this->mathang_id; }
    public function setmathang_id($value){ $this->mathang_id = $value; }
    public function getphienban(){ return $this->phienban; }
    public function setphienban($value){ $this->phienban = $value; }
    public function getmausac(){ return $this->mausac; }
    public function setmausac($value){ $this->mausac = $value; }
    public function gethinhanh(){ return $this->hinhanh; }
    public function sethinhanh($value){ $this->hinhanh = $value; }
    public function getgiaban(){ return $this->giaban; }
    public function setgiaban($value){ $this->giaban = $value; }
    public function getsoluong(){ return $this->soluong; }
    public function setsoluong($value){ $this->soluong = $value; }

    // Lấy giỏ hàng theo người dùng (JOIN với mathang, key mảng là giohang.id, ưu tiên lấy giá và ảnh của biến thể)
    public function laygiohangtheonguoidung($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return array();
        }
        $db = DATABASE::connect();
        try{
            $sql = "SELECT g.id, g.nguoidung_id, g.mathang_id, g.phienban, g.mausac, 
                           g.hinhanh AS bienthe_hinhanh, g.giaban AS bienthe_giaban, g.soluong, 
                           m.tenmathang, m.hinhanh AS goc_hinhanh, m.giaban AS goc_giaban, m.soluongton 
                    FROM giohang g 
                    INNER JOIN mathang m ON g.mathang_id = m.id 
                    WHERE g.nguoidung_id = :nguoidung_id 
                    ORDER BY g.id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll();

            $giohang = array();
            foreach($result as $r){
                $gh_id = (int)$r["id"];
                $mh_id = (int)$r["mathang_id"];
                $dongia = (!empty($r["bienthe_giaban"]) && (float)$r["bienthe_giaban"] > 0) 
                            ? (float)$r["bienthe_giaban"] 
                            : (float)$r["goc_giaban"];
                $hinhanh = !empty($r["bienthe_hinhanh"]) ? $r["bienthe_hinhanh"] : $r["goc_hinhanh"];
                $soluong = intval($r["soluong"]);
                $thanhtien = round($dongia * $soluong, 2);

                $giohang[$gh_id] = array(
                    "id" => $gh_id,
                    "giohang_id" => $gh_id,
                    "nguoidung_id" => (int)$r["nguoidung_id"],
                    "mathang_id" => $mh_id,
                    "tenmathang" => $r["tenmathang"],
                    "tenhang" => $r["tenmathang"],
                    "hinhanh" => $hinhanh,
                    "phienban" => $r["phienban"] ?? "",
                    "mausac" => $r["mausac"] ?? "",
                    "giaban" => $dongia,
                    "soluong" => $soluong,
                    "soluongton" => $r["soluongton"],
                    "thanhtien" => $thanhtien
                );
            }
            return $giohang;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm biến thể mặt hàng vào giỏ hàng của người dùng (kiểm tra trùng theo nguoidung_id, mathang_id, phienban, mausac)
    // Trả về ID của dòng trong bảng giohang (để phục vụ chuyển thẳng sang mua ngay nếu cần)
    public function themvaogio($nguoidung_id, $mathang_id, $soluong = 1, $phienban = "", $mausac = "", $hinhanh = "", $giaban = 0){
        $nguoidung_id = (int)$nguoidung_id;
        $mathang_id = (int)$mathang_id;
        $soluong = (int)$soluong;
        $phienban = trim($phienban ?? "");
        $mausac = trim($mausac ?? "");
        $hinhanh = trim($hinhanh ?? "");
        $giaban = (float)($giaban ?? 0);

        if($nguoidung_id <= 0 || $mathang_id <= 0){
            return false;
        }
        if($soluong <= 0){
            $soluong = 1;
        }
        $db = DATABASE::connect();
        try{
            // Nếu chưa có giá hoặc ảnh biến thể, lấy giá trị gốc từ bảng mathang
            if($giaban <= 0 || empty($hinhanh)){
                $sql_mh = "SELECT giaban, hinhanh FROM mathang WHERE id = :id";
                $cmd_mh = $db->prepare($sql_mh);
                $cmd_mh->bindValue(":id", $mathang_id, PDO::PARAM_INT);
                $cmd_mh->execute();
                $mh_info = $cmd_mh->fetch();
                if($mh_info){
                    if($giaban <= 0) $giaban = (float)$mh_info["giaban"];
                    if(empty($hinhanh)) $hinhanh = $mh_info["hinhanh"];
                }
            }

            // Kiểm tra biến thể này đã tồn tại trong giỏ của người dùng chưa
            $sql_kt = "SELECT id, soluong FROM giohang 
                       WHERE nguoidung_id = :nguoidung_id 
                         AND mathang_id = :mathang_id 
                         AND phienban = :phienban 
                         AND mausac = :mausac 
                       LIMIT 1";
            $cmd_kt = $db->prepare($sql_kt);
            $cmd_kt->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd_kt->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
            $cmd_kt->bindValue(":phienban", $phienban);
            $cmd_kt->bindValue(":mausac", $mausac);
            $cmd_kt->execute();
            $dong_tontai = $cmd_kt->fetch();

            if($dong_tontai){
                // Nếu đã tồn tại đúng biến thể này thì tăng số lượng và cập nhật giá/ảnh mới nhất
                $existing_id = (int)$dong_tontai["id"];
                $sql = "UPDATE giohang 
                        SET soluong = soluong + :soluong,
                            giaban = CASE WHEN :giaban > 0 THEN :giaban ELSE giaban END,
                            hinhanh = CASE WHEN :hinhanh != '' THEN :hinhanh ELSE hinhanh END
                        WHERE id = :id";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
                $cmd->bindValue(":giaban", $giaban);
                $cmd->bindValue(":hinhanh", $hinhanh);
                $cmd->bindValue(":id", $existing_id, PDO::PARAM_INT);
                $cmd->execute();
                return $existing_id;
            }
            else{
                // Nếu chưa tồn tại thì thêm mới một dòng riêng biệt cho biến thể này
                $sql = "INSERT INTO giohang(nguoidung_id, mathang_id, phienban, mausac, hinhanh, giaban, soluong) 
                        VALUES(:nguoidung_id, :mathang_id, :phienban, :mausac, :hinhanh, :giaban, :soluong)";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
                $cmd->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
                $cmd->bindValue(":phienban", $phienban);
                $cmd->bindValue(":mausac", $mausac);
                $cmd->bindValue(":hinhanh", $hinhanh);
                $cmd->bindValue(":giaban", $giaban);
                $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
                $cmd->execute();
                return (int)$db->lastInsertId();
            }
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật số lượng của một dòng trong giỏ hàng (thao tác theo giohang.id)
    public function capnhatsoluong($nguoidung_id, $giohang_id, $soluong){
        $nguoidung_id = (int)$nguoidung_id;
        $giohang_id = (int)$giohang_id;
        $soluong = (int)$soluong;
        if($nguoidung_id <= 0 || $giohang_id <= 0){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE giohang SET soluong = :soluong WHERE id = :giohang_id AND nguoidung_id = :nguoidung_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
            $cmd->bindValue(":giohang_id", $giohang_id, PDO::PARAM_INT);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa một dòng khỏi giỏ hàng (thao tác theo giohang.id)
    public function xoamotmathang($nguoidung_id, $giohang_id){
        $nguoidung_id = (int)$nguoidung_id;
        $giohang_id = (int)$giohang_id;
        if($nguoidung_id <= 0 || $giohang_id <= 0){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM giohang WHERE id = :giohang_id AND nguoidung_id = :nguoidung_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":giohang_id", $giohang_id, PDO::PARAM_INT);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa toàn bộ giỏ hàng của người dùng
    public function xoatoanbogiohang($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM giohang WHERE nguoidung_id = :nguoidung_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa các dòng được chọn khỏi giỏ của người dùng (thao tác theo danh sách giohang.id)
    public function xoacacmathang($nguoidung_id, $ds_giohang_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0 || empty($ds_giohang_id) || !is_array($ds_giohang_id)){
            return false;
        }
        $ids = array();
        foreach($ds_giohang_id as $gid){
            $gid = (int)$gid;
            if($gid > 0){
                $ids[] = $gid;
            }
        }
        if(empty($ids)){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $in_clause = implode(",", $ids);
            $sql = "DELETE FROM giohang WHERE nguoidung_id = :nguoidung_id AND id IN ($in_clause)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đếm số dòng (loại mặt hàng/biến thể) trong giỏ của người dùng (hiển thị trên badge Giỏ hàng)
    public function demtongsoluong($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return 0;
        }
        $db = DATABASE::connect();
        try{
            $sql = "SELECT COUNT(*) AS tongsoluong FROM giohang WHERE nguoidung_id = :nguoidung_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetch();
            if($result && $result["tongsoluong"] != null){
                return intval($result["tongsoluong"]);
            }
            return 0;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đếm số loại mặt hàng trong giỏ của người dùng (alias)
    public function demmathang($nguoidung_id){
        return $this->demtongsoluong($nguoidung_id);
    }

    // Tính tổng tiền giỏ hàng của người dùng (ưu tiên giaban của biến thể nếu có)
    public function tinhtiengiohang($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return 0;
        }
        $db = DATABASE::connect();
        try{
            $sql = "SELECT SUM(g.soluong * CASE WHEN g.giaban > 0 THEN g.giaban ELSE m.giaban END) AS tongtien 
                    FROM giohang g 
                    INNER JOIN mathang m ON g.mathang_id = m.id 
                    WHERE g.nguoidung_id = :nguoidung_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetch();
            if($result && $result["tongtien"] != null){
                return floatval($result["tongtien"]);
            }
            return 0;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

// Các hàm trợ giúp tương thích với các view
function laygiohang(){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->laygiohangtheonguoidung((int)$_SESSION['khachhang']['id']);
    }
    return array();
}

function demhangtronggio(){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->demtongsoluong((int)$_SESSION['khachhang']['id']);
    }
    return 0;
}

function demsoluongtronggio(){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->demtongsoluong((int)$_SESSION['khachhang']['id']);
    }
    return 0;
}

function tinhtiengiohang(){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->tinhtiengiohang((int)$_SESSION['khachhang']['id']);
    }
    return 0;
}

function xoagiohang(){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->xoatoanbogiohang((int)$_SESSION['khachhang']['id']);
    }
}

function xoacacmathangtronggio($ds_giohang_id){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->xoacacmathang((int)$_SESSION['khachhang']['id'], $ds_giohang_id);
    }
    return false;
}
?>
