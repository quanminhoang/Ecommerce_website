<form action="category/update/<?php echo $category['ID'] ?>" class="form-wrapper" method="POST">
    <h1 class="form-title">Thêm danh mục</h1>
    <div class="form-container mt-20">
        <div class="form-group">
            <label for="">
                Tên danh mục
                <b>(*)</b>
            </label>
            <input type="text" placeholder="Nhập tên danh mục" value="<?php echo $category['Name'] ?>" name="name">
        </div>
    </div>
    <div class=" form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
        <a href="category" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>