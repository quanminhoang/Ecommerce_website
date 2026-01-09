<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <h1 class="table__title">Danh sách khách hàng</h1>
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
                    <th class="width-100">STT</th>
                    <th class="width-150">Tên</th>
                    <th class="width-150">Ngày sinh</th>
                    <th class="width-150">Điện thoại</th>
                    <th class="width-250">Email</th>
                    <th class="width-320">Địa chỉ</th>
                    <!-- <th class="width-150">Hành động</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($customers as $customer) { ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php echo $number;
                            $number++ ?>
                        </td>
                        <td class="width-150"> <?php echo $customer['Name'] ?> </td>
                        <td class="width-150 text-center">
                            <?php
                            $date = strtotime($customer['Birthday']);
                            $date = date('d/m/Y', $date);
                            echo $date;
                            ?>
                        </td>
                        <td class="width-150 text-center"> <?php echo $customer['PhoneNumber'] ?></td>
                        <td class="width-250"><?php echo $customer['Email'] ?></td>
                        <td class="width-320"><?php echo $customer['Address'] ?></td>

                        <!-- <td class="width-150 text-center">
                            <a href="#!" class="btn-action btn-action--view">Xem chi tiết</a>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>