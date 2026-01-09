<?php
class CustomerModel extends BaseModel
{
    const TableName = 'customers';

    public function getCustomers()
    {
        return $this->getAll(self::TableName);
    }

    public function getCustomer($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function searchCustomers($name)
    {
        return $this->searchName(self::TableName, $name);
    }

    public function totalCustomer()
    {
        $sql = "SELECT COUNT(*) as customerNumber FROM customers WHERE customers.Status = 1";
        $result = mysqli_fetch_array($this->querySql($sql));
        return $result;
    }
}
