<?php


namespace Magenest\Sales\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CommissionType extends AbstractSource
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
                'label'=>__('fixed')
            ],
            [
                'value'=> 2,
                'label' => __('percent')
            ]
        ];
    }
}
