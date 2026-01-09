<form action="brand/update/<?php echo $brand['ID'] ?>" class="form-wrapper" method="POST">
    <h1 class="form-title">Cập nhật hãng sản phẩm</h1>
    <div class="form-group">
        <label for="">
            Tên
            <b>(*)</b>
        </label>
        <input name="name" type="text" placeholder="Nhập tên hãng" value="<?php echo $brand["Name"] ?>">
    </div>
    <div class=" form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
        <a href="brand" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>