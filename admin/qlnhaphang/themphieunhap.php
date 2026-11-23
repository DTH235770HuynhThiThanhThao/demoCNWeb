<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile */
.brand-title-bar {
    width: 5px;
    height: 38px;
    background-color: #d70018;
    border-radius: 4px;
    margin-right: 14px;
    flex-shrink: 0;
}
.section-accent-bar {
    width: 4px;
    height: 18px;
    background-color: #d70018;
    border-radius: 3px;
    margin-right: 10px;
    flex-shrink: 0;
}
.btn-flagship-red {
    background-color: #d70018;
    border-color: #d70018;
    color: #ffffff;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-flagship-red:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(215, 0, 24, 0.25);
}
.btn-outline-flagship {
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    background-color: #ffffff;
    transition: all 0.2s ease;
}
.btn-outline-flagship:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff5f5;
}
.btn-back {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-back:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.table-flagship-head th {
    background-color: #f8fafc !important;
    color: #475569 !important;
    font-weight: 700 !important;
    font-size: 0.78rem !important;
    border-bottom: 1px solid #e2e8f0 !important;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}
.form-control-flagship, .form-select-flagship {
    border-color: #cbd5e1;
    border-radius: 10px;
    font-size: 13.5px;
}
.form-control-flagship:focus, .form-select-flagship:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215, 0, 24, 0.1);
}
</style>

<?php 
$mathang_id_chon = isset($mathang_id_chon) ? (int)$mathang_id_chon : 0;
$ten_may_chon = "";
if($mathang_id_chon > 0 && !empty($mathang)){
    foreach($mathang as $m_item){
        if($m_item["id"] == $mathang_id_chon){
            $ten_may_chon = $m_item["tenmathang"];
            break;
        }
    }
}
?>

<!-- 1. Thanh tiêu đề & nút quay lại -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center">
        <div class="brand-title-bar"></div>
        <div>
            <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">LẬP PHIẾU NHẬP KHO</h3>
            <p class="text-muted small mb-0 mt-1">Tạo phiếu nhập hàng, quản lý nhà cung cấp và tự động đồng bộ tồn kho</p>
        </div>
    </div>
    <div>
        <a href="index.php?tab=tonkho" class="btn btn-sm btn-back d-inline-flex align-items-center px-3 py-2 shadow-sm">
            <i class="align-middle me-1.5" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
            <span>Quay lại tồn kho</span>
        </a>
    </div>
</div>

<?php if(!empty($ten_may_chon)): ?>
    <div class="alert alert-info border-0 shadow-sm rounded-3 d-flex align-items-center py-2.5 px-3 mb-4" style="background-color: #e0f2fe; color: #0369a1;" role="alert">
        <i class="align-middle me-2" data-feather="info" style="width: 18px; height: 18px;"></i>
        <div>
            Đang lập phiếu nhập thêm số lượng cho mẫu: <strong class="text-dark"><?= htmlspecialchars($ten_may_chon) ?></strong> (đã được tự động chọn sẵn ở dòng 1).
        </div>
    </div>
<?php endif; ?>

