<?php
class BrandModel extends BaseModel
{
    const TableName = 'brands';

    public function getBrands()
    {
        return $this->getAll(self::TableName);
    }

    public function getBrand($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function searchBrands($name)
    {
        return $this->searchName(self::TableName, $name);
    }

    public function createBrand($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateBrand($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }

    public function deleteBrand($id)
    {
        return $this->destroy(self::TableName, $id);
    }
}
