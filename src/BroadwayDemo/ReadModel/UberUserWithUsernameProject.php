<?php
/**
 * User: mhightower
 * Date: 2/6/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UserAccountAddedToUserEvent;

class UberUserWithUsernameProject extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    protected function applyUserAccountAddedToUserEvent(UserAccountAddedToUserEvent $event)
    {
        $readModel = $this->createReadModel($event->getUserAccount()->getUserName());
        $this->addPassword(
            $readModel,
            $event->getUserAccount()->getPassword()
        );
        $this->repository->save($readModel);
    }
    private function createReadModel($userName)
    {
        $readModel = new UberUserWithUsername($userName);
        return $readModel;
    }
    private function addPassword(UberUserWithUsername $readModel, Password $password)
    {
        $readModel->addPassword($password);
    }
}
