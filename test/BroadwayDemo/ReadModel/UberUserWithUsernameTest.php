<?php
/**
 * User: mhightower
 * Date: 2/6/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\Testing\ReadModelTestCase;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UserAccountPassword;

class UberUserWithUsernameTest extends ReadModelTestCase
{
    /** @var Password $password */
    protected $password;
    /**
     * {@inheritDoc}
     */
    protected function createReadModel()
    {
        $readModel = new UberUserWithUsername(123445);
        $this->password = UserAccountPassword::create('12345');
        $readModel->addPassword($this->password);
        return $readModel;
    }

    /**
     * @test
     */
    public function it_exposes_the_password_hash()
    {
        $readModel = $this->createReadModel();
        $this->assertEquals($this->password->getPasswordHash(), $readModel->getPassword()->getPasswordHash());
    }
}
