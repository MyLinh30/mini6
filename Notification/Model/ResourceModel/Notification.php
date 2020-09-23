<?php


namespace Magenest\Notification\Model\ResourceModel;


class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('promo_notification','entity_id');
        // TODO: Implement _construct() method.
    }
}
