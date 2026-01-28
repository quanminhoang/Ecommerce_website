<div class="bill">
    <div class="bill__header">
        <div class="btn-status 
            <?php
            // Xử lý màu sắc hiển thị trạng thái
            if ($order['StatusOrder'] == 1) echo 'btn-status--pending'; // Màu vàng/cam
            elseif ($order['StatusOrder'] == 2) echo 'btn-status--success'; // Màu xanh lá (Đã duyệt)
            elseif ($order['StatusOrder'] == 3) echo 'btn-status--close';   // Màu đỏ (Đã hủy)
            elseif ($order['StatusOrder'] == 4) echo 'btn-status--pending'; // Màu cam/xanh dương (Đang giao - Dùng tạm class pending hoặc tạo class mới)
            elseif ($order['StatusOrder'] == 5) echo 'btn-status--success'; // Màu xanh lá (Hoàn thành)
            ?>
        " style="<?php if($order['StatusOrder'] == 4) echo 'background-color: #3498db; color: white;'; ?>"> 
        <?php
            // Xử lý chữ hiển thị
            if ($order['StatusOrder'] == 1) echo 'Đơn hàng mới';
            elseif ($order['StatusOrder'] == 2) echo 'Đã duyệt - Chờ giao';
            elseif ($order['StatusOrder'] == 3) echo 'Đã hủy';
            elseif ($order['StatusOrder'] == 4) echo 'Đang giao hàng';
            elseif ($order['StatusOrder'] == 5) echo 'Giao thành công';
            ?>
        </div>
        <p>Hóa đơn <b>#<?php echo $order['ID'] ?></b></p>
    </div>

    <div class="bill__content">
        <div class="bill__top">
            <div class="bill__info">
                <div class="customer__info">
                    <p class="customer__position">Thông tin khách hàng</p>
                    <div class="bill__name">Người nhận: <b><?php echo $order['NameReceive'] ?></b></div>
                    <div class="bill__phone">Số điện thoại: <?php echo $order['PhoneReceive'] ?></div>
                    <div class="bill__address">Địa chỉ: <?php echo $order['AddressReceive'] ?></div>
                    <div class="bill__note">Ghi chú: <i style="color: #666;"><?= $order['Note'] ?: 'Không có' ?></i></div>
                    <div class="bill__note">Phương thức thanh toán: <b><?php echo $payment = $order['payment'] == 0 ? "COD (Tiền mặt)" : 'MOMO' ?></b></div>
                    <div class="bill__tie">
                        Thời gian đặt:
                        <?php $date = strtotime($order['OrderDate']); echo date('H:i:s d/m/Y', $date); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bill__main">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="15%">Hình ảnh</th>
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
                    // Reset lại con trỏ dữ liệu nếu cần, hoặc đảm bảo biến $orderDetails chưa bị chạy hết
                    if (mysqli_num_rows($orderDetails) > 0) {
                        mysqli_data_seek($orderDetails, 0); // Đưa con trỏ về đầu
                        while ($orderDetail = mysqli_fetch_array($orderDetails)) {
                            $totalQuantity += $orderDetail['Quantity'];
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center">
                                <img src="/Ecommerce_website/product_img/<?php echo $orderDetail['img'] ?>"
                                    alt="Img" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
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
            <div class="bill__summary" style="text-align: right; padding-right: 20px;">
                <p>Tổng số lượng: <b><?php echo $totalQuantity; ?></b> sản phẩm</p>
                <p class="bill__total" style="font-size: 20px; color: #d35400;">
                    Tổng tiền thanh toán: <b><?php echo number_format($order['Total'], 0, '.', '.'); ?> VND</b>
                </p>
            </div>

            <div class="bill__action">
                
                <?php if ($order['StatusOrder'] == 1): ?>
                    <a href="order/acceptShow/<?php echo $order['ID'] ?>"
                        class="btn-action btn-action--accept"
                        onclick="return confirm('Xác nhận DUYỆT đơn hàng này?');">
                        <i class="fa-solid fa-check"></i> Duyệt đơn
                    </a>
                    <a href="order/destroyShow/<?php echo $order['ID'] ?>"
                        class="btn-action btn-action--destroy"
                        onclick="return confirm('Xác nhận HỦY đơn hàng này?');">
                        <i class="fa-solid fa-xmark"></i> Hủy đơn
                    </a>

                <?php elseif ($order['StatusOrder'] == 2): ?>
                    <a href="order/shippingShow/<?php echo $order['ID'] ?>"
                        class="btn-action"
                        style="background-color: #3498db; color: white;"
                        onclick="return confirm('Bắt đầu giao hàng cho đơn này?');">
                        <i class="fa-solid fa-truck-fast"></i> Bắt đầu giao hàng
                    </a>

                <?php elseif ($order['StatusOrder'] == 4): ?>
                    <a href="order/completedShow/<?php echo $order['ID'] ?>"
                        class="btn-action"
                        style="background-color: #27ae60; color: white;"
                        onclick="return confirm('Xác nhận khách đã nhận được hàng và thanh toán?');">
                        <i class="fa-solid fa-box-open"></i> Khách đã nhận hàng (Hoàn tất)
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>