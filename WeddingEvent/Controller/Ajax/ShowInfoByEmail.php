<?php


namespace Magenest\WeddingEvent\Controller\Ajax;


use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class ShowInfoByEmail extends \Magento\Framework\App\Action\Action
{
    protected $weddingCollectionFactory;
    protected $resultJsonFactory;
    public function __construct(Context $context,
                                \Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory $weddingCollectionFactory,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory)
    {
        $this->weddingCollectionFactory = $weddingCollectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $bride_email = $data['bride_email'];
        $groom_email = $data['groom_email'];
        $collection = $this->weddingCollectionFactory->create();
        $resultJson = $this->resultJsonFactory->create();
        $all = $collection->addFieldToFilter('bride_email', array('eq' => $bride_email))
            ->addFieldToFilter('groom_email', array('eq1' => $groom_email))->getData();
        if (count($all)>0){
            $resultJson->setData($all[0]);
        }
        else {
            $resultJson->setData([]);
        }
        return $resultJson;

    }
}
