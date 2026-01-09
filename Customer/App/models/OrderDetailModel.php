<?php
class orderDetailModel extends BaseModel
{
    const TableName = 'orderDetails';

    public function createOrderDetail($sql)
    {
        return $this->querySql($sql);
    }
}
