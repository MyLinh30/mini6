<?php


namespace Magenest\MyLinh\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleVendor implements ObserverInterface
{
    protected $vendorFactory;
    public function __construct(\Magenest\MyLinh\Model\VendorFactory $vendorFactory)
    {
        $this->vendorFactory = $vendorFactory;
    }
    public function execute(Observer $observer)
    {
        $data = $observer->getData('customer');
        $model = $this->vendorFactory->create();
        $model->setEmail($data['email']);
        $model->setFirstName($data['first_name']);
        $model->setLastName($data['last_name']);
        $model->setCustomerId($data['id']);
        $model->save();
        // TODO: Implement execute() method.
    }
}
