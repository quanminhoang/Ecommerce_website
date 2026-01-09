<header class="header">
    <div class="header-top" id="top">
        <div class="container">
            <div class="header-top__container">
                <div class="header__welcome">Chào mừng bạn đã đến với Shop Figure!</div>
                <div class="header__social">
                    <ul>
                        <li><i class="fa-brands fa-facebook-f"></i></li>
                        <li><i class="fa-brands fa-twitter"></i></li>
                        <li><i class="fa-brands fa-google"></i></li>
                        <li><i class="fa-brands fa-youtube"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="header-main__container">
                <div class="header__logo">
                    <a href="#">
                        <img src="./public/img/logo.png" alt="">
                    </a>
                </div>
                <div class="header__search">
                    <div class="search__trend">
                        <p class="search__title">Xu hướng tìm kiếm</p>
                        <ul>
                            <li> Mô Hình Luffy Cưỡi Bò</li>
                            <li> Dragon Ball </li>
                            <li> Naruto </li>
                        </ul>
                    </div>
                    <div class="search__form">
                        <form action="product/search" class="form__search" method="POST">
                            <input type="text" placeholder="Nhập từ khóa tìm kiếm" name='name'>
                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <div class="header__account-cart">
                    <a href="order/cart" class="cart">
                        <div class="cart__img" id="cart">
                            <img src="./public/img/cart.png" alt="">
                            <span><?php echo $numberCart = (isset($_SESSION['cart']) && isset($_SESSION['customer'])) ? count($_SESSION['cart']) : 0 ?></span>
                        </div>
                    </a>
                    <div href="#" class="account" style="display:<?php echo $display = isset($_SESSION['customer']) ? '' : 'none'; ?>">
                        <p class="account__name">
                            <i class="fa-regular fa-user"></i>
                            <?php echo $name = isset($_SESSION['customer']) ? $_SESSION['customer']['Name'] : '' ?>
                        </p>
                        <ul>
                            <li><a href="order/sayHi">Đơn hàng của tôi</a></li>
                            <li>
                                <a href="auth/logout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="auth__btn" style="display:<?php echo $display = isset($_SESSION['customer']) ? 'none' : ''; ?>">
                        <a href="auth/register" class="auth__btn--login">Đăng ký</a>
                        <a href="auth/sayHi" class="auth__btn--login">Đăng Nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom" id="navbar">
        <div class="header-bottom__wrapper">
            <div class="container">
                <div class="header-bottom__container">
                    <nav class="header-bottom__menu">
                        <ul class="menu">
                            <li class="menu__item">
                                <a href="home" class="menu__link">Trang chủ</a>
                            </li>
                            <li class="menu__item">
                                <a href="product" class="menu__link">Sản phẩm</a>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link">
                                    Danh mục sản phẩm
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="sub-menu">
                                    <?php foreach ($categories as $category) { ?>
                                        <li>
                                            <a href="product/byCate/<?php echo $category['ID'] ?>"><?php echo $category['Name']; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a href="news" class="menu__link">Tin tức </a>
                            </li>
                            <li class="menu__item">
                                <a href="#" class="menu__link">Bản đồ</a>
                            </li>
                            <li class="menu__item">
                                <a href="#" class="menu__link">Liên hệ</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="header-bottom__hotline">
                        <div class="hotline__img">
                            <img src="./public/img/call_white.png" alt="">
                        </div>
                        <p class="hotline__phone">Hotline: <a href="#">033 366 9832</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>