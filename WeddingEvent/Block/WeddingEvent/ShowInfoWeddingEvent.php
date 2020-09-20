<?php


namespace Magenest\WeddingEvent\Block\WeddingEvent;


use Magento\Framework\View\Element\Template;

class ShowInfoWeddingEvent extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
    public function getUrlShow(){
        return $this->getUrl('wed/wed/index');
    }

}
