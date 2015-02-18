<?php
/**
 * User: mhightower
 * Date: 2/2/15
 */

namespace BroadwayDemo\User;

use Broadway\CommandHandling\CommandHandler;
use Broadway\ReadModel\InMemory\InMemoryRepository;
use BroadwayDemo\Authentication\AddUserAccountToUser;
use BroadwayDemo\Authentication\AuthenticateUser;
use BroadwayDemo\ReadModel\UberUserWithUsernameProject;

class UserCommandHandler extends CommandHandler
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AuthenticateUser $command
     * @todo Incomplete
     */
    public function handleAuthenticateUser(AuthenticateUser $command)
    {
        $this->repository->load($userid);
    }
    public function handleCreateUser(CreateUser $command)
    {
        $user = User::create($command->getUserId());
        $this->repository->add($user);
    }
    public function handleAddUserAccountToUser(AddUserAccountToUser $command)
    {
        /**
         * @var User $user
         */
        $user = $this->repository->load($command->getUserId());
        $user->addUserAccount($command->getAccount());
        $this->repository->add($user);
    }
}
