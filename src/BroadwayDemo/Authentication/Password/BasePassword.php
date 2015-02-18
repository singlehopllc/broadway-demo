<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication\Password;

abstract class BasePassword
{
    const MINIMUM_LENGTH = 5;
    protected $passwordHashWithSalt;
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
}
