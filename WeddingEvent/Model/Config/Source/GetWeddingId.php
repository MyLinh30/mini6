<?php


namespace Magenest\WeddingEvent\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class GetWeddingId extends AbstractSource
{
    protected $_weddingCollectionFactory;
    public function __construct(\Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory $weddingCollectionFactoryFactory )
    {
        $this->_weddingCollectionFactory = $weddingCollectionFactoryFactory;
    }

    public function getAllOptions()
    {
        $collection = $this->_weddingCollectionFactory->create();
        $option[] = ['value'=> null, 'label'=> __('--Select option--')];
        $all = $collection->addFieldToSelect(['title','id']);
        foreach ($all as $item){
            $option[] = ['value'=> $item['id'], 'label'=> $item['title']];
        }
        return $option;
        // TODO: Implement getAllOptions() method.
    }
}
