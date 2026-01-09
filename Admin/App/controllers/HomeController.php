<?php
class HomeController extends BaseController
{
    private $orderModel;
    private $customerModel;
    private $productModel;

    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
        $this->customerModel = $this->model('CustomerModel');
        $this->productModel = $this->model('ProductModel');
    }

    function sayHi()
    {
        $totalOrderNew = $this->orderModel->totalOrderNew();
        $totalProduct = $this->productModel->totalProduct();
        $totalPrice = $this->orderModel->totalPrice();
        $totalCustomer = $this->customerModel->totalCustomer();

        $this->view(
            'main-layout',
            [
                'page' => 'home/index',
                'pageName' => 'Trang chủ',
                'totalOrderNew' => $totalOrderNew,
                'totalProduct' => $totalProduct,
                'totalPrice' => $totalPrice,
                'totalCustomer' => $totalCustomer
            ]
        );
    }
}
