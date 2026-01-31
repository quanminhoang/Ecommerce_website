<?php
class orderModel extends BaseModel
{
    const TableName = 'orders';

    public function createOrder($data)
    {
        $this->create(self::TableName, $data);
        return mysqli_insert_id($this->connect);
    }

    public function getOrders($customerID)
    {
        $sql = "SELECT * FROM orders WHERE orders.CustomerID = {$customerID}";
        return $this->querySql($sql);
    }

    public function getOrderbyCustomer($id)
    {
        $sql = "SELECT orders.ID FROM orders, customers WHERE orders.CustomerID = customers.ID AND orders.CustomerID = {$id}";
        return $this->querySql($sql);
    }

    public function updateModel($id, $data)
    {
        $this->update(self::TableName, $id, $data);
    }
    /* Dán vào trong file OrderModel.php */
    public function getOrdersByCustomer($customerId)
    {
        $sql = "SELECT * FROM orders WHERE CustomerID = $customerId ORDER BY ID DESC";
        return $this->querySql($sql);
    }

    public function getOrderById($id)
    {
        $sql = "SELECT orders.*, customers.Name 
            FROM orders, customers 
            WHERE orders.CustomerID = customers.ID 
            AND orders.ID = $id";
        $result = $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    public function getOrderDetails($id)
    {
        $sql = "SELECT orderdetails.*, products.Name, products.img 
            FROM orderdetails, products 
            WHERE orderdetails.ProductID = products.ID 
            AND orderdetails.OrderID = $id";
        return $this->querySql($sql);
    }

    public function updateOrder($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }
}
