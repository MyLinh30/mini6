<?php


namespace Magenest\Notification\Setup\Patch\Data;


use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Psr\Log\LoggerInterface;

class AddNotificationReceivedCustomerAttribute implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var Config
     */
    private $eavConfig;
    /**
     * @var \Magento\Customer\Model\ResourceModel\Attribute
     */
    private $attributeResource;

    /**
     * AddPhoneAttribute constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     * @param LoggerInterface $logger
     * @param \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        LoggerInterface $logger,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->addNotificationRecievedCustomerAttribute();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function addNotificationRecievedCustomerAttribute()
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'notification_received',
            [
                'type' => 'text',
                'label' => 'Notification Received',
                'frontend'=>'',
                'input' => 'text',
                'required' => false,
                'sort_order' => 30,
                'visible' => false,
                'user_defined' => false,
                'unique' => false,
                'system' => false
            ]

        );

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'notification_received');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        $attribute->setData('used_in_forms', []);

        $this->attributeResource->save($attribute);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     *
     */
    public function revert()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
