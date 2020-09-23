<?php


namespace Magenest\Notification\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Option\ArrayInterface;

class GetIdNotification extends AbstractSource
{
    protected $notificatioCollectionFactory;
    public function __construct(\Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory $notificatioCollectionFactory)
    {
        $this->notificatioCollectionFactory = $notificatioCollectionFactory;
    }

    public function getAllOptions()
    {
//        $collection = $this->notificatioCollectionFactory->create();
//        $options[] = ['value'=> null, 'label'=> __('Select option')];
//        $allCollection = $collection->addFieldToSelect('status');
//        foreach($allCollection as $item){
//            $item[] = ['value'=> ]
//        }
//        // TODO: Implement getAllOptions() method.
    }
}
