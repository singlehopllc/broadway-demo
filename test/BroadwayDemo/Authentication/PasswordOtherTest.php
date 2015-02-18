<?php
/**
 * User: mhightower
 * Date: 2/1/15
 */

namespace BroadwayDemo\Authentication;

class PasswordOtherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function create_password_with_plaintext()
    {
        $passwordString = 'abcd1234';
        $passwd = UserAccountPassword::create($passwordString);
        $this->assertTrue($passwd->verify($passwordString));

    }

    /**
     * @test
     */
    public function create_password_and_get_hash()
    {
        $passwordString = 'abcd1234';
        $passwd = UserAccountPassword::create($passwordString);
        $this->assertNotEmpty($passwd->getPasswordHash());
    }

    /**
     * @test
     * @expectedException \BroadwayDemo\Authentication\Password\MinimumPasswordLengthException
     */
    public function minimum_character_fail_to_create_password()
    {
        $passwordString = 'ab12';
        $passwd = UserAccountPassword::create($passwordString);
    }
    /**
     * @test
     * @expectedException \BroadwayDemo\Authentication\password\InvalidPasswordHashException
     */
    public function minimum_character_fail_to_create_password_with_hash()
    {
        $hash = 'ab12';
        $passwd = new UserAccountPassword($hash);
    }
}
