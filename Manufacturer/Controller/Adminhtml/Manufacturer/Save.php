<?php


namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;


use Magenest\Manufacturer\Model\ResourceModel\Manufacturer\Collection;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $_manufacturerFactory;
    public function __construct(Action\Context $context,
                                \Magenest\Manufacturer\Model\ManufacturerFactory $manufacturerFactory)
    {
        $this->_manufacturerFactory = $manufacturerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->_objectManager->create('Magenest\Manufacturer\Model\Manufacturer');
        $model->setData($data);
        $model->save();
        $this->messageManager->addSuccess(__('Save thanh cong'));
        return $this->_redirect('manufacturer/manufacturer/index');

//        $model = $this->_manufacturerFactory->create()->load($data['entity_id']);
//        $model->setName($data['name']);
//        if(isset($data['enabled'])){
//            $model->setEnabled(1);
//        }else {
//            $model->setEnabled(0);
//        }
//        $model->setAddressStreet($data['address_street']);
//        $model->setAddressCity($data['address_city']);
//        $model->setAddressCountry($data['address_country']);
//        $model->setContactName($data['contact_name']);
//        $model->setContactPhone($data['contact_phone']);
//        $model->save();
//        $this->messageManager->addSuccess(__('ADD SUCCESS!'));
////        $page = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
////        return $page->setPath('*/*/');
//        $this->_redirect('manufacturer/manufacturer/index');
    }
}
