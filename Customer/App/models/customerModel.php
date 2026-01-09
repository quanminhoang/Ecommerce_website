<?php
class CustomerModel extends BaseModel
{
    const TableName = 'customers';

    public function createCustomer($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function findEmail($email)
    {
        $sql = "SELECT * FROM customers WHERE Email = '${email}' and Status = '1' and verify = '1'";
        $result =  $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    public function emailVerify($email)
    {
        $sql = "SELECT * FROM customers WHERE Email = '${email}' and Status = '1' and verify = '0'";
        $result =  $this->querySql($sql);
        return mysqli_fetch_array($result);
    }

    public function updateCustomer($id, $data)
    {
        $this->update(self::TableName, $id, $data);
    }
}