<form method="post" action="index.php" id="formNhapHang" onsubmit="return kiemTraFormNhapHang()">
    <input type="hidden" name="action" value="xulythem">

    <!-- KHỐI 1: THÔNG TIN PHIẾU NHẬP -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center">
            <div class="section-accent-bar"></div>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Thông tin chứng từ nhập kho</h5>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <!-- Nhà cung cấp -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted mb-1">
                        Nhà cung cấp / Nhà phân phối <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-flagship" name="txtnhacungcap" id="txtnhacungcap" list="dsNhaCungCap" placeholder="Nhập hoặc chọn nhà cung cấp..." required>
                    <datalist id="dsNhaCungCap">
                        <option value="Apple Việt Nam Chính Hãng">
                        <option value="Samsung Electronics Vina">
                        <option value="Nhà phân phối Digiworld (DGW)">
                        <option value="Công ty Cổ phần Synnex FPT">
                        <option value="OPPO Việt Nam">
                        <option value="Xiaomi Việt Nam">
                        <option value="Công ty TNHH Phân Phối Petrosetco (PSD)">
                    </datalist>

                    <!-- Các nút gợi ý chọn nhanh -->
                    <div class="d-flex flex-wrap gap-1 mt-2 align-items-center">
                        <span class="small text-muted me-1" style="font-size: 11.5px;">Gợi ý nhanh:</span>
                        <button type="button" class="btn btn-sm btn-light border py-0.5 px-2 rounded-2" style="font-size: 11.5px;" onclick="ganNCC('Apple Việt Nam Chính Hãng')">Apple VN</button>
                        <button type="button" class="btn btn-sm btn-light border py-0.5 px-2 rounded-2" style="font-size: 11.5px;" onclick="ganNCC('Samsung Electronics Vina')">Samsung Vina</button>
                        <button type="button" class="btn btn-sm btn-light border py-0.5 px-2 rounded-2" style="font-size: 11.5px;" onclick="ganNCC('Nhà phân phối Digiworld (DGW)')">Digiworld</button>
                        <button type="button" class="btn btn-sm btn-light border py-0.5 px-2 rounded-2" style="font-size: 11.5px;" onclick="ganNCC('Công ty Cổ phần Synnex FPT')">Synnex FPT</button>
                    </div>
                </div>

                <!-- Người lập phiếu & Ngày giờ -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted mb-1">Người lập phiếu</label>
                    <input type="text" class="form-control form-control-flagship bg-light" value="<?= htmlspecialchars($_SESSION["nguoidung"]["hoten"] ?? "Quản trị viên") ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted mb-1">Thời gian lập</label>
                    <input type="text" class="form-control form-control-flagship bg-light" value="<?= date("d/m/Y H:i") ?>" readonly>
                </div>

                <!-- Ghi chú nhập kho -->
                <div class="col-12">
                    <label class="form-label fw-semibold small text-muted mb-1">Ghi chú nhập kho</label>
                    <input type="text" class="form-control form-control-flagship" name="txtghichu" placeholder="Ví dụ: Nhập bổ sung tồn kho đợt 1, số hóa đơn VAT, chứng từ kho...">
                </div>
            </div>
        </div>
    </div>

    <!-- KHỐI 2: BẢNG CHỌN DANH SÁCH MẶT HÀNG NHẬP -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center">
                <div class="section-accent-bar"></div>
                <h5 class="fw-bold mb-0 text-dark" style="font-size: 15px;">Danh sách điện thoại nhập kho</h5>
            </div>
            <button type="button" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm" onclick="themDongSanPham()">
                <i class="align-middle" data-feather="plus" style="width: 14px; height: 14px;"></i>
                <span>Thêm dòng sản phẩm</span>
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="bangNhapChiTiet">
                    <thead class="table-flagship-head text-center">
                        <tr>
                            <th class="ps-4" style="width: 60px;">STT</th>
                            <th style="min-width: 320px;" class="text-start">CHỌN MẪU ĐIỆN THOẠI</th>
                            <th style="width: 210px;">GIÁ NHẬP (VNĐ)</th>
                            <th style="width: 150px;">SỐ LƯỢNG NHẬP</th>
                            <th style="width: 210px;" class="text-end">THÀNH TIỀN</th>
                            <th class="pe-4" style="width: 70px;">XÓA</th>
                        </tr>
                    </thead>
                    <tbody id="thanBangNhap">
                        <!-- Các dòng sản phẩm được thêm vào đây -->
                    </tbody>
                    <tfoot style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                        <tr>
                            <td colspan="3" class="text-end fw-bold py-3 text-secondary ps-4">
                                TỔNG CỘNG PHIẾU NHẬP:
                            </td>
                            <td class="text-center fw-bold py-3">
                                <span id="hienThiTongSoLuong" class="badge rounded-pill fw-bold px-3 py-1.5" style="background-color: #f1f5f9; color: #1e293b; border: 1px solid #e2e8f0; font-size: 13px;">0 máy</span>
                            </td>
                            <td class="text-end fw-bold py-3">
                                <span id="hienThiTongTien" class="fw-bold fs-5" style="color: #d70018;">0đ</span>
                            </td>
                            <td class="pe-4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white p-3.5 px-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <button type="button" class="btn btn-sm btn-outline-flagship d-inline-flex align-items-center gap-1.5 px-3 py-2" onclick="themDongSanPham()">
                <i class="align-middle" data-feather="plus-circle" style="width: 15px; height: 15px;"></i>
                <span>Thêm một mẫu điện thoại khác</span>
            </button>

            <div class="d-flex align-items-center gap-2">
                <a href="index.php?tab=tonkho" class="btn btn-back px-3 py-2">Hủy bỏ</a>
                <button type="submit" class="btn btn-flagship-red px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="align-middle" data-feather="check-circle" style="width: 16px; height: 16px;"></i>
                    <span>Lưu phiếu nhập & Cập nhật tồn kho</span>
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Dữ liệu nguồn danh sách mặt hàng để JavaScript tạo option -->
<script>
var danhSachSanPhamData = [
    <?php foreach($mathang as $m): ?>
    {
        id: <?= $m["id"] ?>,
        ten: <?= json_encode($m["tenmathang"]) ?>,
        hang: <?= json_encode($m["tendanhmuc"] ?? "") ?>,
        ton: <?= (int)$m["soluongton"] ?>,
        giagoc: <?= (float)$m["giagoc"] ?>,
        giaban: <?= (float)$m["giaban"] ?>
    },
    <?php endforeach; ?>
];

