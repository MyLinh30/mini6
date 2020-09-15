<?php


namespace Magenest\Sales\Block;


use Magento\Framework\View\Element\Template;

class AllProductHasSA extends Template
{
    protected $_session;
    protected $productCollectionFactory;
    public function __construct(Template\Context $context,
                                \Magento\Customer\Model\Session $session,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
                                \Magento\Customer\Model\SessionFactory $_sessionFactory,
                                array $data = [])
    {
        $this->_session= $session;
        $this->_sessionFactory = $_sessionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getInfoProduct()
    {
        $customer = $this->_sessionFactory->create()->getCustomer();
        if($customer){
            $collection = $this->productCollectionFactory->create();
            $info = $customer->getData();
            $idCustomer = $info['entity_id'];
            $all = $collection->addAttributeToSelect('*')->addAttributeToFilter('sale_agent_id', $idCustomer);
            if($all->getData()){
                foreach ($all as $item){
                    $data['name'] = $item['name'];
                    $data['sku'] = $item['sku'];
                    $data['url'] = $item['url_key'];
                    $data['commission_type'] = $item['commission_type'];
                    $data['commission_value'] = $item['commission_value'];
                }
                return $data;
            };

        }
    }

}
