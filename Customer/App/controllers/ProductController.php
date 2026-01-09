<?php
class ProductController extends BaseController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('categoryModel');
        $this->productModel = $this->model('productModel');
    }

    public function sayHi()
    {

        $categories = $this->categoryModel->getCategories();
        $products = $this->productModel->getProducts(['ID', 'ASC'], 9999);
        $this->view(
            'main-layout',
            [
                'page' => 'products/index',
                'pageName' => 'Shop Mô Hình',
                'categories' => $categories,
                'products' => $products
            ]
        );
    }

    public function show($id)
    {
        $categories = $this->categoryModel->getCategories();
        $product = $this->productModel->getProduct($id);
        $this->view(
            'main-layout',
            [
                'page' => 'products/showProduct',
                'pageName' => $product['Name'],
                'categories' => $categories,
                'product' => $product
            ]
        );
    }


    public function ByCate($id)
    {
        $products = $this->productModel->productByCate($id);
        $category = $this->categoryModel->getCategory($id);
        $categories = $this->categoryModel->getCategories();


        $this->view(
            'main-layout',
            [
                'page' => 'products/byCateID',
                'pageName' => 'Danh mục',
                'categoryTitle' => $category,
                'products' => $products,
                'categories' => $categories
            ]
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        $categories = $this->categoryModel->getCategories();
        $products = $this->productModel->searchProduct($name);
        if ($name) {
            $this->view(
                'main-layout',
                [
                    'page' => 'products/searchProduct',
                    'pageName' => 'Shop Mô Hình',
                    'categories' => $categories,
                    'products' => $products
                ]
            );
        } else {
            header("location:../product/sayHi");
        }
    }
}
