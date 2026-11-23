<?php include("../inc/top.php"); ?>

<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
	<div>
		<a href="index.php" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="arrow-left"></i>
			<span>Trở về danh sách mặt hàng</span>
		</a>
	</div>
	<div class="d-flex align-items-center gap-2">
		<a href="index.php?action=anhmau&id=<?= $m['id'] ?>&from=bienthe" class="btn btn-outline-success btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="image"></i>
			<span>Quản lý ảnh màu</span>
		</a>
		<a href="../../public/index.php?action=detail&id=<?= $m['id'] ?>" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1">
			<i class="align-middle" data-feather="external-link"></i>
			<span>Xem trên Web</span>
		</a>
	</div>
</div>

<?php if(isset($_GET["msg"]) && $_GET["msg"] === "saved"): ?>
	<div class="alert alert-dismissible fade show d-flex align-items-center justify-content-between mb-3" 
	     style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-radius: 10px; padding: 12px 16px;" 
	     role="alert">
		<div class="d-flex align-items-center">
			<i class="bi bi-check-circle-fill me-2" data-feather="check-circle"></i>
			<strong>Đã lưu cấu hình biến thể thành công!</strong>
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0;"></button>
	</div>
<?php endif; ?>

<!-- Thẻ thông tin nhanh mặt hàng -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-body p-3">
		<div class="d-flex align-items-center gap-3">
			<img src="../../<?= $m["hinhanh"] ?>" 
			     alt="<?= htmlspecialchars($m["tenmathang"]) ?>" 
			     class="rounded border bg-white p-1" 
			     style="width: 72px; height: 72px; object-fit: contain;"
			     onerror="this.src='../../images/products/a1.jpg';">
			<div>
				<div class="d-flex align-items-center gap-2 flex-wrap">
					<span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold"><?= sprintf("SP-%03d", $m["id"]) ?></span>
					<span class="badge bg-light text-secondary border"><?= htmlspecialchars($m["tendanhmuc"] ?? "Điện thoại") ?></span>
				</div>
				<h4 class="fw-bold mb-1 mt-1 text-dark"><?= htmlspecialchars($m["tenmathang"]) ?></h4>
				<div class="small text-muted">
					<span>Giá bán: <strong class="text-danger"><?= number_format($m["giaban"], 0, ',', '.') ?>đ</strong></span>
					<span class="mx-2">&bull;</span>
					<span>Tồn kho: <strong class="text-success"><?= $m["soluongton"] ?></strong> chiếc</span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Form cấu hình nhanh Phiên bản & Màu sắc -->
