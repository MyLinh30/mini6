<?php


namespace Magenest\MyLinh\Controller\Vendor;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class InputInfoVendor extends \Magento\Framework\App\Action\Action
{
    public $resultPageFactory;
    public function __construct(Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       return $this->resultPageFactory->create();

    }
}
