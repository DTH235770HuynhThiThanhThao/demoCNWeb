<?php include("../inc/top.php"); ?>

<style>
/* Style chuẩn Tech Flagship Thảo Mobile - Tối giản, thanh thoát */
.brand-title-bar {
    width: 5px;
    height: 38px;
    background-color: #d70018;
    border-radius: 4px;
    margin-right: 14px;
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
.btn-reset-form {
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-reset-form:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
.btn-action-neutral {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    color: #475569;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}
.btn-action-neutral.btn-edit:hover {
    border-color: #0284c7;
    color: #0284c7;
    background-color: #f0f9ff;
}
.btn-action-neutral.btn-delete:hover {
    border-color: #d70018;
    color: #d70018;
    background-color: #fff5f5;
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
.input-flagship {
    border-color: #cbd5e1;
    border-radius: 10px;
    font-size: 13.5px;
}
.input-flagship:focus {
    border-color: #d70018;
    box-shadow: 0 0 0 3px rgba(215, 0, 24, 0.1);
}
</style>

<!-- 1. Thanh tiêu đề & nút Thêm danh mục -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div class="d-flex align-items-center">
        <div class="brand-title-bar"></div>
        <div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.3px;">QUẢN LÝ DANH MỤC HÃNG</h3>
                <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 12px;">
                    Tổng: <?= count($danhmuc) ?> thương hiệu
                </span>
            </div>
            <p class="text-muted small mb-0 mt-1">Quản lý danh sách thương hiệu điện thoại phân phối chính hãng tại Thảo Mobile</p>
        </div>
    </div>
    <div>
        <button class="btn btn-flagship-red d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#formThemDanhMuc" aria-expanded="false" aria-controls="formThemDanhMuc">
            <i class="align-middle" data-feather="plus" style="width: 16px; height: 16px;"></i> 
            <span>Thêm danh mục</span>
        </button>
    </div>
</div>

<!-- 2. Form thêm nhanh inline (collapse) -->
<div id="formThemDanhMuc" class="collapse mb-4">
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-0" style="border-left: 4px solid #d70018 !important; background-color: #ffffff;">
        <form method="post" action="index.php"> 
            <input type="hidden" name="action" value="them">
            <div class="row g-2 align-items-center">	
                <div class="col-auto">
                    <label class="col-form-label fw-bold text-dark small">Tên thương hiệu mới: <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-5 col-lg-4">
                    <input type="text" class="form-control input-flagship" name="ten" placeholder="Ví dụ: Apple, Samsung, Xiaomi, OPPO..." required>
                </div>
                <div class="col-auto d-flex gap-2">
                    <button type="submit" class="btn btn-flagship-red px-3 py-1.5 d-inline-flex align-items-center gap-1.5 shadow-sm">
                        <i class="align-middle" data-feather="check" style="width: 15px; height: 15px;"></i>
                        <span>Lưu danh mục</span>
                    </button>
                    <button type="button" class="btn btn-reset-form px-3 py-1.5" data-bs-toggle="collapse" data-bs-target="#formThemDanhMuc">
                        Hủy
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 3. Bảng danh sách danh mục thương hiệu -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-flagship-head">
                    <tr>
                        <th class="ps-4 py-3 text-center" style="width: 100px;">MÃ DM</th>
                        <th class="py-3" style="min-width: 250px;">TÊN THƯƠNG HIỆU</th>
                        <th class="py-3 text-center" style="width: 200px;">SỐ MẪU ĐIỆN THOẠI</th>
                        <th class="pe-4 py-3 text-center" style="width: 130px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($danhmuc)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="align-middle mb-2 text-muted" data-feather="inbox" style="width: 42px; height: 42px; opacity: 0.4;"></i>
                            <div class="fw-semibold">Chưa có danh mục thương hiệu nào.</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php 
                    foreach ($danhmuc as $d): 
                        $somay = (int)($d["somathang"] ?? 0);
                        $ma_dm = "#DM" . sprintf("%02d", $d["id"]);
                        
                        if($d["id"] == $idsua): // hiển thị form sửa inline
                    ?>
                        <tr style="background-color: #fff9f9;">
                            <form method="post" action="index.php">
                                <input type="hidden" name="action" value="capnhat">
                                <input type="hidden" name="id" value="<?= $d["id"] ?>">
                                <td class="ps-4 text-center">
                                    <span class="badge fw-bold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 11.5px; padding: 4px 8px; border-radius: 6px; font-family: monospace;">
                                        <?= $ma_dm ?>
                                    </span>
                                </td>
                                <td>
                                    <input class="form-control input-flagship" name="ten" type="text" value="<?= htmlspecialchars($d["tendanhmuc"]) ?>" required autofocus style="max-width: 320px;">
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 11.5px;">
                                        <?= $somay ?> mẫu máy
                                    </span>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-flagship-red px-2.5 py-1 d-inline-flex align-items-center gap-1 shadow-sm" type="submit" title="Lưu thay đổi">
                                            <i class="align-middle" data-feather="check" style="width: 14px; height: 14px;"></i>
                                            <span>Lưu</span>
                                        </button>
                                        <a href="index.php" class="btn btn-sm btn-reset-form px-2.5 py-1 text-decoration-none" title="Hủy bỏ">
                                            Hủy
                                        </a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td class="ps-4 text-center">
                                <span class="badge fw-bold" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 11.5px; padding: 4px 8px; border-radius: 6px; font-family: monospace;">
                                    <?= $ma_dm ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2.5">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background-color: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; flex-shrink: 0;">
                                        <i class="align-middle" data-feather="tag" style="width: 15px; height: 15px;"></i>
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark fs-6" style="letter-spacing: -0.2px;">
                                            <?= htmlspecialchars($d["tendanhmuc"]) ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill fw-semibold px-2.5 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; font-size: 12px;">
                                    <?= $somay ?> mẫu máy
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-inline-flex align-items-center gap-2">
                                    <a class="btn-action-neutral btn-edit" href="index.php?action=sua&id=<?= $d["id"] ?>" title="Sửa tên danh mục">
                                        <i class="align-middle" data-feather="edit-2" style="width: 15px; height: 15px;"></i>
                                    </a>
                                    <a class="btn-action-neutral btn-delete" href="index.php?action=xoa&id=<?= $d["id"] ?>" title="Xóa danh mục" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục thương hiệu <?= htmlspecialchars($d['tendanhmuc']) ?> không?');">
                                        <i class="align-middle" data-feather="trash-2" style="width: 15px; height: 15px;"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>
