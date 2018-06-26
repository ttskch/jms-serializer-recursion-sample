<?php
namespace App;

use JMS\Serializer\Annotation\MaxDepth;

class Post
{
    public $title;

    /**
     * @var User
     *
     * @MaxDepth(1)
     */
    public $user;
}
