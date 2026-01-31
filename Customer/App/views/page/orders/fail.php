<div class="container" style="padding: 100px 0;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-danger text-white text-center py-4">
                    <i class="fas fa-times-circle fa-4x mb-3"></i>
                    <h2 class="fw-bold">THANH TOÁN THẤT BẠI</h2>
                </div>
                <div class="card-body p-5 text-center">
                    <p class="fs-5 text-muted">Rất tiếc! Giao dịch của bạn không thể hoàn tất.</p>

                    <div class="alert alert-secondary py-3 my-4">
                        <p class="mb-1 small text-uppercase">Lý do lỗi:</p>
                        <strong class="text-danger">
                            <?php
                            // Giải mã mã lỗi MoMo cơ bản
                            if ($resultCode == 1006) echo "Người dùng đã hủy giao dịch";
                            elseif ($resultCode == 9000) echo "Giao dịch không xác định";
                            else echo "Lỗi hệ thống hoặc số dư không đủ (Mã: $resultCode)";
                            ?>
                        </strong>
                    </div>

                    <p class="mb-4">Sản phẩm vẫn nằm trong giỏ hàng. Bạn có thể thử lại ngay hoặc chọn phương thức thanh toán khác.</p>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="cart" class="btn btn-danger btn-lg px-4 me-sm-2" style="border-radius: 30px;">
                            <i class="fas fa-shopping-cart me-2"></i> Quay lại giỏ hàng
                        </a>
                        <a href="home" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 30px;">
                            Trang chủ
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3 text-muted small">
                    Figure Store - Hệ thống thanh toán an toàn
                </div>
            </div>
        </div>
    </div>
</div>