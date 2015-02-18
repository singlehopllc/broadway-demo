<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\Authentication;

use Broadway\Serializer\SerializableInterface;

abstract class UserAccountEvent implements SerializableInterface
{
    private $userAccountId;

    public function __construct(UserAccountId $userAccountId)
    {
        $this->userAccountId = $userAccountId;
    }

    /**
     * @return UserAccountId
     */
    public function getUserAccountId()
    {
        return $this->userAccountId;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return array('userAccountId' => (string) $this->userAccountId);
    }
}
