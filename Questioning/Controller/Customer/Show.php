<?php


namespace Magenest\Questioning\Controller\Customer;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Show extends \Magento\Framework\App\Action\Action
{
    protected $_sessionFactory;
    protected $customerCollectionFactory;
    protected $resultJsonFactory;
    protected $customerFatory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\CustomerFactory  $customerFactory,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                SessionFactory $sessionFactory,
                                \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory)
    {
        $this->customerFatory = $customerFactory;
        $this->_sessionFactory = $sessionFactory;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $customerSession = $this->_sessionFactory->create();
        $customerId= $customerSession->getCustomer()->getId();
        $customerCutomPrefix = $this->customerFatory->create()->load($customerId)->getCustomPrefix();
        $collection = $this->customerCollectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('custom_prefix', $customerCutomPrefix);
        $data = $collection->getData();
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($data);
    }
}

