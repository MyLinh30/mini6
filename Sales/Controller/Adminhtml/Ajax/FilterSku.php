<?php


namespace Magenest\Sales\Controller\Adminhtml\Ajax;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class FilterSku extends \Magento\Backend\App\Action
{
   protected $resultPageFactory;
   protected $salesAgentCollectionFactory;
   protected $resultJsonFactory;
   public function __construct(Action\Context $context,
                               \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                               \Magenest\Sales\Model\ResourceModel\SaleAgent\CollectionFactory $salesAgentCollectionFactory,
                               \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory)
   {
       $this->resultPageFactory = $resultPageFactory;
       $this->salesAgentCollectionFactory = $salesAgentCollectionFactory;
       $this->resultJsonFactory = $resultJsonFactory;
       parent::__construct($context);
   }

    public function execute()
    {
        $collection = $this->salesAgentCollectionFactory->create();
        $resultJson = $this->resultJsonFactory->create();
        $getSku = $this->getRequest()->getPost('sku');
        $all = $collection->addAttributetoSelect('commission_value')->addAttributetoFilter('sku',array(
            'like' => '%'.$getSku.'%'));
        foreach ($all as $item){
            $data [] = $item['commission_value'];
        }
        return $resultJson->setData($data);
    }

}
