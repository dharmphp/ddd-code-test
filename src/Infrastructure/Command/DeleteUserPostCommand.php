<?php


namespace Task\GetOnBoard\Infrastructure\Command;


use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\User;
use Task\GetOnBoard\Repository\CommunityRepository;

class DeleteUserPostCommand
{
    private User $user;
    private Community $community;

    /**
     * DeleteUserPostCommand constructor.
     * @param string $userId
     * @param string $communityId
     */
    public function __construct(string $userId, string $communityId)
    {
        $this->user = CommunityRepository::getUser($userId);
        $this->community = CommunityRepository::getCommunity($communityId);
    }

    /**
     * @param string $postId
     * @return Post
     */
    public function execute(string $postId)
    {

        $post = $this->community->findPost($postId);

        if($post->getUserId() == $this->user->getId()) {
            return $this->community->deletePost($postId);
        }

        return null;
    }
}