<?php
/**
 * User: mhightower
 * Date: 2/4/15
 */

namespace BroadwayDemo\Authentication;

use Assert\Assertion as Assert;

class UserAccountId
{
    private $identifier;
    public function __construct($identifier)
    {
        Assert::string($identifier);
        Assert::uuid($identifier);
        $this->identifier = $identifier;
    }

    public function __toString()
    {
        return (string) $this->identifier;
    }
}
