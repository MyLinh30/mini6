<?php


namespace Magenest\Questioning\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    public function __construct(Context $context,\Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_resultPageFactory->create();
        // TODO: Implement execute() method.
    }
}
