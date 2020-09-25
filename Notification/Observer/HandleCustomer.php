<?php


namespace Magenest\Notification\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class HandleCustomer implements ObserverInterface
{
    protected $customerFactory;
    protected $jsonHelper;
    protected $customerCollectionFactory;
    public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory,
                                \Magento\Framework\Json\Helper\Data $jsonHelper,
                                \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory)
    {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->customerFactory = $customerFactory;
        $this->jsonHelper = $jsonHelper;
    }
    public function execute(Observer $observer)
    {
        $data = $observer->getData('notification');
        $option = [];
        $collection = $this->customerCollectionFactory->create();
        if($data['status'] == 1 ){
            foreach ($collection as $item){
                $result = $item->getData();
                $idCustomer = $result['entity_id'];
                $model = $this->customerFactory->create();
                $getCustomer = $model->load($idCustomer);
                $idNotificationCreate = $data['entity_id'];
                $dataReceive = $getCustomer->getNotificationReceived();
                if (!$dataReceive) $dataReceive = $this->jsonHelper->jsonEncode([]);
                $option = $this->jsonHelper->jsonDecode($dataReceive);
                if(!in_array($idNotificationCreate,$option)){
                    array_push($option,$idNotificationCreate);
                }
                //jsonEncode chuyen kieu dl nao do sang json
                $encodedData = $this->jsonHelper->jsonEncode($option);
                //jsonDecode chuyen dang json sang string
                //$decodeData = $this->jsonHelper->jsonDecode($encodedData);
                $getCustomer->setNotificationReceived($encodedData);
                $getCustomer->save();
            }
        }
    }
}
