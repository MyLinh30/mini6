<?php


namespace Magenest\Sales\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Eav\Model\Config;

class HandleSA implements ObserverInterface
{
    protected $saleFactory;
    protected $saleCollectionFactory;
    protected $customerFactory;
    protected $eavConfig;
    public function __construct(\Magenest\Sales\Model\SaleAgentFactory $saleFactory,
                                \Magenest\Sales\Model\ResourceModel\SaleAgent\CollectionFactory $saleCollectionFactory,
                                \Magento\Customer\Model\CustomerFactory $customerFactory,
                                Config $eavConfig)
    {
        $this->eavConfig = $eavConfig;
        $this->saleCollectionFactory = $saleCollectionFactory;
        $this->saleFactory = $saleFactory;
        $this->customerFactory = $customerFactory;
    }

    public function execute(Observer $observer)
    {
        $model = $this->saleFactory->create();
        $order = $observer->getEvent()->getOrder()->getData();
        foreach ($order['items'] as $item){
            $data = $item->getData();
            $result = [
                'order_id' => $data['order_id'],
                'order_item_id'=> $data['item_id'],
                'order_item_sku'=> $data['sku'],
                'order_item_price' =>$data['price'],
                'commission_percenr'=> 1,
                'commission_value'=> 1
            ];
            $model->setData($result);
            $model->save();
//            $model->load($getProductId);
//            if($model->getSalAgentId()){
//                $model->setData('order_id',10);
//                $model->setData('order_item_id',$data['product_options']['info_buyRequest']['order_item_id']);
//                $model->setData('order_item_sku',$data['product_options']['info_buyRequest']['order_item_sku']);
//                $model->setData('order_item_price',$data['product_id']);
//                $model->setData('commission_percent',2);
//                $model->setData('commission_value',10);
//                $model->save();
//            }


        }


    }
}
