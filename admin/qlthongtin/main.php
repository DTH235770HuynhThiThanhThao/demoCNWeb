<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
	<div>
		<h3 class="fw-bold mb-1 text-info">Cấu hình thông tin website</h3>
		<p class="text-muted small mb-0">Quản lý thương hiệu, số hotline, địa chỉ, giờ mở cửa và nội dung giới thiệu cửa hàng</p>
	</div>
	<div>
		<a href="../../public/index.php?action=gioithieu" target="_blank" class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
			<i class="align-middle" data-feather="external-link"></i>
			<span>Xem trang Giới thiệu ngoài web</span>
		</a>
	</div>
</div>

<?php if(isset($_GET["msg"]) && $_GET["msg"] == "capnhat_ok"): ?>
	<div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
		<i class="align-middle me-2" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
		<div>
			<strong>Cập nhật thành công!</strong> Thông tin cửa hàng đã được lưu và tự động đồng bộ lên thanh Top-bar, chân trang Footer và trang Giới thiệu.
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif; ?>

<div class="row g-4">
	<!-- CỘT TRÁI (col-lg-8): FORM CHỈNH SỬA THÔNG TIN CỬA HÀNG -->
	<div class="col-lg-8">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white py-3 border-bottom">
				<div class="d-flex align-items-center gap-2">
					<i class="align-middle text-primary" data-feather="sliders"></i>
					<h5 class="fw-bold mb-0 text-dark">Cấu hình thông tin cửa hàng</h5>
				</div>
				<div class="text-muted small mt-1">
					Thông tin này sẽ hiển thị trực tiếp trên thanh tiêu đề, chân trang và trang Giới thiệu ngoài website.
				</div>
			</div>

			<div class="card-body p-4">
				<form method="post" action="index.php" id="formThongTin">
					<input type="hidden" name="action" value="capnhat">

					<!-- Hàng 1: Tên cửa hàng & Hotline -->
					<div class="row g-3 mb-3">
						<div class="col-md-6">
							<label class="form-label fw-bold text-dark">
								Tên cửa hàng / Thương hiệu <span class="text-danger">*</span>
							</label>
							<div class="input-group">
								<span class="input-group-text"><i class="align-middle" data-feather="home"></i></span>
								<input type="text" class="form-control" name="txttencuahang" id="inputTenCuaHang" 
								       value="<?= htmlspecialchars($thongtin["tencuahang"] ?? "Thảo Mobile") ?>" 
								       required placeholder="Nhập tên cửa hàng...">
							</div>
						</div>

						<div class="col-md-6">
							<label class="form-label fw-bold text-dark">
								Số điện thoại Hotline <span class="text-danger">*</span>
							</label>
							<div class="input-group">
								<span class="input-group-text"><i class="align-middle" data-feather="phone-call"></i></span>
								<input type="text" class="form-control" name="txtsodienthoai" id="inputHotline" 
								       value="<?= htmlspecialchars($thongtin["sodienthoai"] ?? "0357185269") ?>" 
								       required placeholder="Ví dụ: 0357185269...">
							</div>
						</div>
					</div>

					<!-- Hàng 2: Email liên hệ & Giờ mở cửa -->
					<div class="row g-3 mb-3">
						<div class="col-md-6">
							<label class="form-label fw-bold text-dark">
								Email liên hệ <span class="text-danger">*</span>
							</label>
							<div class="input-group">
								<span class="input-group-text"><i class="align-middle" data-feather="mail"></i></span>
								<input type="email" class="form-control" name="txtemail" id="inputEmail" 
								       value="<?= htmlspecialchars($thongtin["email"] ?? "thanhthaoshop@gmail.com") ?>" 
								       required placeholder="Ví dụ: hotro@shop.com...">
							</div>
						</div>

						<div class="col-md-6">
							<label class="form-label fw-bold text-dark">
								Giờ mở cửa phục vụ
							</label>
							<div class="input-group">
								<span class="input-group-text"><i class="align-middle" data-feather="clock"></i></span>
								<input type="text" class="form-control" name="txtgiomocua" id="inputGioMoCua" 
								       value="<?= htmlspecialchars($thongtin["giomocua"] ?? "08:00 - 21:30 (Tất cả các ngày trong tuần)") ?>" 
								       placeholder="Ví dụ: 08:00 - 21:30...">
							</div>
						</div>
					</div>

					<!-- Hàng 3: Dòng thông báo chạy trên thanh Top-bar (Slogan) -->
					<div class="mb-3">
						<label class="form-label fw-bold text-dark">
							Dòng thông báo chạy trên thanh Top-bar (Slogan khuyến mãi)
						</label>
						<div class="input-group">
							<span class="input-group-text"><i class="align-middle" data-feather="volume-2"></i></span>
							<input type="text" class="form-control" name="txtslogan" id="inputSlogan" 
							       value="<?= htmlspecialchars($thongtin["slogan"] ?? "Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng") ?>" 
							       placeholder="Nhập slogan hoặc ưu đãi nổi bật trên đầu trang...">
						</div>
						<div class="form-text small text-muted">
							Hiển thị trên dải banner màu đỏ/đen ở trên cùng của trang web khách hàng.
						</div>
					</div>

					<!-- Hàng 4: Địa chỉ cửa hàng -->
					<div class="mb-3">
						<label class="form-label fw-bold text-dark">
							Địa chỉ cửa hàng / Showroom <span class="text-danger">*</span>
						</label>
						<div class="input-group">
							<span class="input-group-text"><i class="align-middle" data-feather="map-pin"></i></span>
							<input type="text" class="form-control" name="txtdiachi" id="inputDiaChi" 
							       value="<?= htmlspecialchars($thongtin["diachi"] ?? "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp") ?>" 
							       required placeholder="Nhập số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành...">
						</div>
					</div>

					<!-- Hàng 5: Nội dung giới thiệu cửa hàng -->
					<div class="mb-4">
						<label class="form-label fw-bold text-dark">
							Nội dung giới thiệu cửa hàng
						</label>
						<textarea class="form-control" name="txtgioithieu" id="inputGioiThieu" rows="5" placeholder="Nhập đôi nét giới thiệu về lịch sử hình thành, sứ mệnh, cam kết của cửa hàng..."><?= htmlspecialchars($thongtin["gioithieu"] ?? "") ?></textarea>
						<div class="form-text small text-muted">
							Hiển thị ở khối giới thiệu chính trên trang <code>Giới thiệu & Liên hệ (about.php)</code>.
						</div>
					</div>

					<!-- Nút bấm hành động -->
					<div class="d-flex align-items-center gap-2 pt-2 border-top">
						<button type="submit" class="btn btn-primary px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
							<i class="align-middle" data-feather="save"></i>
							<span>Lưu thay đổi</span>
						</button>
						<button type="reset" class="btn btn-light border px-3 py-2" onclick="setTimeout(capNhatLivePreview, 50)">
							Khôi phục ban đầu
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- CỘT PHẢI (col-lg-4): KHUNG XEM TRƯỚC TRỰC QUAN (LIVE PREVIEW) -->
	<div class="col-lg-4">
		<div class="card border-0 shadow-sm mb-4">
			<div class="card-header bg-white py-3 border-bottom d-flex align-items-center gap-2">
				<i class="align-middle text-success" data-feather="eye"></i>
				<h5 class="fw-bold mb-0 text-dark">Xem trước trực quan</h5>
			</div>

			<div class="card-body p-4">
				<!-- Thẻ mô phỏng danh thiếp cửa hàng -->
				<div class="p-3 rounded-3 text-white shadow-sm mb-3" style="background: linear-gradient(135deg, #142B4A 0%, #0d1f35 100%);">
					<div class="d-flex align-items-center gap-3 mb-3">
						<img src="../../images/logo/logo2.jpg" alt="Logo" class="rounded-3 shadow-sm bg-white p-1" style="width: 52px; height: 52px; object-fit: cover;" onerror="this.src='../../images/logo/logo.jpg';">
						<div>
							<h5 class="fw-bold mb-0 text-white" id="pvTenCuaHang"><?= htmlspecialchars($thongtin["tencuahang"] ?? "Thảo Mobile") ?></h5>
							<small class="text-white-50">Hệ thống bán lẻ chính hãng</small>
						</div>
					</div>

					<div class="small border-top border-secondary pt-2 mt-2">
						<div class="d-flex align-items-start gap-2 mb-2">
							<i class="align-middle text-warning mt-1" data-feather="phone-call" style="width: 14px; height: 14px;"></i>
							<span>Hotline: <strong class="text-warning" id="pvHotline"><?= htmlspecialchars($thongtin["sodienthoai"] ?? "0357185269") ?></strong></span>
						</div>
						<div class="d-flex align-items-start gap-2 mb-2">
							<i class="align-middle text-info mt-1" data-feather="mail" style="width: 14px; height: 14px;"></i>
							<span class="text-truncate" id="pvEmail"><?= htmlspecialchars($thongtin["email"] ?? "thanhthaoshop@gmail.com") ?></span>
						</div>
						<div class="d-flex align-items-start gap-2 mb-2">
							<i class="align-middle text-danger mt-1" data-feather="map-pin" style="width: 14px; height: 14px;"></i>
							<span id="pvDiaChi"><?= htmlspecialchars($thongtin["diachi"] ?? "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp") ?></span>
						</div>
						<div class="d-flex align-items-start gap-2">
							<i class="align-middle text-success mt-1" data-feather="clock" style="width: 14px; height: 14px;"></i>
							<span id="pvGioMoCua"><?= htmlspecialchars($thongtin["giomocua"] ?? "08:00 - 21:30") ?></span>
						</div>
					</div>
				</div>

				<!-- Mô phỏng Top Announcement Bar -->
				<div class="border rounded p-2 mb-3 bg-light">
					<div class="small text-muted fw-semibold mb-1">Mô phỏng Top-bar ngoài web:</div>
					<div class="p-2 rounded bg-dark text-white small" style="font-size: 11px;">
						<i class="align-middle text-warning me-1" data-feather="bell" style="width: 12px; height: 12px;"></i>
						<span id="pvSlogan"><?= htmlspecialchars($thongtin["slogan"] ?? "Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng") ?></span>
					</div>
				</div>

				<div class="d-grid">
					<a href="../../public/index.php?action=gioithieu" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center justify-content-center gap-1">
						<span>Xem ngoài trang chủ</span>
						<i class="align-middle" data-feather="arrow-up-right" style="width: 15px; height: 15px;"></i>
					</a>
				</div>
			</div>
		</div>

		<!-- Hướng dẫn sử dụng -->
		<div class="card border-0 shadow-sm bg-light">
			<div class="card-body p-3 small text-muted">
				<h6 class="fw-bold text-dark mb-2"><i class="align-middle me-1 text-primary" data-feather="help-circle"></i>Vị trí hiển thị trên hệ thống:</h6>
				<ul class="ps-3 mb-0">
					<li class="mb-1"><strong>Tên & Hotline:</strong> Thanh điều hướng trên cùng, logo và nút gọi hotline.</li>
					<li class="mb-1"><strong>Slogan:</strong> Dải thông báo chạy trên đầu trang chủ.</li>
					<li class="mb-1"><strong>Địa chỉ, Email, Giờ mở cửa:</strong> Chân trang (Footer) và hộp liên hệ trang Giới thiệu.</li>
					<li><strong>Giới thiệu:</strong> Khối giới thiệu cửa hàng tại <code>public/about.php</code>.</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
