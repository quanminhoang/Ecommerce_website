<div class="sidebar">
    <div class="featuredProducts">
        <div class="title--border">
            <p>sản phẩm nổi bật</p>
        </div>
        <ul class="featuredProducts__list">

            <?php while ($product = mysqli_fetch_array($productHot)) { ?>
                <li class="featuredProducts__item">
                    <a href="product/show/<?php echo $product['ID'] ?>" class="featuredProducts__link"></a>
                    <div class="item__img">
                        <img src="../product_img/<?php echo $product['Img'] ?>" alt="">
                    </div>
                    <div class="item__content">
                        <h2><?php echo $product['Name'] ?></h2>
                        <p> <?php echo number_format($product['PromotionPrice'], 0, '.', '.');  ?> </p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="support">
        <div class="support__title title--border">
            <p>Hỗ trợ trực tuyến</p>
        </div>
        <ul class="supporters">
            <li class="supporter">
                <div class="supporter__icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="supporter__content">
                    <p>Tư vấn bán hàng 1
                        <br />
                        <b>Mr. Phát:</b> 097 1539 681
                    </p>
                </div>
            </li>
            <li class="supporter">
                <div class="supporter__icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="supporter__content">
                    <p>Tư vấn bán hàng 2
                        <br />
                        <b>Tư vấn 1:</b> 097 1539 681
                    </p>
                </div>
            </li>
            <li class="supporter">
                <div class="supporter__icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="supporter__content">
                    <p>Email liên hệ
                        <br />
                        <b>kongtu2x@gmail.com/b>
                    </p>
                </div>
            </li>
        </ul>
    </div>

    <div class="advertisement">
        <img src="./public/img/banner.jpg" alt="">
    </div>
</div>