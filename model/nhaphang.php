<?php
class NHAPHANG{
    // Khai báo các thuộc tính
    private $id;
    private $nguoidung_id;
    private $nhacungcap;
    private $ngaynhap;
    private $tongtien;
    private $ghichu;

    public function getid(){ return $this->id; }
    public function setid($value){ $this->id = $value; }
    public function getnguoidung_id(){ return $this->nguoidung_id; }
    public function setnguoidung_id($value){ $this->nguoidung_id = $value; }
    public function getnhacungcap(){ return $this->nhacungcap; }
    public function setnhacungcap($value){ $this->nhacungcap = $value; }
    public function getngaynhap(){ return $this->ngaynhap; }
    public function setngaynhap($value){ $this->ngaynhap = $value; }
    public function gettongtien(){ return $this->tongtien; }
    public function settongtien($value){ $this->tongtien = $value; }
    public function getghichu(){ return $this->ghichu; }
    public function setghichu($value){ $this->ghichu = $value; }

    // 1. Lấy danh sách phiếu nhập kèm tên người lập và tổng số lượng máy đã nhập
    public function laydanhsachphieunhap(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT pn.*, nd.hoten, nd.email, nd.sodienthoai,
                           COALESCE(SUM(ct.soluong), 0) AS tongsoluong
                    FROM phieunhap pn
                    LEFT JOIN nguoidung nd ON pn.nguoidung_id = nd.id
                    LEFT JOIN phieunhapct ct ON pn.id = ct.phieunhap_id
                    GROUP BY pn.id
                    ORDER BY pn.id DESC";
            $cmd = $db->prepare($sql);
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

    // 2. Lấy thông tin 1 phiếu nhập theo id kèm người lập
    public function layphieunhaptheoid($id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT pn.*, nd.hoten, nd.email, nd.sodienthoai
                    FROM phieunhap pn
                    LEFT JOIN nguoidung nd ON pn.nguoidung_id = nd.id
                    WHERE pn.id = :id";
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

    // 3. Lấy danh sách chi tiết các mặt hàng trong 1 phiếu nhập
    public function laychitietphieunhap($phieunhap_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT ct.*, mh.tenmathang, mh.hinhanh, mh.giaban, mh.soluongton
                    FROM phieunhapct ct
                    LEFT JOIN mathang mh ON ct.mathang_id = mh.id
                    WHERE ct.phieunhap_id = :phieunhap_id
                    ORDER BY ct.id ASC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":phieunhap_id", (int)$phieunhap_id, PDO::PARAM_INT);
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

    // 4. Thêm phiếu nhập mới và tự động cộng dồn số lượng tồn kho của mặt hàng
    public function themphieunhap($nguoidung_id, $nhacungcap, $ghichu, $ds_mathang, $ds_gianhap, $ds_soluong){
        $db = DATABASE::connect();
        try{
            $db->beginTransaction();

            // Tính tổng tiền toàn bộ phiếu nhập
            $tongtien = 0;
            if(is_array($ds_mathang)){
                for($i = 0; $i < count($ds_mathang); $i++){
                    $mh_id = (int)($ds_mathang[$i] ?? 0);
                    $sl = (int)($ds_soluong[$i] ?? 0);
                    $gia = (float)($ds_gianhap[$i] ?? 0);
                    if($mh_id > 0 && $sl > 0){
                        $tongtien += ($gia * $sl);
                    }
                }
            }

            // Tạo dòng phiếu nhập
            $sql_pn = "INSERT INTO phieunhap(nguoidung_id, nhacungcap, ngaynhap, tongtien, ghichu)
                       VALUES(:nguoidung_id, :nhacungcap, NOW(), :tongtien, :ghichu)";
            $cmd_pn = $db->prepare($sql_pn);
            $cmd_pn->bindValue(":nguoidung_id", (int)$nguoidung_id, PDO::PARAM_INT);
            $cmd_pn->bindValue(":nhacungcap", $nhacungcap);
            $cmd_pn->bindValue(":tongtien", $tongtien);
            $cmd_pn->bindValue(":ghichu", $ghichu);
            $cmd_pn->execute();

            $phieunhap_id = $db->lastInsertId();

            // Chuẩn bị câu lệnh chèn chi tiết và cập nhật tồn kho
            $sql_ct = "INSERT INTO phieunhapct(phieunhap_id, mathang_id, gianhap, soluong, thanhtien)
                       VALUES(:phieunhap_id, :mathang_id, :gianhap, :soluong, :thanhtien)";
            $cmd_ct = $db->prepare($sql_ct);

            $sql_kho = "UPDATE mathang SET soluongton = soluongton + :soluong WHERE id = :mathang_id";
            $cmd_kho = $db->prepare($sql_kho);

            // Lưu từng dòng sản phẩm và cộng dồn tồn kho
            if(is_array($ds_mathang)){
                for($i = 0; $i < count($ds_mathang); $i++){
                    $mh_id = (int)($ds_mathang[$i] ?? 0);
                    $sl = (int)($ds_soluong[$i] ?? 0);
                    $gia = (float)($ds_gianhap[$i] ?? 0);

                    if($mh_id > 0 && $sl > 0){
                        $thanhtien = $gia * $sl;

                        // Chèn chi tiết phiếu nhập
                        $cmd_ct->bindValue(":phieunhap_id", (int)$phieunhap_id, PDO::PARAM_INT);
                        $cmd_ct->bindValue(":mathang_id", (int)$mh_id, PDO::PARAM_INT);
                        $cmd_ct->bindValue(":gianhap", $gia);
                        $cmd_ct->bindValue(":soluong", (int)$sl, PDO::PARAM_INT);
                        $cmd_ct->bindValue(":thanhtien", $thanhtien);
                        $cmd_ct->execute();

                        // Cập nhật tăng số lượng tồn kho của mặt hàng
                        $cmd_kho->bindValue(":soluong", (int)$sl, PDO::PARAM_INT);
                        $cmd_kho->bindValue(":mathang_id", (int)$mh_id, PDO::PARAM_INT);
                        $cmd_kho->execute();
                    }
                }
            }

            $db->commit();
            return $phieunhap_id;
        }
        catch(PDOException $e){
            $db->rollBack();
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đếm tổng số phiếu nhập
    public function demphieunhap(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT COUNT(*) FROM phieunhap";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            return (int)$cmd->fetchColumn();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Tính tổng tiền nhập hàng từ trước đến nay
    public function tongtiennhaphang(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT COALESCE(SUM(tongtien), 0) FROM phieunhap";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            return (float)$cmd->fetchColumn();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // 5. Lấy danh sách tồn kho chi tiết kèm tổng nhập và đã bán
    public function laydanhsachtonkho($tukhoa = '', $muctonkho = ''){
        $db = DATABASE::connect();
        try{
            $where = " WHERE 1=1";
            $params = array();

            if(!empty($tukhoa)){
                $id_tim = 0;
                if(preg_match('/^SP-?(\d+)$/i', trim($tukhoa), $m_match)){
                    $id_tim = (int)$m_match[1];
                } elseif(is_numeric(trim($tukhoa))){
                    $id_tim = (int)trim($tukhoa);
                }

                $where .= " AND (m.tenmathang LIKE :tukhoa OR dm.tendanhmuc LIKE :tukhoa2";
                $params[':tukhoa'] = "%" . trim($tukhoa) . "%";
                $params[':tukhoa2'] = "%" . trim($tukhoa) . "%";

                if($id_tim > 0){
                    $where .= " OR m.id = :id_tim";
                    $params[':id_tim'] = $id_tim;
                }
                $where .= ")";
            }

            if($muctonkho === 'hethang'){
                $where .= " AND m.soluongton = 0";
            } elseif($muctonkho === 'saphet'){
                $where .= " AND m.soluongton <= 15";
            } elseif($muctonkho === 'conhang'){
                $where .= " AND m.soluongton > 15";
            }

            $sql = "SELECT m.id, m.tenmathang, m.hinhanh, m.giagoc, m.giaban, m.soluongton, m.danhmuc_id,
                           dm.tendanhmuc AS tenhang,
                           COALESCE(pn.tongnhap, 0) AS tongnhap,
                           COALESCE(dh.daban, 0) AS daban
                    FROM mathang m
                    LEFT JOIN danhmuc dm ON m.danhmuc_id = dm.id
                    LEFT JOIN (
                        SELECT mathang_id, SUM(soluong) AS tongnhap 
                        FROM phieunhapct 
                        GROUP BY mathang_id
                    ) pn ON m.id = pn.mathang_id
                    LEFT JOIN (
                        SELECT ct.mathang_id, SUM(ct.soluong) AS daban 
                        FROM donhangct ct 
                        INNER JOIN donhang d ON ct.donhang_id = d.id 
                        WHERE d.trangthai = 3 
                        GROUP BY ct.mathang_id
                    ) dh ON m.id = dh.mathang_id"
                    . $where .
                    " ORDER BY m.soluongton ASC, m.id DESC";

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

    // 6. Thống kê tổng quan tồn kho
    public function thongketonkho(){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT 
                        COALESCE(SUM(soluongton), 0) AS tongmayton,
                        COALESCE(SUM(CASE WHEN soluongton <= 15 THEN 1 ELSE 0 END), 0) AS maysaphet,
                        COALESCE(SUM(CASE WHEN soluongton = 0 THEN 1 ELSE 0 END), 0) AS mayhethang
                    FROM mathang";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return array('tongmayton' => 0, 'maysaphet' => 0, 'mayhethang' => 0);
            }
            return $row;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>
