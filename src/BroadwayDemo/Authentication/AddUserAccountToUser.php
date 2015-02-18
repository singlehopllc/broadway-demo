<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\Authentication;

use BroadwayDemo\User\UserCommand;

class AddUserAccountToUser extends UserCommand
{
    private $account;

    public function __construct(UserId $userId, UserAccount $account)
    {
        parent::__construct($userId);
        $this->account = $account;
    }
    public function getAccount()
    {
        return $this->account;
    }
}
