<?php
class CategoryModel extends BaseModel
{
    const TableName = 'categories';

    public function getCategories()
    {
        return $this->getAll(self::TableName);
    }

    public function getCategory($id)
    {
        return $this->find(self::TableName, $id);
    }
}
