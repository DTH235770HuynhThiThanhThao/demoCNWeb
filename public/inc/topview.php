<div class="topview-card">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs topview-tabs" role="tablist">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link active tab-noibat" data-bs-toggle="tab" href="#tab-noibat">
                <i class="bi bi-star me-1 d-none d-sm-inline"></i>Nổi bật
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link tab-xemnhieu" data-bs-toggle="tab" href="#tab-xemnhieu">
                <i class="bi bi-eye me-1 d-none d-sm-inline"></i>Xem nhiều
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link tab-banchay" data-bs-toggle="tab" href="#tab-banchay">
                <i class="bi bi-fire me-1 d-none d-sm-inline"></i>Bán chạy
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link tab-moi" data-bs-toggle="tab" href="#tab-moi">
                <i class="bi bi-sparkles me-1 d-none d-sm-inline"></i>Mới về
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-2">
        <!-- Tab 1: Nổi bật -->
        <div id="tab-noibat" class="tab-pane active fade show">
            <?php 
            if(!empty($mathangnoibat)): 
                $rank = 0;
                foreach($mathangnoibat as $x): 
                    $rank++;
                    if($rank > 4) break;
            ?>
                <div class="topview-item">
                    <span class="rank-badge rank-<?php echo $rank; ?>"><?php echo $rank; ?></span>
                    <a class="text-decoration-none d-flex align-items-center flex-grow-1 text-dark overflow-hidden" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
                        <img class="img-thumbnail me-3 rounded flex-shrink-0 bg-white" style="width: 52px; height: 52px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($x["tenmathang"]); ?>">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-1 fw-bold text-truncate" title="<?php echo htmlspecialchars($x["tenmathang"]); ?>"><?php echo $x["tenmathang"]; ?></h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Nổi bật</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <!-- Tab 2: Xem nhiều -->
        <div id="tab-xemnhieu" class="tab-pane fade">
            <?php 
            if(!empty($mathangxemnhieu)): 
                $rank = 0;
                foreach($mathangxemnhieu as $x): 
                    $rank++;
                    if($rank > 4) break;
            ?>
                <div class="topview-item">
                    <span class="rank-badge rank-<?php echo $rank; ?>"><?php echo $rank; ?></span>
                    <a class="text-decoration-none d-flex align-items-center flex-grow-1 text-dark overflow-hidden" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
                        <img class="img-thumbnail me-3 rounded flex-shrink-0 bg-white" style="width: 52px; height: 52px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($x["tenmathang"]); ?>">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-1 fw-bold text-truncate" title="<?php echo htmlspecialchars($x["tenmathang"]); ?>"><?php echo $x["tenmathang"]; ?></h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
                                <small class="text-muted"><i class="bi bi-eye"></i> <?php echo number_format($x["luotxem"]); ?> lượt xem</small>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <!-- Tab 3: Bán chạy -->
        <div id="tab-banchay" class="tab-pane fade">
            <?php 
            if(!empty($mathangbanchay)): 
                $rank = 0;
                foreach($mathangbanchay as $x): 
                    $rank++;
                    if($rank > 4) break;
            ?>
                <div class="topview-item">
                    <span class="rank-badge rank-<?php echo $rank; ?>"><?php echo $rank; ?></span>
                    <a class="text-decoration-none d-flex align-items-center flex-grow-1 text-dark overflow-hidden" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
                        <img class="img-thumbnail me-3 rounded flex-shrink-0 bg-white" style="width: 52px; height: 52px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($x["tenmathang"]); ?>">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-1 fw-bold text-truncate" title="<?php echo htmlspecialchars($x["tenmathang"]); ?>"><?php echo $x["tenmathang"]; ?></h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
                                <small class="text-success fw-semibold"><i class="bi bi-bag-check-fill"></i> Đã bán <?php echo number_format($x["luotmua"]); ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <!-- Tab 4: Sản phẩm mới -->
        <div id="tab-moi" class="tab-pane fade">
            <?php 
            if(!empty($mathangmoi)): 
                $rank = 0;
                foreach($mathangmoi as $x): 
                    $rank++;
                    if($rank > 4) break;
            ?>
                <div class="topview-item">
                    <span class="rank-badge rank-<?php echo $rank; ?>"><?php echo $rank; ?></span>
                    <a class="text-decoration-none d-flex align-items-center flex-grow-1 text-dark overflow-hidden" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">
                        <img class="img-thumbnail me-3 rounded flex-shrink-0 bg-white" style="width: 52px; height: 52px; object-fit: contain;" src="../<?php echo $x["hinhanh"]; ?>" alt="<?php echo htmlspecialchars($x["tenmathang"]); ?>">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="mb-1 fw-bold text-truncate" title="<?php echo htmlspecialchars($x["tenmathang"]); ?>"><?php echo $x["tenmathang"]; ?></h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</span>
                                <span class="badge bg-danger">Mới</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>
