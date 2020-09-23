<?php


namespace Magenest\Manufacturer\Model\ResourceModel;


class Manufacturer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('manufacturer_entity','entity_id');
        // TODO: Implement _construct() method.
    }
}
