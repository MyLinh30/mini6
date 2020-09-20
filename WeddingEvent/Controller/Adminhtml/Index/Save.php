<?php


namespace Magenest\WeddingEvent\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends \Magento\Backend\App\Action
{
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getPost();
        $model = $this->_objectManager->create('Magenest\WeddingEvent\Model\Wedding');
        $model->setData($data);
        $model->save();
        $this->_eventManager->dispatch('wedding_save_after', ['wedding'=>$model]);
        $this->messageManager->addSuccess(__('Save wedding event succesfully'));
        $this->_redirect('wed/index/index');
    }
}
