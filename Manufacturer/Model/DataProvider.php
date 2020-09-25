<?php


namespace Magenest\Manufacturer\Model;


use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;
    public function __construct($name,
                                $primaryFieldName,
                                \Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory $collectionFactory,
                                $requestFieldName,
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
        foreach ($item as $manufacturer){
            $this->_loadedData[$manufacturer->getId()]= $manufacturer->getData();
        }
        return $this->_loadedData;
    }

}
