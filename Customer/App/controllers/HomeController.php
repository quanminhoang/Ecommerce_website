<?php
class HomeController extends BaseController
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
        $productHot = $this->productModel->getProductHot();
        $products = $this->productModel->getProducts(['ID', 'DESC'], 8);
        $productDiscount = $this->productModel->getProductDiscount();
        $this->view(
            'main-layout',
            [
                'page' => 'home/index',
                'pageName' => 'Shop Mô Hình',
                'categories' => $categories,
                'productHot' => $productHot,
                'products' => $products,
                'productDiscount' => $productDiscount
            ]
        );
    }
}
