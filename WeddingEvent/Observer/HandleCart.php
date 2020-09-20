<?php


namespace Magenest\WeddingEvent\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleCart implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        if(isset($observer->getInfo()['amount'])){
            $observer->getProduct()->setPrice($observer->getInfo()['amount']);
        }
        return $observer;

    }
}
