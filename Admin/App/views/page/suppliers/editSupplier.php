<form action="supplier/update/<?php echo $supplier['ID'] ?>" method="POST" class="form-wrapper">
    <h1 class="form-title">Cập nhật nhà cung cấp</h1>
    <div class="form-group mt-20">
        <label for="">
            Tên
            <b>(*)</b>
        </label>
        <input type="text" name='name' placeholder="Nhập tên nhà cung cấp" value="<?php echo $supplier['Name'] ?>">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Email
            <b>(*)</b>
        </label>
        <input type="text" name='email' placeholder="Nhập Email" value="<?php echo $supplier['Email'] ?>">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Số điện thoại
            <b>(*)</b>
        </label>
        <input type="text" name='phoneNumber' placeholder="Nhập số điện thoại" value="<?php echo $supplier['PhoneNumber'] ?>">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Địa chỉ
            <b>(*)</b>
        </label>
        <textarea type="text" name='address' placeholder="Nhập địa chỉ"><?php echo $supplier['Address'] ?></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
        <a href="supplier" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>