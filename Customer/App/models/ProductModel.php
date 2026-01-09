<?php
class ProductModel extends BaseModel
{
    const TableName = 'products';

    public function getProducts($order, $limit)
    {
        return $this->getAll(self::TableName, ['*'], $order, $limit);
    }

    public function getProduct($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function getProductHot()
    {
        $sql = "SELECT * FROM products WHERE status = 1 AND Hot = 1 limit 4";
        return $this->querySql($sql);
    }

    public function productByCate($cateID)
    {
        $sql = "SELECT * FROM products WHERE products.CateID = ${cateID}";
        return $this->querySql($sql);
    }

    public function getProductDiscount()
    {
        $sql = "SELECT * FROM products WHERE products.Discount != 0 limit 8";
        return $this->querySql($sql);
    }

    public function searchProduct($name)
    {
        $sql = "SELECT * FROM products WHERE products.Name like '%${name}%' AND products.status = 1";
        return  $this->querySql($sql);
    }
}
