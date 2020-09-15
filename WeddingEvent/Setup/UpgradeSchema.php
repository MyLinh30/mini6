<?php


namespace Magenest\WeddingEvent\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(),'1.0.4','<'))
        {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            $gamerTable = $installer->getConnection()->newTable(
                $installer->getTable('magenest_wedding_event')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'ID'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Title'
            )->addColumn(
                'commission',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Commission'
            )->addColumn(
                'bride_firstname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100, [
                'nullable' => false,
            ],
                'Bride Firstname'
            )->addColumn(
                'bride_lastname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Bride Lastname'
            )->addColumn(
                'bride_email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Bride Email'
            )->addColumn(
                'sent_to_bride',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Sent to Bride'
            )->addColumn(
                'groom_firstname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100, [
                'nullable' => false,
            ],
                'Groom Firstname'
            )->addColumn(
                'groom_lastname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Groom Lastname'
            )->addColumn(
                'groom_email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Groom Email'
            )->addColumn(
                'sent_to_groom',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Sent to Groom'
            )->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'Message'
            )->setComment('Wedding Event Table');
            $installer->getConnection()->createTable($gamerTable);
            $installer->endSetup();
        }
    }
}
