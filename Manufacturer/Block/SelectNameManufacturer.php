<?php


namespace Magenest\Manufacturer\Block;


use Magento\Framework\View\Element\Template;

class SelectNameManufacturer extends Template
{
    protected $productFactory;
    protected $manufacturerCollectionFactory;
    public function __construct(Template\Context $context,
                                \Magento\Catalog\Model\ProductFactory $productFactory,
                                \Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory $manufacturerCollectionFactory,
                                array $data = [])
    {
        $this->productFactory = $productFactory;
        $this->manufacturerCollectionFactory = $manufacturerCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getUrlInfoManufacturer(){
        return $this->getUrl('manufacturer/manufacturer/show');
    }
    public function getNameManufacturer(){
        $data = $this->getRequest()->getParam('id');
        $collection = $this->manufacturerCollectionFactory->create();
        $model = $this->productFactory->create()->load($data);
        if($model->getId() && ($model->getManufacturerId()) ){
            $all = $collection->addFieldToSelect('name')
                ->addFieldToFilter('entity_id',$model->getManufacturerId());
            $result = $all->getData();
            $res= $result[0]['name'];
        }
        else {
            $res = [];
        }
        return $res;
    }


}
