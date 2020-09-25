<?php


namespace Magenest\Notification\Controller\Notification;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class DeleteNotification extends \Magento\Framework\App\Action\Action
{
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    public function __construct(Context $context,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\SessionFactory $_sessionFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory)
    {
        $this->_sessionFactory = $_sessionFactory;
        $this->customerFactory = $customerFactory;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParam('val');
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        if($model->getId()){
            $dataReceived = $model->getNotificationReceived();
            if(!$dataReceived) {
                $dataReceived = $this->jsonHelper->jsonEncode([]);
            }
            $notificationReceived = $this->jsonHelper->jsonDecode($dataReceived);
            if (($key = array_search($data,$notificationReceived )) !== false) {
                unset($notificationReceived[$key]);
            }
            $encodedDataViewed = $this->jsonHelper->jsonEncode($notificationReceived);
            $model->setNotificationReceived($encodedDataViewed);
            $model->save();
        }
    }
}
