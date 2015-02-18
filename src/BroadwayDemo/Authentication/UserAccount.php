<?php
/**
 * User: mhightower
 * Date: 2/2/15
 */

namespace BroadwayDemo\Authentication;


interface UserAccount
{
    public function getUserAccountId();
    public function getUserName();
    public function getPassword();
}
