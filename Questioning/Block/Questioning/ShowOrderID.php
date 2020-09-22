<?php


namespace Magenest\Questioning\Block\Questioning;


use Magento\Framework\View\Element\Template;

class ShowOrderID extends Template
{
    protected $_orderCollectionFactory;
    public function __construct(Template\Context $context,
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $_orderCollectionFactory,
                                array $data = [])
    {
        $this->_orderCollectionFactory = $_orderCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getOrderId(){
        $collection = $this->_orderCollectionFactory->create();
        $collection->addAttributeToSelect('entity_id');
        return $collection->getData();
    }

}
