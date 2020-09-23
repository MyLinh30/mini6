<?php


namespace Magenest\Manufacturer\Model\ResourceModel\Manufacturer;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName='entity_id';
    protected function _construct()
    {
        $this->_init('Magenest\Manufacturer\Model\Manufacturer','Magenest\Manufacturer\Model\ResourceModel\Manufacturer');
        parent::_construct(); // TODO: Change the autogenerated stub
    }

}