var sanPhamIdChonTruoc = <?= (int)$mathang_id_chon ?>;

function ganNCC(ten) {
    document.getElementById("txtnhacungcap").value = ten;
}

// Hàm thêm một dòng mới vào bảng
function themDongSanPham(sanPhamIdDefault = 0) {
    var tbody = document.getElementById("thanBangNhap");
    var rowIndex = tbody.children.length;

    var tr = document.createElement("tr");
    tr.className = "dong-nhap-hang";

    // Tạo dropdown chọn mặt hàng
    var optionsHtml = '<option value="">-- Chọn điện thoại cần nhập --</option>';
    danhSachSanPhamData.forEach(function(sp) {
        var selected = (sp.id === sanPhamIdDefault) ? 'selected' : '';
        optionsHtml += '<option value="' + sp.id + '" data-giagoc="' + sp.giagoc + '" data-giaban="' + sp.giaban + '" data-ton="' + sp.ton + '" ' + selected + '>' +
            sp.ten + ' (Tồn: ' + sp.ton + ' | Giá bán: ' + dinhDangTien(sp.giaban) + ')' +
            '</option>';
    });

    tr.innerHTML = 
        '<td class="text-center fw-bold cot-stt ps-4 text-muted">' + (rowIndex + 1) + '</td>' +
        '<td>' +
            '<select class="form-select form-select-flagship select-mathang" name="optmathang[]" required onchange="doiMatHang(this)">' +
                optionsHtml +
            '</select>' +
        '</td>' +
        '<td>' +
            '<div class="input-group input-group-sm">' +
                '<input type="number" class="form-control form-control-flagship text-end input-gianhap" name="txtgianhap[]" min="0" step="10000" placeholder="0" required oninput="tinhThanhTienDong(this)">' +
                '<span class="input-group-text small bg-light">đ</span>' +
            '</div>' +
        '</td>' +
        '<td>' +
            '<input type="number" class="form-control form-control-flagship text-center input-soluong" name="txtsoluong[]" min="1" value="1" required oninput="tinhThanhTienDong(this)">' +
        '</td>' +
        '<td class="text-end">' +
            '<span class="fw-bold text-thanhtien" style="color: #d70018; font-size: 13.5px;">0đ</span>' +
        '</td>' +
        '<td class="text-center pe-4">' +
            '<button type="button" class="btn btn-sm btn-outline-danger p-1 rounded-2" onclick="xoaDong(this)" title="Xóa dòng này" style="width: 30px; height: 30px;">' +
                '&times;' +
            '</button>' +
        '</td>';

    tbody.appendChild(tr);

    // Tự động kích hoạt đổi mặt hàng nếu có chọn mặc định
    if (sanPhamIdDefault > 0) {
        var selectEl = tr.querySelector(".select-mathang");
        doiMatHang(selectEl);
    }

    capNhatTongCong();
}

