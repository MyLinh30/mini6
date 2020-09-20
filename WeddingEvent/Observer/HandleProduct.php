<?php


namespace Magenest\WeddingEvent\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleProduct implements ObserverInterface
{

    protected $_productFactory;
    public function __construct(\Magento\Catalog\Model\ProductFactory $productFactory){
        $this->_productFactory = $productFactory;
    }
    public function execute(Observer $observer)
    {
        $data = $observer->getData('wedding');
        $id = $data['id'];
        $model = $this->_productFactory->create();
        $model->setSku($data['title']);
        $model->setName($data['title']);
        $model->setAttributeSetId($id);
        $model->setStatus(1);
        //$product->setWeight(10);
        $model->setVisibility(4);
        //$model->setTaxClassId(0);
        $model->setTypeId('virtual');
        $model->setPrice(280000);
        $model->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => 50
            )
        );
        //$model->setWeddingEventId($id);
        $model->save();
    }
}
