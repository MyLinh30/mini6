<?php


namespace Magenest\WeddingEvent\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleCart implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        if(isset($observer->getInfo()['qty'])){
            $data= $observer->getProduct();
            $data->setPrice($observer->getInfo()['qty']);
            $data->save();
        }
        return $observer;

    }
}
