<?php
/**
 * User: mhightower
 * Date: 2/1/15
 */

namespace BroadwayDemo\Authentication;

class AuthenticateUser
{
    private $userName;
    private $plainTextPassword;

    public function __construct($userName, $plainTextPassword)
    {
        $this->userName = $userName;
        $this->plainTextPassword = $plainTextPassword;
    }
    public function userName()
    {
        return $this->userName;
    }
    public function password()
    {
        return $this->plainTextPassword;
    }
}
