<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UserAccountPassword;
use BroadwayDemo\Authentication\UserId;

class UserWithUsernameWantsToAuthenticate implements ReadModelInterface, SerializableInterface
{
    private $userId;
    private $userName;
    /** @var Password $password */
    private $password;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $readModel = new self($data['userId']);
        $readModel->addUsername($data['userName']);
        $readModel->addPassword(new UserAccountPassword($data['passwordHash']));
        return $readModel;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'userId'       => $this->userId,
            'userName'     => $this->userName,
            'passwordHash' => $this->password->getPasswordHash()
        );
    }

    /**
     * @param string $userName
     *
     * @return $this
     */
    public function addUsername($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param Password $password
     *
     * @return $this
     */
    public function addPassword(Password $password)
    {
        $this->password = $password;
        return $this;
    }
}
