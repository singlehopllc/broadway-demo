<?php
/**
 * User: mhightower
 * Date: 2/6/15
 */

namespace BroadwayDemo\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use BroadwayDemo\Authentication\Password;
use BroadwayDemo\Authentication\UserAccountPassword;

class UberUserWithUsername implements ReadModelInterface, SerializableInterface
{
    private $userName;
    /** @var Password */
    private $password;
    /**
     * @param integer $userName
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        $this->userName;
    }

    /**
     * @return UberUserWithUsername The object instance
     */
    public static function deserialize(array $data)
    {
        $readModel = new self($data['userName']);
        $readModel->addPassword(new UserAccountPassword($data['passwordHash']));
        return $readModel;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'userName'      => $this->userName,
            'passwordHash'  => $this->password->getPasswordHash()
        );
    }

    /**
     * @param Password $password
     * @return $this
     */
    public function addPassword(Password $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return Password
     */
    public function getPassword()
    {
        return $this->password;
    }
}
