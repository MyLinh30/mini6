<?php


namespace Magenest\Questioning\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleQtyCart implements ObserverInterface
{


    public function execute(Observer $observer)
    {
        if(isset($observer->getInfo()['qty'])){
           if($observer->getInfo()['qty']> 1){
               $this->_redirect('checkout/index/index');
           }
        }
        return $observer;
        // TODO: Implement execute() method.
    }
}
