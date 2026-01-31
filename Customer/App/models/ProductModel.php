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
        $sql = "SELECT * FROM products WHERE status = 1 AND Hot = 1 LIMIT 8";
        return $this->querySql($sql);
    }

    public function productByCate($cateID)
    {
        $sql = "SELECT * FROM products WHERE products.CateID = {$cateID}";
        return $this->querySql($sql);
    }

    public function getProductDiscount()
    {
        $sql = "SELECT * FROM products WHERE products.Discount != 0 AND products.status = 1";
        return $this->querySql($sql);
    }

public function getTopSelling()
{
    $sql = "SELECT p.*, SUM(od.Quantity) as TotalSold 
            FROM products p
            INNER JOIN orderDetails od ON p.ID = od.ProductID
            WHERE p.status = 1
            GROUP BY p.ID
            ORDER BY TotalSold DESC
            LIMIT 5";
            
    $result = $this->querySql($sql);

    if (empty($result)) {
        $sql = "SELECT *, 0 as TotalSold FROM products WHERE status = 1 ORDER BY ID DESC LIMIT 3";
        return $this->querySql($sql);
    }

    return $result;
}



    public function searchProduct($name)
    {
        $sql = "SELECT * FROM products WHERE products.Name like '%{$name}%' AND products.status = 1";
        return  $this->querySql($sql);
    }
    public function minusStock($productId, $quantity)
    {
        $productId = intval($productId);
        $quantity = intval($quantity);

        // Trừ số lượng tồn kho
        $sql = "UPDATE products 
                SET Quantity = Quantity - $quantity 
                WHERE ID = $productId";

        return $this->querySql($sql);
    }

    public function plusStock($id, $qty)
    {
        $sql = "UPDATE products SET Quantity = Quantity + $qty WHERE ID = $id";
        return $this->querySql($sql);
    }
}
