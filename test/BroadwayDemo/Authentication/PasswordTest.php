<?php
/**
 * User: mhightower
 * Date: 2/1/15
 */

namespace BroadwayDemo\Authentication;

use BroadwayDemo\Authentication\Password\PasswordFactory;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function create_password_with_plaintext()
    {
        $passwordString = 'abcd1234';
        $passwd = PasswordFactory::createPasswordUsingPlainText($passwordString);
        $this->assertTrue($passwd->verify($passwordString));

    }
    /**
     * @test
     */
    public function create_password_and_get_hash()
    {
        $passwordString = 'abcd1234';
        $hash = PasswordFactory::createPasswordUsingPlainText($passwordString);
        $passwd = PasswordFactory::createPasswordUsingSaltAndHash($hash->getPasswordHash());
        $this->assertEquals($hash->getPasswordHash(), $passwd->getPasswordHash());
    }
    /**
     * @test
     */
    public function create_password_with_hash()
    {
        $passwordString = 'abcd1234';
        $hash = PasswordFactory::createPasswordUsingPlainText($passwordString);
        $passwd = PasswordFactory::createPasswordUsingSaltAndHash($hash->getPasswordHash());
        $this->assertTrue($passwd->verify($passwordString));

    }
    /**
     * @test
     * @expectedException \BroadwayDemo\Authentication\Password\MinimumPasswordLengthException
     */
    public function minimum_character_fail_to_create_password()
    {
        $passwordString = 'ab12';
        $passwd = PasswordFactory::createPasswordUsingPlainText($passwordString);
    }
    /**
     * @test
     * @expectedException \BroadwayDemo\Authentication\password\InvalidPasswordHashException
     */
    public function minimum_character_fail_to_create_password_with_hash()
    {
        $hash = 'ab12';
        $passwd = PasswordFactory::createPasswordUsingSaltAndHash($hash);
    }
}
