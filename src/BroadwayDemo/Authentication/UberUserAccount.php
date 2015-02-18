<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\Authentication;

use Broadway\EventSourcing\EventSourcedEntity;

class UberUserAccount extends EventSourcedEntity implements UserAccount
{
    private $clientId;
    private $email;
    private $password;
    private $userAccountId;

    public function __construct(UserAccountId $userAccountId, $clientId, Password $password, $company, $email)
    {
        $this->userAccountId = $userAccountId;
        $this->password = $password;
        $this->company = $company;
        $this->email = $email;
        $this->clientId = $clientId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }
    public function getUserName()
    {
        return $this->clientId;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getUserId()
    {
        return $this->clientId;
    }

    public function getUserAccountId()
    {
        return $this->userAccountId;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
