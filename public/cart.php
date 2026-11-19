<?php
include("inc/top.php");
?>
<?php if(isset($thongbao) && !empty($thongbao)): ?>
<div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $thongbao ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(demhangtronggio()==0){ ?>
<h3 class="text-navy">Giỏ hàng rỗng!</h3>
<p>Vui lòng chọn sản phẩm...</p>    
<?php 
} 
else{ 
?>
<h3 class="text-navy">Giỏ hàng của bạn:</h3>
<form action="index.php" method="post" id="form-giohang">
<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th style="width: 130px;">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chon-tat-ca" checked>
                    <label class="form-check-label fw-bold" for="chon-tat-ca">Chọn tất cả</label>
                </div>
            </th>
            <th>Hình ảnh</th>
            <th>Tên hàng</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($giohang as $id => $mh): 
    $thanhtien = $mh["thanhtien"];
?>
    <tr>
        <td class="text-center">
            <input type="checkbox" class="form-check-input chon-san-pham" name="chon_mathang[]" value="<?= $id ?>" data-thanhtien="<?= $thanhtien ?>" checked>
        </td>
        <td><img width="50" src="../<?php echo $mh["hinhanh"]; ?>"></td>
        <td><?php echo $mh["tenmathang"]; ?></td>
        <td><?php echo number_format($mh["giaban"]); ?>đ</td>
        <td><input type="number" name="mh[<?php echo $id; ?>]" value="<?php echo $mh["soluong"]; ?>" min="0" class="form-control d-inline-block" style="width: 80px;"></td>
        <td><?php echo number_format($thanhtien); ?>đ</td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="4"></td>
        <td class="fw-bold">Tổng tiền</td>
        <td class="text-danger fw-bold fs-5" id="tongtien-hienthi"><?php echo number_format(tinhtiengiohang()); ?>đ</td>
    </tr>
    </tbody>
</table>
<div class="row">
    <div class="col"><a href="index.php?action=xoagiohang" class="text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?');">Xóa tất cả</a> (Xóa một mặt hàng nhập số lượng = 0)</div>
    <div class="col text-end">    
        <input type="hidden" name="action" id="cart-action" value="capnhatgio">
        <button type="submit" class="btn btn-warning" onclick="document.getElementById('cart-action').value='capnhatgio';">Cập nhật</button>
        <button type="submit" class="btn btn-success" id="btn-thanhtoan" onclick="document.getElementById('cart-action').value='thanhtoan';">Thanh toán</button>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chonTatCa = document.getElementById('chon-tat-ca');
    const cacSanPham = document.querySelectorAll('.chon-san-pham');
    const tongTienHienThi = document.getElementById('tongtien-hienthi');
    const btnThanhToan = document.getElementById('btn-thanhtoan');

    function capNhatTongTien() {
        let tong = 0;
        let soLuongChon = 0;

        cacSanPham.forEach(function(cb) {
            if (cb.checked) {
                soLuongChon++;
                tong += parseFloat(cb.getAttribute('data-thanhtien') || 0);
            }
        });

        if (chonTatCa) {
            chonTatCa.checked = (cacSanPham.length > 0 && soLuongChon === cacSanPham.length);
        }

        if (tongTienHienThi) {
            tongTienHienThi.textContent = tong.toLocaleString('vi-VN') + 'đ';
        }
    }

    if (chonTatCa) {
        chonTatCa.addEventListener('change', function() {
            const isChecked = this.checked;
            cacSanPham.forEach(function(cb) {
                cb.checked = isChecked;
            });
            capNhatTongTien();
        });
    }

    cacSanPham.forEach(function(cb) {
        cb.addEventListener('change', function() {
            capNhatTongTien();
        });
    });

    if (btnThanhToan) {
        btnThanhToan.addEventListener('click', function(e) {
            let coChon = false;
            cacSanPham.forEach(function(cb) {
                if (cb.checked) {
                    coChon = true;
                }
            });

            if (!coChon) {
                e.preventDefault();
                alert('Vui lòng tích chọn ít nhất 1 sản phẩm để thanh toán!');
                return false;
            }
        });
    }

    // Tính tổng tiền lần đầu
    capNhatTongTien();
});
</script>
<?php } // end if ?>
<?php
include("inc/bottom.php");
?>
