<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <h1 class="table__title">Danh sách danh mục</h1>
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
            <a href="category/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th>Tên danh mục</th>
                    <th class="width-250">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($categories as $category) { ?>
                    <tr>
                        <td class='width-100 text-center'> <?php echo $number;
                                                            $number++ ?></td>
                        <td class="text-center"> <?php echo $category['Name'] ?> </td>
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