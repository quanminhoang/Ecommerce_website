<div class="container">
    <form class="form" action="auth/signIn" method="POST" id="form">
        <div class="form__title">
            <h1>Đăng nhập</h1>
        </div>
        <div class="form-group">
            <input class="form-input" type="text" placeholder="Email" name="username">
            <span class="err"></span>
        </div>
        <div class="form-group">
            <input class="form-input" type="password" placeholder="Mật khẩu" name="password" autocomplete="on">
            <span class="err"></span>
        </div>
        <div class="form__btn">
            <button type="submit">Đăng nhập</button>
        </div>
        <div class="form__support">
            <a href="#">Quên mật khẩu</a>
            <a href="#">Đăng nhập bằng SMS</a>
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
            <p>Bạn chưa có tài khoản ? <a href="auth/register">Đăng ký</a></p>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
    const inputs = $("#form .form-input");

    // Blur
    inputs.on('blur', function(e) {
        const target = e.target;
        const parent = target.parentElement;
        const error = parent.querySelector('.err');

        if (!target.value) {
            parent.classList.add('active');
            error.innerText = "Vui lòng nhập dữ liệu";
        } else if (target.name === "username") {
            let isEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(target.value);
            if (!isEmail) {
                parent.classList.add('active');
                error.innerText = "Email không hợp lệ";
            } else {
                parent.classList.remove('active');
                error.innerText = '';
            }
        } else {
            parent.classList.remove('active');
            error.innerText = '';
        }
    });

    // Input
    inputs.on('input', function(e) {
        const parent = e.target.parentElement;
        const error = parent.querySelector('.err');
        parent.classList.remove('active');
        error.innerText = '';
    });

    // Submit
    $("#form").submit(function(e) {
        e.preventDefault();

        let hasError = false;

        // Kiểm tra dữ liệu trống
        inputs.each(function() {
            const parent = $(this).parent();
            const error = parent.find('.err');

            if (!$(this).val()) {
                parent.addClass('active');
                error.text('Vui lòng nhập dữ liệu');
                hasError = true;
            }
        });

        if (hasError) return;

        const emailInput = $('input[name="username"]');

        // Check email trước khi login
        $.post('auth/checkEmail', { email: emailInput.val() }, function(data) {
            if (!data.status) {
                const parent = emailInput.parent();
                const error = parent.find('.err');
                parent.addClass('active');
                error.text('Tài khoản chưa được đăng ký');
                return;
            }

            // Submit login
            $.post($("#form").attr('action'), $("#form").serialize(), function(res) {
                if (res.status) {
                    window.location.href = 'home';
                } else {
                    const input = $(`input[name=${res.field}]`);
                    const parent = input.parent();
                    const error = parent.find('.err');
                    parent.addClass('active');
                    error.text(res.message);
                }
            }, 'json');

        }, 'json');
    });
});

</script>