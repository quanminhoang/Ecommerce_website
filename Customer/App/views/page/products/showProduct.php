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
                <img src="../product_img/<?php echo $product['Img'] ?>" alt="">
            </div>
            <div class="productDetail__content">
                <h1 class="content__title"><?php echo $product['Name'] ?></h1>
                <p class="content__price">
                    <span>
                        <?php echo number_format($product['PromotionPrice'], 0, '.', '.');  ?>
                    </span>
                    <span>
                        <?php echo number_format($product['Price'], 0, '.', '.');   ?>
                    </span>
                </p>
                <div class="content__desc">
                    <h5>Mô tả :</h5>
                    <?php echo $product['Description'] ?>
                </div>
                <form class="content__bottom" action="order/addToCart/<?php echo $product['ID'] ?>" method="POST">
                    <div>
                        <form class="content__bottom" action="order/addToCart/<?php echo $product['ID'] ?>" method="POST">
                            <div style="display: flex; align-items: center; gap: 5px; font-size: 16px;">
                                <label for="">Kích thước (cm):</label>
                                <label for=""><?php echo trim($product['Size'], ','); ?></label>
                            </div>
                    </div>
                    <div>
                        <label for="">Số lượng</label>
                        <input type="number" value="1" min="1" name="quantity">
                        <input type="hidden" name="name" value="<?php echo $product['Name'] ?>">
                            <input type="hidden" name="size" value="<?php echo trim($product['Size'], ',') . ' cm'; ?>">
                        <input type="hidden" name="img" value="<?php echo $product['Img'] ?>">
                        <input type="hidden" name="promotionPrice" value="<?php echo $product['PromotionPrice'] ?>">
                        <input type="hidden">
                        <button type="submit">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Thêm vào giỏ
                        </button>
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