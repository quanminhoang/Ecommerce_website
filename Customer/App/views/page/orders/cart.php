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
                        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
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
                        <button type="submit">Tiến hành thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>