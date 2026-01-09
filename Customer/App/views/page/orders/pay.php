<div class="pay">
    <div class="container">
        <div class="pay__container">
            <?php $customer = $_SESSION['customer'] ?? []; ?>
            <form id="payForm" class="form bill" action="order/checkOut" method="POST">
                <div class="form__title">
                    <h1 class="text-center">Thông tin nhận hàng</h1>
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Tên Người nhận" name="nameReceive" value="<?php echo htmlspecialchars($customer['Name'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Địa chỉ người nhận" name="addressReceive" value="<?php echo htmlspecialchars($customer['Address'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Số điện thoại người nhận" name="phoneReceive" value="<?php echo htmlspecialchars($customer['PhoneNumber'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Ghi chú" name="note">
                </div>

                <div class="form-group">
                    <select name="payment">
                        <option value="" selected>Vui lòng chọn phương thức thanh toán</option>
                        <option value="COD">Thanh toán khi nhận hàng</option>
                        <option value="payUrl">Thanh toán qua momo</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea placeholder="Hóa đơn" rows="10" readonly class="bill_input">
<?php
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $total = 0;
    foreach ($_SESSION['cart'] as $value) {
        $total += $value['PromotionPrice'] * $value['Quantity'];
        echo '- ' . $value['Name'] . ' - Size ' . $value['Size'] . ' -- '
            . '( ' . number_format($value['PromotionPrice'], 0, ',', ',')
            . ' x ' . $value['Quantity']  . ' = '
            . number_format($value['PromotionPrice'] * $value['Quantity'], 0, ',', ',') . ' )' . '&#13';
    }
    echo '&#13' . "- Tổng tiền: " . number_format($total, 0, ',', ',') . " VNĐ";
}
?>
                    </textarea>
                </div>

                <div class="form__btn">
                    <button type="submit" name="COD">Thanh toán </button>
                </div>
            </form>

            <div class="pay__right">
                <div class="pay__logo">
                    <img src="./public/img/logo.png" alt="">
                </div>
                <p class="">Figure Store mô hình chính hãng 100%.</p>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i>123 ABC, TPHCM</li>
                    <li><i class="fa-solid fa-phone"></i>Hotline: 097 1539 681</li>
                    <li><i class="fa-solid fa-envelope"></i>figurestore@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        const inputs = $(".pay__container .form-group input[name!='note'], .pay__container .form-group select");

        function showError(el, msg) {
            const parent = el.parent();
            parent.addClass('active');
            if (!parent.find('.err').length) parent.append('<span class="err">' + msg + '</span>');
        }

        function clearError(el) {
            const parent = el.parent();
            parent.removeClass('active');
            parent.find('.err').remove();
        }

        function getFieldName(el) {
            switch (el.attr('name')) {
                case 'nameReceive':
                    return 'Tên Người nhận';
                case 'addressReceive':
                    return 'Địa chỉ người nhận';
                case 'phoneReceive':
                    return 'Số điện thoại người nhận';
                case 'payment':
                    return 'Phương thức thanh toán';
                default:
                    return '';
            }
        }

        inputs.on('blur', function() {
            const val = $(this).val().trim();
            clearError($(this));

            if (!val) {
                showError($(this), 'Vui lòng điền ' + getFieldName($(this)));
            } else if ($(this).attr('name') === 'phoneReceive') {
                const phoneRegex = /^[0-9]{9,12}$/;
                if (!phoneRegex.test(val)) showError($(this), 'Số điện thoại không hợp lệ');
            }
        });

        inputs.on('input change', function() {
            clearError($(this));
        });

        $("#payForm").submit(function(e) {
            console.log("Submitting form..."); // debug
            let hasError = false;

            inputs.each(function() {
                const val = $(this).val().trim();
                clearError($(this));

                if (!val) {
                    showError($(this), 'Vui lòng điền ' + getFieldName($(this)));
                    hasError = true;
                } else if ($(this).attr('name') === 'phoneReceive') {
                    const phoneRegex = /^[0-9]{9,12}$/;
                    if (!phoneRegex.test(val)) {
                        showError($(this), 'Số điện thoại không hợp lệ');
                        hasError = true;
                    }
                }
            });

            if (hasError) {
                e.preventDefault();
                console.log("Form has errors, prevented submit.");
            }
        });
    });
</script>