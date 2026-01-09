<?php
class ProductModel extends BaseModel
{
    const TableName = 'products';

    public function getProducts()
    {
        return $this->getAll(self::TableName);
    }

    public function getPropertyProducts()
    {
        $sql = " SELECT products.ID, products.Img, products.Name as productName, products.Price, products.PromotionPrice, products.Discount, products.Hot, products.ViewCount, categories.Name as categoryName 
        FROM products, categories 
        WHERE products.Status = 1 
        AND products.CateID = categories.ID";

        return $this->querySql($sql);
    }

    public function getProduct($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function createProduct($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function getProductsByCategory($CateID)
    {
        $sql = "SELECT * FROM products WHERE products.CateID = ${CateID} AND products.status=1";
        return $this->querySql($sql);
    }

    public function getProductsByBrand($BrandID)
    {
        $sql = "SELECT * FROM products WHERE products.BrandID = ${BrandID} AND products.status=1";
        return $this->querySql($sql);
    }

    public function getProductsBySupplier($SupplerID)
    {
        $sql = "SELECT * FROM products WHERE products.SupplierID = ${SupplerID} AND products.status=1";
        return $this->querySql($sql);
    }

    public function updateProduct($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }

    public function searchProduct($name)
    {
        $sql = " SELECT products.ID, products.Img, products.Name as productName, products.Price, products.PromotionPrice, products.Discount, products.Hot, products.ViewCount, categories.Name as categoryName 
        FROM products, categories 
        WHERE products.Status = 1 
        AND categories.status = 1 
        AND products.CateID = categories.ID
        AND products.name like '%${name}%'";
        return $this->querySql($sql);
    }

    public function deleteProduct($id)
    {
        return $this->destroy(self::TableName, $id);
    }

    public function deleteProductByCategory($CateID)
    {
        $sql = "UPDATE products 
        SET products.Status = 0 
        Where products.CateID =${CateID} 
        AND products.Status = 1";
        return $this->querySql($sql);
    }

    public function totalProduct()
    {
        $sql = "SELECT COUNT(*) as productNumber FROM products WHERE products.Status = 1";
        $result = mysqli_fetch_array($this->querySql($sql));;
        return $result;
    }
}
