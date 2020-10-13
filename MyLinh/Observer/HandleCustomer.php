<?php


namespace Magenest\MyLinh\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleCustomer implements ObserverInterface
{
    protected $vendorFactory;
    public function __construct(\Magenest\MyLinh\Model\VendorFactory $vendorFactory)
    {
        $this->vendorFactory = $vendorFactory;
    }

    public function execute(Observer $observer)
    {
//        $staffModel = $this->vendorFactory->create();
//        $customer = $observer->getData('customer');
//        $staffTypeId = $customer->getCustomAttribute('staff_type')->getValue();
//        $data = [
//            'customer_id' => $customer->getId(),
//            'nick_name' => $customer->getFirstname() . ' ' . $customer->getLastname(),
//            'type' => $staffTypeId,
//            'status' => 2,
//        ];
//        $staffModel->setData($data);
//        $staffModel->save();
//        return;
//        // TODO: Implement execute() method.
    }
}
