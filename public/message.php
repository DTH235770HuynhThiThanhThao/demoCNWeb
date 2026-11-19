<?php include("inc/top.php"); ?>

<br><br>
<div class="container">  
  <div class="row"> 
    <h4 class="text-navy">Cảm ơn quý khách <?php echo $hoten; ?>!</h4>   
	<p>Đơn hàng mã số <?php echo $donhang_id; ?> trị giá <strong><?php echo number_format($tongtien) ?>đ</strong> sẽ được giao đến quý khách trong thời gian sớm nhất.<p>
	<p><a href="index.php?action=lichsumuahang" class="btn btn-navy"><i class="bi bi-clock-history me-1"></i> Xem lịch sử mua hàng</a></p>
  </div>  
</div>

<?php include("inc/bottom.php"); ?>