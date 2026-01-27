<div class="cart">
    <div class="container">
        <div class="cart__container">
            <div class="cart__title">
                <h1>Thông tin giỏ hàng</h1>
            </div>
            <div class="cart__table">
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th lass="w-10">Size</th>
                            <th lass="w-10">Đơn giá</th>
                            <th class="w-10">Số lượng</th>
                            <th lass="w-10">Thành tiền</th>
                            <th class="w-30">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        // Biến kiểm tra giỏ hàng có trống không
                        $hasCart = false; 

                        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            $hasCart = true; // Đánh dấu là có hàng
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $priceToUse = $value['PromotionPrice'] > 0 ? $value['PromotionPrice'] : $value['Price'];
                                $total += $priceToUse * $value['Quantity'];
                        ?>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <img src="../product_img/<?php echo $value['Img'] ?>" alt="">
                                        </div>
                                        <p><?php echo $value['Name'] ?></p>
                                    </td>
                                    <td class="w-10 text-right">
                                        <?php echo $value['Size']; ?>
                                    </td>
                                    <td class="w-10 text-right">
                                        <?php echo number_format($value['PromotionPrice'], 0, '.', '.');  ?>
                                    </td>
                                    <td class="w-10 text-center">
                                        <?php echo $value['Quantity']; ?>
                                    </td>
                                    <td class="w-10 text-right"><?php echo
                                                                number_format($value['PromotionPrice'] * $value['Quantity'], 0, ',', ',');
                                                                ?></td>
                                    <td class="w-30 text-center">
                                        <a href="order/deleteCart/<?php echo $key; ?>">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            // Hiển thị thông báo nếu giỏ hàng trống (Tuỳ chọn)
                            echo '<tr><td colspan="6" style="text-align:center; padding: 20px;">Giỏ hàng của bạn đang trống!</td></tr>';
                        } ?>
                    </tbody>
                </table>
                
                <div class="table__bottom">
                    <div class="table__total">
                        <p>Tổng giá sản phẩm</p>
                        <p><?php echo number_format($total, 0, '.', '.');  ?></p>
                    </div>
                    <form class="table__pay" action="order/pay" method="POST">
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                        
                        <?php if ($hasCart): ?>
                            <button type="submit" style="cursor: pointer; opacity: 1;">Tiến hành thanh toán</button>
                        <?php else: ?>
                            <button type="button" disabled style="cursor: not-allowed; opacity: 0.5; background-color: #ccc;">Tiến hành thanh toán</button>
                        <?php endif; ?>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>