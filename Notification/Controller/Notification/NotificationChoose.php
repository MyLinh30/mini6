<?php


namespace Magenest\Notification\Controller\Notification;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class NotificationChoose extends \Magento\Framework\App\Action\Action
{
    protected $notificationCollectionFactory;
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    protected $resultJsonFactory;
    protected $notificationFactory;
    public function __construct(Context $context,
                                JsonFactory $resultJsonFactory,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\SessionFactory $_sessionFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magenest\Notification\Model\NotificationFactory $notificationFactory,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificationCollectionFactory)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->notificationFactory = $notificationFactory;
        $this->jsonHelper = $jsonHelper;
        $this->customerFactory= $customerFactory;
        $this->_sessionFactory = $_sessionFactory;
        $this->notificationCollectionFactory = $notificationCollectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        //json_encode: convert gia tri string chi dinh sang Json
        //json_decode: khoi phuc du lieu ma hoa tro ve ban goc


        //$data = $this->getRequest()->getParam('val');
        $data = 1;
        $resultJson = $this->resultJsonFactory->create();
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        //chuyen json sang array
        $notificationReceived = $this->jsonHelper->jsonDecode($model->getNotificationReceived());
        //collection getData()
        $collectionReceived = $this->notificationCollectionFactory->create();
        $received = $collectionReceived
            ->addFieldToSelect(['entity_id','created_at','short_description'])
            ->addFieldToFilter('entity_id', ['in'=>$notificationReceived])->setPageSize($data);
        $dataReceived = $model->getNotificationViewed();
        if(!$dataReceived) {
            $dataReceived = $this->jsonHelper->jsonEncode([]);
        }
        $notificationViewed = $this->jsonHelper->jsonDecode($dataReceived);
        $option = array( "received" => $received->getData(),"seen" => $notificationViewed);
        $result = $this->jsonHelper->jsonEncode($option);
        return $resultJson->setData($result);
    }

}
