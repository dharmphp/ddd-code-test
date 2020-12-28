<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Entity\ValueObjects\CommentsAllowedFlag;
use Task\GetOnBoard\Entity\ValueObjects\DeleteFlag;
use Task\GetOnBoard\Entity\ValueObjects\DomainId;
use Task\GetOnBoard\Entity\ValueObjects\PostType;

class Post extends DomainId
{
    private string $title;
    private string $text;
    private PostType $type;
    private string $userId;
    private array $comments;
    private DeleteFlag $deleted;
    private CommentsAllowedFlag $commentsAllowed;

    const TYPE_ARTICLE      = 'article';
    const TYPE_CONVERSATION = 'conversation';
    const TYPE_QUESTION     = 'question';

    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->deleted = new DeleteFlag(false);
        $this->commentsAllowed = new CommentsAllowedFlag(true);
        $this->comments = [];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type->getType();
    }

    /**
     * @param PostType $type
     */
    public function setType(PostType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param $text
     * @return Comment
     */
    public function addComment($text)
    {
        $comment = new Comment();
        $comment->setText($text);

        $this->comments[] = $comment;

        return $comment;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param DeleteFlag $deleted
     */
    public function setDeleted(DeleteFlag $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function isCommentsAllowed(): bool
    {
        return $this->commentsAllowed->getCommentsAllowed();
    }

    /**
     * @param CommentsAllowedFlag $commentsAllowed
     * @return null
     */
    public function setCommentsAllowed(CommentsAllowedFlag $commentsAllowed)
    {

        /*
         * Removed code to solve the bug (If we disable commenting for an article, we end up deleting all comments from the article.)
         *
        if (!$commentsAllowed) {
            $this->comments = [];
        }
        */

        $this->commentsAllowed = $commentsAllowed;
    }
}
