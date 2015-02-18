<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication\Password;

interface Password
{
    public function getPasswordHash($saltAndHash);
    public function verify($plaintext);
}