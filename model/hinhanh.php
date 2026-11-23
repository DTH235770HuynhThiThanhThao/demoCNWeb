<?php
class HINHANH{
    private $id;
    private $tieude;
    private $duongdan;
    private $loai;
    private $thutu;
    private $trangthai;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function gettieude(){ return $this->tieude; }
    public function settieude($value){ $this->tieude = $value; }
    public function getduongdan(){ return $this->duongdan; }
    public function setduongdan($value){ $this->duongdan = $value; }
    public function getloai(){ return $this->loai; }
    public function setloai($value){ $this->loai = $value; }
    public function getthutu(){ return $this->thutu; }
    public function setthutu($value){ $this->thutu = $value; }
    public function gettrangthai(){ return $this->trangthai; }
    public function settrangthai($value){ $this->trangthai = $value; }

    // Tự động kiểm tra và khởi tạo bảng hinhanh nếu chưa có
    public static function khoitaobang(){
        $db = DATABASE::connect();
        try{
            $sql_check = "SHOW TABLES LIKE 'hinhanh'";
            $cmd_check = $db->query($sql_check);
            if($cmd_check->rowCount() == 0){
                $sql_create = "CREATE TABLE IF NOT EXISTS `hinhanh` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `tieude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                    `duongdan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                    `loai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                    `thutu` int(11) NOT NULL DEFAULT 1,
                    `trangthai` tinyint(4) NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
                $db->exec($sql_create);

                $sql_seed = "INSERT INTO `hinhanh` (`id`, `tieude`, `duongdan`, `loai`, `thutu`, `trangthai`) VALUES
                    (1, 'Logo chính Thảo Mobile', 'logo1.jpg', 'logo', 1, 1),
                    (2, 'Siêu phẩm công nghệ mới - Đặt trước ngay', 'h4.jpg', 'banner_chinh', 1, 1),
                    (3, 'Lễ hội mua sắm giảm sốc đến 50%', 'h5.jpg', 'banner_chinh', 2, 1),
                    (4, 'Ưu đãi trả góp 0% lãi suất - Thủ tục nhanh', 'h6.jpg', 'banner_chinh', 3, 1),
                    (5, 'Ưu đãi siêu phẩm giá cực khủng', 'h7.jpg', 'banner_chinh', 4, 1),
                    (6, 'Điện thoại chính hãng bảo hành 12 tháng', 'h1.jpg', 'banner_phu', 1, 1),
                    (7, 'Siêu ưu đãi công nghệ - Mua là có quà', 'h2.jpg', 'banner_phu', 2, 1),
                    (8, 'Thảo Mobile Flagship Store', 'h3.jpg', 'banner_phu', 3, 1);";
                $db->exec($sql_seed);
            }
        }
        catch(PDOException $e){
            // Bỏ qua lỗi khởi tạo nếu đã có
        }
    }

    // 1. Lấy toàn bộ danh sách hình ảnh hoặc lọc theo loại ('logo', 'banner_chinh', 'banner_phu')
    public function laydanhsachhinhanh($loai = ''){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            if(!empty($loai)){
                $sql = "SELECT * FROM hinhanh WHERE loai = :loai ORDER BY thutu ASC, id DESC";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":loai", $loai);
            }
            else{
                $sql = "SELECT * FROM hinhanh ORDER BY thutu ASC, id DESC";
                $cmd = $db->prepare($sql);
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

    // 2. Lấy các ảnh đang hiển thị (trangthai = 1) theo từng loại để đưa ra trang chủ
    public function layhinhanhhienthi($loai){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hinhanh WHERE loai = :loai AND trangthai = 1 ORDER BY thutu ASC, id DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":loai", $loai);
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy thông tin 1 hình ảnh theo ID
    public function layhinhanhtheoid($id){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hinhanh WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            return $cmd->fetch();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy thông tin logo đang hiển thị
    public function laylogo(){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hinhanh WHERE loai = 'logo' AND trangthai = 1 ORDER BY thutu ASC, id DESC LIMIT 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetch();
            if(!$result){
                return array("duongdan" => "logo1.jpg", "tieude" => "Thảo Mobile");
            }
            return $result;
        }
        catch(PDOException $e){
            return array("duongdan" => "logo1.jpg", "tieude" => "Thảo Mobile");
        }
    }

    // 3. Thêm banner mới
    public function themhinhanh($tieude, $duongdan, $loai, $thutu){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO hinhanh (tieude, duongdan, loai, thutu, trangthai) 
                    VALUES (:tieude, :duongdan, :loai, :thutu, 1)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":tieude", $tieude);
            $cmd->bindValue(":duongdan", $duongdan);
            $cmd->bindValue(":loai", $loai);
            $cmd->bindValue(":thutu", $thutu);
            return $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi thêm hình ảnh: $error_message</p>";
            exit();
        }
    }

    // 4. Bật / tắt hiển thị banner (trangthai = 1 hoặc 0)
    public function doitrangthai($id, $trangthai){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE hinhanh SET trangthai = :trangthai WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":trangthai", $trangthai);
            $cmd->bindValue(":id", $id);
            return $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi đổi trạng thái: $error_message</p>";
            exit();
        }
    }

    // 5. Cập nhật file ảnh logo mới (loai = 'logo')
    public function capnhatlogo($duongdan){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            $sql_check = "SELECT id FROM hinhanh WHERE loai = 'logo' LIMIT 1";
            $cmd_check = $db->prepare($sql_check);
            $cmd_check->execute();
            if($cmd_check->rowCount() > 0){
                $sql = "UPDATE hinhanh SET duongdan = :duongdan, trangthai = 1 WHERE loai = 'logo' LIMIT 1";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":duongdan", $duongdan);
                return $cmd->execute();
            }
            else{
                $sql = "INSERT INTO hinhanh (tieude, duongdan, loai, thutu, trangthai) 
                        VALUES ('Logo chính Thảo Mobile', :duongdan, 'logo', 1, 1)";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(":duongdan", $duongdan);
                return $cmd->execute();
            }
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi cập nhật logo: $error_message</p>";
            exit();
        }
    }

    // 6. Xóa banner khỏi CSDL (và xóa file ảnh nếu không phải ảnh mặc định)
    public function xoahinhanh($id){
        self::khoitaobang();
        $db = DATABASE::connect();
        try{
            // Lấy thông tin ảnh trước khi xóa
            $anh = $this->layhinhanhtheoid($id);
            if($anh){
                // Danh sách ảnh mặc định không được xóa file vật lý
                $anh_macdinh = array('logo.jpg', 'logo1.jpg', 'h1.jpg', 'h2.jpg', 'h3.jpg', 'h4.jpg', 'h5.jpg', 'h6.jpg', 'h7.jpg');
                $filename = basename($anh["duongdan"]);
                if(!in_array(strtolower($filename), $anh_macdinh)){
                    $file_carousel = "../../images/carousel/" . $filename;
                    if(file_exists($file_carousel)){
                        unlink($file_carousel);
                    }
                    $file_logo = "../../images/logo/" . $filename;
                    if(file_exists($file_logo)){
                        unlink($file_logo);
                    }
                }
            }

            $sql = "DELETE FROM hinhanh WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            return $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi xóa hình ảnh: $error_message</p>";
            exit();
        }
    }
}
?>