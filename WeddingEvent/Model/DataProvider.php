<?php


namespace Magenest\WeddingEvent\Model;


use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;
    public function __construct($name,
                                $primaryFieldName,
                                \Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory $collectionFactory,
                                $requestFieldName,
                                array $meta = [],
                                array $data = [])
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->_loadedData)){
            return $this->_loadedData;
        }
        $item  = $this->collection->getItems();
        foreach ($item as $wed) {
            $this->_loadedData[$wed->getId()] = $wed->getData();
        }
        return $this->_loadedData;
    }

}
