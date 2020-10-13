<?php


namespace Magenest\MyLinh\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleSaveUser implements ObserverInterface
{
    private $vendorFactory;

    public function __construct(\Magenest\MyLinh\Model\VendorFactory $vendorFactory){
        $this->vendorFactory=$vendorFactory;
    }

    public function execute(Observer $observer)
    {
        $email = $observer->getData('object')->getData()['email'];
        if(isset($observer->getData('object')->getData()['roles'])){
            if($observer->getData('object')->getData()['roles'][0]==1){
                $vendor= $this->vendorFactory->create()->load($email,'email');
                $vendor->delete();
            }
        }
        return $observer;
    }
}
