<?php


namespace Magenest\Sales\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleCustomer implements ObserverInterface
{
    protected $customerFactory;
    public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }
    public function execute(Observer $observer)
    {
        $customer = $observer->getData('customer');
        $customer->getData();
        if($customer['is_sales_agent']==1){
            $customer->setFirstname('Sales Agent: ' . $customer['firstname']);
        }
    }
}
