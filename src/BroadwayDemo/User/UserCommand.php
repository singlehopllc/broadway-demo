<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\User;

use BroadwayDemo\Authentication\UserId;

abstract class UserCommand
{
    private $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
