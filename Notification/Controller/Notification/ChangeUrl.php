<?php


namespace Magenest\Notification\Controller\Notification;


use Magenest\Notification\Model\Notification;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class ChangeUrl extends \Magento\Framework\App\Action\Action
{
    protected $notificationFactory;
    public function __construct(Context $context,
                                \Magenest\Notification\Model\NotificationFactory $notificationFactory)
    {
        $this->notificationFactory = $notificationFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->notificationFactory->create()->load($data['val']);
        if($model->getId()){
            $model->setRedirectUrl($data['href']);
            $model->save();
        }
    }
}
