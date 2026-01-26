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
                    <th class="width-100">Tồn kho</th>
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

                        <td class="width-100 text-center">
                            <?php
                            // Logic: Nếu <= 0 thì hiện chữ Hết hàng màu đỏ
                            if (!isset($product['Quantity']) || $product['Quantity'] <= 0) {
                                echo '<span style="color: red; font-weight: bold;">Hết hàng</span>';
                            } else {
                                echo $product['Quantity'];
                            }
                            ?>
                        </td>

                        <td class="width-150 text-right">
                            <?php
                            // 1. Lấy dữ liệu gốc
                            $price = $product['Price'];
                            $discount = $product['Discount'];

                            // 2. Tính toán lại giá khuyến mãi
                            // Nếu có giảm giá (>0), ta tự tính toán luôn, không phụ thuộc vào database nữa
                            if ($discount > 0) {
                                $promotionPrice = $price - ($price * ($discount / 100));
                            } else {
                                $promotionPrice = $product['PromotionPrice'];
                            }
                            ?>

                            <?php if ($discount > 0) { ?>
                                <span style="text-decoration: line-through; color: #888; font-size: 13px;">
                                    <?php echo number_format($price, 0, '.', '.'); ?> đ
                                </span>
                                <br />
                                <span style="color: #dc3545; font-weight: bold;">
                                    <?php echo number_format($promotionPrice, 0, '.', '.'); ?> đ
                                </span>
                                <br />
                                <small style="color: #dc3545; font-weight: bold;">
                                    - <?php echo $discount ?>%
                                </small>
                            <?php } else { ?>
                                <span style="font-weight: bold; color: #333;">
                                    <?php echo number_format($price, 0, '.', '.'); ?> đ
                                </span>
                            <?php } ?>
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