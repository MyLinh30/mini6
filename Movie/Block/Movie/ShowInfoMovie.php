<?php


namespace Magenest\Movie\Block\Movie;


use Magento\Framework\View\Element\Template;

class ShowInfoMovie extends Template
{
    protected $collectionFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory $collectionFactory,
        array $data = []
    ){
        parent::__construct($context,$data);
        $this->collectionFactory=$collectionFactory;
    }

    public function getMovies(){
       $collection = $this->collectionFactory->create();
       $allMovie = $collection->getMovies();
       return $allMovie;
    }

}
