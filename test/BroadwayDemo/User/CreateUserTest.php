<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\User;

use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UberUserAccount;
use BroadwayDemo\Authentication\UserAccountId;
use BroadwayDemo\Authentication\UserAccountPassword;
use BroadwayDemo\Authentication\UserId;

class CreateUserTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_creates_a_user()
    {
        $password = UserAccountPassword::create('1234567890');
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $this->scenario
            ->given([])
            ->when(new CreateUser(
                $userId,
                [new UberUserAccount($userAccountId, 123456, $password, 'Acme', 'nobody@acme.com')]
            ))
            ->then([
                new UserCreated($userId)
            ]);
    }
}
