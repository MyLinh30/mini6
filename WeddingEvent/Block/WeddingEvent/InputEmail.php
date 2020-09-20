<?php


namespace Magenest\WeddingEvent\Block\WeddingEvent;


use Magento\Framework\View\Element\Template;

class InputEmail extends Template
{
    protected $_listProduct;
    public function __construct(Template\Context $context,
                                \Magento\Catalog\Block\Product\ListProduct $listProduct,
                                array $data = [])
    {
        $this->_listProduct = $listProduct;
        parent::__construct($context, $data);
    }
    public function getWeddingInfoUrl(){
        return $this->getUrl("wed/ajax/showinfobyemail");
    }

    public function getAddToCartPostParamUrl(){
        return $this->getUrl("wed/ajax/addtocartpostparam");
    }

    public function getProduct(){

    }
    public function getAddToCartPostParam($product){
        return $this->_listProduct->getAddToCartPostParams($product);
    }


}
