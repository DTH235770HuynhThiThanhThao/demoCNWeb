<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, sang trọng */
.btn-flagship-back {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    color: #334155;
    font-size: 12.5px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn-flagship-back:hover {
    background-color: #f8fafc;
    border-color: #cbd5e1;
    color: #0f172a;
}
.btn-flagship-nav {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    color: #334155;
    font-size: 12.5px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn-flagship-nav:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff1f2;
}
.brand-accent-bar {
    width: 4px;
    height: 18px;
    background-color: #d70018;
    border-radius: 3px;
    flex-shrink: 0;
}
.btn-tag-suggest {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 12px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    transition: all 0.2s ease;
}
.btn-tag-suggest:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff1f2;
}
.btn-dark-add {
    background-color: #1e293b;
    border-color: #1e293b;
    color: #ffffff;
    font-weight: 600;
    border-radius: 10px;
    padding: 0 16px;
    transition: all 0.2s ease;
}
.btn-dark-add:hover {
    background-color: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
}
.btn-flagship-save {
    background-color: #d70018;
    border: 1px solid #d70018;
    color: #ffffff;
    font-weight: 700;
    border-radius: 10px;
    padding: 10px 24px;
    box-shadow: 0 2px 8px rgba(215, 0, 24, 0.25);
    transition: all 0.2s ease;
}
.btn-flagship-save:hover {
    background-color: #b91c1c;
    border-color: #b91c1c;
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(215, 0, 24, 0.35);
}
.btn-flagship-cancel {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 22px;
    text-decoration: none;
    transition: all 0.2s ease;
}
.btn-flagship-cancel:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
</style>

<!-- 1. Thanh điều hướng đầu trang -->
<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
	<div>
		<a href="index.php" class="btn-flagship-back">
			<i class="align-middle me-1" data-feather="arrow-left" style="width: 15px; height: 15px;"></i>
			<span>Trở về danh sách mặt hàng</span>
		</a>
	</div>
	<div class="d-flex align-items-center gap-2">
		<a href="index.php?action=anhmau&id=<?= $m['id'] ?>&from=bienthe" class="btn-flagship-nav">
			<i class="align-middle me-1" data-feather="image" style="width: 15px; height: 15px;"></i>
			<span>Quản lý ảnh màu</span>
		</a>
		<a href="../../public/index.php?action=detail&id=<?= $m['id'] ?>" target="_blank" class="btn-flagship-nav">
			<i class="align-middle me-1" data-feather="external-link" style="width: 15px; height: 15px;"></i>
			<span>Xem trên Web</span>
		</a>
	</div>
</div>

<?php if(isset($_GET["msg"]) && $_GET["msg"] === "saved"): ?>
	<div class="alert alert-dismissible fade show d-flex align-items-center justify-content-between mb-3 shadow-sm" 
	     style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px;" 
	     role="alert">
		<div class="d-flex align-items-center">
			<i class="bi bi-check-circle-fill me-2 text-success" data-feather="check-circle"></i>
			<strong>Đã lưu cấu hình biến thể thành công!</strong>
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0;"></button>
	</div>
<?php endif; ?>

<!-- 2. Thẻ thông tin nhanh mặt hàng -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
	<div class="card-body p-3">
		<div class="d-flex align-items-center gap-3">
			<img src="../../<?= $m["hinhanh"] ?>" 
			     alt="<?= htmlspecialchars($m["tenmathang"]) ?>" 
			     class="rounded-3 border bg-white p-1" 
			     style="width: 72px; height: 72px; object-fit: contain;"
			     onerror="this.src='../../images/products/a1.jpg';">
			<div>
				<div class="d-flex align-items-center gap-2 flex-wrap">
					<span class="badge fw-bold" style="background-color: #fee2e2; color: #d70018; border: 1px solid #fecaca; border-radius: 8px; font-size: 12px; padding: 4px 8px;"><?= sprintf("SP-%03d", $m["id"]) ?></span>
					<span class="badge bg-light text-secondary border rounded-3" style="font-size: 12px;"><?= htmlspecialchars($m["tendanhmuc"] ?? "Điện thoại") ?></span>
				</div>
				<h4 class="fw-bold mb-1 mt-1 text-dark" style="letter-spacing: -0.2px;"><?= htmlspecialchars($m["tenmathang"]) ?></h4>
				<div class="small text-muted">
					<span>Giá bán: <strong class="text-danger"><?= number_format($m["giaban"], 0, ',', '.') ?>đ</strong></span>
					<span class="mx-2">&bull;</span>
					<span>Tồn kho: <strong class="text-success"><?= $m["soluongton"] ?></strong> chiếc</span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 3. Form cấu hình nhanh Phiên bản & Màu sắc -->
