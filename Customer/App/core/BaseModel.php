<?php
class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->HandleConnect();
    }

    public function getAll($tableName, $select = ['*'], $orderBy = [], $limit = 99999)
    {
        $columns = implode(', ', $select);
        $orderByString = implode(' ', $orderBy);
        if ($orderByString) {
            $sql = "
                SELECT ${columns} 
                FROM ${tableName} 
                where status = 1
                ORDER BY ${orderByString}  LiMIT ${limit}
                ";
        } else {
            $sql = "
                SELECT ${columns} 
                FROM ${tableName} 
                where status = 1 LiMIT ${limit}
            ";
        }

        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }

        return $data;
    }

    public function find($tableName, $id)
    {
        $sql = "SELECT * FROM ${tableName} Where id = ${id}";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function create($tableName, $data)
    {
        function handleString($value)
        {
            return "'" . $value . "'";
        }
        $valueString = array_map('handleString', array_values($data));
        $columns = implode(', ', array_keys($data));
        $newValue = implode(', ', $valueString);
        $sql = "
            INSERT INTO ${tableName}(${columns}) 
            VALUE(${newValue})
        ";
        $this->_query($sql);
    }

    public function update($tableName, $id, $data)
    {
        $dataSet = [];
        foreach ($data as $key => $value) {
            array_push($dataSet, "${key} = '${value}'");
        }
        $dataSetString = implode(', ', $dataSet);
        $sql = "UPDATE ${tableName} SET ${dataSetString} WHERE id = ${id}";
        $this->_query($sql);
    }

    public function destroy($tableName, $id)
    {
        $sql = "UPDATE ${tableName} SET status = 0 WHERE id = ${id}";
        $this->_query($sql);
    }

    public function querySql($sql)
    {
        $query = $this->_query($sql);
        return $query;
    }

    private function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }
}
