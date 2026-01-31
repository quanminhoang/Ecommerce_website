<div class="bill">
    <div class="bill__header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px;">

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
                $bgColor = '#3498db'; // Màu xanh dương cho đang giao
                break;
            case 5:
                $statusText = 'Giao thành công';
                $bgColor = '#27ae60';
                break;
        }
        ?>

        <div style="background-color: <?php echo $bgColor; ?>; color: white; padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
            <?php echo $statusText; ?>
        </div>

        <p style="margin: 0; font-size: 20px; font-weight: 700;">Hóa đơn <b>#<?php echo $order['ID'] ?></b></p>
    </div>

    <div class="bill__content">
        <div class="bill__top">
            <div class="bill__info bill__info-container">
                <div class="customer__info">
                    <p class="customer__position">Thông tin nhận hàng</p>
                    <div class="bill__name">Người nhận: <b><?php echo $order['NameReceive'] ?></b></div>
                    <div class="bill__phone">Số điện thoại: <?php echo $order['PhoneReceive'] ?></div>
                    <div class="bill__address">Địa chỉ: <?php echo $order['AddressReceive'] ?></div>
                    <div class="bill__note">Phương thức: <b><?php echo $order['payment'] == 0 ? "COD (Tiền mặt)" : 'MOMO' ?></b></div>
                </div>

                <div class="customer__info">
                    <p class="customer__position">Thông tin đơn hàng</p>
                    <div class="bill__tie">
                        Thời gian đặt: <b><?php $date = strtotime($order['OrderDate']);
                                            echo date('H:i:s d/m/Y', $date); ?></b>
                    </div>
                    <div class="bill__note">Ghi chú: <i style="color: #666;"><?= $order['Note'] ?: 'Không có' ?></i></div>
                </div>
            </div>
        </div>

        <div class="bill__main">
            <table>
                <thead>
                    <tr>
                        <th class="text-left" width="5%">#</th>
                        <th class="text-left" width="15%">Hình ảnh</th>
                        <th width="30%">Sản phẩm</th>
                        <th class="text-center" width="10%">Size</th>
                        <th class="text-center" width="10%">Số lượng</th>
                        <th class="text-center" width="15%">Giá</th>
                        <th class="text-center" width="15%">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totalQuantity = 0;
                    if (mysqli_num_rows($orderDetails) > 0) {
                        mysqli_data_seek($orderDetails, 0);
                        while ($orderDetail = mysqli_fetch_array($orderDetails)) { // Biến là $orderDetail
                            $totalQuantity += $orderDetail['Quantity'];
                    ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-center">
                                    <img src="../product_img/<?php echo $orderDetail['img'] ?>"
                                        onerror="this.onerror=null;this.src='public/img/ErrImg.png';"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td style="font-weight: 500; vertical-align: middle;"><?php echo $orderDetail['Name']; ?></td>
                                <td class="text-center"><?php echo strtoupper($orderDetail['Size']); ?></td>
                                <td class="text-center"><?php echo $orderDetail['Quantity']; ?></td>
                                <td class="text-center"><?php echo number_format($orderDetail['Price'], 0, '.', '.'); ?> đ</td>
                                <td class="text-center" style="font-weight: bold;"><?php echo number_format($orderDetail['Price'] * $orderDetail['Quantity'], 0, '.', '.'); ?> đ</td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="bill__bottom">
            <div class="bill__summary">
                <div class="summary__item">
                    <span>Tổng số lượng:</span>
                    <b><?php echo $totalQuantity; ?> sản phẩm</b>
                </div>
                <div class="summary__item total-price">
                    <span>Tổng thanh toán:</span>
                    <b class="price-value"><?php echo number_format($order['Total'], 0, '.', '.'); ?> VND</b>
                </div>
            </div>

            <div class="bill__action">
                <?php if ($order['StatusOrder'] == 1): ?>
                    <a href="order/acceptShow/<?php echo $order['ID'] ?>"
                        class="btn-bill btn-bill--accept"
                        onclick="return confirm('Xác nhận DUYỆT đơn hàng này?');">
                        <i class="fa-solid fa-check"></i> Duyệt đơn ngay
                    </a>
                    <a href="order/destroyShow/<?php echo $order['ID'] ?>"
                        class="btn-bill btn-bill--destroy"
                        onclick="return confirm('Xác nhận HỦY đơn hàng này?');">
                        <i class="fa-solid fa-xmark"></i> Hủy đơn hàng
                    </a>

                <?php elseif ($order['StatusOrder'] == 2): ?>
                    <a href="order/shippingShow/<?php echo $order['ID'] ?>"
                        class="btn-bill btn-bill--shipping"
                        onclick="return confirm('Bắt đầu giao hàng cho đơn này?');">
                        <i class="fa-solid fa-truck-fast"></i> Bắt đầu giao hàng
                    </a>

                <?php elseif ($order['StatusOrder'] == 4): ?>
                    <a href="order/completedShow/<?php echo $order['ID'] ?>"
                        class="btn-bill btn-bill--complete"
                        onclick="return confirm('Xác nhận khách đã nhận được hàng và thanh toán?');">
                        <i class="fa-solid fa-box-open"></i> Hoàn tất đơn hàng
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>