<div class="cart">
    <div class="container">
        <div class="cart__container">
            <div class="cart__title">
                <h1>Giỏ hàng</h1>
            </div>

            <?php
            $total = 0;
            $hasCart = false;
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $hasCart = true;
            }
            ?>

            <?php if ($hasCart): ?>
                <div class="cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-5 text-left"></th>
                                <th class="w-5 text-left">Ảnh sản Phẩm</th>
                                <th class="w-20 text-left">Tên sản phẩm</th>
                                <th class="w-10 text-center">Size</th>
                                <th class="w-15 text-center">Đơn giá</th>
                                <th class="w-10 text-center">Số lượng</th>
                                <th class="w-15 text-center">Thành tiền</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $priceToUse = ($value['PromotionPrice'] > 0) ? $value['PromotionPrice'] : $value['Price'];
                                $subtotal = $priceToUse * $value['Quantity'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td class="w-5 text-center" style="position: relative; vertical-align: middle;">
                                        <a href="order/deleteCart/<?php echo $key; ?>"
                                            class="cart-remove-btn"
                                            onclick="return confirm('Xóa sản phẩm này?')"
                                            style="position: static; color: #333; font-size: 18px;">
                                            <i class="fa-regular fa-xmark"></i>
                                        </a>
                                    </td>
                                    <td class="text-left">
                                        <div class="img">
                                            <img src="../product_img/<?php echo $value['Img'] ?>"
                                                onerror="this.onerror=null;this.src='public/img/image.png';"
                                                alt="Product">
                                        </div>
                                    </td>
                                    <td class="w-20 text-left"><?php echo $value['Name']; ?></td>
                                    <td class="w-10 text-center"><?php echo $value['Size']; ?></td>
                                    <td class="w-15 text-center"><?php echo number_format($priceToUse, 0, '.', '.'); ?> VNĐ</td>
                                    <td class="w-10 text-left">
                                        <div class="qty-box">
                                            <a href="order/updateQuantity/<?php echo $key; ?>/minus"
                                                class="qty-action <?php echo ($value['Quantity'] <= 1) ? 'disabled' : ''; ?>">&minus;</a>

                                            <span class="qty-count"><?php echo $value['Quantity']; ?></span>

                                            <?php if ($value['Quantity'] < $value['Stock']): ?>
                                                <a href="order/updateQuantity/<?php echo $key; ?>/plus" class="qty-action">+</a>
                                            <?php else: ?>
                                                <span class="qty-action disabled" title="Đã đạt giới hạn tồn kho" style="color: #ccc; cursor: not-allowed;">+</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="w-15 price-column text-center" style="font-weight: Bold;">
                                            <?php echo number_format($subtotal, 0, '.', '.') . ' VNĐ'; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="table__bottom">
                        <div class="table__total">
                            <p>Tổng giá sản phẩm</p>
                            <p><?php echo number_format($total, 0, '.', '.'); ?> VNĐ</p>
                        </div>
                        <form class="table__pay" action="order/pay" method="POST">
                            <input type="hidden" name="total" value="<?php echo $total; ?>">
                            <button type="submit" style="cursor: pointer;">Tiến hành thanh toán</button>
                        </form>
                    </div>
                </div>

            <?php else: ?>
                <div class="cart__empty" style="text-align: center; padding: 40px 0;">
                    <p style="font-size: 1rem; color: #666; margin-bottom: 30px;">Không có sản phẩm nào trong giỏ hàng của bạn.</p>

                    <div class="cart__table">
                        <div class="table__bottom" style="margin: 0 auto !important; float: none !important; border-top: none;">
                            <div class="table__pay">
                                <a href="index.php" style="text-decoration: none;">
                                    <button type="button" style="cursor: pointer; width: 250px;">Tiếp tục mua sắm</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>