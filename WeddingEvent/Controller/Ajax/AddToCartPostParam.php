<?php


namespace Magenest\WeddingEvent\Controller\Ajax;


use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class AddToCartPostParam extends \Magento\Framework\App\Action\Action
{
    protected $_listProduct;
    protected $productFactory;
    protected $productCollectionFactory;
    protected $resultJsonFactory;
    public function __construct(Context $context,
                                ListProduct $listProduct,
                                ProductFactory $productFactory,
                                CollectionFactory $productCollectionFactory,
                                JsonFactory $resultJsonFactory)
    {
        $this->_listProduct = $listProduct;
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    public function getProductPostParams(\Magento\Catalog\Model\Product $product)
    {
        return $this->_listProduct->getAddToCartPostParams($product);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $collection = $this->productCollectionFactory->create();
        $products = $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('wedding_event_id',$id)
            ->getData();
        $product = $this->productFactory->create();
        $product->load($products[0]['entity_id']);
        $postParam = $this->getProductPostParams($product);
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($postParam);
    }
}
