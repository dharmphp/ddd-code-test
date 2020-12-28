<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Entity\ValueObjects\DomainId;

class Community extends DomainId
{
    private $name;
    private $posts = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param $id
     * @return Post|null
     */
    public function &findPost($id)
    {
        foreach ($this->posts as &$post) {
            if ($post->id == $id) {
                return $post;
            }
        }
        return null;
    }

    /**
     * @param Post $post
     * @return Post|null
     */
    public function addPost($post)
    {
        $this->posts[] = $post;
        return $post;
    }


    /**
     * @param $id
     * @param $title
     * @param $text
     * @return mixed|null
     */
    public function updatePost($id, $title, $text)
    {
        $post = $this->findPost($id);

        // Early exit if post not found
        if($post === null) return null;

        $post->setTitle($title);
        $post->setText($text);

        return $post;
    }

    /**
     * @param $parentId
     * @param $text
     * @return Comment|null
     */
    public function addComment($parentId, $text)
    {
        $post = $this->findPost($parentId);

        // Early exit if post not found
        if($post === null) return null;


        $comment = $post->addComment($text);

        return $comment;
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $post = $this->findPost($id);

        // Early exit if post not found
        if($post === null) return;

        $post->setDeleted(true);
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        $posts = [];
        foreach ($this->posts as $post){
            if (!$post->getDeleted()) {
                $posts[] = $post;
            }
        }

        return $posts;
    }

    /**
     * @param $articleId
     * return void
     */
    public function disableCommentsForArticle($articleId): void
    {
        $post = $this->findPost($articleId);

        /*
         * Early exit if post not found
         * Or post is not Article as only article can have comments disable
         * not conversation and questions
         */

        if($post === null || $post->getType() !== Post::TYPE_ARTICLE) return null;

        $post->setCommentsAllowed(false);
    }
}