<form method="post" action="index.php" id="formBienThe">
	<input type="hidden" name="action" value="luubienthe">
	<input type="hidden" name="txtid" value="<?= $m["id"] ?>">

	<div class="row g-4 mb-4">
		<!-- CỘT TRÁI: QUẢN LÝ PHIÊN BẢN (DUNG LƯỢNG) -->
		<div class="col-lg-6">
			<div class="card border-0 shadow-sm rounded-4 h-100">
				<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
					<div class="brand-accent-bar"></div>
					<h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">Phiên bản dung lượng</h5>
				</div>
				<div class="card-body p-4">
					<p class="text-muted small mb-3">
						Thêm các phiên bản bộ nhớ của máy (hỗ trợ dạng: <code>128GB</code>, <code>256GB:24990000</code> hoặc kèm RAM: <code>512GB:27990000:12GB</code>). Khách hàng sẽ thấy các nút chọn dung lượng tương ứng trên trang chi tiết sản phẩm.
					</p>

					<!-- Gợi ý nhanh dung lượng phổ biến -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-muted d-block mb-1.5">Gợi ý dung lượng phổ biến:</label>
						<div class="d-flex flex-wrap gap-2">
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYPhienBan('64GB')">+ 64GB</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYPhienBan('128GB')">+ 128GB</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYPhienBan('256GB')">+ 256GB</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYPhienBan('512GB')">+ 512GB</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYPhienBan('1TB')">+ 1TB</button>
						</div>
					</div>

					<!-- Danh sách tag dung lượng hiện có -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-dark">Danh sách dung lượng hiện có:</label>
						<div id="vungTagPhienBan" class="d-flex flex-wrap gap-2 p-3 rounded-3 border" style="background-color: #f8fafc; min-height: 120px;">
							<!-- Render động bằng JS -->
						</div>
					</div>

					<!-- Ô nhập liệu: Dung lượng, RAM (tùy chọn), Giá bán -->
					<div class="p-3 rounded-3 border mb-3" style="background-color: #ffffff;">
						<label class="form-label small fw-semibold text-dark mb-2">Thêm phiên bản mới:</label>
						<div class="row g-2 mb-2">
							<div class="col-4">
								<input type="text" id="inputDungLuong" class="form-control" placeholder="Dung lượng (vd 256GB)" style="border-radius: 8px; border-color: #cbd5e1; height: 38px; font-size: 13px;" onkeypress="xuLyEnterPhienBan(event)">
							</div>
							<div class="col-3">
								<input type="text" id="inputRAM" class="form-control" placeholder="RAM (vd 8GB)" style="border-radius: 8px; border-color: #cbd5e1; height: 38px; font-size: 13px;" onkeypress="xuLyEnterPhienBan(event)">
							</div>
							<div class="col-5">
								<input type="number" id="inputGiaBan" class="form-control" placeholder="Giá bán (VNĐ)" style="border-radius: 8px; border-color: #cbd5e1; height: 38px; font-size: 13px;" onkeypress="xuLyEnterPhienBan(event)">
							</div>
						</div>
						<button type="button" class="btn btn-dark-add w-100 d-flex justify-content-center align-items-center gap-1.5" onclick="themPhienBanThuCong()">
							<i class="align-middle" data-feather="plus" style="width: 15px; height: 15px;"></i>
							<span>+ Thêm phiên bản</span>
						</button>
					</div>

					<!-- Input ẩn chứa chuỗi giá trị thực tế phân cách bởi dấu phẩy -->
					<input type="hidden" name="txtphienban" id="txtphienban" value="<?= htmlspecialchars($m["phienban"] ?? "") ?>">
					<div class="d-none">
						<code id="previewPhienBan"><?= htmlspecialchars($m["phienban"] ?? "") ?></code>
					</div>
				</div>
			</div>
		</div>

		<!-- CỘT PHẢI: QUẢN LÝ MÀU SẮC -->
		<div class="col-lg-6">
			<div class="card border-0 shadow-sm rounded-4 h-100">
				<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
					<div class="brand-accent-bar"></div>
					<h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">Màu sắc điện thoại</h5>
				</div>
				<div class="card-body p-4">
					<p class="text-muted small mb-3">
						Thêm các màu sắc thực tế của sản phẩm (ví dụ: Titan Sa Mạc, Titan Đen, Titan Trắng). Thứ tự các màu sẽ liên kết tương ứng với ảnh trong <strong>Quản lý ảnh màu</strong>.
					</p>

					<!-- Gợi ý nhanh các màu hot (1 hàng gọn nhẹ) -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-muted d-block mb-1.5">Gợi ý màu sắc tiêu biểu:</label>
						<div class="d-flex flex-wrap gap-2">
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Đen')">+ Đen</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Trắng')">+ Trắng</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Xanh Dương')">+ Xanh Dương</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Tím')">+ Tím</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Bạc')">+ Bạc</button>
							<button type="button" class="btn btn-sm btn-tag-suggest" onclick="themGoiYMauSac('Titan Tự Nhiên')">+ Titan Tự Nhiên</button>
						</div>
					</div>

					<!-- Danh sách tag màu sắc hiện có -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-dark">Danh sách màu sắc hiện có:</label>
						<div id="vungTagMauSac" class="d-flex flex-wrap gap-2 p-3 rounded-3 border" style="background-color: #f8fafc; min-height: 120px;">
							<!-- Render động bằng JS -->
						</div>
					</div>

					<!-- Ô thêm màu sắc tùy ý -->
					<div class="input-group mb-2">
						<input type="text" id="inputMauSacMoi" class="form-control" placeholder="Nhập tên màu sắc khác..." style="border-radius: 10px 0 0 10px; border-color: #cbd5e1; height: 40px; font-size: 13px;" onkeypress="xuLyEnterMauSac(event)">
						<button type="button" class="btn btn-dark-add d-inline-flex align-items-center gap-1" style="border-radius: 0 10px 10px 0;" onclick="themMauSacThuCong()">
							<i class="align-middle" data-feather="plus" style="width: 15px; height: 15px;"></i>
							<span>Thêm</span>
						</button>
					</div>

					<!-- Input ẩn chứa chuỗi giá trị thực tế phân cách bởi dấu phẩy -->
					<input type="hidden" name="txtmausac" id="txtmausac" value="<?= htmlspecialchars($m["mausac"] ?? "") ?>">
					<div class="d-none">
						<code id="previewMauSac"><?= htmlspecialchars($m["mausac"] ?? "") ?></code>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 4. Thanh lưu thay đổi dưới cùng -->
	<div class="card border-0 shadow-sm rounded-4 mb-4">
		<div class="card-body p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
			<a href="index.php" class="btn btn-flagship-cancel d-inline-flex align-items-center gap-1.5">
				<i class="align-middle" data-feather="x" style="width: 16px; height: 16px;"></i>
				<span>Hủy bỏ</span>
			</a>
			<button type="submit" class="btn btn-flagship-save d-inline-flex align-items-center gap-2">
				<i class="align-middle" data-feather="save" style="width: 16px; height: 16px;"></i>
				<span>Lưu biến thể</span>
			</button>
		</div>
	</div>
