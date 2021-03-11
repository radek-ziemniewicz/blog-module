<?php

namespace Radek\Blog\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // Start setup.
        $setup->startSetup();
        $data = [];

        // Data.
        $table = $setup->getTable(InstallSchema::POSTS_TABLE);
        $columns = ['title', 'content', 'created_at', 'updated_at'];
        $data[] = ['First post', "Here's content of the first post", '2021-03-11 17:00:00', '2021-03-11 17:00:00'];
        $data[] = ['Second post', "Here's content of the second post", '2021-03-11 17:00:00', '2021-03-11 17:00:00'];

        // Insert and end setup.
        $setup->getConnection()->insertArray($table, $columns, $data);
        $setup->endSetup();
    }
}
