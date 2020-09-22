<?php


namespace Magenest\Questioning\Controller\Exam;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Sales\Model\OrderFactory;

class GetQuestionProduct extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_orderCollectionFactory;
    protected $_productCollectionFactory;
    protected $_productFactory;
    protected $resultJsonFactory;
    public function __construct(Context $context,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                \Magento\Framework\View\Result\PageFactory $_resultPageFactory,
                                \Magento\Catalog\Model\ProductFactory $productFactory,
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_productFactory = $productFactory;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_resultPageFactory = $_resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
   {
        $data = $this->getRequest()->getParam('text');

        $resultJson = $this->resultJsonFactory->create();
        $item =[];
        $orderCollection = $this->_orderCollectionFactory->create();
        $orderCollection->addAttributeToSelect('*');
        $orderCollection->addAttributeToSelect('*')
            ->addAttributeToFilter('entity_id', $data);
        $orderCollection->getSelect()->join(array('second'=> 'quote_item'),'main_table.quote_id = second.quote_id','second.product_id');
        $getDataCollection = $orderCollection->getData();
        foreach ($getDataCollection as $result){
            $idProduct = $result['product_id'];
            $productModel = $this->_productFactory->create();
            $productModel->load($idProduct);
            if($productModel->getId()){
                $questionProduct = $productModel['question'];
            }
            $arr = array_push($item,  $questionProduct);
        }
        return $resultJson->setData($questionProduct);

        // TODO: Implement execute() method.
    }
}
