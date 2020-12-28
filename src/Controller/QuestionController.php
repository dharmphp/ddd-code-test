<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Infrastructure\Command\AddUserCommentCommand;
use Task\GetOnBoard\Infrastructure\Command\AddUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\DeleteUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\UpdateUserPostCommand;
use Task\GetOnBoard\Infrastructure\Factory\PostFactory;
use Task\GetOnBoard\Repository\CommunityRepository;

class QuestionController
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
     * @param $title
     * @param $text
     *
     * @return Post|null POST
     *
     * POST
     */
    public function createAction($userId, $communityId, $title, $text)
    {
        $question = PostFactory::createQuestion($title, $text);

        $addPostCommand = new AddUserPostCommand($userId, $communityId);
        $post = $addPostCommand->execute($question);

        return $post;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $questionId
     * @param $title
     * @param $text
     *
     * @return mixed
     *
     * PUT
     */
    public function updateAction($userId, $communityId, $questionId, $title, $text)
    {
        $updatePostCommand = new UpdateUserPostCommand($userId, $communityId);
        $post = $updatePostCommand->execute($questionId, $text, $title);

        return $post;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $questionId
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $questionId)
    {
        $deletePostCommand = new DeleteUserPostCommand($userId, $communityId);
        $deletePostCommand->execute($questionId);

        return null;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $questionId
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $questionId, $text)
    {
        $addCommentCommand = new AddUserCommentCommand($userId, $communityId);
        return $addCommentCommand->execute($questionId, $text);
    }
}
