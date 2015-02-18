<?php
/**
 * User: mhightower
 * Date: 2/2/15
 */

namespace BroadwayDemo\Authentication;


class UserAuthenticatedEvent
{
    private $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function userId()
    {
        return $this->userId;
    }
}
