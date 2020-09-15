<?php


namespace Magenest\Sales\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class IsSaleAgent extends AbstractSource
{

    public function getAllOptions()
    {
        return [
            [
                'value'=>null,
                'label'=>__('--Select Option--')
            ],
            [
                'value'=> 1,
                'label'=>__('Yes')
            ],
            [
                'value'=> 0,
                'label' => __('No')
            ]
        ];
        // TODO: Implement getAllOptions() method.
    }
}
