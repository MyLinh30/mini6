<?php


namespace Magenest\MyLinh\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(),'1.0.10','<'))
        {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            $gamerTable = $installer->getConnection()->newTable(
                $installer->getTable('magenest_test_vendor_mylinh')
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
                'customer_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11, [
                'nullable' => false,
                'required'=> true,
            ],
                'Customer ID'
            )->addColumn(
                'first_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false,
            ],
                'First Name'
            )->addColumn(
                'last_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false,
            ],
                'Last Name'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false,
                'reqiured'=> true,
            ],
                'Email'
            )->addColumn(
                'company',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                'nullable' => true,
            ],
                'Company'
            )->addColumn(
                'phone_number',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15, [
                'nullable' => false,
            ],
                'Phone Number'
            )->addColumn(
                'fax',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                20, [
                'nullable' => false,
            ],
                'Fax'
            )->addColumn(
                'address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                'nullable' => true,
            ],
                'Address'
            )->addColumn(
                'street',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                'nullable' => true,
            ],
                'Street'
            )->addColumn(
                'country',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null, [
                'nullable' => true,
            ],
                'Country'
            )->addColumn(
                'city',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50, [
                'nullable' => false,
            ],
                'City'
            )->addColumn(
                'postcode',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                20, [
                'nullable' => false,
            ],
                'Postcode'
            )->addColumn(
                'total_sales',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11, [
                'nullable' => false,
            ],
                'Fax'
            )->setComment('Magenest Vendor Table');
            $installer->getConnection()->createTable($gamerTable);
            $installer->endSetup();
        }
        // TODO: Implement upgrade() method.
    }
}
