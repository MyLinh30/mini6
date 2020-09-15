<?php


namespace Magenest\Sales\Model\ResourceModel\SaleAgent;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init('Magenest\Sales\Model\SaleAgent','Magenest\Sales\Model\ResourceModel\SaleAgent');
    }
}
