<?php
/**
 * User: mhightower
 * Date: 2/6/15
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
use BroadwayDemo\User\UserCreated;

class UberUserWithUsernameProjectTest extends ProjectorScenarioTestCase
{
    /** @var UserAccountPassword $password */
    protected $password;
    /**
     * {@inheritDoc}
     */
    protected function createProjector(InMemoryRepository $repository)
    {
        return new UberUserWithUsernameProject($repository);
    }

    /**
     * @test
     */
    public function it_creates_a_read_model_on_addition_of_account()
    {
        $userId   = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $this->password = UserAccountPassword::create('123456');
        $clientId = '98765';
        $userAccount = new UberUserAccount($userAccountId, $clientId, $this->password, 'Acme', 'nobody@example.com');

        $this->scenario->given([])
            ->when(new UserAccountAddedToUserEvent($userId, $userAccount))
            ->then(array(
                $this->createReadModel($userAccount->getUserName())
            ));
    }
    /**
     * @test
     */
    public function it_can_find_userid_with_username()
    {
        $userId   = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $this->password = UserAccountPassword::create('123456');
        $clientId = '98765';
        $userAccount = new UberUserAccount($userAccountId, $clientId, $this->password, 'Acme', 'nobody@example.com');
        $readModel = $this->createReadModel($userAccount->getUserName());
        $readModel->addPassword($userAccount->getPassword());
        $this->scenario->given([new UserCreated($userId)])
            ->when(new UserAccountAddedToUserEvent($userId, $userAccount))
            ->then(array(
                $readModel
            ));
    }

    private function createReadModel($userName)
    {
        $readModel = new UberUserWithUsername($userName);
        $readModel->addPassword(new UserAccountPassword($this->password->getPasswordHash()));
        return $readModel;
    }
}
