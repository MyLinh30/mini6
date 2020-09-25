<?php


namespace Magenest\Manufacturer\Block\Adminhtml\Manufacturer\Edit;


use Magenest\Notification\Block\Adminhtml\Notification\Edit\GenericButton;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete MANUFACTURER'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this MANUFACTURER ?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('manufacturer/manufacturer/delete', ['id' => $this->getId()]);
    }
}
