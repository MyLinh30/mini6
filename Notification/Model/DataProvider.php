<?php


namespace Magenest\Notification\Model;


use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;
    public function __construct($name,
                                $primaryFieldName,
                                $requestFieldName,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $collectionFactory,
                                array $meta = [],
                                array $data = [])
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if(isset($this->_loadedData)){
            return $this->_loadedData;
        }
        $item = $this->collection->getItems();
        foreach ($item as $no){
            $this->_loadedData[$no->getId()] = $no->getData();
        }
        return $this->_loadedData;
    }
}
