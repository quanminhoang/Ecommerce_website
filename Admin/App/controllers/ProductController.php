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
        $this->view(
            'main-layout',
            [
                'page' => 'products/addProduct',
                'pageName' => 'Thêm sản phẩm',
                'categories' => $categories,
                'brands' => $brands,
                'suppliers' => $suppliers,
            ]
        );
    }

    function create()
    {
        $name = $_POST['name'];
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : 0;
        $promotionPrice = isset($_POST['promotionPrice']) && $_POST['promotionPrice'] !== ''
            ? floatval($_POST['promotionPrice'])
            : $price;
        $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : 0;
        $sizeProduct = $_POST['size'];
        $hot = $_POST['hot'];
        $description = $_POST['description'];
        $detail = $_POST['detail'];
        $file = $_FILES['file'];
        $cateID = $_POST['categoryID'];
        $supplierID = $_POST['supplierID'];
        $brandID = $_POST['brandID'];

        // format name file
        $error = [];
        $size_allow = 10;
        $fileName = $file['name'];
        $fileName = explode('.', $fileName);
        $ext = end($fileName);
        $new_file_name = md5(uniqid()) . '.' . $ext;




        if (
            $file && $file['name']
            && $name  && $price  && $sizeProduct
            && $description && $detail
            && $cateID && $supplierID && $brandID
        ) {
            //Check type file
            $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
            if (in_array($ext, $allow_ext)) {
                $size = $file['size'] / 1024 / 1024;
                if ($size <= $size_allow) {
                    $upload = move_uploaded_file($file['tmp_name'], '../product_img/' . $new_file_name);
                    if (!$upload) {
                        $error[] = 'error upload';
                    }
                } else {
                    $error = 'size_error';
                }
            } else {
                $error[] = 'ext_error';
            }

            $data = [
                'Name' => $name,
                'Price' => $price,
                'PromotionPrice' => $promotionPrice,
                'Discount' => $discount ? $discount : 0,
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
        } else {
            header('location:add');
        }
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
        $this->view(
            'main-layout',
            [
                'page' => 'products/editProduct',
                'pageName' => 'Cập nhật sản phẩm',
                'categories' => $categories,
                'brands' => $brands,
                'suppliers' => $suppliers,
                'product' => $product,
            ]
        );
    }

    public function update($id)
    {
        $product = $this->productModel->getProduct($id);
        $name = $_POST['name'];
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : $product['Price'];
        $promotionPrice = isset($_POST['promotionPrice']) && $_POST['promotionPrice'] !== '' 
                  ? floatval($_POST['promotionPrice']) 
                  : $price; // Nếu trống, dùng giá gốc

        $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : $product['Discount'];

        $sizeProduct = $_POST['size'];
        $hot = $_POST['hot'];
        $description = $_POST['description'];
        $detail = $_POST['detail'];
        $file = $_FILES['file'];
        $cateID = $_POST['categoryID'];
        $supplierID = $_POST['supplierID'];
        $brandID = $_POST['brandID'];

        // format name file
        $error = [];
        $size_allow = 10;
        $fileName = $file['name'];
        $fileName = explode('.', $fileName);
        $ext = end($fileName);
        $new_file_name = md5(uniqid()) . '.' . $ext;

        //Check type file
        $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
        if (in_array($ext, $allow_ext)) {
            $size = $file['size'] / 1024 / 1024;
            if ($size <= $size_allow) {
                $upload = move_uploaded_file($file['tmp_name'], '../product_img/' . $new_file_name);
                if ($upload) {
                    $status =  unlink('../product_img/' . $product['Img']);
                }
                if (!$upload) {
                    $error[] = 'error upload';
                }
            } else {
                $error = 'size_error';
            }
        } else {
            $error[] = 'ext_error';
        }

        $data = [];
        if ($name != $product['Name']) {
            $data['Name'] = $name;
        }

        if ($price != $product['Price']) {
            $data['Price'] = $price;
        }

        if ($promotionPrice != $product['PromotionPrice']) {
            $data['PromotionPrice'] = $promotionPrice;
        }

        if ($discount != $product['Discount']) {
            $data['Discount'] = $discount;
        }

        if ($sizeProduct != $product['Size']) {
            $data['Size'] = $sizeProduct;
        }

        if ($cateID != $product['CateID']) {
            $data['CateID'] = $cateID;
        }

        if ($brandID != $product['BrandID']) {
            $data['BrandID'] = $brandID;
        }

        if ($supplierID != $product['SupplierID']) {
            $data['SupplierID'] = $supplierID;
        }

        if ($description != $product['Description']) {
            $data['Description'] = $description;
        }

        if ($detail != $product['Detail']) {
            $data['Detail'] = $detail;
        }

        if ($hot != $product['Hot']) {
            $data['Hot'] = $hot;
        }

        if ($file && $file['name']) {
            $data['Img'] = $new_file_name;
        }

        if (count($data) > 0) {
            $this->productModel->updateProduct($id, $data);
            header("location:../edit/${id}");
        } else {
            header("location:../edit/${id}");
        }
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
