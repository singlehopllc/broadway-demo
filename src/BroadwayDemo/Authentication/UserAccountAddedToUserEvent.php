<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\Authentication;


use BroadwayDemo\User\UserEvent;

class UserAccountAddedToUserEvent extends UserEvent
{
    private $userAccount;

    public function __construct(UserId $userId, UserAccount $userAccount)
    {
        parent::__construct($userId);
        $this->userAccount = $userAccount;
    }
    /**
     * @return UserAccountAddedToUserEvent The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            new UserId($data['userId']),
            new UberUserAccount(
                new UserAccountId($data['userAccountId']),
                $data['clientId'],
                new UserAccountPassword($data['passwordHash']),
                $data['company'],
                $data['email']
            )
        );
    }

    public function getUserAccountId()
    {
        return $this->userAccount->getUserAccountId();
    }
    public function getUserAccount()
    {
        return $this->userAccount;
    }
}
