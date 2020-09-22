<?php


namespace Magenest\Questioning\Block;


use Magento\Framework\View\Element\Template;

class ShowKeyWordQuestion extends Template
{
    protected $productFactory;
    public function __construct(Template\Context $context,
                                \Magento\Catalog\Model\ProductFactory $productFactory,
                                array $data = [])
    {
       $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }
    public function getKeyWord()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->productFactory->create();
        $model->load($id);
        if($model->getId() && isset($model['question'])){
            $keyWord =$model['question'];
        }
        return $keyWord;
    }

}
