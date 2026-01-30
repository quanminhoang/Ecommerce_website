<?php
$form_errors = isset($form_errors) ? $form_errors : [];
$old = isset($form_old) && is_array($form_old) ? $form_old : [];
$esc = function($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); };
?>
<form action="product/create" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Thêm sản phẩm</h1>
    <?php if (!empty($form_errors)): ?>
    <div class="form-errors" style="background:#fee;border:1px solid #c00;border-radius:6px;padding:10px 14px;margin-bottom:16px;">
        <ul style="margin:8px 0 0 0;padding-left:20px;">
            <?php foreach ($form_errors as $err): ?>
            <li><?php echo $esc($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="form">
        <div class="form-left">
            <div class="form-group">
                <label for="file">
                    <div class="form-img">
                        <img id="blah" src="./public/img/img.png" alt="">
                    </div>
                </label>
                <label for="file" class="input-file">Thêm ảnh đại diện</label>
                <input type="file" id="file" style="display: none;" name="file" accept="image/*">
            </div>
            <div class="form-group">
                <label for="">
                    Giá
                    <b>(*)</b>
                </label>
                <input type="text" id="price" placeholder="Nhập giá sản phẩm" name="price" value="<?php echo $esc($old['price'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="">
                    Giá Khuyến mãi
                </label>
                <input type="text" id="promotionPrice" placeholder="Nhập giá khuyến mãi" name="promotionPrice" value="<?php echo $esc($old['promotionPrice'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="">
                    Giảm (%)
                </label>
                <input type="text" id="discount" placeholder="Nhập % giảm giá" name="discount" value="<?php echo $esc($old['discount'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="">
                    Số lượng tồn kho
                    <b>(*)</b>
                </label>
                <input type="number" min="0" value="<?php echo $esc(isset($old['quantity']) ? $old['quantity'] : '0'); ?>" placeholder="Nhập số lượng hàng" name="quantity">
            </div>
            </div>
        <div class="form-right">
            <div class="form-container">
                <div class="form-group">
                    <label for="">
                        Tên
                        <b>(*)</b>
                    </label>
                    <input type="text" placeholder="Nhập tên sản phẩm" name="name" value="<?php echo $esc($old['name'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="">
                        Size
                        <b>(*)</b>
                    </label>
                    <input type="text" placeholder="Nhập Size sản phẩm" name="size" value="<?php echo $esc($old['size'] ?? ''); ?>">
                </div>
            </div>
            <div class="form-container">
                <div class="form-group">
                    <label for="">
                        Danh mục
                        <b>(*)</b>
                    </label>
                    <select name="categoryID">
                        <?php
                        $catVal = isset($old['categoryID']) ? (string)$old['categoryID'] : '';
                        $noCat = ($catVal === '' || $catVal === ' ');
                        ?>
                        <option<?php echo $noCat ? ' selected' : ''; ?> disabled value=" ">-- Chọn --</option>
                        <?php foreach ($categories as $category) {
                            $sel = ($catVal !== '' && $catVal !== ' ' && $catVal === (string)$category['ID']) ? ' selected' : '';
                        ?>
                            <option<?php echo $sel; ?> value="<?php echo $esc($category['ID']); ?>"><?php echo $esc($category['Name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Nhà cung cấp
                        <b>(*)</b>
                    </label>
                    <select name="supplierID">
                        <?php $supVal = isset($old['supplierID']) ? (string)$old['supplierID'] : ''; $noSup = ($supVal === '' || $supVal === ' '); ?>
                        <option<?php echo $noSup ? ' selected' : ''; ?> disabled value=" ">-- Chọn --</option>
                        <?php foreach ($suppliers as $supplier) {
                            $sel = ($supVal !== '' && $supVal !== ' ' && $supVal === (string)$supplier['ID']) ? ' selected' : '';
                        ?>
                            <option<?php echo $sel; ?> value="<?php echo $esc($supplier['ID']); ?>"><?php echo $esc($supplier['Name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-container">
                <div class="form-group">
                    <label for="">
                        Hãng
                        <b>(*)</b>
                    </label>
                    <select name="brandID">
                        <?php $brandVal = isset($old['brandID']) ? (string)$old['brandID'] : ''; $noBrand = ($brandVal === '' || $brandVal === ' '); ?>
                        <option<?php echo $noBrand ? ' selected' : ''; ?> disabled value=" ">-- Chọn --</option>
                        <?php foreach ($brands as $brand) {
                            $sel = ($brandVal !== '' && $brandVal !== ' ' && $brandVal === (string)$brand['ID']) ? ' selected' : '';
                        ?>
                            <option<?php echo $sel; ?> value="<?php echo $esc($brand['ID']); ?>"><?php echo $esc($brand['Name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Nổi bật
                    </label>
                    <select name="hot">
                        <option disabled>-- Chọn --</option>
                        <?php $hotVal = $old['hot'] ?? '0'; ?>
                        <option<?php echo $hotVal === '0' ? ' selected' : ''; ?> value="0">Không</option>
                        <option<?php echo $hotVal === '1' ? ' selected' : ''; ?> value="1">Có</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    Mô tả
                    <b>(*)</b>
                </label>
                <textarea name='description' placeholder="Nhập mô tả sản phẩm" id='ckeditor'><?php echo $esc($old['description'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Thông tin chi tiết
                    <b>(*)</b>
                </label>
                <textarea name='detail' placeholder="Nhập thông tin chi tiết / Dung thành phần" id='ckeditor1'><?php echo $esc($old['detail'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        <a href="product" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>
<script>
    // Preview Img Input
    const fileValue = document.getElementById('file');
    fileValue.onchange = evt => {
        const [file] = fileValue.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

    // -----------------------
    // Ckeditor
    // CKEDITOR.replace('ckeditor');
    // CKEDITOR.replace('ckeditor1');
    ClassicEditor.create(document.querySelector('#ckeditor')).catch((error) => {
        console.error(error);
    });

    ClassicEditor.create(document.querySelector('#ckeditor1')).catch((error) => {
        console.error(error);
    });


const priceInput = document.getElementById('price');
const discountInput = document.getElementById('discount');
const promotionPriceInput = document.getElementById('promotionPrice');

const calculatePrice = () => {
    let priceRaw = priceInput.value.replace(/\./g, '');
    let price = parseFloat(priceRaw) || 0;
    let discount = parseFloat(discountInput.value) || 0;

    // Giới hạn % từ 0 - 100
    if (discount > 100) {
        discount = 100;
        discountInput.value = 100;
    }
    if (discount < 0) {
        discount = 0;
        discountInput.value = 0;
    }

    if (price > 0) {
        let finalPrice = price - (price * (discount / 100));
        promotionPriceInput.value = Math.round(finalPrice);
    } else {
        promotionPriceInput.value = 0;
    }
}

if (priceInput && discountInput) {
    priceInput.addEventListener('input', calculatePrice);
    discountInput.addEventListener('input', calculatePrice);
}

</script>

