<?php


namespace Magenest\Questioning\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleCustomerPrefix implements ObserverInterface
{
    protected $customerFactory;
    public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }
    public function execute(Observer $observer)
    {
        $data = $observer->getCustomer();
        if(strlen($data->getFirstname()) %2 ==0){
            $observer->getCustomer()->setCustomPrefix('Even');
        }
        else {
            $observer->getCustomer()->setCustomPrefix('Odd');
        }
        return $observer;
    }
}
