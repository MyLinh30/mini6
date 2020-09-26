<?php


namespace Magenest\Notification\Block\Account;


use Magento\Framework\View\Element\Template;

class MyNotification extends Template
{
    protected $notificationCollectionFactory;
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    public function __construct(Template\Context $context,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\SessionFactory $_sessionFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificationCollectionFactory,
                                array $data = [])
    {
        $this->jsonHelper = $jsonHelper;
        $this->customerFactory= $customerFactory;
        $this->_sessionFactory = $_sessionFactory;
        $this->notificationCollectionFactory = $notificationCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getUrlMyNotification (){
        return $this->getUrl('notification/notification/index');
    }
    public function getNotificationNotView()
    {
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        $notificationReceived = $this->jsonHelper->jsonDecode($model->getNotificationReceived());
        $collectionReceived = $this->notificationCollectionFactory->create();
        $received = $collectionReceived->addFieldToSelect('entity_id')
            ->addFieldToFilter('entity_id', ['in'=>$notificationReceived]);
        $dataReceived = $model->getNotificationViewed();
        if(!$dataReceived) {
            $dataReceived = $this->jsonHelper->jsonEncode([]);
        }
        $notificationViewed = $this->jsonHelper->jsonDecode($dataReceived);
        $option = array(  "received" => $received,"seen" => $notificationViewed);
        foreach ($option['received'] as $notificationViewed){
            if(!(in_array($notificationViewed->getId(),$option['seen']))){
                $result[] = [$notificationViewed['entity_id']];
            }
        }
        if( count($result)>0){
            return count($result);
        }
        else {
            return (int)0;
        }

    }
}
