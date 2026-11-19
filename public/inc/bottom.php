            </div>
        </section>
        
        <!-- Top products -->

        <section class="mb-3">            
            <div class="container-fluid">
                <div class="row align-items-stretch">                    
                    <div class="col-md-6 mb-3 mb-md-0 d-flex flex-column">
                        <?php include("inc/carousel.php"); ?>    
                    </div>
                    <div class="col-md-6 d-flex flex-column">
                        <?php include("inc/topview.php"); ?>
                    </div>
                </div>
            </div>
        </section> 

        <!-- Footer-->
        <footer class="py-5 bg-navy">
            <style>
            .footer-link { transition: color 0.18s, padding-left 0.18s; }
            .footer-link:hover { color: #fff !important; padding-left: 4px; }
            footer hr { border-color: rgba(255,255,255,0.15); }
            </style>

            <div class="text-center mb-5"><a class="text-warning" href="#top"><i class="bi bi-chevron-up"  style="font-size: 3rem; font-weight: bold; color:white;"></i></a></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-light">
                        <a href="index.php" class="text-decoration-none text-white">
                            <div class="d-flex align-items-center mb-3">
                                <img src="../images/logo/logo.jpg" alt="Thanh Thảo Shop" class="rounded-3 me-3 shadow-sm" style="height: 64px; width: 64px; object-fit: cover;">
                                <h5 class="mb-0 fw-bold">Thanh Thảo Shop - Cửa hàng điện thoại</h5>
                            </div>
                        </a>
                        <p><b><i>Địa chỉ:</i></b> 18 Ung Văn Khiêm, phường Đông Xuyên, TP Long Xuyên, An Giang<br>
                            <b><i>Điện thoại:</i></b> 076 3841190<br> 
                            <b><i>Email:</i></b> abc@abc.com</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-white fw-bold mb-3">DANH MỤC HÀNG</h4>
                        <?php foreach ($danhmuc as $d): ?>
                            <a class="d-block text-decoration-none text-white-50 footer-link mb-1"
                               href="?action=group&id=<?php echo $d["id"]; ?>">
                                <i class="bi bi-chevron-right me-1" style="font-size:0.75rem;"></i><?php echo $d["tendanhmuc"]; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-white fw-bold mb-3">DỊCH VỤ KHÁCH HÀNG</h4>
                        <a href="#" class="d-block text-decoration-none text-white-50 footer-link mb-1">
                            <i class="bi bi-chevron-right me-1" style="font-size:0.75rem;"></i>Hướng dẫn mua hàng
                        </a>
                        <a href="#" class="d-block text-decoration-none text-white-50 footer-link mb-1">
                            <i class="bi bi-chevron-right me-1" style="font-size:0.75rem;"></i>Câu hỏi thường gặp
                        </a>
                        <a href="#" class="d-block text-decoration-none text-white-50 footer-link mb-1">
                            <i class="bi bi-chevron-right me-1" style="font-size:0.75rem;"></i>Liên hệ với chúng tôi
                        </a>
                        <a href="../admin/index.php" class="d-block text-decoration-none text-white-50 footer-link mb-1">
                            <i class="bi bi-shield-lock me-1"></i>Quản trị hệ thống
                        </a>
                    </div>
                </div>
                <hr>
                <p class="m-0 text-center text-warning fw-bolder">Copyright &copy; Thanh Thảo Shop 2026</p>
            </div>
        </footer>

    </body>
</html>
