<?php


namespace Magenest\Movie\Model\ResourceModel;


class Movie extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('magenest_movie','movie_id');
        // TODO: Implement _construct() method.
    }
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        return parent::load($object, $value, $field); // TODO: Change the autogenerated stub
    }
}