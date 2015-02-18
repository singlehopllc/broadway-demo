<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\Authentication;

use BroadwayDemo\User\UserCommandHandlerTest;
use BroadwayDemo\User\UserCreated;

class AuthenticateUserTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_authenticates_user()
    {
        $username = 123456;
        $plainTextPassword = '1234567890';
        $password = UserAccountPassword::create($plainTextPassword);
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $userAccount = new UberUserAccount($userAccountId, $username, $password, 'Acme', 'nobody@example.com');
        $this->scenario
            ->given(array(
                new UserCreated($userId),
                new UserAccountAddedToUserEvent($userId, $userAccount)
            ))
            ->when(new AuthenticateUser($username, $plainTextPassword))
            ->then(array(
                new UserAuthenticatedEvent($userId)
            ));
    }
}
