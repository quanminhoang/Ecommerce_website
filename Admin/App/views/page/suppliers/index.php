<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <h1 class="table__title">Danh sách nhà cung cấp</h1>
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
        <div class="table__right">
            <a href="supplier/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-250">Tên</th>
                    <th class="width-320">Email</th>
                    <th class="width-320">Địa chỉ</th>
                    <th class="width-150">Điện thoại</th>
                    <th class="width-200">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($suppliers as $supplier) {
                ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php
                            echo $number;
                            $number++
                            ?>
                        </td>
                        <td class="width-250"><?php echo $supplier['Name'] ?> </td>
                        <td class="width-320"><?php echo $supplier['Email'] ?> </td>
                        <td class="width-320"><?php echo $supplier['Address'] ?></td>
                        <td class="width-150 text-center"><?php echo $supplier['PhoneNumber'] ?></td>
                        <td class="width-200 text-center">
                            <a href="supplier/edit/<?php echo $supplier['ID'] ?>" class="btn-action btn-action--edit">
                                Sửa
                            </a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $supplier['ID'] ?>, 'Bạn có chắc muốn xóa nhà cung cấp này ?','supplier/delete');">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>