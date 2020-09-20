<?php


namespace Magenest\Movie\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();


        // create magenest_actor table
        $actorTable = $installer->getConnection()->newTable(
            $installer->getTable('magenest_actor')
        )->addColumn(
            'actor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
            ' Actor ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null, [
            'nullable' => false,
        ],
            'Actor Name'
        )->setComment('Magenest Actor Table');


        // create magenest_director table
        $directorTable = $installer->getConnection()->newTable(
            $installer->getTable('magenest_director')
        )->addColumn(
            'director_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
            ' Actor ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null, [
            'nullable' => false,
        ],
            'Actor name'
        )->setComment('Magenest Director Table');


        // crate magenest_movie table
        $movieTable = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie')
        )->addColumn(
            'movie_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
            ' Movie ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false,],
            'Movie name'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Movie description'
        )->addColumn(
            'rating',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['default' => 0],
            'Movie rating'
        )->addColumn(
            'director_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
                'unsigned' => true,
            ],
            'Movie director ID'
        )->addForeignKey(
            $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
            'director_id',
            $installer->getTable('magenest_director'), 'director_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment('Magenest Movie Table');

        //crate magenest_movie_actor table
        $movieActorTable = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie_actor')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
            ' id'
        )
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'nullable' => false,
                'unsigned' => true
            ],
                ' Actor id'
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Movie id'
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'actor_id',
                $installer->getTable('magenest_actor'), 'actor_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'movie_id',
                $installer->getTable('magenest_movie'), 'movie_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($actorTable);
        $installer->getConnection()->createTable($directorTable);
        $installer->getConnection()->createTable($movieTable);
        $installer->getConnection()->createTable($movieActorTable);
        $installer->endSetup();
    }

}
