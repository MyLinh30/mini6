<?php


namespace Magenest\Manufacturer\Block\Adminhtml\Manufacturer;


use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getUrlAddManufacturer()
    {
        return $this->getUrl('manufacturer/manufacturer/add');
    }
}
