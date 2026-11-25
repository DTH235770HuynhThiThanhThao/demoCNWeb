<?php
include("inc/top.php");
?>

<?php if(isset($thongbao) && !empty($thongbao)): ?>
<div class="alert alert-warning alert-dismissible fade show my-3 border-0 shadow-sm rounded-3" role="alert">
    <i class="bi bi-exclamation-triangle-fill text-warning me-2 fs-5"></i><?= $thongbao ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(empty($giohang)){ ?>
    <!-- 1. Giao diện khi giỏ hàng trống -->
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4 bg-white">
        <div class="mb-3">
            <i class="bi bi-bag-x text-muted" style="font-size: 5rem; color: #cbd5e1 !important;"></i>
        </div>
        <h4 class="fw-bold text-dark mb-2">Giỏ hàng của bạn đang trống</h4>
        <p class="text-muted mb-4">Hãy chọn thêm các sản phẩm điện thoại hấp dẫn để nhận ưu đãi ngay hôm nay!</p>
        <div>
            <a href="index.php" class="btn btn-buy-now-lg px-4 py-2 d-inline-flex align-items-center text-white text-decoration-none rounded-pill shadow-sm">
                <i class="bi bi-cart-plus me-2 fs-5"></i>
                <span>KHÁM PHÁ ĐIỆN THOẠI NGAY</span>
            </a>
        </div>
    </div>
<?php 
} else { 
?>
<!-- 2. Giao diện khi có sản phẩm -->
<!-- Thanh Breadcrumb nhỏ gọn & Quay lại -->
<div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-shop mb-0">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door me-1"></i>Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng của bạn</li>
        </ol>
    </nav>
    <a href="index.php" class="text-decoration-none small fw-semibold text-danger">
        <i class="bi bi-arrow-left me-1"></i>Tiếp tục mua sắm
    </a>
</div>

<!-- Form giỏ hàng bao trọn cả 2 cột -->
<form action="index.php" method="post" id="form-giohang">
    <div class="row g-4">
        <!-- CỘT TRÁI (col-lg-8): DANH SÁCH SẢN PHẨM TRONG GIỎ -->
        <div class="col-lg-8">
            <!-- Thanh điều khiển trên cùng (Chọn tất cả, Cập nhật, Xóa tất cả) -->
            <div class="cart-control-bar d-flex flex-wrap align-items-center justify-content-between mb-3">
                <div class="form-check d-flex align-items-center m-0">
                    <input type="checkbox" class="form-check-input cart-checkbox me-2" id="chon-tat-ca" checked>
                    <label class="form-check-label fw-bold text-dark cursor-pointer" for="chon-tat-ca">
                        Chọn tất cả (<span id="tong-so-san-pham"><?= count($giohang) ?></span> sản phẩm)
                    </label>
                </div>
                <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                    <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold" onclick="document.getElementById('cart-action').value='capnhatgio';">
                        <i class="bi bi-arrow-clockwise me-1"></i>Cập nhật giỏ hàng
                    </button>
                    <a href="index.php?action=xoagiohang" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold text-decoration-none" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?');">
                        <i class="bi bi-trash3 me-1"></i>Xóa tất cả
                    </a>
                </div>
            </div>

            <!-- Từng sản phẩm trình bày dạng thẻ ngang hiện đại -->
            <?php foreach($giohang as $id => $mh): 
                $thanhtien = $mh["thanhtien"];
            ?>
            <div class="cart-item-card mb-3" id="cart-item-<?= $id ?>">
                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap gap-3">
                    <!-- Checkbox tích chọn -->
                    <div class="flex-shrink-0">
                        <input type="checkbox" class="form-check-input cart-checkbox chon-san-pham" 
                               name="chon_mathang[]" value="<?= $id ?>" 
                               data-dongia="<?= $mh["giaban"] ?>" 
                               data-thanhtien="<?= $thanhtien ?>" 
                               data-id="<?= $id ?>" checked>
                    </div>

                    <!-- Ảnh sản phẩm -->
                    <a href="index.php?action=detail&id=<?= $mh["mathang_id"] ?>" class="flex-shrink-0">
                        <img src="../<?= $mh["hinhanh"] ?>" alt="<?= htmlspecialchars($mh["tenmathang"]) ?>" class="cart-item-thumb">
                    </a>

                    <!-- Thông tin máy -->
                    <div class="flex-grow-1 overflow-hidden">
                        <a href="index.php?action=detail&id=<?= $mh["mathang_id"] ?>" class="fw-bold text-dark text-decoration-none d-block mb-1 hover-red text-truncate" title="<?= htmlspecialchars($mh["tenmathang"]) ?>">
                            <?= $mh["tenmathang"] ?>
                        </a>

                        <!-- Nhãn biến thể Phiên bản & Màu sắc -->
                        <?php if(!empty($mh["phienban"]) || !empty($mh["mausac"])): ?>
                        <div class="d-flex align-items-center gap-1 flex-wrap mb-1">
                            <?php if(!empty($mh["phienban"])): ?>
                                <span class="badge px-2 py-1 text-dark border" style="background-color: #fff1f2; border-color: #fecdd3 !important; font-size: 0.72rem;">
                                    <i class="bi bi-hdd-network text-danger me-1"></i><b><?= htmlspecialchars($mh["phienban"]) ?></b>
                                </span>
                            <?php endif; ?>
                            <?php if(!empty($mh["mausac"])): ?>
                                <span class="badge px-2 py-1 text-dark border" style="background-color: #f8fafc; border-color: #e2e8f0 !important; font-size: 0.72rem;">
                                    <i class="bi bi-palette text-danger me-1"></i><?= htmlspecialchars($mh["mausac"]) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="fw-bold text-danger fs-6"><?= number_format($mh["giaban"]) ?>đ</span>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0" style="font-size: 0.72rem;">Chính hãng VN/A</span>
                        </div>
                    </div>

                    <!-- Cụm chỉnh số lượng - [số] + -->
                    <div class="flex-shrink-0 my-2 my-sm-0">
                        <div class="quantity-stepper" style="height: 38px;">
                            <button type="button" class="btn-step" onclick="thayDoiSoLuong(<?= $id ?>, -1)"><i class="bi bi-dash"></i></button>
                            <input type="number" id="qty-<?= $id ?>" name="mh[<?= $id ?>]" value="<?= $mh["soluong"] ?>" min="1" max="99" class="input-soluong" onchange="nhapSoLuong(<?= $id ?>)">
                            <button type="button" class="btn-step" onclick="thayDoiSoLuong(<?= $id ?>, 1)"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>

                    <!-- Thành tiền & Nút xóa -->
                    <div class="text-end flex-shrink-0 ms-auto ms-sm-0" style="min-width: 115px;">
                        <div class="fw-bold text-danger fs-6 mb-1 item-thanhtien" id="thanhtien-<?= $id ?>"><?= number_format($thanhtien) ?>đ</div>
                        <a href="index.php?action=xoamotmathang&id=<?= $id ?>" class="text-secondary small text-decoration-none btn-delete-item" title="Xóa sản phẩm này" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                            <i class="bi bi-trash3 text-danger me-1"></i><span class="text-muted">Xóa</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- CỘT PHẢI (col-lg-4): KHUNG TÓM TẮT ĐƠN HÀNG (STICKY-TOP) -->
        <div class="col-lg-4">
            <div class="cart-summary-card">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-receipt me-2 text-danger"></i>TÓM TẮT ĐƠN HÀNG</h5>
                
                <div class="d-flex justify-content-between align-items-center mb-2 small">
                    <span class="text-muted">Số sản phẩm đã chọn:</span>
                    <span class="fw-bold text-dark"><b id="so-mon-da-chon">0</b> sản phẩm</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2 small">
                    <span class="text-muted">Tạm tính:</span>
                    <span class="fw-bold text-dark" id="tam-tinh-hien-thi">0đ</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 small">
                    <span class="text-muted">Phí vận chuyển:</span>
                    <span class="text-success fw-bold"><i class="bi bi-check2-circle me-1"></i>Miễn phí</span>
                </div>

                <hr class="my-3" style="border-style: dashed; border-color: #cbd5e1;">

                <div class="d-flex justify-content-between align-items-baseline mb-3">
                    <span class="fw-bold text-dark">Tổng tiền thanh toán:</span>
                    <span class="fw-bold text-danger fs-4" id="tong-tien-gio-hang">0đ</span>
                </div>

                <!-- Input hành động ẩn -->
                <input type="hidden" name="action" id="cart-action" value="capnhatgio">

                <!-- Nút Tiến hành thanh toán -->
                <button type="submit" class="btn btn-buy-now-lg w-100 py-3 shadow" id="btn-thanhtoan" onclick="document.getElementById('cart-action').value='thanhtoan';">
                    <i class="bi bi-credit-card-2-front-fill me-2 fs-5"></i>
                    <span id="btn-thanhtoan-text">TIẾN HÀNH THANH TOÁN (0)</span>
                </button>

                <div class="mt-3 p-2 bg-light rounded-2 text-center small text-muted">
                    <i class="bi bi-shield-check text-success me-1"></i>Bảo mật thanh toán 100% • Đổi trả miễn phí 30 ngày
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript tính toán tức thì & đồng bộ giỏ hàng -->
<script>
// Định dạng tiền tệ VNĐ
function dinhDangTien(so) {
    return new Intl.NumberFormat('vi-VN').format(so) + 'đ';
}

// Tính lại toàn bộ giỏ hàng
function capNhatTongTien() {
    var chonTatCa = document.getElementById('chon-tat-ca');
    var cacSanPham = document.querySelectorAll('.chon-san-pham');
    var tongTienHienThi = document.getElementById('tong-tien-gio-hang');
    var tamTinhHienThi = document.getElementById('tam-tinh-hien-thi');
    var soMonDaChon = document.getElementById('so-mon-da-chon');
    var btnThanhToanText = document.getElementById('btn-thanhtoan-text');

    var tong = 0;
    var soLuongChon = 0;

    cacSanPham.forEach(function(cb) {
        if (cb.checked) {
            soLuongChon++;
            tong += parseFloat(cb.getAttribute('data-thanhtien') || 0);
        }
    });

    if (chonTatCa) {
        chonTatCa.checked = (cacSanPham.length > 0 && soLuongChon === cacSanPham.length);
    }

    if (soMonDaChon) {
        soMonDaChon.textContent = soLuongChon;
    }

    if (tamTinhHienThi) {
        tamTinhHienThi.textContent = dinhDangTien(tong);
    }

    if (tongTienHienThi) {
        tongTienHienThi.textContent = dinhDangTien(tong);
    }

    if (btnThanhToanText) {
        btnThanhToanText.textContent = 'TIẾN HÀNH THANH TOÁN (' + soLuongChon + ')';
    }
}

// Tăng / giảm số lượng bằng nút + / -
function thayDoiSoLuong(id, delta) {
    var input = document.getElementById('qty-' + id);
    if (!input) return;

    var val = parseInt(input.value) || 1;
    var newVal = val + delta;

    if (newVal < 1) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            window.location.href = 'index.php?action=xoamotmathang&id=' + id;
        }
        return;
    }

    if (newVal > 99) newVal = 99;
    input.value = newVal;

    // Cập nhật thành tiền của món đó
    var cb = document.querySelector('.chon-san-pham[data-id="' + id + '"]');
    if (cb) {
        var donGia = parseFloat(cb.getAttribute('data-dongia') || 0);
        var thanhtien = donGia * newVal;
        cb.setAttribute('data-thanhtien', thanhtien);

        var thanhtienEl = document.getElementById('thanhtien-' + id);
        if (thanhtienEl) {
            thanhtienEl.textContent = dinhDangTien(thanhtien);
        }
    }

    capNhatTongTien();
}

