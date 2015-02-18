<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\User;


use Broadway\Serializer\SerializableInterface;
use BroadwayDemo\Authentication\UserId;

abstract class UserEvent implements SerializableInterface
{
    private $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return array('userId' => (string) $this->userId);
    }
}
