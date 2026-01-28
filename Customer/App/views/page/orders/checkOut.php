<?php
session_start();

// Kiểm tra giỏ hàng có tồn tại không, nếu không thì đá về trang chủ
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<script>alert("Giỏ hàng đang trống!"); window.location.href="/";</script>';
    exit();
}

$cart = $_SESSION['cart'];
$totalPrice = 0;

// Tính tạm tính để xét phí ship
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

// Logic phí vận chuyển (Theo quy tắc ở trang chi tiết: > 1 triệu freeship)
$shippingFee = ($totalPrice > 1000000) ? 0 : 30000; // Mặc định 30k nếu dưới 1 triệu
$grandTotal = $totalPrice + $shippingFee;
?>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb__container">
            <a href="/">Trang chủ</a>
            <i class="fa-solid fa-angles-right"></i>
            <a href="cart">Giỏ hàng</a>
            <i class="fa-solid fa-angles-right"></i>
            <a>Thanh toán</a>
        </div>
    </div>
</div>

<section class="checkout-page" style="padding: 40px 0; background: #f5f5f5;">
    <div class="container">
        <form action="order/confirm" method="POST"> <div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
                
                <div class="col-left" style="flex: 0 0 60%; max-width: 60%; padding: 0 15px;">
                    <div class="checkout-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; color: #333;">
                            <i class="fa-solid fa-address-card"></i> Thông tin giao hàng
                        </h3>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Họ và tên người nhận <span style="color:red">*</span></label>
                            <input type="text" name="fullname" required placeholder="Nhập họ tên đầy đủ" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Số điện thoại <span style="color:red">*</span></label>
                            <input type="text" name="phone" required placeholder="Nhập số điện thoại" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Email (Tùy chọn)</label>
                            <input type="email" name="email" placeholder="Nhập email để nhận thông báo" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Địa chỉ nhận hàng <span style="color:red">*</span></label>
                            <textarea name="address" required rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" 
                                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                        </div>

                        <div class="form-group" style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Ghi chú đơn hàng</label>
                            <textarea name="note" rows="2" placeholder="Ví dụ: Giao hàng giờ hành chính, gọi trước khi giao..." 
                                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-right" style="flex: 0 0 40%; max-width: 40%; padding: 0 15px;">
                    <div class="checkout-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; color: #333;">
                            <i class="fa-solid fa-cart-arrow-down"></i> Đơn hàng (<?php echo count($cart); ?> sản phẩm)
                        </h3>

                        <div class="order-list" style="max-height: 300px; overflow-y: auto; margin-bottom: 20px;">
                            <?php foreach ($cart as $item): ?>
                                <div class="order-item" style="display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                                    <div class="img" style="width: 60px; height: 60px;">
                                        <img src="../product_img/<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                                    </div>
                                    <div class="info" style="flex: 1;">
                                        <p style="margin: 0; font-weight: 600; font-size: 14px;"><?php echo $item['name']; ?></p>
                                        <p style="margin: 5px 0 0; color: #666; font-size: 13px;">
                                            <?php echo $item['quantity']; ?> x <strong><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</strong>
                                        </p>
                                        <p style="margin: 0; font-size: 12px; color: #888;">Size: <?php echo $item['size']; ?></p>
                                    </div>
                                    <div class="item-total" style="font-weight: bold; font-size: 14px; color: #333;">
                                        <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> đ
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="order-summary" style="border-top: 2px solid #eee; padding-top: 15px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>Tạm tính:</span>
                                <span><?php echo number_format($totalPrice, 0, ',', '.'); ?> đ</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>Phí vận chuyển:</span>
                                <span>
                                    <?php if ($shippingFee == 0): ?>
                                        <span style="color: #28a745;">Miễn phí</span>
                                    <?php else: ?>
                                        <?php echo number_format($shippingFee, 0, ',', '.'); ?> đ
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 15px; font-size: 20px; font-weight: bold; color: #d70018;">
                                <span>Tổng cộng:</span>
                                <span><?php echo number_format($grandTotal, 0, ',', '.'); ?> đ</span>
                            </div>

                            <input type="hidden" name="total_price" value="<?php echo $grandTotal; ?>">
                            
                            <button type="submit" name="btn_checkout" 
                                    style="width: 100%; background: #d70018; color: #fff; padding: 15px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; text-transform: uppercase; cursor: pointer; margin-top: 20px; transition: 0.3s;">
                                Đặt hàng ngay
                            </button>
                            <p style="text-align: center; margin-top: 10px; font-size: 13px; color: #666;">(Thanh toán khi nhận hàng)</p>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>