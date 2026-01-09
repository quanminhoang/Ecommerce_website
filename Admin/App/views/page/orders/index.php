<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <h1 class="table__title">Danh sách đơn đặt hàng</h1>
            <div class="select_page">
                <select id="rowsPerPage">
                    <option value="10">10</option>
                    <option selected value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">Mã đơn</th>
                    <th class="width-150">Thời gian</th>
                    <th class="width-150">Trạng thái</th>
                    <th class="width-200">Tên Người đặt</th>
                    <th class="width-200">Tên Người nhận</th>
                    <th class="width-200">Số điện thoại người nhận</th>
                    <th class="width-200">Địa chỉ người nhận</th>
                    <th class="width-200">Tổng tiền</th>
                    <th class="width-200">Xác nhận</th>
                    <th class="width-150">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_array($orders)) { ?>
                    <tr>
                        <td class="width-50 text-center">#<?php echo $order['ID'] ?></td>
                        <td class="width-150 text-center">
                            <?php $date = strtotime($order['OrderDate']);
                            $date = date('H:i:s d/m/Y', $date);
                            echo $date;
                            ?>
                        </td>
                        <td class="width-150">
                            <p class="btn-status 
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
                            </p>
                        </td>
                        <td class="width-200"><?php echo $order['Name'] ?></td>
                        <td class="width-200"><?php echo $order['NameReceive'] ?></td>
                        <td class="width-200"><?php echo $order['PhoneReceive'] ?></td>
                        <td class="width-200"><?php echo $order['AddressReceive'] ?></td>
                        <td class="width-200 text-right">
                            <?php echo number_format($order['Total'], 0, '.', '.');  ?></td>
                        <td class="width-200 text-center">
                            <p style="display:<?php echo $display = $order['StatusOrder'] == 1 ? '' : 'none' ?>">
                                <a href="order/accept/<?php echo $order['ID'] ?>" class="btn-action btn-action--accept">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                                <a href="order/destroy/<?php echo $order['ID'] ?>" class="btn-action btn-action--destroy">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </p>
                            <p style="display:<?php echo $display = $order['StatusOrder'] != 1 ? '' : 'none' ?>">
                                <a class="btn-action btn-action--disable">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </p>
                        </td>
                        <td class="width-150 text-center">
                            <a href="order/show/<?php echo $order['ID'] ?>" class="btn-action btn-action--view">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>