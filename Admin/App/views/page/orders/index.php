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
                    <th class="width-200">ID khách hàng</th>
                    <th class="width-200">Tên người nhận</th>
                    <th class="width-200">Số điện thoại</th>
                    <th class="width-200">Địa chỉ</th>
                    <th class="width-200">Tổng tiền</th>
                    <th class="width-200">Duyệt nhanh</th>
                    <th class="width-150"></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_array($orders)) { ?>
                    <tr>
                        <td class="width-50 text-left">#O<?php echo $order['ID'] ?></td>
                        <td class="width-150 text-left">
                            <?php $date = strtotime($order['OrderDate']);
                            $date = date('H:i:s d/m/Y', $date);
                            echo $date;
                            ?>
                        </td>
                        <td class="width-150 text-left">
                            <p class="btn-status 
                    <?php
                    // Giữ class cũ cho 3 trạng thái đầu
                    if ($order['StatusOrder'] == 1) echo 'btn-status--pending';
                    elseif ($order['StatusOrder'] == 2) echo 'btn-status--success';
                    elseif ($order['StatusOrder'] == 3) echo 'btn-status--close';
                    ?>"

                                <?php
                                if ($order['StatusOrder'] == 4) {
                                    echo 'style="background-color: #f39c12 !important; color: #fff; border: none;"';
                                } elseif ($order['StatusOrder'] == 5) {
                                    echo 'style="background-color: #16a085 !important; color: #fff; border: none;"';
                                }
                                ?>>

                                <?php
                                // Hiển thị chữ
                                if ($order['StatusOrder'] == 1) echo 'Đơn hàng mới';
                                elseif ($order['StatusOrder'] == 2) echo 'Đã duyệt';
                                elseif ($order['StatusOrder'] == 3) echo 'Đã hủy';
                                elseif ($order['StatusOrder'] == 4) echo 'Đang giao hàng';
                                elseif ($order['StatusOrder'] == 5) echo 'Giao thành công';
                                ?>
                            </p>
                        </td>
                        <td class="width-200 text-left">#U<?php echo $order['CustomerID'] ?></td>
                        <td class="width-200 text-left"><?php echo $order['NameReceive'] ?></td>
                        <td class="width-200 text-left"><?php echo $order['PhoneReceive'] ?></td>
                        <td class="width-200 text-left"><?php echo $order['AddressReceive'] ?></td>
                        <td class="width-200 text-left">
                            <?php echo number_format($order['Total'], 0, '.', '.');  ?></td>
                        <td class="width-200">
                            <?php if ($order['StatusOrder'] == 1): ?>
                                <p style="display: flex; gap: 8px;">
                                    <a href="order/accept/<?php echo $order['ID'] ?>"
                                        class="btn-action btn-action--accept"
                                        onclick="if(confirm('Xác nhận DUYỆT đơn hàng này?')) { alert('Xong'); return true; } return false;">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                    <a href="order/destroy/<?php echo $order['ID'] ?>"
                                        class="btn-action btn-action--destroy"
                                        onclick="if(confirm('Bạn có chắc chắn muốn HỦY đơn hàng này?')) { alert('Xong'); return true; } return false;">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </p>

                            <?php else: ?>
                                <span>
                                    Xong
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="width-150 text-center">
                            <a href="order/show/<?php echo $order['ID'] ?>" class="btn-action btn-action--view">Xem chi tiết</a>
                        </td>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>