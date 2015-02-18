<?php
/**
 * User: mhightower
 * Date: 2/10/15
 */

namespace BroadwayDemo\Authentication;

use Broadway\EventSourcing\EventSourcedEntity;

class LocalUserAccount extends EventSourcedEntity implements UserAccount
{

    public function getUserAccountId()
    {
        // TODO: Implement getUserAccountId() method.
    }

    public function getUserName()
    {
        // TODO: Implement getUserName() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }
}
