<?php


namespace Magenest\Sales\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ShowIdSaleAgent extends AbstractSource
{
    protected $customerCollectionFactory;
    public function __construct(\Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory )
    {
        $this->customerCollectionFactory = $customerCollectionFactory;

    }

    public function getAllOptions()
    {
        $collection = $this->customerCollectionFactory->create();
        $options[] =['value'=>null,'label'=> __('--Select Option--')];
        $all = $collection
            ->addAttributeToSelect(['entity_id'])
            ->addAttributeToFilter('is_sales_agent','1');
        foreach ($all as $sa)
        {
            $options[] = ['value'=>$sa['entity_id'],'label'=>$sa['entity_id']];
        }
        return  $options;
    }
}
