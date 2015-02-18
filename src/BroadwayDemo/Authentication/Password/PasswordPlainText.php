<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication\Password;

class PasswordPlainText extends BasePassword
{
    public function __construct($plainText)
    {
        $passwordSize = mb_strlen($plainText);
        /*Assert::minLength(
            $password,
            self::MINIMUM_LENGTH,
            'Password size is '
            . $passwordSize
            . ', minimum password size is '
            . self::MINIMUM_LENGTH
        );*/
        if (mb_strlen($plainText) < self::MINIMUM_LENGTH) {
            throw new MinimumPasswordLengthException(
                'Password size is '
                . $passwordSize
                . ', minimum password size is '
                . self::MINIMUM_LENGTH,
                100
            );
        }
        $this->passwordHashWithSalt = $this->hashOf($plainText);
    }
    private function hashOf($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
