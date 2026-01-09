<form action="supplier/create" method="POST" class="form-wrapper">
    <h1 class="form-title">Thêm nhà cung cấp</h1>
    <div class="form-group mt-20">
        <label for="">
            Tên
            <b>(*)</b>
        </label>
        <input type="text" name='name' placeholder="Nhập tên nhà cung cấp">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Email
            <b>(*)</b>
        </label>
        <input type="text" name='email' placeholder="Nhập Email">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Số điện thoại
            <b>(*)</b>
        </label>
        <input type="text" name='phoneNumber' placeholder="Nhập số điện thoại">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Địa chỉ
            <b>(*)</b>
        </label>
        <textarea type="text" name='address' placeholder="Nhập địa chỉ"></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        <a href="manufacture" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>