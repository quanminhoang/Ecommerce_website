<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <div class="table__top">
                <h1 class="table__title">Danh sách sản phẩm</h1>
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
        <div class="table__right">
            <a href="product/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-150">Nổi bật</th>
                    <th class="width-200">Hình ảnh</th>
                    <th class="width-320">Tên</th>
                    <th class="width-150">Danh mục</th>
                    <th class="width-150">Giá</th>
                    <th class="width-250">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                while ($product = mysqli_fetch_array($products)) { ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php echo $number;
                            $number++; ?>
                        </td>
                        <td class="width-150 text-center"><?php echo $hot = $product['Hot'] == 1 ? 'Có' : 'Không' ?></td>
                        <td class="width-100"> <img src="../product_img/<?php echo $product['Img'] ?>" alt=""></td>
                        <td class=""><?php echo $product['productName'] ?> </td>
                        <td class="width-150"><?php echo $product['categoryName'] ?> </td>
                        <td class="width-150 text-right">
                            <b style="text-decoration: line-through;">
                                <?php echo number_format($product['Price'], 0, '.', '.');  ?>
                            </b>
                            <br />
                            <?php echo number_format($product['PromotionPrice'], 0, '.', '.');  ?>
                            <br />
                            <b style="color:#ff0000; <?php echo $discount = $product['Discount'] == 0 ? 'display: none;' : '' ?>">
                                - <?php echo $product['Discount'] . '%' ?>
                            </b>
                        </td>
                        <td class="width-250 text-center">
                            <a href="product/edit/<?php echo $product['ID'] ?>" class="btn-action btn-action--edit">Chi tiết</a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $product['ID'] ?>, 'Bạn có chắc muốn xóa sản phẩm này ?','product/delete');">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>