<?php


namespace Magenest\MyLinh\Block;


use Magento\Framework\View\Element\Template;

class InfoVendor extends Template
{
    public function getUrlInputInfoVendor(){
        return $this->getUrl('mylinh/vendor/inputinfovendor');
    }

}
