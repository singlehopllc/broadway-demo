<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\User;


use BroadwayDemo\Authentication\AddUserAccountToUser;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UberUserAccount;
use BroadwayDemo\Authentication\UserAccountAddedToUserEvent;
use BroadwayDemo\Authentication\UserAccountId;
use BroadwayDemo\Authentication\UserAccountPassword;
use BroadwayDemo\Authentication\UserId;

class AddUserAccountToUserTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_adds_an_account_to_user()
    {
        $password = UserAccountPassword::create('1234567890');
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $userAccountId = new UserAccountId('00000000-0000-0000-0000-000000000000');
        $account = new UberUserAccount(
            $userAccountId,
            123456,
            $password,
            'Acme',
            'nobody@example.com'
        );
        $this->scenario
            ->withAggregateId($userId)
            ->given([new UserCreated($userId)])
            ->when(new AddUserAccountToUser($userId, $account))
            ->then([
                new UserAccountAddedToUserEvent($userId, $account)
            ]);
    }
}