</form>

<script>
// Quản lý mảng danh sách phiên bản và màu sắc
var mangPhienBan = [];
var mangMauSac = [];

// Khởi tạo dữ liệu ban đầu từ input ẩn
(function khoiTaoDuLieu() {
	var pbRaw = document.getElementById("txtphienban").value.trim();
	if (pbRaw) {
		mangPhienBan = pbRaw.split(',').map(function(s) { return s.trim(); }).filter(function(s) { return s.length > 0; });
	}

	var msRaw = document.getElementById("txtmausac").value.trim();
	if (msRaw) {
		mangMauSac = msRaw.split(',').map(function(s) { return s.trim(); }).filter(function(s) { return s.length > 0; });
	}

	renderPhienBan();
	renderMauSac();
})();

// Format hiển thị tag phiên bản dung lượng tách bạch: Dung lượng, Giá bán và RAM
function formatTagPhienBan(item) {
	var parts = item.split(":");
	var dl = parts[0].trim();
	var gia = parts[1] ? parseInt(parts[1].trim()) : null;
	var ram = parts[2] ? parts[2].trim() : null;

	var html = '<strong class="text-dark me-1" style="font-size: 13px;">' + escapeHtml(dl) + '</strong>';
	if (ram) {
		html += '<span class="badge me-1" style="background:#fee2e2; color:#d70018; font-size:11px; font-weight:700;">' + escapeHtml(ram) + '</span>';
	}
	if (gia && !isNaN(gia)) {
		html += '<span class="fw-bold me-1" style="color:#d70018; font-size:12.5px;">' + gia.toLocaleString('vi-VN') + 'đ</span>';
	}
	return html;
}

