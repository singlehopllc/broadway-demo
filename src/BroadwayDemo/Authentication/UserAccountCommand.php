<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\Authentication;


abstract class UserAccountCommand
{
    private $userAccountId;

    public function __construct(UserAccountId $userAccountId)
    {
        $this->userAccountId = $userAccountId;
    }

    /**
     * @return UserId
     */
    public function getUserAccountId()
    {
        return $this->userAccountId;
    }
}
