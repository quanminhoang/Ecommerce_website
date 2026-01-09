<?php
class AdminModel extends BaseModel
{
    const tableName = 'administrators';

    public function findEmail($email)
    {
        $sql = "SELECT * FROM administrators WHERE Email = '${email}'";
        $result =  $this->querySql($sql);
        return mysqli_fetch_array($result);
    }
}