// Cập nhật lại giao diện và input ẩn cho Phiên bản
function renderPhienBan() {
	var vung = document.getElementById("vungTagPhienBan");
	vung.innerHTML = "";
	if (mangPhienBan.length === 0) {
		vung.innerHTML = '<span class="text-muted small fst-italic">Chưa có phiên bản dung lượng nào. Hãy bấm gợi ý hoặc thêm mới.</span>';
	} else {
		mangPhienBan.forEach(function(item, idx) {
			var badge = document.createElement("span");
			badge.className = "badge bg-white text-dark shadow-sm px-3 py-2 d-inline-flex align-items-center gap-2 rounded-3";
			badge.style.border = "1px solid #e2e8f0";
			badge.innerHTML = formatTagPhienBan(item) +
				'<button type="button" class="btn-close btn-close-sm ms-1" style="font-size: 10px;" onclick="xoaPhienBan(' + idx + ')" title="Xóa"></button>';
			vung.appendChild(badge);
		});
	}

	var chuoi = mangPhienBan.join(", ");
	document.getElementById("txtphienban").value = chuoi;
	var preview = document.getElementById("previewPhienBan");
	if (preview) preview.innerText = chuoi || "(trống)";
}

// Cập nhật lại giao diện và input ẩn cho Màu sắc
function renderMauSac() {
	var vung = document.getElementById("vungTagMauSac");
	vung.innerHTML = "";
	if (mangMauSac.length === 0) {
		vung.innerHTML = '<span class="text-muted small fst-italic">Chưa có màu sắc nào. Hãy bấm gợi ý hoặc thêm mới.</span>';
	} else {
		mangMauSac.forEach(function(item, idx) {
			var badge = document.createElement("span");
			badge.className = "badge bg-white text-dark shadow-sm px-3 py-2 d-inline-flex align-items-center gap-2 rounded-3";
			badge.style.border = "1px solid #e2e8f0";
			badge.style.fontSize = "13px";
			badge.style.fontWeight = "600";
			badge.innerHTML = '<span>' + escapeHtml(item) + '</span>' +
				'<button type="button" class="btn-close btn-close-sm ms-1" style="font-size: 10px;" onclick="xoaMauSac(' + idx + ')" title="Xóa"></button>';
			vung.appendChild(badge);
		});
	}

	var chuoi = mangMauSac.join(", ");
	document.getElementById("txtmausac").value = chuoi;
	var preview = document.getElementById("previewMauSac");
	if (preview) preview.innerText = chuoi || "(trống)";
}

