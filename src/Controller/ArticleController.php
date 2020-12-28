<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Infrastructure\Command\AddUserCommentCommand;
use Task\GetOnBoard\Infrastructure\Command\AddUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\DeleteUserPostCommand;
use Task\GetOnBoard\Infrastructure\Command\UpdateUserPostCommand;
use Task\GetOnBoard\Infrastructure\Factory\PostFactory;
use Task\GetOnBoard\Repository\CommunityRepository;

class ArticleController
{
    /**
     * @param $communityId
     * @return array
     *
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
        $article = PostFactory::createArticle($title, $text);
        $addPostCommand = new AddUserPostCommand($userId, $communityId);
        return $addPostCommand->execute($article);
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $articleId
     * @param $title
     * @param $text
     *
     * @return mixed
     *
     * PUT
     */
    public function updateAction($userId, $communityId, $articleId, $title, $text)
    {
        $updatePostCommand = new UpdateUserPostCommand($userId, $communityId);
        return $updatePostCommand->execute($articleId, $text, $title);
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $articleId
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $articleId)
    {
        $deletePostCommand = new DeleteUserPostCommand($userId, $communityId);
        $deletePostCommand->execute($articleId);

        return null;
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $articleId
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $articleId, $text)
    {
        $addCommentCommand = new AddUserCommentCommand($userId, $communityId);
        return $addCommentCommand->execute($articleId, $text);
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH
     */
    public function disableCommentsAction($communityId, $articleId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $community->disableCommentsForArticle($articleId);
    }
}
