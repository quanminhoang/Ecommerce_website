<div class="table-wrapper">
    <div class="table__header">
        <h1 class="table__title">Kết quả tìm kiếm</h1>
        <div class="table__right">
            <a href="category/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-250">Tên danh mục</th>
                    <th class="width-250">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                while ($category = mysqli_fetch_array($categories)) { ?>
                    <tr>
                        <td class='width-100 text-center'> <?php echo $number;
                                                            $number++ ?></td>
                        <td class='width-250 '> <?php echo  $category['Name'] ?> </td>
                        <td class='width-250 text-center'>
                            <a href='category/edit/<?php echo $category['ID'] ?>' class='btn-action btn-action--edit'>Sửa</a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $category['ID'] ?>, 'Bạn có chắc muốn xóa danh mục sản phẩm này ?','category/delete');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>