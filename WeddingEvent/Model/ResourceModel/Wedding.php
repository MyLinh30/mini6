<?php


namespace Magenest\WeddingEvent\Model\ResourceModel;


class Wedding extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('magenest_wedding_event','id');
        // TODO: Implement _construct() method.
    }
}