// Nhập trực tiếp số lượng vào ô input
function nhapSoLuong(id) {
    var input = document.getElementById('qty-' + id);
    if (!input) return;

    var val = parseInt(input.value) || 1;
    if (val < 1) val = 1;
    if (val > 99) val = 99;
    input.value = val;

    var cb = document.querySelector('.chon-san-pham[data-id="' + id + '"]');
    if (cb) {
        var donGia = parseFloat(cb.getAttribute('data-dongia') || 0);
        var thanhtien = donGia * val;
        cb.setAttribute('data-thanhtien', thanhtien);

        var thanhtienEl = document.getElementById('thanhtien-' + id);
        if (thanhtienEl) {
            thanhtienEl.textContent = dinhDangTien(thanhtien);
        }
    }

    capNhatTongTien();
}

document.addEventListener('DOMContentLoaded', function() {
    var chonTatCa = document.getElementById('chon-tat-ca');
    var cacSanPham = document.querySelectorAll('.chon-san-pham');
    var btnThanhToan = document.getElementById('btn-thanhtoan');

    // Sự kiện Chọn tất cả
    if (chonTatCa) {
        chonTatCa.addEventListener('change', function() {
            var isChecked = this.checked;
            cacSanPham.forEach(function(cb) {
                cb.checked = isChecked;
            });
            capNhatTongTien();
        });
    }

    // Sự kiện tích từng sản phẩm
    cacSanPham.forEach(function(cb) {
        cb.addEventListener('change', function() {
            capNhatTongTien();
        });
    });

    // Kiểm tra trước khi bấm Thanh toán
    if (btnThanhToan) {
        btnThanhToan.addEventListener('click', function(e) {
            var coChon = false;
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

    // Tính tổng tiền lần đầu khi tải trang
    capNhatTongTien();
});
</script>
<?php } // end if ?>

<?php
include("inc/bottom.php");
?>
