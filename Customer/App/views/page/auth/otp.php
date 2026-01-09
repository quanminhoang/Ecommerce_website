<div class="container">
    <form class="form" action="auth/submitVerify" method="POST" id="form">
        <div class="form__title">
            <h1 class="text-center">Xác minh mã</h1>
            <p style="margin-top: 12px;">Mã xác thực đã được gửi tới <b> <?php echo $email ?></b> của bạn</p>
        </div>
        <div class="">

        </div>
        <div class="form-group">
            <input class="form-input" type="text" placeholder="VD: 2321" name="otp" autocomplete="on">
            <span class="err"></span>
        </div>
        <?php if (isset($err)) { ?>
            <p style="color:red; margin-top:8px">Mã OTP không chính xác</p>
        <?php } ?>
        <input value="<?php echo $email ?>" name="email" type="hidden">
        <div class="form__btn">
            <button type="submit">Xác thực</button>
        </div>
        <div class="form__support">
            <a href="auth/register">Quay lại</a>
        </div>
        <div class="form__bottom">
            <p>Hoặc</p>
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-facebook"></i>
                        Facebook
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-google"></i>
                        Google
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-apple"></i>
                        Apple
                    </a>
                </li>
            </ul>
            <p>Bạn mới có tài khoản ? <a href="auth/register">Đăng ký</a></p>
        </div>
    </form>
</div>