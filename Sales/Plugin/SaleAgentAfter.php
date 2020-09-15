<?php


namespace Magenest\Sales\Plugin;


class SaleAgentAfter
{
    protected $_salesFactory;
    protected $_sessionFactory;
    public function __construct(\Magenest\Sales\Model\SaleAgentFactory $_salesFactory,\Magento\Customer\Model\SessionFactory $sessionFactory )
    {
        $this->_salesFactory = $_salesFactory;
        $this->_sessionFactory = $sessionFactory;
    }
    public function afterGetData(\Magento\Customer\Model\Customer $customer, $result)
    {
         // $customersession = $this->_sessionFactory->create();


//          if($result===1)
//          {
//              if($customer->getId()){
//                  $model = $this->_salesFactory->create();
//                  $model->load($customer->getId());
//                  if($model->getId() && $model->getIsSalesAgent())
//                  $result['firstname']= $result['Sales Agent: ' . $result['firstname']];
//                  //$data['firstname']= $data['Sales Agent: ' . $data['firstname']];
//             }
//          }
//          return $result;

          if($customer->getId()){
              $customer->setFirstname("SA");
          }
          return $result;
    }

}
