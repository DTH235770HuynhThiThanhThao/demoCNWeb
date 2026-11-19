<?php
class GIOHANG{
    private $id;
    private $nguoidung_id;
    private $mathang_id;
    private $soluong;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function getnguoidung_id(){ return $this->nguoidung_id; }
    public function setnguoidung_id($value){ $this->nguoidung_id = $value; }
    public function getmathang_id(){ return $this->mathang_id; }
    public function setmathang_id($value){ $this->mathang_id = $value; }
    public function getsoluong(){ return $this->soluong; }
    public function setsoluong($value){ $this->soluong = $value; }

    // Lấy giỏ hàng theo người dùng (JOIN với mathang để lấy thông tin chi tiết và tính thành tiền)
    public function laygiohangtheonguoidung($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return array();
        }
        $db = DATABASE::connect();
        try{
            $sql = "SELECT g.id, g.nguoidung_id, g.mathang_id, g.soluong, 
                           m.tenmathang, m.hinhanh, m.giaban, m.soluongton 
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
                $mh_id = $r["mathang_id"];
                $dongia = $r["giaban"];
                $soluong = intval($r["soluong"]);
                $thanhtien = round($dongia * $soluong, 2);
                $giohang[$mh_id] = array(
                    "id" => $r["id"],
                    "nguoidung_id" => $r["nguoidung_id"],
                    "mathang_id" => $mh_id,
                    "tenmathang" => $r["tenmathang"],
                    "tenhang" => $r["tenmathang"],
                    "hinhanh" => $r["hinhanh"],
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

    // Thêm mặt hàng vào giỏ hàng của người dùng (nếu đã có thì tăng số lượng)
    public function themvaogio($nguoidung_id, $mathang_id, $soluong){
        $nguoidung_id = (int)$nguoidung_id;
        $mathang_id = (int)$mathang_id;
        $soluong = (int)$soluong;
        if($nguoidung_id <= 0 || $mathang_id <= 0){
            return false;
        }
        if($soluong <= 0){
            $soluong = 1;
        }
        $db = DATABASE::connect();
        try{
            // Kiểm tra mặt hàng đã tồn tại trong giỏ của người dùng chưa
            $sql_kt = "SELECT COUNT(*) FROM giohang WHERE nguoidung_id = :nguoidung_id AND mathang_id = :mathang_id";
            $cmd_kt = $db->prepare($sql_kt);
            $cmd_kt->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd_kt->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
            $cmd_kt->execute();
            $tontai = $cmd_kt->fetchColumn();

            if($tontai > 0){
                // Nếu đã tồn tại thì cập nhật tăng số lượng
                $sql = "UPDATE giohang SET soluong = soluong + :soluong WHERE nguoidung_id = :nguoidung_id AND mathang_id = :mathang_id";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
                $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
                $cmd->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
                $result = $cmd->execute();
                return $result;
            }
            else{
                // Nếu chưa tồn tại thì thêm mới vào giỏ hàng
                $sql = "INSERT INTO giohang(nguoidung_id, mathang_id, soluong) VALUES(:nguoidung_id, :mathang_id, :soluong)";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
                $cmd->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
                $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
                $result = $cmd->execute();
                return $result;
            }
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật số lượng của một mặt hàng trong giỏ
    public function capnhatsoluong($nguoidung_id, $mathang_id, $soluong){
        $nguoidung_id = (int)$nguoidung_id;
        $mathang_id = (int)$mathang_id;
        $soluong = (int)$soluong;
        if($nguoidung_id <= 0 || $mathang_id <= 0){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE giohang SET soluong = :soluong WHERE nguoidung_id = :nguoidung_id AND mathang_id = :mathang_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":soluong", $soluong, PDO::PARAM_INT);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa một mặt hàng khỏi giỏ
    public function xoamotmathang($nguoidung_id, $mathang_id){
        $nguoidung_id = (int)$nguoidung_id;
        $mathang_id = (int)$mathang_id;
        if($nguoidung_id <= 0 || $mathang_id <= 0){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM giohang WHERE nguoidung_id = :nguoidung_id AND mathang_id = :mathang_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":nguoidung_id", $nguoidung_id, PDO::PARAM_INT);
            $cmd->bindValue(":mathang_id", $mathang_id, PDO::PARAM_INT);
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

    // Xóa các mặt hàng được chọn khỏi giỏ của người dùng
    public function xoacacmathang($nguoidung_id, $ds_mathang_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0 || empty($ds_mathang_id) || !is_array($ds_mathang_id)){
            return false;
        }
        $ids = array();
        foreach($ds_mathang_id as $mid){
            $mid = (int)$mid;
            if($mid > 0){
                $ids[] = $mid;
            }
        }
        if(empty($ids)){
            return false;
        }
        $db = DATABASE::connect();
        try{
            $in_clause = implode(",", $ids);
            $sql = "DELETE FROM giohang WHERE nguoidung_id = :nguoidung_id AND mathang_id IN ($in_clause)";
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

    // Đếm số loại mặt hàng khác nhau trong giỏ của người dùng (hiển thị trên badge Giỏ hàng)
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

    // Tính tổng tiền giỏ hàng của người dùng
    public function tinhtiengiohang($nguoidung_id){
        $nguoidung_id = (int)$nguoidung_id;
        if($nguoidung_id <= 0){
            return 0;
        }
        $db = DATABASE::connect();
        try{
            $sql = "SELECT SUM(g.soluong * m.giaban) AS tongtien 
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

function xoacacmathangtronggio($ds_mathang_id){
    if(isset($_SESSION['khachhang']['id']) && (int)$_SESSION['khachhang']['id'] > 0){
        $gh = new GIOHANG();
        return $gh->xoacacmathang((int)$_SESSION['khachhang']['id'], $ds_mathang_id);
    }
    return false;
}
?>