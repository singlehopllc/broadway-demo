<?php
/**
 * User: mhightower
 * Date: 2/10/15
 */

namespace BroadwayDemo\Authentication;

use Broadway\ReadModel\RepositoryInterface;

class DefaultEncryptionLogin implements Authenticate
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function execute($userIdentifier, $password)
    {
        $user = $this->repository->findBy(['userName' => $userIdentifier]);
        return $this->isValidPassword($user->getUserAccount->getPassword(), $password);
    }
    private function isValidPassword($hash, $password)
    {
        return password_verify($password, $hash);
    }
}
