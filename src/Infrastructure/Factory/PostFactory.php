<?php

namespace Task\GetOnBoard\Infrastructure\Factory;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\ValueObjects\PostType;

class PostFactory
{
    /**
     * @param $title
     * @param $text
     *
     * @return Post|null
     */

    public static function createPost($text, $title = '')
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setText($text);
        return $post;
    }
    /**
     * @param $title
     * @param $text
     *
     * @return Post|null
     */
    public static function createArticle($title, $text): Post
    {
        $post = self::createPost($text, $title);
        $post->setType( new PostType(Post::TYPE_ARTICLE));
        return $post;
    }

    /**
     * @param $title
     * @param $text
     *
     * @return Post|null
     */
    public static function createQuestion($title, $text): Post
    {
        $post = self::createPost($text, $title);
        $post->setType( new PostType(Post::TYPE_QUESTION));
        return $post;
    }

    /**
     * @param $text
     *
     * @return Post|null
     */
    public static function createConversation($text): Post
    {
        $post = self::createPost($text);
        $post->setType( new PostType(Post::TYPE_CONVERSATION));
        return $post;
    }

}
