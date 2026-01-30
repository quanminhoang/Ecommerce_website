<form action="product/update/<?php echo $product['ID'] ?>" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Cập nhật sản phẩm</h1>
    <div class="form">
        <div class="form-left">
            <div class="form-group">
                <label for="file">
                    <div class="form-img">
                        <img id="blah" src="/Ecommerce_website/product_img/<?php echo trim($product['Img']); ?>" alt="Ảnh sản phẩm">
                    </div> 
                </label>
                <label for="file" class="input-file">Thay đổi ảnh</label>
                <input type="file" id="file" style="display: none;" name="file" accept="image/*">
            </div>
            <div class="form-group">
                <label for="">
                    Giá
                    <b>(*)</b>
                </label>
                <input type="text" id="price" placeholder="Nhập giá  sản phẩm" name="price" value="<?php echo $product['Price'] ?>">
            </div>
            <div class="form-group">
                <label for="">
                    Giá Khuyến mãi
                    <b>(*)</b>
                </label>
                <input type="text" id="promotionPrice" placeholder="Nhập giá khuyến mãi" name="promotionPrice" value="<?php echo trim($product['PromotionPrice']); ?>">
            </div>
            <div class="form-group">
                <label for="">Giảm (%)</label>
                <input type="text" id="discount" placeholder="Nhập % giảm giá" name="discount" value="<?php echo trim($product['Discount']); ?>">
            </div>

            <div class="form-group">
                <label for="">
                    Số lượng tồn kho
                    <b>(*)</b>
                </label>
                <input type="number" min="0" placeholder="Nhập số lượng hàng" name="quantity" 
                       value="<?php echo isset($product['Quantity']) ? $product['Quantity'] : 0; ?>">
            </div>
        </div>
        <div class="form-right">
            <div class="form-container">
                <div class="form-group">
                    <label for="">
                        Tên
                        <b>(*)</b>
                    </label>
                    <input type="text" placeholder="Nhập tên sản phẩm" name="name" value="<?php echo $product['Name'] ?>">
                </div>
                <div class="form-group">
                    <label for="">
                        Size
                        <b>(*)</b>
                    </label>
                    <input type="text" placeholder="Nhập Size sản phẩm" name="size" value="<?php echo $product['Size'] ?>">
                </div>
            </div>
            <div class="form-container">
                <div class="form-group">
                    <label for="">
                        Danh mục
                        <b>(*)</b>
                    </label>
                    <select name="categoryID">
                        <option selected disabled value=" ">-- Chọn --</option>
                        <?php foreach ($categories as $category) { ?>
                            <option <?php echo $selected = $category['ID'] == $product['CateID'] ? "selected" : "" ?> value="<?php echo $category['ID'] ?>"><?php echo $category['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Nhà cung cấp
                        <b>(*)</b>
                    </label>
                    <select name="supplierID">
                        <option selected disabled value=" ">-- Chọn --</option>
                        <?php foreach ($suppliers as $supplier) { ?>
                            <option <?php echo $selected = $supplier['ID'] == $product['SupplierID'] ? "selected" : "" ?> value="<?php echo $supplier['ID'] ?>"><?php echo $supplier['Name'] ?></option>
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
                        <option selected disabled value=" ">-- Chọn --</option>
                        <?php foreach ($brands as $brand) { ?>
                            <option <?php echo $selected = $brand['ID'] == $product['BrandID'] ? "selected" : "" ?> value="<?php echo $brand['ID'] ?>"><?php echo $brand['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Nổi bật
                        <b>(*)</b>
                    </label>
                    <select name="hot">
                        <option <?php echo $selected = $product['Hot'] == 1 ? "selected" : "" ?> value="1">Có</option>
                        <option <?php echo $selected = $product['Hot'] == 0 ? "selected" : "" ?> value="0">Không</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    Mô tả
                    <b>(*)</b>
                </label>
                <textarea name='description' placeholder="Nhập mô tả sản phẩm" id='ckeditor'><?php echo $product['Description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Thông tin chi tiết
                    <b>(*)</b>
                </label>
                <textarea name='detail' placeholder="Nhập mô tả sản phẩm" id='ckeditor1'><?php echo $product['Detail'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu thay đổi</button>
        <a href="product" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>

<script>
    // ---------------------------------------------------------
    // 1. TÍNH TOÁN GIÁ TỰ ĐỘNG (Logic mới thêm vào)
    // ---------------------------------------------------------
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const promotionPriceInput = document.getElementById('promotionPrice');

    const calculatePrice = () => {
        // Lấy giá trị, xóa dấu chấm phân cách nếu có
        let priceRaw = priceInput.value;
        if (priceRaw) {
            priceRaw = priceRaw.toString().replace(/\./g, '');
        }

        let price = parseFloat(priceRaw) || 0;
        let discount = parseFloat(discountInput.value) || 0;

        // Giới hạn %
        if (discount > 100) discount = 100;
        if (discount < 0) discount = 0;

        // Tính toán
        if (price > 0) {
            let finalPrice = price - (price * (discount / 100));
            promotionPriceInput.value = Math.round(finalPrice);
        } else {
            promotionPriceInput.value = 0;
        }
    }

    // Lắng nghe sự kiện thay đổi
    if (priceInput && discountInput && promotionPriceInput) {
        priceInput.addEventListener('input', calculatePrice);
        discountInput.addEventListener('input', calculatePrice);
        priceInput.addEventListener('keyup', calculatePrice);
        discountInput.addEventListener('keyup', calculatePrice);

        // QUAN TRỌNG: Chạy hàm này ngay lập tức khi trang vừa load
        // Để sửa lỗi giá hiển thị 1.000.000 thành 700.000
        calculatePrice();
    }


    // ---------------------------------------------------------
    // 2. Preview Ảnh (Code cũ)
    // ---------------------------------------------------------
    const fileInput = document.getElementById('file');
    const blah = document.getElementById('blah'); 

    if (fileInput) {
        fileInput.onchange = evt => {
            const [file] = fileInput.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    }

    // ---------------------------------------------------------
    // 3. Ckeditor (Code cũ)
    // ---------------------------------------------------------
    if(document.querySelector('#ckeditor')) {
        ClassicEditor.create(document.querySelector('#ckeditor')).catch((error) => {
            console.error(error);
        });
    }

    if(document.querySelector('#ckeditor1')) {
        ClassicEditor.create(document.querySelector('#ckeditor1')).catch((error) => {
            console.error(error);
        });
    }
</script>