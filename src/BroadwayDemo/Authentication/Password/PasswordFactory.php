<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication\Password;

class PasswordFactory
{
    public static function createPasswordUsingPlainText($plaintext)
    {
        return new PasswordPlainText($plaintext);
    }
    public static function createPasswordUsingSaltAndHash($saltAndHash)
    {
        return new PasswordSaltAndHash($saltAndHash);
    }
}
