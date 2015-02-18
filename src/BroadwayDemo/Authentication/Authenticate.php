<?php
/**
 * User: mhightower
 * Date: 2/10/15
 */

namespace BroadwayDemo\Authentication;

interface Authenticate
{
    public function execute($userIdentifier, $password);
}
