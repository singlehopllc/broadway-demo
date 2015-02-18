<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication;

use BroadwayDemo\Authentication\Password\InvalidPasswordHashException;
use BroadwayDemo\Authentication\Password\MinimumPasswordLengthException;

class UserAccountPassword implements Password
{
    const MINIMUM_LENGTH = 5;
    protected $passwordHashWithSalt;

    /**
     * @param string $saltAndHash
     */
    public function __construct($saltAndHash)
    {
        if (!$this->validHash($saltAndHash)) {
            throw new InvalidPasswordHashException();
        }
        $this->passwordHashWithSalt = $saltAndHash;
    }

    /**
     * @param string $plainText
     *
     * @return \BroadwayDemo\Authentication\Password
     */
    public static function create($plainText)
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
        $saltAndHash = self::hashOf($plainText);
        return new self($saltAndHash);
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->passwordHashWithSalt;
    }
    public function __toString()
    {
        return str_repeat('X', strlen($this->getPasswordHash()));
    }
    /**
     * @param string $plainText
     *
     * @return bool
     */
    public function verify($plainText)
    {
        return password_verify($plainText, $this->passwordHashWithSalt);
    }

    /**
     * @param $hash
     *
     * @return bool
     */
    private function validHash($hash)
    {
        $foo = password_get_info($hash);
        return $foo['algoName'] === 'unknown' ? false : true;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    public static function hashOf($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
