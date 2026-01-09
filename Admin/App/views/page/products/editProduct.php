<form action="product/update/<?php echo $product['ID'] ?>" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Cập nhật sản phẩm</h1>
    <div class="form">
        <div class="form-left">
            <div class="form-group">
                <label for="file">
                    <div class="form-img">
                        <img id="blah" src="/figure_store/product_img/<?php echo trim($product['Img']); ?>" alt="Ảnh sản phẩm">
                    </div>
                </label>
                <label for="file" class="input-file">Thay đổi ảnh đại diện</label>
                <input type="file" id="file" style="display: none;" name="file" accept="image/*">
            </div>
            <div class="form-group">
                <label for="">
                    Giá
                    <b>(*)</b>
                </label>
                <input type="text" placeholder="Nhập giá sản phẩm" name="price" value="<?php echo $product['Price'] ?>">
            </div>
            <div class="form-group">
                <label for="">
                    Giá Khuyến mãi
                    <b>(*)</b>
                </label>
                <input type="text" placeholder="Nhập giá khuyến mãi" name="promotionPrice" value=" <?php echo $product['PromotionPrice'] ?>">
            </div>
            <div class="form-group">
                <label for="">Giảm</label>
                <input type="text" placeholder="Nhập % giảm giá" name="discount" value=" <?php echo $product['Discount'] ?>">
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
                <textarea name='description' placeholder="Nhập mô tả sản phẩm" id='ckeditor'>
                    <?php echo $product['Description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Thông tin chi tiết
                    <b>(*)</b>
                </label>
                <textarea name='detail' placeholder="Nhập mô tả sản phẩm" id='ckeditor1'>
                <?php echo $product['Detail'] ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
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

    const fileInput = document.getElementById('file');
    const blah = document.getElementById('blah'); // Khai báo img element

    fileInput.addEventListener('change', (evt) => {
        const [file] = fileInput.files;
        if (file) {
            blah.src = URL.createObjectURL(file);
        }
    });

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
</script>