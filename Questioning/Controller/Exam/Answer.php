<?php


namespace Magenest\Questioning\Controller\Exam;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Answer extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    public function __construct(Context $context,\Magento\Framework\View\Result\PageFactory $_resultPageFactory)
    {
        $this->_resultPageFactory = $_resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_resultPageFactory->create();
        // TODO: Implement execute() method.
    }
}
