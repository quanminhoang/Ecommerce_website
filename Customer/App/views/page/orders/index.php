<div class="cart">
    <div class="container">
        <div class="cart__container">
            <div class="cart__title">
                <h1>Lịch sử mua hàng</h1>
            </div>
            <div class="cart__table">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">Mã đơn</th>
                            <th class="text-center">Trạng thái</th> 
                            <th class="text-center">Thời gian</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Kiểm tra nếu có đơn hàng
                        if (isset($orders) && mysqli_num_rows($orders) > 0) {
                            while ($order = mysqli_fetch_array($orders)) { 
                        ?>
                            <tr>
                                <td class="text-center">#<?php echo $order['ID'] ?></td>
                                
                                <td class="text-center">
                                    <?php 
                                    // LOGIC HIỂN THỊ TRẠNG THÁI MỚI
                                    if ($order['StatusOrder'] == 1) {
                                        echo '<span style="color: #ff9800; font-weight: bold;">Chờ xử lý</span>';
                                    } 
                                    elseif ($order['StatusOrder'] == 2) {
                                        echo '<span style="color: #27ae60; font-weight: bold;">Đã duyệt</span>';
                                    } 
                                    elseif ($order['StatusOrder'] == 3) {
                                        echo '<span style="color: red; font-weight: bold;">Đã hủy</span>';
                                    } 
                                    elseif ($order['StatusOrder'] == 4) {
                                        // Màu xanh dương cho đang giao
                                        echo '<span style="color: #2980b9; font-weight: bold;">Đang giao hàng</span>';
                                    } 
                                    elseif ($order['StatusOrder'] == 5) {
                                        // Màu xanh lá đậm cho hoàn thành
                                        echo '<span style="color: #16a085; font-weight: bold;">Giao thành công</span>';
                                    } 
                                    else {
                                        echo '<span style="color: #333;">Không xác định</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <?php 
                                    $date = strtotime($order['OrderDate']);
                                    echo date('H:i:s d/m/Y', $date);
                                    ?>
                                </td>
                                
                                <td class="text-center" style="color: #d35400; font-weight: bold;">
                                    <?php echo number_format($order['Total'], 0, '.', '.'); ?> VND
                                </td>
                                
                                <td class="text-center">
                                    <?php echo ($order['payment'] == 0) ? "Thanh toán khi nhận hàng (COD)" : 'Thanh toán MOMO' ?>
                                </td>
                            </tr>
                        <?php 
                            } 
                        } else {
                        ?>
                            <tr>
                                <td colspan="5" class="text-center">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>