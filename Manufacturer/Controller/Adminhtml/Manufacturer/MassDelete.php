<?php


namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;


use Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_filter;
    protected $manufacturerCollectionFactory;
    protected $resultFactory;
    public function __construct(Action\Context $context,
                                \Magento\Ui\Component\MassAction\Filter $_filter,
                                CollectionFactory $manufacturerCollectionFactory)
    {
        $this->_filter = $_filter;
        $this->manufacturerCollectionFactory = $manufacturerCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->manufacturerCollectionFactory->create();
        $collection = $this->_filter->getCollection($result);
        $collectionSize = $collection->getSize();
        foreach ($collection as $item){
            $item->delete();
        }
        $this->messageManager->addSuccess(__('A total of %1 element(s) have been deleted.'.$collectionSize));
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('manufacturer/manufacturer/index');

        // TODO: Implement execute() method.
    }
}
