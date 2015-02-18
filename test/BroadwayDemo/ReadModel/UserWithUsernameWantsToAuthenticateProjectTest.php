<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\ReadModel;


use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UberUserAccount;
use BroadwayDemo\Authentication\UserAccountAddedToUserEvent;
use BroadwayDemo\Authentication\UserAccountId;
use BroadwayDemo\Authentication\UserAccountPassword;
use BroadwayDemo\Authentication\UserId;
use BroadwayDemo\User\User;
use BroadwayDemo\User\UserCreated;

class UserWithUsernameWantsToAuthenticateProjectTest extends ProjectorScenarioTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function createProjector(InMemoryRepository $repository)
    {
        return new UserWithUsernameWantsToAuthenticateProject($repository);
    }

    /**
     * @test
     */
    public function it_creates_a_read_model_on_user_created()
    {
        $userId   = new UserId('00000000-0000-0000-0000-000000000000');

        $this->scenario->given([])
            ->when(new UserCreated($userId))
            ->then(array(
                $this->createReadModel($userId)
            ));
    }
    /**
     * @test
     */
    public function it_can_find_userid_with_username()
    {
        $userId   = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $password = UserAccountPassword::create('123456');
        $clientId = '98765';
        $userAccount = new UberUserAccount($userAccountId, $clientId, $password, 'Acme', 'nobody@example.com');
        $readModel = $this->createReadModel($userId);
        $readModel->addUsername($userAccount->getUserName());
        $readModel->addPassword($userAccount->getPassword());
        $this->scenario->given([new UserCreated($userId)])
            ->when(new UserAccountAddedToUserEvent($userId, $userAccount))
            ->then(array(
                $readModel
            ));
    }

    private function createReadModel($userId)
    {
        $readModel = new UserWithUsernameWantsToAuthenticate($userId);
        return $readModel;
    }
}
