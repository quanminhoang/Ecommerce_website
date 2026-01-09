<div class="sidebar">
    <div class="category">
        <div class="title--border">
            <p>Danh mục sản phẩm</p>
        </div>
        <ul class="categories">
            <li><a href="product">Tất cả sản phẩm</a></li>
            <?php foreach ($categories as $category) { ?>
                <li><a href="product/byCate/<?php echo $category['ID'] ?>"><?php echo $category['Name'] ?></a></li>
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
                        <b>Tư vấn 1:</b> 097 1539 681
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
                        <b>Tư vấn 2:</b> 097 1539 681
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
                        <b>kongtu2x@gmail.com</b>
                    </p>
                </div>
            </li>
        </ul>
    </div>

    <div class="advertisement">
        <img src="./public/img/banner.jpg" alt="">
    </div>
</div>