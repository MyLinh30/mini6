<?php


namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Add extends \Magento\Backend\App\Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        // TODO: Implement execute() method.
    }
}
