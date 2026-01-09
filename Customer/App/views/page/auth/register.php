<div class="container">
    <form class="form" action="auth/verify" method="POST" id="form">
        <div class="">
            <div class="form__title">
                <h1>Đăng ký</h1>
            </div>
            <div class="form-group">
                <input class="form-input" type="text" placeholder="Họ và tên" name="name" autocomplete="off">
                <span class="err"></span>
            </div>

            <div class="form-group">
                <input class="form-input" type="password" placeholder="Mật khẩu" name="pass" autocomplete="on">
                <span class="err"></span>
            </div>
            <div class="form-group">
                <input class="form-input" type="password" placeholder="Nhập lại mật khẩu" name="pass_r" autocomplete="on">
                <span class="err"></span>
            </div>
            <div class="form-group">
                <input class="form-input" type="date" placeholder="Ngày sinh" name="birthday">
                <span class="err"></span>
            </div>
            <div class="form-group">
                <textarea class="form-input" type="text" placeholder="Địa chỉ" name="address"></textarea>
                <span class="err"></span>
            </div>
            <div class="form-group">
                <input class="form-input" type="text" placeholder="Điện thoại" name="phoneNumber">
                <span class="err"></span>
            </div>
            <div class="form-group" style="position: relative;">
                <input class="form-input" type="text" placeholder="Email" name="email" id="email" autocomplete="off">
                <span class="err"></span>
            </div>
        </div>
        <div class="form__btn">
            <button type="submit">Đăng ký</button>
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
            <p>Bạn đã có tài khoản ? <a href="auth/sayHi">Đăng nhập</a></p>
        </div>
    </form>

</div>

<script>
    $(document).ready(function() {
        let checkEmail = false;
        let checkPassword = false;
        let pass = 0;
        const inputs = $("#form .form-input");

        // Lắng nghe sự kiện "blur" cho input
        inputs.on('blur', function(e) {
            const target = e.target;
            const parentElement = target.parentElement;
            const errorElement = parentElement.querySelector('.err');

            if (!target.value) {
                parentElement.classList.add('active');
                errorElement.innerText = "Vui lòng nhập dữ liệu";
            } else {
                if (target.name === "pass") {
                    pass = target.value;
                }

                if (target.name === "pass_r") {
                    if (target.value === pass) {
                        if (parentElement.classList.contains('active')) {
                            parentElement.classList.remove('active');
                        }
                        errorElement.innerText = '';
                        checkPassword = true;
                        return;
                    } else {
                        parentElement.classList.add('active');
                        errorElement.innerText = "Mật khẩu không khớp";
                        if (checkPassword) {
                            checkPassword = false;
                        }
                        return;
                    }
                }

                if (target.name === "email") {
                    let isEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(target.value);

                    if (!isEmail) {
                        parentElement.classList.add('active');
                        errorElement.innerText = "Email không hợp lệ";
                        if (checkEmail) {
                            checkEmail = false;
                        }
                        return;
                    } else {
                        $.post("auth/checkEmail", {
                            email: target.value
                        }, function(data) {
                            if (data.status) {
                                parentElement.classList.add('active');
                                errorElement.innerText = data.message;
                                return;
                            } else {
                                if (parentElement.classList.contains('active')) {
                                    parentElement.classList.remove('active');
                                }
                                errorElement.innerText = '';
                                checkEmail = true;
                                return;
                            }
                        });
                    }
                }

                if (parentElement.classList.contains('active')) {
                    parentElement.classList.remove('active');
                }
                errorElement.innerText = '';
            }
        });

        // Lắng nghe sự kiện "input" cho input
        inputs.on('input', function(e) {
            const parentElement = e.target.parentElement;
            const errorElement = parentElement.querySelector('.err');

            if (parentElement.classList.contains('active')) {
                parentElement.classList.remove('active');
            }
            errorElement.innerText = '';
        });

        // Lắng nghe sự kiện "submit" cho form
        $("#form").submit(function(e) {
            let countVal = 0;

            inputs.each(function() {
                if (!$(this).val()) {
                    countVal += 1;
                    const parentElement = $(this).parent();
                    const errorElement = parentElement.find('.err');

                    if (!parentElement.hasClass('active')) {
                        parentElement.addClass('active');
                        errorElement.text('Vui lòng nhập dữ liệu');
                    }
                }
            });

            if (countVal === 0 && checkEmail && checkPassword) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>