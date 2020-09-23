<?php


namespace Magenest\Manufacturer\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(),'1.0.6','<'))
        {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            $gamerTable = $installer->getConnection()->newTable(
                $installer->getTable('manufacturer_entity')
            )->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'Entity ID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false,
            ],
                'Name'
            )->addColumn(
                'enabled',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1, [
                'nullable' => false,
            ],
                'Enabled'
            )->addColumn(
                'address_street',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false,
            ],
                'Address Street'
            )->addColumn(
                'address_city',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100, [
                'nullable' => false,
            ],
                'Address City'
            )->addColumn(
                'address_country',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                5, [
                'nullable' => false,
            ],
                'Address country'
            )->addColumn(
                'contact_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100, [
                'nullable' => false,
            ],
                'Contact name'
            )->addColumn(
                'contact_phone',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                20, [
                'nullable' => false,
            ],
                'Contact phone'
            )->setComment('Magenest Manufacturer Table');
            $installer->getConnection()->createTable($gamerTable);
            $installer->endSetup();
        }
    }
}
