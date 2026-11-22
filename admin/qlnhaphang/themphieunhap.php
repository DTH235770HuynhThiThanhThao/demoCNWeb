<?php include("../inc/top.php"); ?>

<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
	<div>
		<a href="index.php?tab=tonkho" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
			<i class="align-middle" data-feather="arrow-left"></i>
			<span>Trở về quản lý tồn kho & nhập hàng</span>
		</a>
	</div>
</div>

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

<?php if(!empty($ten_may_chon)): ?>
	<div class="alert alert-info border-0 shadow-sm d-flex align-items-center py-2 px-3 mb-3" role="alert">
		<i class="align-middle me-2 text-info" data-feather="corner-down-right" style="width: 20px; height: 20px;"></i>
		<div>
			Đang lập phiếu nhập thêm số lượng cho mẫu điện thoại: <strong class="text-dark"><?= htmlspecialchars($ten_may_chon) ?></strong> (đã được tự động chọn sẵn ở dòng 1).
		</div>
	</div>
<?php endif; ?>

<form method="post" action="index.php" id="formNhapHang" onsubmit="return kiemTraFormNhapHang()">
	<input type="hidden" name="action" value="xulythem">

	<!-- KHỐI 1: THÔNG TIN PHIẾU NHẬP -->
	<div class="card border-0 shadow-sm mb-4">
		<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
			<i class="align-middle text-primary" data-feather="file-plus"></i>
			<h5 class="fw-bold mb-0 text-dark">Lập phiếu nhập kho điện thoại</h5>
		</div>
		<div class="card-body p-4">
			<div class="row g-3">
				<!-- Nhà cung cấp -->
				<div class="col-md-6">
					<label class="form-label fw-bold text-dark">
						Nhà cung cấp / Nhà phân phối <span class="text-danger">*</span>
					</label>
					<input type="text" class="form-control" name="txtnhacungcap" id="txtnhacungcap" list="dsNhaCungCap" placeholder="Nhập hoặc chọn nhà cung cấp..." required>
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
					<div class="d-flex flex-wrap gap-1 mt-2">
						<span class="small text-muted me-1">Gợi ý nhanh:</span>
						<button type="button" class="btn btn-sm btn-light border py-0 px-2" style="font-size: 11px;" onclick="ganNCC('Apple Việt Nam Chính Hãng')">Apple VN</button>
						<button type="button" class="btn btn-sm btn-light border py-0 px-2" style="font-size: 11px;" onclick="ganNCC('Samsung Electronics Vina')">Samsung Vina</button>
						<button type="button" class="btn btn-sm btn-light border py-0 px-2" style="font-size: 11px;" onclick="ganNCC('Nhà phân phối Digiworld (DGW)')">Digiworld</button>
						<button type="button" class="btn btn-sm btn-light border py-0 px-2" style="font-size: 11px;" onclick="ganNCC('Công ty Cổ phần Synnex FPT')">Synnex FPT</button>
					</div>
				</div>

				<!-- Người lập phiếu & Ngày giờ -->
				<div class="col-md-3">
					<label class="form-label fw-bold text-dark">Người lập phiếu</label>
					<input type="text" class="form-control bg-light" value="<?= htmlspecialchars($_SESSION["nguoidung"]["hoten"] ?? "Quản trị viên") ?>" readonly>
				</div>
				<div class="col-md-3">
					<label class="form-label fw-bold text-dark">Thời gian lập</label>
					<input type="text" class="form-control bg-light" value="<?= date("d/m/Y H:i") ?>" readonly>
				</div>

				<!-- Ghi chú nhập kho -->
				<div class="col-12">
					<label class="form-label fw-bold text-dark">Ghi chú nhập kho</label>
					<input type="text" class="form-control" name="txtghichu" placeholder="Ví dụ: Nhập bổ sung tồn kho, số hóa đơn VAT, chứng từ kho...">
				</div>
			</div>
		</div>
	</div>

	<!-- KHỐI 2: BẢNG CHỌN DANH SÁCH MẶT HÀNG NHẬP -->
	<div class="card border-0 shadow-sm mb-4">
		<div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
			<div class="d-flex align-items-center gap-2">
				<i class="align-middle text-success" data-feather="list"></i>
				<h5 class="fw-bold mb-0 text-dark">Danh sách điện thoại nhập kho</h5>
			</div>
			<button type="button" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1" onclick="themDongSanPham()">
				<i class="align-middle" data-feather="plus"></i>
				<span>+ Thêm dòng sản phẩm</span>
			</button>
		</div>

		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-bordered align-middle mb-0" id="bangNhapChiTiet">
					<thead class="table-light small text-secondary text-uppercase text-center">
						<tr>
							<th style="width: 50px;">STT</th>
							<th style="min-width: 320px;" class="text-start">Chọn mẫu điện thoại</th>
							<th style="width: 200px;">Giá nhập (VNĐ)</th>
							<th style="width: 140px;">Số lượng nhập</th>
							<th style="width: 200px;" class="text-end">Thành tiền</th>
							<th style="width: 60px;">Xóa</th>
						</tr>
					</thead>
					<tbody id="thanBangNhap">
						<!-- Các dòng sản phẩm được thêm vào đây -->
					</tbody>
					<tfoot class="table-light">
						<tr>
							<td colspan="3" class="text-end fw-bold py-3 fs-6">
								Tổng cộng:
							</td>
							<td class="text-center fw-bold py-3">
								<span id="hienThiTongSoLuong" class="badge bg-primary fs-6 px-3 py-2">0 máy</span>
							</td>
							<td class="text-end fw-bold py-3">
								<span id="hienThiTongTien" class="text-danger fw-bold fs-5">0đ</span>
							</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

		<div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
			<button type="button" class="btn btn-outline-primary d-inline-flex align-items-center gap-1" onclick="themDongSanPham()">
				<i class="align-middle" data-feather="plus-circle"></i>
				<span>Thêm một mẫu điện thoại khác</span>
			</button>

			<div class="d-flex align-items-center gap-2">
				<a href="index.php?tab=tonkho" class="btn btn-light border px-3">Hủy bỏ</a>
				<button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
					<i class="align-middle" data-feather="check-circle"></i>
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
		'<td class="text-center fw-bold cot-stt">' + (rowIndex + 1) + '</td>' +
		'<td>' +
			'<select class="form-select select-mathang" name="optmathang[]" required onchange="doiMatHang(this)">' +
				optionsHtml +
			'</select>' +
		'</td>' +
		'<td>' +
			'<div class="input-group">' +
				'<input type="number" class="form-control text-end input-gianhap" name="txtgianhap[]" min="0" step="10000" placeholder="0" required oninput="tinhThanhTienDong(this)">' +
				'<span class="input-group-text small">đ</span>' +
			'</div>' +
		'</td>' +
		'<td>' +
			'<input type="number" class="form-control text-center input-soluong" name="txtsoluong[]" min="1" value="1" required oninput="tinhThanhTienDong(this)">' +
		'</td>' +
		'<td class="text-end">' +
			'<span class="fw-bold text-danger text-thanhtien">0đ</span>' +
		'</td>' +
		'<td class="text-center">' +
			'<button type="button" class="btn btn-outline-danger btn-sm p-1 rounded" onclick="xoaDong(this)" title="Xóa dòng này">' +
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