// Cập nhật Live Preview khi người dùng nhập liệu
function capNhatLivePreview() {
	var ten = document.getElementById("inputTenCuaHang").value.trim() || "Thảo Mobile";
	var hotline = document.getElementById("inputHotline").value.trim() || "0357185269";
	var email = document.getElementById("inputEmail").value.trim() || "thaomobile@gmail.com";
	var diachi = document.getElementById("inputDiaChi").value.trim() || "Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp";
	var giomocua = document.getElementById("inputGioMoCua").value.trim() || "08:00 - 21:30";
	var slogan = document.getElementById("inputSlogan").value.trim() || "Giao nhanh 2H • Bảo hành 12 tháng";

	document.getElementById("pvTenCuaHang").innerText = ten;
	document.getElementById("pvHotline").innerText = hotline;
	document.getElementById("pvEmail").innerText = email;
	document.getElementById("pvDiaChi").innerText = diachi;
	document.getElementById("pvGioMoCua").innerText = giomocua;
	document.getElementById("pvSlogan").innerText = slogan;
}

// Lắng nghe sự kiện input
document.addEventListener("DOMContentLoaded", function() {
	var inputs = ["inputTenCuaHang", "inputHotline", "inputEmail", "inputDiaChi", "inputGioMoCua", "inputSlogan"];
	inputs.forEach(function(id) {
		var el = document.getElementById(id);
		if (el) {
			el.addEventListener("input", capNhatLivePreview);
		}
	});
});
</script>

<?php include("../inc/bottom.php"); ?>
