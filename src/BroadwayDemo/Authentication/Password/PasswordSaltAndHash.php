<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication\Password;

class PasswordSaltAndHash extends BasePassword
{
    public function __construct($hash)
    {
        if (!$this->validHash($hash)) {
            throw new InvalidPasswordHashException();
        }
        $this->passwordHashWithSalt = $hash;
    }
    private function validHash($hash)
    {
        $info = password_get_info($hash);
        return $info['algoName'] === 'unknown' ? false : true;
    }
}
