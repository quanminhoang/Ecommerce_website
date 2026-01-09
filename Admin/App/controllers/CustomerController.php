<?php
class CustomerController extends BaseController
{
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = $this->model('CustomerModel');
    }

    public function sayHi()
    {
        $customers = $this->customerModel->getCustomers();
        $this->view(
            'main-layout',
            [
                'page' => 'customers/index',
                'pageName' => 'Khách hàng',
                'customers' => $customers
            ]
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $customers = $this->customerModel->searchCustomers($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'customers/searchCustomer',
                    'pageName' => 'Khách hàng',
                    'customers' => $customers
                ]
            );
        } else {
            header('Location:sayHi');
        }
    }
}
