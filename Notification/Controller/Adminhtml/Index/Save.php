<?php


namespace Magenest\Notification\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends \Magento\Backend\App\Action
{
    protected $notificationFactory;
    public function __construct(Action\Context $context,\Magenest\Notification\Model\Notification $notificationFactory)
    {
        $this->notificationFactory = $notificationFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->_objectManager->create('Magenest\Notification\Model\Notification');
        $model->setData($data);
        $model->save();
        $this->_eventManager->dispatch('set_notification_received',['notification'=> $model]);
        $this->messageManager->addSuccess('Add NOTIFICATION success!');
        $this->_redirect('notification/index/index');

        // TODO: Implement execute() method.
    }
}
