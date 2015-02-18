<?php
/**
 * User: mhightower
 * Date: 2/2/15
 */

namespace BroadwayDemo\User;


use Broadway\EventSourcing\EventSourcedAggregateRoot;
use BroadwayDemo\Authentication\UserAccount;
use BroadwayDemo\Authentication\UserAccountAddedToUserEvent;
use BroadwayDemo\Authentication\UserAccountId;
use BroadwayDemo\Authentication\UserId;

/**
 * Class User
 * @package BroadwayDemo\User
 *          No Constructor
 */
class User extends EventSourcedAggregateRoot
{
    private $userId;
    private $accounts;
    /**
     * @return UserId
     */
    public function getAggregateRootId()
    {
        return $this->userId;
    }

    public static function create(UserId $userId)
    {
        $user = new self();
        $user->createdUser(new UserCreated($userId));
        return $user;
    }
    private function createdUser(UserCreated $event)
    {
        $this->apply($event);
    }
    public function addUserAccount(UserAccount $userAccount)
    {
        $this->apply(new UserAccountAddedToUserEvent($this->userId, $userAccount));
    }
    protected function applyUserAccountAddedToUserEvent(UserAccountAddedToUserEvent $event)
    {
        $userAccountId = $event->getUserAccountId();

        if (! $this->userAccountInUser($event->getUserAccount())) {
            $this->accounts[] = $event->getUserAccount();
        }
    }
    protected function applyUserCreated(UserCreated $event)
    {
        $this->userId = $event->getUserId();
        $this->accounts = [];
    }

    /**
     * @param $userAccount
     *
     * @return bool
     * @todo Check to see if this actually works, needs test
     */
    private function userAccountInUser($userAccount)
    {
        return in_array($userAccount, $this->accounts);
    }
    protected function getChildEntities()
    {
        return is_null($this->accounts) ? [] : $this->accounts ;
    }
}