// Xử lý thêm phiên bản từ gợi ý
function themGoiYPhienBan(val) {
	var dlInput = document.getElementById("inputDungLuong");
	var ramInput = document.getElementById("inputRAM");
	var giaInput = document.getElementById("inputGiaBan");
	if (dlInput) {
		dlInput.value = val;
		if (ramInput && !ramInput.value) {
			if (val === "64GB") ramInput.value = "4GB";
			else if (val === "128GB") ramInput.value = "6GB";
			else if (val === "256GB") ramInput.value = "8GB";
			else if (val === "512GB") ramInput.value = "12GB";
			else if (val === "1TB") ramInput.value = "16GB";
		}
		if (giaInput && !giaInput.value) {
			giaInput.value = "<?= $m['giaban'] ?>";
		}
		dlInput.focus();
	}
}

// Xử lý thêm phiên bản từ ô nhập liệu
function themPhienBanThuCong() {
	var dlInput = document.getElementById("inputDungLuong");
	var ramInput = document.getElementById("inputRAM");
	var giaInput = document.getElementById("inputGiaBan");

	var dl = dlInput ? dlInput.value.trim() : "";
	var ram = ramInput ? ramInput.value.trim() : "";
	var gia = giaInput ? giaInput.value.trim() : "";

	if (!dl) {
		alert("Vui lòng nhập dung lượng (ví dụ: 128GB, 256GB, 512GB)!");
		if (dlInput) dlInput.focus();
		return;
	}

	// Chuẩn hóa định dạng lưu: DungLượng[:Giá[:RAM]]
	var chuoiPB = dl;
	if (gia) {
		chuoiPB += ":" + gia;
		if (ram) {
			chuoiPB += ":" + ram;
		}
	} else if (ram) {
		chuoiPB += ":<?= $m['giaban'] ?>:" + ram;
	}

	// Kiểm tra xem dung lượng này đã có chưa
	var existingIdx = -1;
	for (var i = 0; i < mangPhienBan.length; i++) {
		var parts = mangPhienBan[i].split(":");
		if (parts[0].trim().toUpperCase() === dl.toUpperCase()) {
			existingIdx = i;
			break;
		}
	}

	if (existingIdx !== -1) {
		mangPhienBan[existingIdx] = chuoiPB;
	} else {
		mangPhienBan.push(chuoiPB);
	}

	renderPhienBan();

	if (dlInput) dlInput.value = "";
	if (ramInput) ramInput.value = "";
	if (giaInput) giaInput.value = "";
	if (dlInput) dlInput.focus();
}

function xuLyEnterPhienBan(e) {
	if (e.key === "Enter") {
		e.preventDefault();
		themPhienBanThuCong();
	}
}

function xoaPhienBan(idx) {
	mangPhienBan.splice(idx, 1);
	renderPhienBan();
}

// Xử lý thêm màu sắc từ gợi ý
function themGoiYMauSac(val) {
	if (!mangMauSac.includes(val)) {
		mangMauSac.push(val);
		renderMauSac();
	}
}

// Xử lý thêm màu sắc từ ô gõ tay
function themMauSacThuCong() {
	var input = document.getElementById("inputMauSacMoi");
	var val = input.value.trim();
	if (val) {
		if (!mangMauSac.includes(val)) {
			mangMauSac.push(val);
			renderMauSac();
		}
		input.value = "";
		input.focus();
	}
}

function xuLyEnterMauSac(e) {
	if (e.key === "Enter") {
		e.preventDefault();
		themMauSacThuCong();
	}
}

function xoaMauSac(idx) {
	mangMauSac.splice(idx, 1);
	renderMauSac();
}

function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
</script>

<?php include("../inc/bottom.php"); ?>
