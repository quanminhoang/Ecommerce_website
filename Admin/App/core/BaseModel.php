<?php
class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->HandleConnect();
    }

    public function getAll($tableName, $select = ['*'], $orderBy = [])
    {
        $columns = implode(', ', $select);
        $orderByString = implode(' ', $orderBy);
        if ($orderByString) {
            $sql = "
                SELECT ${columns} 
                FROM ${tableName} 
                where status = 1 
                ORDER BY ${orderByString} 
                ";
        } else {
            $sql = "
                SELECT ${columns} 
                FROM ${tableName} 
                where status = 1 
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
        $sql = "SELECT * FROM ${tableName} Where ID = ${id}";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function searchName($tableName, $name)
    {
        $sql = "SELECT * 
        FROM ${tableName}
        WHERE ${tableName}.name like '%${name}%' 
        AND ${tableName}.status = 1";
        $query = $this->_query($sql);
        return $query;
    }

    public function querySql($sql)
    {
        $query = $this->_query($sql);
        return $query;
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE ${tableName} SET ${dataSetString}, UpdateAt='${date}' WHERE id = ${id}";
        $this->_query($sql);
    }

    public function destroy($tableName, $id)
    {
        $sql = "UPDATE ${tableName} SET status = 0 WHERE id = ${id}";
        $this->_query($sql);
    }

    private function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }
}
