<div class="table-wrapper">
    <div class="table__header">
        <h1 class="table__title">Kết quả tìm kiếm</h1>
        <div class="table__right">
            <a href="brand/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>
    <div class="table-container">
        <table class="content-table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th>Tên</th>
                    <th class="width-200">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                while ($brand = mysqli_fetch_array($brands)) {
                ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php
                            echo $number;
                            $number++;
                            ?>
                        </td>
                        <td class="text-center"> <?php echo $brand['Name'] ?> </td>
                        <td class="width-200 text-center">
                            <a href="brand/edit/<?php echo $brand['ID'] ?>" class="btn-action btn-action--edit">Sửa</a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $brand['ID'] ?>, 'Bạn có chắc muốn xóa hãng sản phẩm này ?','brand');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>