<?php


namespace Magenest\Manufacturer\Controller\Manufacturer;


use Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Show extends \Magento\Framework\App\Action\Action
{
    protected $manufacturerCollectionFactory;
    protected $resultJsonFactory;
    public function __construct(Context $context,
                                JsonFactory $resultJsonFactory,
                                CollectionFactory  $manufacturerCollectionFactory)
    {
        $this->manufacturerCollectionFactory = $manufacturerCollectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $name = $this->getRequest()->getParam('text');
        $collection = $this->manufacturerCollectionFactory->create();
        $resultJson = $this->resultJsonFactory->create();
        $all = $collection->addFieldToSelect('*')
            ->addFieldToFilter('name', $name)->getData();
        return $resultJson->setData($all);
        // TODO: Implement execute() method.
    }
}
