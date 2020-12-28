<?php


namespace Task\GetOnBoard\Infrastructure\Command;


use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\User;
use Task\GetOnBoard\Repository\CommunityRepository;

class AddUserPostCommand
{
    private User $user;
    private Community $community;

    /**
     * AddUserPostCommand constructor.
     * @param string $userId
     * @param string $communityId
     */
    public function __construct(string $userId, string $communityId)
    {
        $this->user = CommunityRepository::getUser($userId);
        $this->community = CommunityRepository::getCommunity($communityId);
    }

    /**
     * @param Post $post
     * @return Post
     */
    public function execute(Post $post)
    {
        $post->setUserId($this->user->getId());
        $this->community->addPost($post);
        $this->user->addPost($post);

        return $post;
    }
}