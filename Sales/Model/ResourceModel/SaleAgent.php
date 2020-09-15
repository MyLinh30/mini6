<?php


namespace Magenest\Sales\Model\ResourceModel;


class SaleAgent extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('magenest_sales_agent','entity_id');
    }
}
