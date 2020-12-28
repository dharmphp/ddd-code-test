<?php


namespace Task\GetOnBoard\Infrastructure\Command;


use Task\GetOnBoard\Entity\Comment;
use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\User;
use Task\GetOnBoard\Repository\CommunityRepository;

class AddUserCommentCommand
{
    private User $user;
    private Community $community;

    /**
     * AddUserCommentCommand constructor.
     * @param string $userId
     * @param string $communityId
     */
    public function __construct(string $userId, string $communityId)
    {
        $this->user = CommunityRepository::getUser($userId);
        $this->community = CommunityRepository::getCommunity($communityId);
    }

    /**
     * @param $postId
     * @param $commentText
     * @return Comment
     */
    public function execute($postId, $commentText)
    {
        $comment = $this->community->addComment($postId, $commentText);
        $this->user->addComment($comment);

        return $comment;
    }
}