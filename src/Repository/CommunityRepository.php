<?php

namespace Task\GetOnBoard\Repository;

use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\User;

class CommunityRepository
{
    private static array $communities = [];
    private static array $users = [];

    public static function getCommunity($id): Community
    {
        foreach (self::$communities as $community) {
            if ($community->id == $id) {
                return $community;
            }
        }

        return null;
    }

    public static function addCommunity(Community $community)
    {
        self::$communities[] = $community;
    }

    public static function getUser($id): User
    {
        foreach (self::$users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }

        return null;
    }

    public static function addUser(User $user)
    {
        self::$users[] = $user;
    }
}
