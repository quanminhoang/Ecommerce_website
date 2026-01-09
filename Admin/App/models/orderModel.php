<?php
class OrderModel extends BaseModel
{
    const TableName = 'orders';
    public function getOrders()
    {
        $sql = "SELECT orders.ID, orders.OrderDate, orders.NameReceive, orders.PhoneReceive, orders.AddressReceive, orders.AddressReceive, orders.Total, orders.StatusOrder, customers.Name FROM orders, customers 
        WHERE orders.CustomerID = customers.ID ORDER BY orders.ID DESC";
        return $this->querySql($sql);
    }

    public function getOrderById($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function searchOrders($name)
    {
        $sql = "SELECT orders.ID, orders.OrderDate, orders.NameReceive, orders.PhoneReceive, orders.AddressReceive, orders.AddressReceive, orders.Total, orders.StatusOrder, customers.Name FROM orders, customers 
        WHERE orders.CustomerID = customers.ID
        AND customers.name like '%${name}%'
        ";
        return $this->querySql($sql);
    }

    public function getOrderDetails($id)
    {
        $sql = "SELECT orderdetails.Quantity, orderdetails.Price, orderdetails.Size, products.Name
        FROM orderdetails, products 
        WHERE orderdetails.ProductID = products.ID 
        AND orderdetails.OrderID = ${id}";
        return $this->querySql($sql);
    }

    public function updateOrder($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }

    public function totalOrderNew()
    {
        $sql = "SELECT COUNT(*) as orderNumber FROM orders WHERE orders.StatusOrder = 1";
        $result = mysqli_fetch_array($this->querySql($sql));;
        return $result;
    }

    public function totalPrice()
    {
        $sql = "SELECT SUM(Total) as totalPrice FROM orders WHERE orders.StatusOrder = 2";
        $result = mysqli_fetch_array($this->querySql($sql));;
        return $result;
    }
}
