<?php


namespace Magenest\Sales\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;

class AddCommissionPercentProuctAttribute implements DataPatchInterface
{

    private $moduleDataSetup;
    private $eavSetupFactory;
    protected $attributeSetFactory;

    /**
     * DataCustomerAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $setup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $setup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY, 'commission_type', [
            'type' => 'int',
            'label' => 'Commission type',
            'input' => 'select',
             'source'=> 'Magenest\Sales\Model\Config\Source\CommissionType',            'user_defined' => false,
            'sort_order' => 210,
            'visible' => true,
            'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'position' => 600,
            'system' => 0,
            'used_in_product_form' => true,
            'used_in_product_listing' => true,
        ]);
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}


