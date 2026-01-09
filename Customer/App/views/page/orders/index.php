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
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Tổng tiền</th>
                            <th>Thành toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_array($orders)) { ?>
                            <tr>
                                <td class="text-center d-block">#<?php echo $order['ID'] ?></td>
                                <td class="text-center"><?php
                                                        echo $status = $order['StatusOrder'] == 1 ? 'Đang Được xử lý' : '';
                                                        echo $status = $order['StatusOrder'] == 2 ? 'Đặt hàng thành công' : '';
                                                        echo $status = $order['StatusOrder'] == 3 ? 'Bị hủy' : '';
                                                        ?></td>
                                <td class="text-center"><?php $date = strtotime($order['OrderDate']);
                                                        $date = date('H:i:s d/m/Y', $date);
                                                        echo $date;
                                                        ?></td>
                                <td class="text-right"><?php echo number_format($order['Total'], 0, '.', '.');  ?> VND</td>
                                <td class="text-center d-block"><?php echo $payment = $order['payment'] == 0 ? "COD" : 'MOMO' ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>