<?php
include("inc/top.php");
?>

<!-- Banner quảng cáo trang chủ -->
<div class="position-relative mt-3 mb-4 rounded-3 overflow-hidden shadow-sm banner-quang-cao">
    <img src="../images/carousel/h7.jpg" class="w-100 d-block banner-img" alt="Chương trình khuyến mãi">
    <a href="#danh-sach-san-pham" class="btn btn-danger btn-buy-now position-absolute fw-bold text-uppercase rounded-pill shadow text-white">
        MUA NGAY <i class="bi bi-cart-plus-fill ms-1"></i>
    </a>
</div>

<style>
html {
    scroll-behavior: smooth;
}
#danh-sach-san-pham {
    scroll-margin-top: 80px;
}
.banner-quang-cao .banner-img {
    height: 280px;
    max-height: 280px;
    object-fit: cover;
    object-position: center;
}
.btn-buy-now {
    left: 73%;
    bottom: 14px;
    padding: 6px 20px;
    font-size: 0.9rem;
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    border: none;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    letter-spacing: 0.5px;
    white-space: nowrap;
}
.btn-buy-now:hover {
    transform: scale(1.08) !important;
    box-shadow: 0 8px 20px rgba(255, 65, 108, 0.5) !important;
    color: #fff !important;
}
@media (max-width: 576px) {
    .banner-quang-cao .banner-img {
        height: 140px;
        max-height: 140px;
    }
    .btn-buy-now {
        left: 65%;
        bottom: 8px;
        font-size: 0.75rem !important;
        padding: 4px 14px !important;
    }
}
</style>

<!-- Danh sách sản phẩm bắt đầu từ Apple -->
<div id="danh-sach-san-pham" style="scroll-margin-top: 80px;">
<?php 
foreach($danhmuc as $d){ 
    $i = 0;
?>
<h3><a class="text-decoration-none text-navy" href="index.php?action=group&id=<?php echo $d["id"]; ?>">
    <?php echo $d["tendanhmuc"]; ?></a></h3>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
<?php 
    foreach($mathang as $m){ 
        if($m["danhmuc_id"] == $d["id"] && $i < 4){
            $i++;
?>
    <div class="col mb-5">
        <div class="card h-100 shadow">
            <!-- Sale badge-->
            <?php if ($m["giaban"] != $m["giagoc"]){ ?>
            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
            <?php } // end if ?>
            <!-- Product image-->
            <a href="index.php?action=detail&id=<?php echo $m["id"]; ?>">
                <img class="card-img-top" src="../<?php echo $m["hinhanh"]; ?>" alt="<?php echo $m["tenmathang"]; ?>" />
            </a>
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <a class="text-decoration-none" href="index.php?action=detail&id=<?php echo $m["id"]; ?>"><h5 class="fw-bolder text-navy"><?php echo $m["tenmathang"]; ?></h5></a>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    <?php if ($m["giaban"] != $m["giagoc"]){ ?>
                    <span class="text-muted text-decoration-line-through"><?php echo number_format($m["giagoc"]); ?>đ</span><?php } // end if ?>
                    <span class="text-danger fw-bolder"><?php echo number_format($m["giaban"]); ?>đ</span>
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-navy mt-auto" href="index.php?action=chovaogio&id=<?php echo $m["id"]; ?>">Chọn mua</a></div>
            </div>
        </div>
    </div>
<?php
        }
    } 
?>
              
</div>
<?php 
    if($i == 0) 
        echo "<p>Danh mục hiện chưa có sản phẩm.</p>";
    else 
?>
        <div class="text-end mb-2"><a class="text-warning text-decoration-none fw-bolder" href="index.php?action=group&id=<?php echo $d["id"]; ?>">Xem thêm <?php echo $d["tendanhmuc"]; ?></a></div>
<?php
} 
?>
</div>

<?php
include("inc/bottom.php");
?>