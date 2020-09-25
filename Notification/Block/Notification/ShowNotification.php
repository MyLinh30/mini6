<?php


namespace Magenest\Notification\Block\Notification;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\View\Element\Template;

class ShowNotification extends Template
{
    protected $notificationCollectionFactory;
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    public function __construct(Template\Context $context,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Customer\Model\SessionFactory $sessionFactory,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificationCollectionFactory,
                                array $data = [])
    {
        $this->jsonHelper = $jsonHelper;
        $this->customerFactory = $customerFactory;
        $this->notificationCollectionFactory = $notificationCollectionFactory;
        $this->_sessionFactory = $sessionFactory;
        parent::__construct($context, $data);
    }
    public function getMyNotification()
    {
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        $notificationReceived = $this->jsonHelper->jsonDecode($model->getNotificationReceived());
        $collectionReceived = $this->notificationCollectionFactory->create();
        $received = $collectionReceived->addFieldToSelect(['entity_id','created_at','short_description'])
            ->addFieldToFilter('entity_id', ['in'=>$notificationReceived]);
        $dataReceived = $model->getNotificationViewed();
        if(!$dataReceived) {
            $dataReceived = $this->jsonHelper->jsonEncode([]);
        }
        $notificationViewed = $this->jsonHelper->jsonDecode($dataReceived);
        $option = array( "received" => $received->getData(),"seen" => $notificationViewed);
        return $option;
    }


}
