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


    public function searchCategories($name)
    {
        return $this->searchName(self::TableName, $name);
    }

    public function createCategory($data)
    {
        return $this->create(self::TableName, $data);
    }

    public function updateCategory($id, $data)
    {
        return $this->update(self::TableName, $id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->destroy(self::TableName, $id);
    }
}
