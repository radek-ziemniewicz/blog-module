<?php

namespace Radek\Blog\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Radek\Blog\Api\Data\PostInterface;
use Radek\Blog\Model\ResourceModel\Post as PostResourceModel;

class Post extends AbstractModel implements PostInterface, IdentityInterface
{
    const CACHE_TAG = 'radek_blog_post';

    public function __construct()
    {
        $this->_init(PostResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    public function getId(): string
    {
        return $this->getData(self::POST_ID);
    }
}
