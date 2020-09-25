<?php


namespace Magenest\Notification\Controller\Notification;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class ChangeViewed extends \Magento\Framework\App\Action\Action
{
    protected $notificationCollectionFactory;
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    protected $notificationFactory;
    public function __construct(Context $context,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\SessionFactory $_sessionFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magenest\Notification\Model\NotificationFactory $notificationFactory,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificationCollectionFactory)
    {
        $this->notificationFactory = $notificationFactory;
        $this->jsonHelper = $jsonHelper;
        $this->customerFactory= $customerFactory;
        $this->_sessionFactory = $_sessionFactory;
        $this->notificationCollectionFactory = $notificationCollectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParam('val');
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        $dataReceived = $model->getNotificationViewed();
        if(!$dataReceived) {
            $dataReceived = $this->jsonHelper->jsonEncode([]);
        }
        $notificationViewed = $this->jsonHelper->jsonDecode($dataReceived);
        if(!(in_array($data,$notificationViewed))){
            array_push($notificationViewed,$data);
        }
        $encodedDataViewed = $this->jsonHelper->jsonEncode($notificationViewed);
        $model->setNotificationViewed($encodedDataViewed);
        $model->save();
    }
}
