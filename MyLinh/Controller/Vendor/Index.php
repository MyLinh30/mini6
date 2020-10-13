<?php


namespace Magenest\MyLinh\Controller\Vendor;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $customerFactory;
    protected $resultJsonFactory;
    public function __construct(Context $context,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory)
    {
       $this->customerFactory = $customerFactory;
       $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $idCustomer = $this->getRequest()->getParam("val");
        $customer = $this->customerFactory->create()->load($idCustomer);
        $resultJson = $this->resultJsonFactory->create();
        $customerData = $customer->getData();
        if(count($customerData)==0){
            $customerData["status"]="notFound";
        }else{
            $customerData["status"]="found";
        }
        return  $resultJson->setData($customerData);
    }
}
