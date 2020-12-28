<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Entity\ValueObjects\DomainId;

class User extends DomainId
{
    private string $username;
    private array $posts;
    private array $roles;
    private array $comments;

    public function __construct()
    {
        parent::__construct();
        $this->posts = [];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param $post
     */
    public function addPost($post): void
    {
        $this->posts[] = $post;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param $comment
     */
    public function addComment($comment): void
    {
        $this->comments[] = $comment;
    }
}
