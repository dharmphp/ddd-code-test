<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Infrastructure\Command\AddUserCommentCommand;
use Task\GetOnBoard\Infrastructure\Command\AddUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\DeleteUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\UpdateUserPostCommand;
use Task\GetOnBoard\Infrastructure\Factory\PostFactory;
use Task\GetOnBoard\Repository\CommunityRepository;

class ConversationController
{
    /**
     * @param $communityId
     * @return array
     *
     * POST
     */
    public function listAction($communityId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $posts = $community->getPosts();

        return $posts;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $text
     *
     * @return Post|null
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $text)
    {
        $conversation = PostFactory::createConversation($text);
        $addPostCommand = new AddUserPostCommand($userId, $communityId);
        $post = $addPostCommand->execute($conversation);

        return $post;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $conversationId
     * @param $text
     *
     * @return mixed
     *
     * PUT
     */
    public function updateAction($userId, $communityId, $conversationId, $text)
    {
        $updatePostCommand = new UpdateUserPostCommand($userId, $communityId);
        $post = $updatePostCommand->execute($conversationId, $text);

        return $post;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $conversationId
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $conversationId)
    {
        $deletePostCommand = new DeleteUserPostCommand($userId, $communityId);
        $deletePostCommand->execute($conversationId);

        return null;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $conversationId
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $conversationId, $text)
    {
        $addCommentCommand = new AddUserCommentCommand($userId, $communityId);
        return $addCommentCommand->execute($conversationId, $text);
    }
}
