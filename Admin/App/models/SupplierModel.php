<?php
class SupplierModel extends BaseModel
{
    const TableName = 'suppliers';

    public function getSuppliers()
    {
        return $this->getAll(self::TableName);
    }

    public function getSupplier($id)
    {
        return $this->find(self::TableName, $id);
    }

    public function searchSuppliers($name)
    {
        return $this->searchName(self::TableName, $name);
    }

    public function createSupplier($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateSupplier($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }

    public function deleteSupplier($id)
    {
        return $this->destroy(self::TableName, $id);
    }
}
