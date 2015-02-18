<?php
/**
 * User: mhightower
 * Date: 2/3/15
 */

namespace BroadwayDemo\User;


use BroadwayDemo\Authentication\UserId;

class UserCreated extends UserEvent
{
    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(new UserId($data['userId']));
    }
}