<form method="post" action="index.php" id="formBienThe">
	<input type="hidden" name="action" value="luubienthe">
	<input type="hidden" name="txtid" value="<?= $m["id"] ?>">

	<div class="row g-4 mb-4">
		<!-- 1. QUẢN LÝ PHIÊN BẢN (DUNG LƯỢNG) -->
		<div class="col-lg-6">
			<div class="card border-0 shadow-sm h-100">
				<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
					<i class="align-middle text-primary" data-feather="hard-drive"></i>
					<h5 class="fw-bold mb-0 text-dark">Phiên bản (Dung lượng)</h5>
				</div>
				<div class="card-body p-4">
					<p class="text-muted small mb-3">
						Thêm các phiên bản bộ nhớ của máy (ví dụ: 128GB, 256GB, 512GB, 1TB). Khách hàng sẽ thấy các nút chọn dung lượng tương ứng trên trang chi tiết sản phẩm.
					</p>

					<!-- Gợi ý nhanh dung lượng phổ biến -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-muted d-block">Gợi ý thêm nhanh:</label>
						<div class="d-flex flex-wrap gap-2">
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYPhienBan('64GB')">+ 64GB</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYPhienBan('128GB')">+ 128GB</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYPhienBan('256GB')">+ 256GB</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYPhienBan('512GB')">+ 512GB</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYPhienBan('1TB')">+ 1TB</button>
						</div>
					</div>

					<!-- Danh sách tag dung lượng hiện có -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-dark">Danh sách dung lượng hiện có:</label>
						<div id="vungTagPhienBan" class="d-flex flex-wrap gap-2 p-3 bg-light rounded border min-vh-25">
							<!-- Render động bằng JS -->
						</div>
					</div>

					<!-- Ô thêm dung lượng tùy ý -->
					<div class="input-group mb-3">
						<input type="text" id="inputPhienBanMoi" class="form-control" placeholder="Nhập dung lượng khác (vd: 2TB)..." onkeypress="xuLyEnterPhienBan(event)">
						<button type="button" class="btn btn-primary d-inline-flex align-items-center gap-1" onclick="themPhienBanThuCong()">
							<i class="align-middle" data-feather="plus"></i>
							<span>Thêm</span>
						</button>
					</div>

					<!-- Input ẩn chứa chuỗi giá trị thực tế phân cách bởi dấu phẩy -->
					<input type="hidden" name="txtphienban" id="txtphienban" value="<?= htmlspecialchars($m["phienban"] ?? "") ?>">
					<div class="form-text small text-muted">
						Chuỗi lưu trong CSDL: <code id="previewPhienBan"><?= htmlspecialchars($m["phienban"] ?? "") ?></code>
					</div>
				</div>
			</div>
		</div>

		<!-- 2. QUẢN LÝ MÀU SẮC -->
		<div class="col-lg-6">
			<div class="card border-0 shadow-sm h-100">
				<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
					<i class="align-middle text-success" data-feather="disc"></i>
					<h5 class="fw-bold mb-0 text-dark">Màu sắc điện thoại</h5>
				</div>
				<div class="card-body p-4">
					<p class="text-muted small mb-3">
						Thêm các màu sắc thực tế của sản phẩm (ví dụ: Titan Sa Mạc, Titan Đen, Titan Trắng). Thứ tự các màu sẽ liên kết tương ứng với ảnh trong <strong>Thư viện ảnh màu</strong>.
					</p>

					<!-- Gợi ý nhanh các màu hot -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-muted d-block">Gợi ý màu sắc phổ biến:</label>
						<div class="d-flex flex-wrap gap-2">
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Titan Sa Mạc')">+ Titan Sa Mạc</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Titan Tự Nhiên')">+ Titan Tự Nhiên</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Titan Đen')">+ Titan Đen</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Titan Trắng')">+ Titan Trắng</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Titan Xanh')">+ Titan Xanh</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Đen')">+ Đen</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Trắng')">+ Trắng</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Xanh Dương')">+ Xanh Dương</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Tím')">+ Tím</button>
							<button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" onclick="themGoiYMauSac('Vàng Gold')">+ Vàng Gold</button>
						</div>
					</div>

					<!-- Danh sách tag màu sắc hiện có -->
					<div class="mb-3">
						<label class="form-label small fw-semibold text-dark">Danh sách màu sắc hiện có:</label>
						<div id="vungTagMauSac" class="d-flex flex-wrap gap-2 p-3 bg-light rounded border min-vh-25">
							<!-- Render động bằng JS -->
						</div>
					</div>

					<!-- Ô thêm màu sắc tùy ý -->
					<div class="input-group mb-3">
						<input type="text" id="inputMauSacMoi" class="form-control" placeholder="Nhập tên màu sắc khác..." onkeypress="xuLyEnterMauSac(event)">
						<button type="button" class="btn btn-success d-inline-flex align-items-center gap-1" onclick="themMauSacThuCong()">
							<i class="align-middle" data-feather="plus"></i>
							<span>Thêm</span>
						</button>
					</div>

					<!-- Input ẩn chứa chuỗi giá trị thực tế phân cách bởi dấu phẩy -->
					<input type="hidden" name="txtmausac" id="txtmausac" value="<?= htmlspecialchars($m["mausac"] ?? "") ?>">
					<div class="form-text small text-muted">
						Chuỗi lưu trong CSDL: <code id="previewMauSac"><?= htmlspecialchars($m["mausac"] ?? "") ?></code>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Nút bấm hành động -->
	<div class="card border-0 shadow-sm">
		<div class="card-body p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
			<a href="index.php" class="btn btn-light border px-4">
				<i class="align-middle me-1" data-feather="x"></i>Hủy bỏ
			</a>
			<button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
				<i class="align-middle" data-feather="save"></i>
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

// Cập nhật lại giao diện và input ẩn cho Phiên bản
function renderPhienBan() {
	var vung = document.getElementById("vungTagPhienBan");
	vung.innerHTML = "";
	if (mangPhienBan.length === 0) {
		vung.innerHTML = '<span class="text-muted small fst-italic">Chưa có phiên bản dung lượng nào. Hãy bấm gợi ý hoặc thêm mới.</span>';
	} else {
		mangPhienBan.forEach(function(item, idx) {
			var badge = document.createElement("span");
			badge.className = "badge bg-white text-dark border shadow-sm px-3 py-2 fs-6 d-inline-flex align-items-center gap-2";
			badge.innerHTML = '<span>' + escapeHtml(item) + '</span>' +
				'<button type="button" class="btn-close btn-close-sm" style="font-size: 10px;" onclick="xoaPhienBan(' + idx + ')" title="Xóa"></button>';
			vung.appendChild(badge);
		});
	}

	var chuoi = mangPhienBan.join(", ");
	document.getElementById("txtphienban").value = chuoi;
	document.getElementById("previewPhienBan").innerText = chuoi || "(trống)";
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
			badge.className = "badge bg-white text-dark border shadow-sm px-3 py-2 fs-6 d-inline-flex align-items-center gap-2";
			badge.innerHTML = '<span class="text-success">&bull;</span><span>' + escapeHtml(item) + '</span>' +
				'<button type="button" class="btn-close btn-close-sm" style="font-size: 10px;" onclick="xoaMauSac(' + idx + ')" title="Xóa"></button>';
			vung.appendChild(badge);
		});
	}

	var chuoi = mangMauSac.join(", ");
	document.getElementById("txtmausac").value = chuoi;
	document.getElementById("previewMauSac").innerText = chuoi || "(trống)";
}

// Xử lý thêm phiên bản từ gợi ý
function themGoiYPhienBan(val) {
	if (!mangPhienBan.includes(val)) {
		mangPhienBan.push(val);
		renderPhienBan();
	}
}

// Xử lý thêm phiên bản từ ô gõ tay
function themPhienBanThuCong() {
	var input = document.getElementById("inputPhienBanMoi");
	var val = input.value.trim();
	if (val) {
		if (!mangPhienBan.includes(val)) {
			mangPhienBan.push(val);
			renderPhienBan();
		}
		input.value = "";
		input.focus();
	}
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
