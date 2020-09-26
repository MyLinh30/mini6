<?php


namespace Magenest\Notification\Block\Notification;


use Magenest\Notification\Model\Notification;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\View\Element\Template;

class ShowNotification extends Template
{
    protected $notificationCollectionFactory;
    protected $_sessionFactory;
    protected $customerFactory;
    protected $jsonHelper;
    protected $notificationCollection;
    public function __construct(Template\Context $context,
                                \Magenest\Notification\Model\Notification $notificationCollection,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Customer\Model\SessionFactory $sessionFactory,
                                \Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificationCollectionFactory,
                                array $data = [])
    {
        $this->notificationCollection = $notificationCollection;
        $this->jsonHelper = $jsonHelper;
        $this->customerFactory = $customerFactory;
        $this->notificationCollectionFactory = $notificationCollectionFactory;
        $this->_sessionFactory = $sessionFactory;
        parent::__construct($context, $data);
    }
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom Pagination'));
        if ($this->getNotification()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getNotification()
                );
            $this->setChild('pager', $pager);
            $this->getNotification()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getNotification(){

        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        $notificationReceived = $this->jsonHelper->jsonDecode($model->getNotificationReceived());
        //model getCollection same CollectionFactory
        $collection = $this->notificationCollection->getCollection();
        $received = $collection->addFieldToSelect(['entity_id','created_at','short_description'])
            ->addFieldToFilter('entity_id', ['in'=>$notificationReceived]);
        $received->setPageSize($pageSize);
        $received->setCurPage($page);
        return $received;
    }
    public function getMyNotification()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getCustomer()->getId();
        $model = $this->customerFactory->create()->load($customerId);
        $notificationReceived = $this->jsonHelper->jsonDecode($model->getNotificationReceived());
        $collectionReceived = $this->notificationCollectionFactory->create();
        $received = $collectionReceived->addFieldToSelect(['entity_id','created_at','short_description'])
            ->addFieldToFilter('entity_id', ['in'=>$notificationReceived]);
        $received->setPageSize($pageSize);
        $received->setCurPage($page);
        $dataReceived = $model->getNotificationViewed();
        if(!$dataReceived) {
            $dataReceived = $this->jsonHelper->jsonEncode([]);
        }
        $notificationViewed = $this->jsonHelper->jsonDecode($dataReceived);
        $option = array( "received" => $received->getData(),"seen" => $notificationViewed);
        return $option;
    }
}
