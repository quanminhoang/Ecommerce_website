<div class="sidebar" id="sidebar">
    <div class="sidebar__logo">
        <a href="/Ecommerce_website/Admin/home" class="logo__link"><b>S</b> Smile </a>
    </div>
    <nav class="menu">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/home" class="menu__link 
                <?php
                $display = $func->handleActive('home');
                echo $display['active'];
                echo $displayDefault = isset($display['display']) ? $display['display'] : '';
                ?>">
                    <i class="fa-solid fa-chart-line"></i>
                    Tổng quan
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/brand" class="menu__link
                <?php
                echo $func->handleActive('brand')['active'];
                ?>">
                    <i class="fa-solid fa-copyright"></i>
                    Hãng
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/supplier" class="menu__link
                <?php
                echo $func->handleActive('supplier')['active'];
                ?>">
                    <i class="fa-solid fa-truck-field"></i>
                    Nhà cung cấp
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/category" class="menu__link
                <?php
                echo $func->handleActive('category')['active'];
                ?>">
                    <i class="fa-solid fa-list"></i>
                    Danh mục
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/product" class="menu__link
                <?php
                echo $func->handleActive('product')['active'];
                ?>">
                    <i class="fa-solid fa-shop"></i>
                    Sản phẩm
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/customer" class="menu__link
                <?php
                echo $func->handleActive('customer')['active'];
                ?>">
                    <i class="fa-solid fa-user"></i>
                    Khách hàng
                </a>
            </li>
            <li class="menu__item">
                <a href="/Ecommerce_website/Admin/order" class="menu__link
                <?php
                echo $func->handleActive('order')['active'];
                ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Đơn hàng
                </a>
            </li>
        </ul>
    </nav>
</div>