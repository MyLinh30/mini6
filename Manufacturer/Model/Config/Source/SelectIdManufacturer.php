<?php


namespace Magenest\Manufacturer\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class SelectIdManufacturer extends AbstractSource
{
    protected $_manufacturerCollectionFactory;
    public function __construct(\Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory $manufacturerCollectionFactory )
    {
        $this->_manufacturerCollectionFactory = $manufacturerCollectionFactory ;
    }

    public function getAllOptions()
    {
        $collection = $this->_manufacturerCollectionFactory->create();
        $option[] = ['value'=> null, 'label'=> __('--Select option--')];
        $all = $collection->addFieldToSelect(['entity_id','name']);
        foreach ($all as $item){
            $option[] = ['value'=> $item['entity_id'], 'label'=> $item['name']];
        }
        return $option;
        // TODO: Implement getAllOptions() method.
    }
}
