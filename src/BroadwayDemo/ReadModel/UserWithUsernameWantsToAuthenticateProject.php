<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use BroadwayDemo\Authentication\UserAccountAddedToUserEvent;
use BroadwayDemo\Authentication\UserId;
use BroadwayDemo\User\UserCreated;

class UserWithUsernameWantsToAuthenticateProject extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreated $event
     * Not making since right now
     */
    protected function applyUserCreated(UserCreated $event)
    {
        $readModel = $this->createReadModel($event->getUserId());
        $this->repository->save($readModel);
    }
    protected function applyUserAccountAddedToUserEvent(UserAccountAddedToUserEvent $event)
    {
        $readModel = $this->getReadModel($event->getUserId());
        $this->addUsername($readModel, $event->getUserAccount()->getUserName());
        $this->addPassword($readModel, $event->getUserAccount()->getPassword());
        $this->repository->save($readModel);
    }
    private function createReadModel(UserId $userId)
    {
        $readModel = new UserWithUsernameWantsToAuthenticate($userId);
        return $readModel;
    }
    private function getReadModel(UserId $userId)
    {
        $readModel = $this->repository->find($userId);
        if (null === $readModel) {
            throw new \ErrorException('No user found ' . $userId);
        }
        return $readModel;
    }
    private function addUsername(UserWithUsernameWantsToAuthenticate $readModel, $username)
    {
        $readModel->addUsername($username);
    }
    private function addPassword(UserWithUsernameWantsToAuthenticate $readModel, $password)
    {
        $readModel->addPassword($password);
    }
}
