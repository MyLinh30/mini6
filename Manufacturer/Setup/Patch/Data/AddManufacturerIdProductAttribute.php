<?php


namespace Magenest\Manufacturer\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class AddManufacturerIdProductAttribute implements DataPatchInterface
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
    )
    {
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
            \Magento\Catalog\Model\Product::ENTITY, 'manufacturer_id', [
            'type' => 'int',
            'label' => 'Manufacturer',
            'input' => 'select',
            'default' => '0',
            'user_defined' => false,
            'sort_order' => 210,
            'visible' => true,
            'source' => 'Magenest\Manufacturer\Model\Config\Source\SelectIdManufacturer',
            'position' => 500,
            'system' => 0,
            'used_in_product_form' => true,
            'used_in_product_listing' => true,
        ]);
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}



