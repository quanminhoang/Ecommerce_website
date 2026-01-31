<div class="cart">
    <div class="container">
        <div class="cart__container">
            <div class="cart__title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #f4f4f4; padding-bottom: 15px;">
                <div>
                    <h1 style="font-size: 1.2rem; color: #333; margin: 0;">Đơn hàng #O<?php echo $order['ID'] ?></h1>
                </div>

                <?php
                $statusText = '';
                $bgColor = '#ccc';

                switch ($order['StatusOrder']) {
                    case 1:
                        $statusText = 'Chờ xác nhận';
                        $bgColor = '#f39c12';
                        break;
                    case 2:
                        $statusText = 'Đã duyệt';
                        $bgColor = '#f39c12';
                        break;
                    case 3:
                        $statusText = 'Đã hủy';
                        $bgColor = '#e74c3c';
                        break;
                    case 4:
                        $statusText = 'Đang giao hàng';
                        $bgColor = '#27ae60';
                        break;
                    case 5:
                        $statusText = 'Giao thành công';
                        $bgColor = '#27ae60';
                        break;
                }
                ?>

                <div style="background-color: <?php echo $bgColor; ?>; color: white; padding: 8px 20px; border-radius: 20px; font-weight: 600; font-size: 0.9rem; text-transform: uppercase;">
                    <?php echo $statusText; ?>
                </div>
            </div>
        </div>

        <div style="background: #fdfdfd; border: 1px solid #eee; padding: 25px; border-radius: 10px; margin-bottom: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <h3 style="margin-bottom: 15px; color: #333; border-left: 4px solid #d35400; padding-left: 10px;">Thông tin nhận hàng</h3>
                <p style="margin: 5px 0;"><b>Người nhận:</b> <?php echo $order['NameReceive'] ?></p>
                <p style="margin: 5px 0;"><b>Số điện thoại:</b> <?php echo $order['PhoneReceive'] ?></p>
                <p style="margin: 5px 0;"><b>Địa chỉ:</b> <?php echo $order['AddressReceive'] ?></p>
            </div>
            <div>
                <h3 style="margin-bottom: 15px; color: #333; border-left: 4px solid #d35400; padding-left: 10px;">Thanh toán & Thời gian</h3>
                <p style="margin: 5px 0;"><b>Phương thức:</b> <?php echo $order['payment'] == 0 ? "Thanh toán khi nhận hàng (COD)" : 'Thanh toán MOMO' ?></p>
                <p style="margin: 5px 0;"><b>Ngày đặt:</b> <?php echo date('d/m/Y H:i', strtotime($order['OrderDate'])); ?></p>
            </div>
        </div>

        <div class="cart__table">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-left">Hình ảnh</th>
                        <th class="text-left">Tên sản phẩm</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Giá sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totalQty = 0;
                    mysqli_data_seek($orderDetails, 0);
                    while ($detail = mysqli_fetch_array($orderDetails)):
                        $subtotal = $detail['Price'] * $detail['Quantity'];
                        $totalQty += $detail['Quantity'];
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-left">
                                <div class="product-img">
                                    <img src="../product_img/<?php echo $detail['img'] ?>"
                                        onerror="this.onerror=null;this.src='public/img/image.png';" style="width: 50px;">
                                </div>
                            </td>
                            <td class="text-left"><b><?php echo $detail['Name'] ?></b></td>
                            <td class="text-center"><?php echo strtoupper($detail['Size']) ?></td>
                            <td class="text-center"><?php echo number_format($detail['Price'], 0, '.', '.') ?> VNĐ</td>
                            <td class="text-center"><?php echo $detail['Quantity'] ?></td>
                            <td class="text-center" style="font-weight: bold;">
                                <?php echo number_format($subtotal, 0, '.', '.') ?> VNĐ
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

                <tfoot style="background: white; font-weight: bold; border-top: 2px solid #eee">
                    <tr>
                        <td colspan="5" style="text-align: right; padding: 20px 15px; color: #555;">Tổng số lượng:</td>
                        <td colspan="2" style="text-align: right; padding: 10px 30px; color: #333;">
                            <?php echo $totalQty ?> sản phẩm
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right; padding: 10px 15px; color: #555;">Tổng thanh toán:</td>
                        <td colspan="2" style="text-align: right; padding: 10px 30px; color: #d35400; font-size: 1.2rem;">
                            <?php echo number_format($order['Total'], 0, '.', '.') ?> VNĐ
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="order-footer">
                <a href="order/sayHi" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Quay lại lịch sử
                </a>

                <div class="table__pay">
                    <?php if ($order['StatusOrder'] == 1 || $order['StatusOrder'] == 2): ?>
                        <a href="order/cancelOrder/<?php echo $order['ID'] ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">
                            <button type="button" class="btn-cancel">Hủy đơn hàng</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>