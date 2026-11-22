<?php
class THONGTIN{
    private $id;
    private $tencuahang;
    private $slogan;
    private $sodienthoai;
    private $email;
    private $diachi;
    private $giomocua;
    private $gioithieu;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function gettencuahang(){ return $this->tencuahang; }
    public function settencuahang($value){ $this->tencuahang = $value; }
    public function getslogan(){ return $this->slogan; }
    public function setslogan($value){ $this->slogan = $value; }
    public function getsodienthoai(){ return $this->sodienthoai; }
    public function setsodienthoai($value){ $this->sodienthoai = $value; }
    public function getemail(){ return $this->email; }
    public function setemail($value){ $this->email = $value; }
    public function getdiachi(){ return $this->diachi; }
    public function setdiachi($value){ $this->diachi = $value; }
    public function getgiomocua(){ return $this->giomocua; }
    public function setgiomocua($value){ $this->giomocua = $value; }
    public function getgioithieu(){ return $this->gioithieu; }
    public function setgioithieu($value){ $this->gioithieu = $value; }

    // 1. Lấy thông tin cấu hình cửa hàng (dòng id = 1)
    public function laythongtin(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM thongtin WHERE id = 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetch();

            // Nếu chưa có dữ liệu trong bảng, tạo dòng mặc định
            if(!$result){
                $sql_khoitao = "INSERT INTO thongtin (id, tencuahang, slogan, sodienthoai, email, diachi, giomocua, gioithieu) 
                                VALUES (1, 'Thảo Mobile', 'Thu cũ đổi mới trợ giá đến 2 triệu • Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng', '076 3841190', 'thaomobile@gmail.com', '18 Ung Văn Khiêm, phường Đông Xuyên, TP Long Xuyên, An Giang', '08:00 - 21:30 (Tất cả các ngày trong tuần)', 'Thảo Mobile là hệ thống bán lẻ điện thoại di động chính hãng uy tín, chuyên cung cấp các dòng smartphone mới nhất từ 4 thương hiệu hàng đầu: Apple, Samsung, OPPO và Xiaomi với mức giá cạnh tranh cùng dịch vụ hậu mãi tận tâm.')";
                $cmd_kt = $db->prepare($sql_khoitao);
                $cmd_kt->execute();

                $cmd->execute();
                $result = $cmd->fetch();
            }

            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 2. Cập nhật thông tin cửa hàng
    public function capnhatthongtin($tencuahang, $slogan, $sodienthoai, $email, $diachi, $giomocua, $gioithieu){
        $db = DATABASE::connect();
        try{
            // Kiểm tra xem dòng id=1 đã tồn tại chưa
            $sql_check = "SELECT COUNT(*) FROM thongtin WHERE id = 1";
            $cmd_check = $db->prepare($sql_check);
            $cmd_check->execute();
            $tontai = (int)$cmd_check->fetchColumn();

            if($tontai > 0){
                $sql = "UPDATE thongtin 
                        SET tencuahang = :tencuahang,
                            slogan = :slogan,
                            sodienthoai = :sodienthoai,
                            email = :email,
                            diachi = :diachi,
                            giomocua = :giomocua,
                            gioithieu = :gioithieu
                        WHERE id = 1";
            } else {
                $sql = "INSERT INTO thongtin (id, tencuahang, slogan, sodienthoai, email, diachi, giomocua, gioithieu)
                        VALUES (1, :tencuahang, :slogan, :sodienthoai, :email, :diachi, :giomocua, :gioithieu)";
            }

            $cmd = $db->prepare($sql);
            $cmd->bindValue(":tencuahang", $tencuahang);
            $cmd->bindValue(":slogan", $slogan);
            $cmd->bindValue(":sodienthoai", $sodienthoai);
            $cmd->bindValue(":email", $email);
            $cmd->bindValue(":diachi", $diachi);
            $cmd->bindValue(":giomocua", $giomocua);
            $cmd->bindValue(":gioithieu", $gioithieu);
            $result = $cmd->execute();

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
