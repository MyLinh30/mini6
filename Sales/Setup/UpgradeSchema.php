<?php


namespace Magenest\Sales\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{


    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(),'1.0.3','<'))
        {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            $gamerTable = $installer->getConnection()->newTable(
                $installer->getTable('magenest_sales_agent')
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
                'order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'nullable' => false,
            ],
                'Order ID'
            )->addColumn(
                'order_item_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                50, [
                'nullable' => false,
            ],
                'Order Item ID'
            )->addColumn(
                'order_item_sku',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100, [
                'nullable' => false,
            ],
                'Oder Item Sku'
            )->addColumn(
                'order_item_price',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                50, [
                'nullable' => false,
            ],
                'Oder Item Price'
            )->addColumn(
                'commission_percent',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                50, [
                'nullable' => false,
            ],
                'Commission Percent'
            )->addColumn(
                'commission_value',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                50, [
                'nullable' => false,
            ],
                'Commission Value'
            )->setComment('Sales Agent Table');
            $installer->getConnection()->createTable($gamerTable);
            $installer->endSetup();
        }
    }
}
