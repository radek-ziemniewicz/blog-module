<?php

namespace Radek\Blog\Block;

use Magento\Framework\View\Element\Template;
use Radek\Blog\Model\Post;
use Radek\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class Posts extends Template
{
    /**
     * @var PostCollectionFactory
     */
    private PostCollectionFactory $factory;

    /**
     * @param Template\Context $context
     * @param PostCollectionFactory $factory
     * @param array $data
     */
    public function __construct(Template\Context $context, PostCollectionFactory $factory, array $data = [])
    {
        $this->factory = $factory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        $postCollection = $this->factory->create();
        $postCollection->addFieldToSelect('*')->load();

        return $postCollection->getItems();
    }

    /**
     * @param Post $post
     *
     * @return string
     */
    public function getPostUrl(Post $post): string
    {
        return'/blog/post/view/id/' . $post->getId();
    }

    /**
     * @param Post $post
     *
     * @return string
     */
    public function getEditPostUrl(Post $post): string
    {
        return'/pub/admin/blog/post/edit/id/' . $post->getId();
    }
}
