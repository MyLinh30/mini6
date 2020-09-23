<?php


namespace Magenest\Notification\Setup;


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
                $installer->getTable('promo_notification')
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
                10, [
                'nullable' => false,
            ],
                'Name Notification'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Status'
            )->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                100, [
                'nullable' => false,
                'default'=>\Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
            ],
                'Create at'
            )->addColumn(
                'short_description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Short Description'
            )->addColumn(
                'redirect_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Redirect url'
            )->setComment('Promo Notification Table');
            $installer->getConnection()->createTable($gamerTable);
            $installer->endSetup();
        }
    }
}
