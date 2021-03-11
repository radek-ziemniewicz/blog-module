<?php

declare(strict_types=1);

namespace Radek\Blog\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Primary key options for column.
     *
     * @var array
     */
    const PRIMARY_OPTS = [
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ];

    /**
     * @var string
     */
    const POSTS_TABLE = 'radek_blog_posts';

    /**
     * @var string
     */
    const COMMENTS_TABLE = 'radek_blog_comments';

    /**
     * {@inheritDoc}
     *
     * @throws Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createPostTable($setup);
        $this->createCommentsTable($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     *
     * @throws Zend_Db_Exception
     */
    private function createPostTable(SchemaSetupInterface $setup): void
    {
        if ($setup->tableExists(self::POSTS_TABLE)) {
            return;
        };

        $table = $setup->getConnection()
            ->newTable(
                $setup->getTable(self::POSTS_TABLE)
            )
            ->addColumn('id', Table::TYPE_INTEGER, null, self::PRIMARY_OPTS, 'Primary key')
            ->addColumn('title', Table::TYPE_TEXT, 255, [], 'Post title')
            ->addColumn('content', Table::TYPE_TEXT, null, [], 'Post content')
            ->addColumn('created_at', Table::TYPE_DATETIME)
            ->addColumn('updated_at', Table::TYPE_DATETIME)
            ->setComment('Blog posts')
        ;

        $setup->getConnection()->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $setup
     *
     * @throws Zend_Db_Exception
     */
    private function createCommentsTable(SchemaSetupInterface $setup): void
    {
        if ($setup->tableExists(self::COMMENTS_TABLE)) {
            return;
        };

        $table = $setup->getConnection()
            ->newTable(
                $setup->getTable(self::COMMENTS_TABLE)
            )
            ->addColumn('id', Table::TYPE_INTEGER, null, self::PRIMARY_OPTS, 'Primary key')
            ->addColumn('post_id', Table::TYPE_INTEGER)
            ->addColumn('content', Table::TYPE_TEXT, null, [], 'Comment content')
            ->addColumn('created_at', Table::TYPE_DATETIME)
            ->addColumn('updated_at', Table::TYPE_DATETIME)
            ->setComment('Blog comments')
            ->addIndex(
                $setup->getIdxName(self::COMMENTS_TABLE, ['post_id']),
                ['post_id']
            )
        ;

        $setup->getConnection()->createTable($table);
    }
}
