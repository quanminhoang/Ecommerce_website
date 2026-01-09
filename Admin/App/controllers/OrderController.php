<?php
class OrderController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
    }

    public function sayHi()
    {
        $orders =  $this->orderModel->getOrders();
        $this->view(
            'main-layout',
            [
                'page' => 'orders/index',
                'pageName' => 'Đơn đặt hàng',
                'orders' => $orders
            ]
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $orders = $this->orderModel->searchOrders($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'orders/index',
                    'pageName' => 'Đơn đặt hàng',
                    'orders' => $orders
                ]
            );
        } else {
            header('location:sayHi');
        }
    }

    public function accept($id)
    {
        $data = ['StatusOrder' => 2];
        $this->orderModel->updateOrder($id, $data);
        header("location:../sayHi");
    }

    public function destroy($id)
    {
        $data = ['StatusOrder' => 3];
        $this->orderModel->updateOrder($id, $data);
        header("location:../sayHi");
    }

    public function acceptShow($id)
    {
        $data = ['StatusOrder' => 2];
        $this->orderModel->updateOrder($id, $data);
        header("location:../show/${id}");
    }

    public function destroyShow($id)
    {
        $data = ['StatusOrder' => 3];
        $this->orderModel->updateOrder($id, $data);
        header("location:../show/${id}");
    }


    public function show($id)
    {
        $customerModel = $this->model('CustomerModel');

        $order = $this->orderModel->getOrderById($id);
        $customerByOrder = $customerModel->getCustomer($order['CustomerID']);
        $orderDetails = $this->orderModel->getOrderDetails($id);

        $this->view(
            'main-layout',
            [
                'page' => 'orders/showOrder',
                'pageName' => 'Chi tiết đơn hàng',
                'order' => $order,
                'customer' => $customerByOrder,
                'orderDetails' => $orderDetails
            ]
        );
    }
}
