<?php

namespace Radek\Blog\Api\Data;

interface PostInterface
{
    const POST_ID = 'id';
    const TITLE = 'title';

    /**
     * @return string
     */
    public function getTitle(): string;

    public function getId();
}
