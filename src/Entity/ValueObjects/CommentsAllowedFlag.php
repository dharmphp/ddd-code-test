<?php


namespace Task\GetOnBoard\Entity\ValueObjects;


class CommentsAllowedFlag
{
    private bool $commentsAllowed;

    /**
     * DeleteFlag constructor.
     * @param bool $commentsAllowed
     */
    public function __construct($commentsAllowed = false)
    {
        $this->commentsAllowed =  $commentsAllowed;
    }

    public function getCommentsAllowed()
    {
        return $this->commentsAllowed;
    }

    /**
     * @param bool $commentsAllowed
     */
    public function setCommentsAllowed(bool $commentsAllowed): void
    {
        $this->commentsAllowed = $commentsAllowed;
    }

}