// Khi người dùng chọn một sản phẩm trong dropdown
function doiMatHang(selectEl) {
    var tr = selectEl.closest("tr");
    var selectedOpt = selectEl.options[selectEl.selectedIndex];
    var giaGoc = parseFloat(selectedOpt.getAttribute("data-giagoc")) || 0;
    var giaBan = parseFloat(selectedOpt.getAttribute("data-giaban")) || 0;

    var inputGiaNhap = tr.querySelector(".input-gianhap");
    // Gợi ý giá nhập: ưu tiên giagoc nếu có, nếu chưa có thì gợi ý khoảng 85% giá bán
    if (giaGoc > 0) {
        inputGiaNhap.value = giaGoc;
    } else if (giaBan > 0) {
        inputGiaNhap.value = Math.round(giaBan * 0.85);
    }

    tinhThanhTienDong(selectEl);
}

// Tính thành tiền cho 1 dòng
function tinhThanhTienDong(el) {
    var tr = el.closest("tr");
    var giaNhap = parseFloat(tr.querySelector(".input-gianhap").value) || 0;
    var soLuong = parseInt(tr.querySelector(".input-soluong").value) || 0;

    var thanhTien = giaNhap * soLuong;
    tr.querySelector(".text-thanhtien").innerText = dinhDangTien(thanhTien);

    capNhatTongCong();
}

// Cập nhật lại tổng số lượng máy và tổng tiền phiếu nhập
function capNhatTongCong() {
    var tongSoLuong = 0;
    var tongTien = 0;

    var rows = document.querySelectorAll("#thanBangNhap tr.dong-nhap-hang");
    rows.forEach(function(row, idx) {
        row.querySelector(".cot-stt").innerText = idx + 1;
        var gia = parseFloat(row.querySelector(".input-gianhap").value) || 0;
        var sl = parseInt(row.querySelector(".input-soluong").value) || 0;
        tongSoLuong += sl;
        tongTien += (gia * sl);
    });

    document.getElementById("hienThiTongSoLuong").innerText = tongSoLuong + " máy";
    document.getElementById("hienThiTongTien").innerText = dinhDangTien(tongTien);
}

// Xóa 1 dòng khỏi bảng
function xoaDong(btn) {
    var tbody = document.getElementById("thanBangNhap");
    if (tbody.children.length <= 1) {
        alert("Phiếu nhập cần có ít nhất 1 dòng sản phẩm!");
        return;
    }
    var tr = btn.closest("tr");
    tr.remove();
    capNhatTongCong();
}

// Kiểm tra trước khi submit form
function kiemTraFormNhapHang() {
    var ncc = document.getElementById("txtnhacungcap").value.trim();
    if (!ncc) {
        alert("Vui lòng nhập tên Nhà cung cấp!");
        document.getElementById("txtnhacungcap").focus();
        return false;
    }

    var rows = document.querySelectorAll("#thanBangNhap tr.dong-nhap-hang");
    if (rows.length === 0) {
        alert("Vui lòng thêm ít nhất 1 mẫu điện thoại cần nhập!");
        return false;
    }

    var hopLe = true;
    rows.forEach(function(row) {
        var spId = row.querySelector(".select-mathang").value;
        var gia = parseFloat(row.querySelector(".input-gianhap").value) || 0;
        var sl = parseInt(row.querySelector(".input-soluong").value) || 0;
        if (!spId) {
            alert("Có dòng chưa chọn mẫu điện thoại!");
            hopLe = false;
        } else if (gia <= 0) {
            alert("Giá nhập phải lớn hơn 0đ!");
            hopLe = false;
        } else if (sl <= 0) {
            alert("Số lượng nhập phải từ 1 máy trở lên!");
            hopLe = false;
        }
    });

    return hopLe;
}

function dinhDangTien(so) {
    return new Intl.NumberFormat('vi-VN').format(so) + 'đ';
}

// Khởi tạo dòng mặc định khi mở trang: nếu có máy chọn trước thì chọn đúng máy đó
document.addEventListener("DOMContentLoaded", function() {
    if (sanPhamIdChonTruoc > 0) {
        themDongSanPham(sanPhamIdChonTruoc);
    } else {
        themDongSanPham(1);
        themDongSanPham(3);
    }
});
</script>

<?php include("../inc/bottom.php"); ?>
