<?php

namespace Radek\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Radek\Blog\Model\ResourceModel\Post as PostResourceModel;
use Radek\Blog\Model\Post;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
