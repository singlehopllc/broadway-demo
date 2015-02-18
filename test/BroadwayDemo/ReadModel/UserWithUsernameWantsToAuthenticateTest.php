<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\Testing\ReadModelTestCase;
use BroadwayDemo\Authentication\UserAccountPassword;
use BroadwayDemo\Authentication\UserId;

class UserWithUsernameWantsToAuthenticateTest extends ReadModelTestCase
{
    /** @var UserAccountPassword $password */
    protected $password;
    /**
     * {@inheritDoc}
     */
    protected function createReadModel()
    {
        $readModel = new UserWithUsernameWantsToAuthenticate(new UserId('00000000-0000-0000-0000-000000000000'));
        $readModel->addUsername('foobar');
        $this->password = UserAccountPassword::create('12345');
        $readModel->addPassword($this->password);
        return $readModel;
    }

    /**
     * @test
     */
    public function it_exposes_the_username()
    {
        $readModel = $this->createReadModel();
        $this->assertEquals('foobar', $readModel->getUserName());
    }
    /**
     * @test
     */
    public function it_exposes_the_password()
    {
        /**
         * @var UserWithUsernameWantsToAuthenticate $readModel
         */
        $readModel = $this->createReadModel();
        $password = new UserAccountPassword($this->password->getPasswordHash());
        $this->assertEquals($password, $readModel->getPassword());
    }
}
