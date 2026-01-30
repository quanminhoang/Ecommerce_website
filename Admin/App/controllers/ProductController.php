<?php
class ProductController extends BaseController
{
    private $productModel;
    private $categoryModel;
    private $brandModel;
    private $supplierModel;

    function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->brandModel = $this->model('BrandModel');
        $this->supplierModel = $this->model('supplierModel');
    }

    function sayHi()
    {
        $products = $this->productModel->getPropertyProducts();
        $this->view(
            'main-layout',
            [
                'page' => 'products/index',
                'pageName' => 'Sản phẩm',
                'products' => $products,
            ]
        );
    }

    function add()
    {
        $categories = $this->categoryModel->getCategories();
        $brands = $this->brandModel->getBrands();
        $suppliers = $this->supplierModel->getSuppliers();
        $form_errors = $_SESSION['product_form_errors'] ?? [];
        $form_old = $_SESSION['product_form_old'] ?? null;
        unset($_SESSION['product_form_errors'], $_SESSION['product_form_old']);
        $this->view(
            'main-layout',
            [
                'page' => 'products/addProduct',
                'pageName' => 'Thêm sản phẩm',
                'categories' => $categories,
                'brands' => $brands,
                'suppliers' => $suppliers,
                'form_errors' => $form_errors,
                'form_old' => $form_old,
            ]
        );
    }

    function create()
    {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : 0;
        $promotionPrice = isset($_POST['promotionPrice']) && $_POST['promotionPrice'] !== ''
            ? floatval($_POST['promotionPrice'])
            : $price;
        $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : 0;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
        $sizeProduct = isset($_POST['size']) ? trim($_POST['size']) : '';
        $hot = isset($_POST['hot']) ? $_POST['hot'] : '0';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $detail = isset($_POST['detail']) ? trim($_POST['detail']) : '';
        $file = $_FILES['file'] ?? null;
        $cateID = isset($_POST['categoryID']) ? trim($_POST['categoryID']) : '';
        $supplierID = isset($_POST['supplierID']) ? trim($_POST['supplierID']) : '';
        $brandID = isset($_POST['brandID']) ? trim($_POST['brandID']) : '';

        $errors = [];
        if ($name === '') $errors[] = 'Vui lòng nhập Tên sản phẩm.';
        if ($price <= 0) $errors[] = 'Vui lòng nhập Giá hợp lệ.';
        if ($sizeProduct === '') $errors[] = 'Vui lòng nhập Size.';
        if ($description === '') $errors[] = 'Vui lòng nhập Mô tả.';
        if ($detail === '') $errors[] = 'Vui lòng nhập Thông tin chi tiết (Dung thành phần).';
        if (!$file || empty($file['name'])) $errors[] = 'Vui lòng chọn Ảnh đại diện.';
        if ($cateID === '' || $cateID === ' ') $errors[] = 'Vui lòng chọn Danh mục.';
        if ($supplierID === '' || $supplierID === ' ') $errors[] = 'Vui lòng chọn Nhà cung cấp.';
        if ($brandID === '' || $brandID === ' ') $errors[] = 'Vui lòng chọn Hãng.';

        if (!empty($errors)) {
            $_SESSION['product_form_errors'] = $errors;
            $_SESSION['product_form_old'] = [
                'name' => $name,
                'price' => $_POST['price'] ?? '',
                'promotionPrice' => $_POST['promotionPrice'] ?? '',
                'discount' => $_POST['discount'] ?? '',
                'quantity' => $quantity,
                'size' => $sizeProduct,
                'hot' => $hot,
                'description' => $description,
                'detail' => $detail,
                'categoryID' => $cateID,
                'supplierID' => $supplierID,
                'brandID' => $brandID,
            ];
            header('location:add');
            return;
        }

        $size_allow = 10;
        $fileName = $file['name'];
        $fileName = explode('.', $fileName);
        $ext = end($fileName);
        $new_file_name = md5(uniqid()) . '.' . $ext;

        $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg', 'webp'];
        if (!in_array(strtolower($ext), $allow_ext)) {
            $_SESSION['product_form_errors'] = ['Chỉ chấp nhận ảnh: jpg, png, gif, bmp, jpeg, webp.'];
            $_SESSION['product_form_old'] = [
                'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
            ];
            header('location:add');
            return;
        }
        $size = $file['size'] / 1024 / 1024;
        if ($size > $size_allow) {
            $_SESSION['product_form_errors'] = ['Kích thước ảnh tối đa ' . $size_allow . 'MB.'];
            $_SESSION['product_form_old'] = [
                'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
            ];
            header('location:add');
            return;
        }

        $upload = move_uploaded_file($file['tmp_name'], '../product_img/' . $new_file_name);
        if (!$upload) {
            $_SESSION['product_form_errors'] = ['Không thể tải ảnh lên.'];
            $_SESSION['product_form_old'] = [
                'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
            ];
            header('location:add');
            return;
        }

        $data = [
            'Name' => $name,
            'Price' => $price,
            'PromotionPrice' => $promotionPrice,
            'Discount' => $discount ? $discount : 0,
            'Quantity' => $quantity,
            'Hot' => $hot,
            'Size' => $sizeProduct,
            'Img' => $new_file_name,
            'Description' => $description,
            'Detail' => $detail,
            'CateID' => $cateID,
            'SupplierID' => $supplierID,
            'BrandID' => $brandID
        ];
        $this->productModel->createProduct($data);
        header('location:add');
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $products = $this->productModel->searchProduct($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'products/searchProduct',
                    'pageName' => 'Tìm kiếm sản phẩm',
                    'products' => $products
                ]
            );
        } else {
            header("location:sayHi");
        }
    }

    public function edit($id)
    {
        $categories = $this->categoryModel->getCategories();
        $brands = $this->brandModel->getBrands();
        $suppliers = $this->supplierModel->getSuppliers();
        $product = $this->productModel->getProduct($id);
        $form_errors = $_SESSION['product_form_errors'] ?? [];
        $form_old = $_SESSION['product_form_old'] ?? null;
        unset($_SESSION['product_form_errors'], $_SESSION['product_form_old']);
        $this->view(
            'main-layout',
            [
                'page' => 'products/editProduct',
                'pageName' => 'Cập nhật sản phẩm',
                'categories' => $categories,
                'brands' => $brands,
                'suppliers' => $suppliers,
                'product' => $product,
                'form_errors' => $form_errors,
                'form_old' => $form_old,
            ]
        );
    }

    public function update($id)
    {
        $product = $this->productModel->getProduct($id);
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : $product['Price'];
        $promotionPrice = isset($_POST['promotionPrice']) && $_POST['promotionPrice'] !== ''
            ? floatval($_POST['promotionPrice'])
            : $price;
        $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : $product['Discount'];
        $currentQty = isset($product['Quantity']) ? $product['Quantity'] : 0;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : $currentQty;
        $sizeProduct = isset($_POST['size']) ? trim($_POST['size']) : '';
        $hot = isset($_POST['hot']) ? $_POST['hot'] : '0';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $detail = isset($_POST['detail']) ? trim($_POST['detail']) : '';
        $file = $_FILES['file'] ?? null;
        $cateID = isset($_POST['categoryID']) ? trim($_POST['categoryID']) : '';
        $supplierID = isset($_POST['supplierID']) ? trim($_POST['supplierID']) : '';
        $brandID = isset($_POST['brandID']) ? trim($_POST['brandID']) : '';

        $errors = [];
        if ($name === '') $errors[] = 'Vui lòng nhập Tên sản phẩm.';
        if ($price <= 0) $errors[] = 'Vui lòng nhập Giá hợp lệ.';
        if ($sizeProduct === '') $errors[] = 'Vui lòng nhập Size.';
        if ($description === '') $errors[] = 'Vui lòng nhập Mô tả.';
        if ($detail === '') $errors[] = 'Vui lòng nhập Thông tin chi tiết (Dung thành phần).';
        if ($cateID === '' || $cateID === ' ') $errors[] = 'Vui lòng chọn Danh mục.';
        if ($supplierID === '' || $supplierID === ' ') $errors[] = 'Vui lòng chọn Nhà cung cấp.';
        if ($brandID === '' || $brandID === ' ') $errors[] = 'Vui lòng chọn Hãng.';

        if (!empty($errors)) {
            $_SESSION['product_form_errors'] = $errors;
            $_SESSION['product_form_old'] = [
                'name' => $name,
                'price' => $_POST['price'] ?? $product['Price'],
                'promotionPrice' => $_POST['promotionPrice'] ?? $product['PromotionPrice'],
                'discount' => $_POST['discount'] ?? $product['Discount'],
                'quantity' => $quantity,
                'size' => $sizeProduct,
                'hot' => $hot,
                'description' => $description,
                'detail' => $detail,
                'categoryID' => $cateID,
                'supplierID' => $supplierID,
                'brandID' => $brandID,
            ];
            header("location:../edit/{$id}");
            return;
        }

        $size_allow = 10;
        $new_file_name = $product['Img'];
        if ($file && !empty($file['name'])) {
            $fileName = explode('.', $file['name']);
            $ext = end($fileName);
            $new_file_name = md5(uniqid()) . '.' . $ext;
            $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg', 'webp'];
            if (!in_array(strtolower($ext), $allow_ext)) {
                $_SESSION['product_form_errors'] = ['Chỉ chấp nhận ảnh: jpg, png, gif, bmp, jpeg, webp.'];
                $_SESSION['product_form_old'] = [
                    'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                    'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                    'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
                ];
                header("location:../edit/{$id}");
                return;
            }
            $size = $file['size'] / 1024 / 1024;
            if ($size > $size_allow) {
                $_SESSION['product_form_errors'] = ['Kích thước ảnh tối đa ' . $size_allow . 'MB.'];
                $_SESSION['product_form_old'] = [
                    'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                    'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                    'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
                ];
                header("location:../edit/{$id}");
                return;
            }
            $upload = move_uploaded_file($file['tmp_name'], '../product_img/' . $new_file_name);
            if (!$upload) {
                $_SESSION['product_form_errors'] = ['Không thể tải ảnh lên.'];
                $_SESSION['product_form_old'] = [
                    'name' => $name, 'price' => $_POST['price'] ?? '', 'promotionPrice' => $_POST['promotionPrice'] ?? '',
                    'discount' => $_POST['discount'] ?? '', 'quantity' => $quantity, 'size' => $sizeProduct, 'hot' => $hot,
                    'description' => $description, 'detail' => $detail, 'categoryID' => $cateID, 'supplierID' => $supplierID, 'brandID' => $brandID,
                ];
                header("location:../edit/{$id}");
                return;
            }
            if (file_exists('../product_img/' . $product['Img'])) {
                unlink('../product_img/' . $product['Img']);
            }
        }

        $data = [];
        if ($name != $product['Name']) $data['Name'] = $name;
        if ($price != $product['Price']) $data['Price'] = $price;
        if ($promotionPrice != $product['PromotionPrice']) $data['PromotionPrice'] = $promotionPrice;
        if ($discount != $product['Discount']) $data['Discount'] = $discount;
        if ($quantity != $currentQty) $data['Quantity'] = $quantity;
        if ($sizeProduct != $product['Size']) $data['Size'] = $sizeProduct;
        if ($cateID != $product['CateID']) $data['CateID'] = $cateID;
        if ($brandID != $product['BrandID']) $data['BrandID'] = $brandID;
        if ($supplierID != $product['SupplierID']) $data['SupplierID'] = $supplierID;
        if ($description != $product['Description']) $data['Description'] = $description;
        if ($detail != $product['Detail']) $data['Detail'] = $detail;
        if ($hot != $product['Hot']) $data['Hot'] = $hot;
        if ($file && $file['name']) $data['Img'] = $new_file_name;

        if (count($data) > 0) {
            $this->productModel->updateProduct($id, $data);
        }
        header("location:../edit/{$id}");
    }

    public function delete()
    {
        $id = $_POST['id'];
        if ($id) {
            $this->productModel->deleteProduct($id);
            header('location:sayHi');
        } else {
            header('location:sayHi');
        }
    }
}
