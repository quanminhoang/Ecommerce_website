<?php require_once './App/views/partials/slider.php'; ?>
<div class="collection">
    <div class="container">
        <div class="collection__container">
            <?php require_once './App/views/partials/sidebar.php' ?>
            <div class="content">

                <div class="product__container">
                    <div class="product__title">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                    <div class="products">
                        <?php foreach ($products as $product) {
                            // 1. Logic tính giá tự động
                            $price = $product['Price'];
                            $discount = isset($product['Discount']) ? $product['Discount'] : 0;

                            if ($discount > 0) {
                                $finalPrice = $price - ($price * ($discount / 100));
                            } else {
                                $finalPrice = $price;
                            }
                        ?>
                            <div class="card">
                                <div class="card__img">
                                    <img src="../product_img/<?php echo $product['Img'] ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                </div>
                                <div class="card__content">
                                    <div class="content__title"><?php echo htmlspecialchars($product['Name']); ?></div>
                                    <div class="content__price">
                                        <p style="color: #d70018; font-weight: bold; white-space: nowrap;">
                                            <?php echo number_format($finalPrice, 0, '.', '.'); ?>₫
                                        </p>
                                        <p style="<?php echo ($discount == 0) ? 'display: none;' : 'text-decoration: line-through; color: #999; font-size: 14px; white-space: nowrap;' ?>">
                                            <?php echo number_format($price, 0, '.', '.'); ?>₫
                                        </p>
                                    </div>
                                </div>
                                <div class="card__discount" style="<?php echo ($discount == 0) ? 'display: none;' : '' ?>">
                                    -<?php echo (int)$discount ?>%
                                </div>
                                <a href="product/show/<?php echo $product['ID'] ?>" class="card__link"></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="banner__middle">
                    <img src="./public/img/article_ads_banner_1.jpg" alt="">
                </div>

                <div class="product__container ">
                    <div class="product__title">
                        <h2>Sản phẩm khuyến mãi</h2>
                    </div>
                    <div class="products">
                        <?php while ($product =  mysqli_fetch_array($productDiscount)) {
                            // 1. Logic tính giá tự động (Lặp lại cho phần này)
                            $price = $product['Price'];
                            $discount = isset($product['Discount']) ? $product['Discount'] : 0;

                            if ($discount > 0) {
                                $finalPrice = $price - ($price * ($discount / 100));
                            } else {
                                $finalPrice = $price;
                            }
                        ?>
                            <div class="card">
                                <div class="card__img">
                                    <img src="../product_img/<?php echo $product['Img'] ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                </div>
                                <div class="card__content">
                                    <div class="content__title"><?php echo htmlspecialchars($product['Name']); ?></div>
                                    <div class="content__price">
                                        <p style="color: #d70018; font-weight: bold; white-space: nowrap;">
                                            <?php echo number_format($finalPrice, 0, '.', '.'); ?>₫
                                        </p>
                                        <p style="<?php echo ($discount == 0) ? 'display: none;' : 'text-decoration: line-through; color: #999; font-size: 14px; white-space: nowrap;' ?>">
                                            <?php echo number_format($price, 0, '.', '.'); ?>₫
                                        </p>
                                    </div>
                                </div>
                                <div class="card__discount" style="<?php echo ($discount == 0) ? 'display: none;' : '' ?>">
                                    -<?php echo (int)$discount ?>%
                                </div>
                                <a href="product/show/<?php echo $product['ID'] ?>" class="card__link"></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>