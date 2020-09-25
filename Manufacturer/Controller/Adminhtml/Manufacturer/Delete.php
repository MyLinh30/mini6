<?php


namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Delete extends \Magento\Backend\App\Action
{
    protected $manufacturerFactory;
    public function __construct(Action\Context $context,
                                \Magenest\Manufacturer\Model\ManufacturerFactory $manufacturerFactory)
    {
        $this->manufacturerFactory = $manufacturerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->manufacturerFactory->create()->load($id);
        $model->delete();
        $this->messageManager->addSuccess('Delete MANUFACTURER SUCCESS!');
        $this->_redirect('manufacturer/manufacturer/index');

    }
}
