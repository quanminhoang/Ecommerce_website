<div class="bill">
    <div class="bill__header">
        <div class="btn-status 
                            <?php
                            echo $status = $order['StatusOrder'] == 1 ? 'btn-status--pending' : '';
                            echo $status = $order['StatusOrder'] == 2 ? 'btn-status--success' : '';
                            echo $status = $order['StatusOrder'] == 3 ? 'btn-status--close' : '';
                            ?>
                            ">
            <?php
            echo $status = $order['StatusOrder'] == 1 ? 'Đơn hàng mới' : '';
            echo $status = $order['StatusOrder'] == 2 ? 'Đã duyệt' : '';
            echo $status = $order['StatusOrder'] == 3 ? 'Đã hủy' : '';
            ?>
        </div>
        <p>Hóa đơn <b>#<?php echo $order['ID'] ?></b></p>
    </div>
    <div class="bill__content">
        <div class="bill__top">
            <div class="bill__info">
                <div class="customer__info">
                    <p class="customer__position">Khách hàng</p>
                    <div class="bill__name">Người nhận: <?php echo $order['NameReceive'] ?></div>
                    <div class="bill__phone">Số điện thoại: <?php echo $order['PhoneReceive'] ?></div>
                    <div class="bill__address">Địa chỉ: <?php echo $order['AddressReceive'] ?></div>
                    <div class="bill__note">Ghi chú: <?= $order['Note'] ?: 'Không' ?></div>
                    <div class="bill__note">Phương thức thanh toán: <?php echo $payment = $order['payment'] == 0 ? "COD" : 'MOMO' ?></div>
                    <div class="bill__tie">
                        Thời gian:
                        <?php $date = strtotime($order['OrderDate']);
                        $date = date('H:i:s d/m/Y', $date);
                        echo $date
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bill__bottom"></div>
        <div class="bill__main">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($orderDetail = mysqli_fetch_array($orderDetails)) { ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center"><?php echo $orderDetail['Name']; ?></td>
                            <td class="text-center"><?php echo strtoupper($orderDetail['Size']); ?></td>
                            <td class="text-center"><?php echo $orderDetail['Quantity']; ?></td>
                            <td class="text-center"><?php echo number_format($orderDetail['Price'], 0, '.', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($orderDetail['Price'] * $orderDetail['Quantity'], 0, '.', '.'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="bill__bottom">
            <p class="bill__total">Tổng cộng: <?php echo number_format($order['Total'], 0, '.', '.');  ?></p>
            <div class="bill__action">
                <div style="display:<?php echo $display = $order['StatusOrder'] == 1 ? '' : 'none' ?>">
                    <a href="order/acceptShow/<?php echo $order['ID'] ?>" class="btn-action btn-action--accept">
                        <i class="fa-solid fa-check"></i>
                    </a>
                    <a href="order/destroyShow/<?php echo $order['ID'] ?>" class="btn-action btn-action--destroy">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>