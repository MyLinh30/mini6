<?php


namespace Magenest\Manufacturer\Block\Adminhtml\Manufacturer\Edit;


use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\Template;

class GenericButton
{
    protected $context;
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getId()
    {
        return $this->context->getRequest()->getParam('entity_id');
    }
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
