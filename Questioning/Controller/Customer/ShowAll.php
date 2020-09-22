<?php


namespace Magenest\Questioning\Controller\Customer;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class ShowAll extends Action
{
    protected $customerCollectionFactory;
    protected $resultJsonFactory;
    protected $customerFactory;
    public function __construct(Context $context,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->customerCollectionFactory->create();
        $result = [];
        $resultJson = $this->resultJsonFactory->create();
        $collection->addAttributeToSelect('*');
        return $resultJson->setData($collection->getData());
//        foreach ($collection as $item){
//            $data = $item->getData();
//            $idCustomer = $data['entity_id'];
//            $model = $this->customerFactory->create()->load($idCustomer);
//        }
//        return $resultJson->setData($model->getData());
//        // TODO: Implement execute() method.
    }
}
