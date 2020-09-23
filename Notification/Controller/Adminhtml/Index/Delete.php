<?php


namespace Magenest\Notification\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Delete extends \Magento\Backend\App\Action
{
    protected $notificationFactory;
    public function __construct(Action\Context $context,\Magenest\Notification\Model\NotificationFactory $notificationFactory )
    {
        $this->notificationFactory = $notificationFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->notificationFactory->create()->load($id);
        $model->delete();
        $this->messageManager->addSuccess('Delete NOTTFICATION SUCCESS!');
        $this->_redirect('notification/index/index');
        // TODO: Implement execute() method.
    }
}
