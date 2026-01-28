<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb__container">
            <a href="product">Sản Phẩm</a>
            <i class="fa-solid fa-angles-right"></i>
            <a><?php echo $product['Name'] ?></a>
        </div>
    </div>
</div>

<section class="productDetail">
    <div class="container">
        <div class="productDetail__container">
            <div class="productDetail__img">
                <img src="../product_img/<?php echo $product['Img'] ?>" alt="<?php echo $product['Name'] ?>">
            </div>

            <div class="productDetail__content">
                <h1 class="content__title"
                    style="color: black; font-size: 24px; text-transform: uppercase;">
                    <?php echo $product['Name'] ?>
                </h1>
                <?php
  
                $originalPrice = (float)$product['Price'];
                $discount = isset($product['Discount']) ? (float)$product['Discount'] : 0; 

                // Tính giá sau giảm
                if ($discount > 0) {
                    $finalPrice = $originalPrice - ($originalPrice * ($discount / 100));
                } else {
                    $finalPrice = $originalPrice;
                }

                // ĐIỀU KIỆN HIỂN THỊ: Chỉ coi là khuyến mãi nếu % giảm > 0 VÀ giá mới thấp hơn giá cũ
                $isDiscounted = ($discount > 0 && $finalPrice < $originalPrice);
                ?>

                <p class="content__price" style="text-decoration: none !important;">
                    <?php if ($isDiscounted): ?>
                        <span style="text-decoration: line-through; color: #888; font-size: 18px; margin-right: 10px;">
                            <?php echo number_format($originalPrice, 0, '.', '.'); ?> đ
                        </span>

                        <span style="color: #d70018; font-weight: bold; font-size: 24px; text-decoration: none;">
                            <?php echo number_format($finalPrice, 0, '.', '.'); ?> đ
                        </span>

                        <span style="background: #d70018; color: #fff; border-radius: 5px; padding: 3px 6px; font-size: 12px; vertical-align: text-top; margin-left: 5px; text-decoration: none;">
                            -<?php echo $discount; ?>%
                        </span>

                    <?php else: ?>
                        <span style="color: #d70018; font-weight: bold; font-size: 24px; text-decoration: none !important;">
                            <?php echo number_format($originalPrice, 0, '.', '.'); ?> đ
                        </span>
                    <?php endif; ?>
                </p>

                <div class="content__desc">
                    <h5>Mô tả :</h5>
                    <?php echo $product['Description'] ?>
                </div>

                <?php
                // Lấy số lượng tồn kho
                $stockQty = isset($product['Quantity']) ? (int)$product['Quantity'] : 0;
                ?>

                <form class="content__bottom" action="order/addToCart/<?php echo $product['ID'] ?>" method="POST">

                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; align-items: center; gap: 5px; font-size: 16px;">
                            <label>Kích thước (cm):</label>
                            <label><strong><?php echo trim($product['Size'], ','); ?></strong></label>
                        </div>
                    </div>

                    <div class="stock-control" style="display: block;">
                        <?php if ($stockQty > 0): ?>

                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                                <input type="number"
                                    id="quantity"
                                    value="1"
                                    min="1"
                                    max="<?php echo $stockQty; ?>"
                                    name="quantity"
                                    style="width: 80px; padding: 6px;">
                            </div>

                            <div style="margin-bottom: 40px;">
                                <?php if ($stockQty < 5): ?>
                                    <p style="color: gray;">
                                        Còn ít hàng (<?php echo $stockQty; ?> sp)
                                        </pl>
                                    <?php else: ?>
                                    <p style="color: gray;">
                                        Còn hàng
                                    </p>
                                <?php endif; ?>
                            </div>


                            <!-- hidden fields -->
                            <input type="hidden" name="name" value="<?php echo $product['Name'] ?>">
                            <input type="hidden" name="size" value="<?php echo trim($product['Size'], ',') . ' cm'; ?>">
                            <input type="hidden" name="img" value="<?php echo $product['Img'] ?>">
                            <input type="hidden" name="promotionPrice"
                                value="<?php echo $isDiscounted ? $finalPrice : $originalPrice; ?>">

                            <!-- ROW 3: Button full width -->
                            <button type="submit"
                                style="width: 80%; padding: 12px 0; font-weight: bold;">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Thêm vào giỏ
                            </button>

                        <?php else: ?>
                            <p style="color: gray;">
                                Hết hàng
                            </p>

                            <button type="button"
                                disabled
                                style="width: 80%; background-color: #ccc; cursor: not-allowed; border: none; padding: 12px; color: #666;">
                                Hết hàng
                            </button>

                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="endow">
                <div class="endow__item">
                    <div class="endow__img">
                        <img src="./public/img/vanchuyen.jpg" alt="">
                    </div>
                    <p>Miễn phí vận chuyển với đơn hàng lớn hơn 1.000.000 đ</p>
                </div>
                <div class="endow__item">
                    <div class="endow__img">
                        <img src="./public/img/giaohangngay.jpg" alt="">
                    </div>
                    <p>Giao hàng ngay sau khi đặt hàng (áp dụng với Hà Nội - HCM)</p>
                </div>
                <div class="endow__item">
                    <div class="endow__img">
                        <img src="./public/img/hoadon.jpg" alt="">
                    </div>
                    <p>Nhà cung cấp xuất hóa đơn cho sản phẩm này</p>
                </div>
            </div>
        </div>

        <div class="productDetail__detail">
            <h5>Thông tin sản phẩm</h5>
            <div class="">
                <?php echo $product['Detail'] ?>
            </div>
        </div>
    </div>
</section>