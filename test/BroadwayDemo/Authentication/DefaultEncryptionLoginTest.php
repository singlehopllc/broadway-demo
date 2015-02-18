<?php
/**
 * User: mhightower
 * Date: 2/10/15
 */

namespace BroadwayDemo\Authentication;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Testing\ReadModelTestCase;
use Broadway\ReadModel\Testing\Scenario;
use BroadwayDemo\ReadModel\UberUserWithUsername;
use BroadwayDemo\ReadModel\UberUserWithUsernameProject;
use BroadwayDemo\User\User;

class DefaultEncryptionLoginTest extends ReadModelTestCase
{
    private $password;
    private $username;

    public function setUp()
    {
        $this->password = UserAccountPassword::create('foobar');
        $this->username = 123456;
    }
    /**
     * @test
     */
    public function it_should_validate_password()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $user = User::create($userId);
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $this->password = UserAccountPassword::create('foobar');
        $this->username = 123456;
        $userAccount = new UberUserAccount($userAccountId, $this->username, $this->password, 'Acme', 'nobody@example.com');
        $user->addUserAccount($userAccount);
        $repository = new InMemoryRepository();
        $project = $this->createProjector($repository);
        $scenario = new Scenario($this, $repository, $project);
        $login = new DefaultEncryptionLogin($repository);
        $login->execute($this->username, 'foobar');

    }
    /**
     * {@inheritDoc}
     */
    protected function createProjector(InMemoryRepository $repository)
    {
        return new UberUserWithUsernameProject($repository);
    }

    protected function createReadModel()
    {
        $readModel = new UberUserWithUsername($this->username);
        $readModel->addPassword($this->password);
        return $readModel;
    }
}
